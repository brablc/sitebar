<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software: you can redistribute it and/or modify      *
 *  it under the terms of the GNU Affero General Public License as published  *
 *  by the Free Software Foundation, either version 3 of the License, or      *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU Affero General Public License for more details.                       *
 *                                                                            *
 *  You should have received a copy of the GNU Affero General Public License  *
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 ******************************************************************************/

require_once('./inc/database.inc.php');
require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');

define ('SB_ADMIN',  1);
define ('SB_ANONYM', 2);
define ('SB_ADMIN_GROUP',  1);

class SB_UserManager extends SB_ErrorHandler
{
    var $user = null;

    var $config;
    var $useCookies = true;
    var $setupDone;
    var $showEmail = false;
    var $db;
    var $plugins = array(); // plugin cache
    var $pluginPaths = array();

    var $uid;
    var $username;
    var $name;
    var $email;
    var $comment;
    var $verified;
    var $approved;
    var $demo;
    var $params = array('config'=>array(),'user'=>array());
    var $hiddenFolders = array();

    function __construct()
    {
        $this->db =& SB_Database::staticInstance();

        /* Read SiteBar configuration - must be the first step ! */
        if ($this->db->hasTable('sitebar_config'))
        {
            $rset = $this->db->select(null, 'sitebar_config');
            $this->config = $this->db->fetchRecord($rset);
        }
        else
        {
            $this->config['release'] = '';
        }

        if ($this->db->currentRelease() != $this->config['release'])
        {
            header('Location: config.php');
            exit;
        }

        $this->explodeParams($this->config['params'],'config');

        $this->loadPlugins();

        /* Check whether Admin has password if not we will run setup */
        $rset = $this->db->select(null, 'sitebar_user',
            array( 'uid'=> SB_ADMIN, '^1'=> 'AND', 'pass'=>null));

        $this->setupDone = ($this->db->fetchRecord($rset)===false);

        $anonym = $this->getUser(SB_ANONYM);
        $this->explodeParams($anonym['params'],'default');

        if (!$this->isLogged())
        {
            if (!$anonym)
            {
                $this->error('Database corrupted - missing anonymous account!');
            }
            else
            {
                $this->initUser($anonym);
                unset($this->user['pass']); // Security
            }
        }

        $lang = $this->getParam('user','lang');

        if (!$lang)
        {
            $l =& SB_Localizer::staticInstance();
            $browserLang = $l->getBrowserLang();
            if (!$this->getParam('config','lang'))
            {
                $this->setParam('config','lang',$l->langDefault);
            }
            $lang = $browserLang?$browserLang:$this->getParam('config','lang');
            $this->setParam('user','lang',$lang);
        }

        // Set our language
        SB_SetLanguage($lang);

        // Check if we have plugin that changes rights
        foreach ($this->plugins as $plugin)
        {
            $execute = $plugin['prefix'].'Init';
            if (function_exists($execute))
            {
                $execute($this);
            }
        }
    }

    function statistics(&$data)
    {
        $rset = $this->db->select('count(*) count', 'sitebar_user');
        $rec = $this->db->fetchRecord($rset);
        $data['users'] = $rec['count']-1;
        $rset = $this->db->select('count(*) count', 'sitebar_group');
        $rec = $this->db->fetchRecord($rset);
        $data['groups'] = $rec['count'];
    }

    public static function & staticInstance()
    {
        static $um;

        if (!$um)
        {
            // Here we give chance to the plugins to change any aspect of this
            // class, be creating an ascendant class.

            $count = 0;
            $dirName = "./plugins";
            $classes = '';

            if (is_dir($dirName) && ($dir = opendir($dirName)))
            {
                while (($plugin = readdir($dir)) !== false)
                {
                    $plugdir = $dirName.'/'.$plugin;
                    $umclass = $plugdir.'/usermanager.inc.php';

                    if (!is_dir($plugdir) || !is_file($umclass))
                    {
                        continue;
                    }

                    $fp = fopen($umclass, "r");

                    if (!$fp)
                    {
                        die("Cannot open existing file $umclass!");
                    }

                    $count++;

                    $skip = 1;
                    while ( !feof($fp) )
                    {
                        $buffer = fgets($fp, 4096);
                        if (strpos($buffer, 'class')===0)
                        {
                            # Eat {
                            fgets($fp, 4096);
                            $skip = 0;
                            $sub = "SB_UserManager$count";
                            $sup = ($count>1?'SB_UserManager'.($count-1):'SB_UserManager');
                            $classes .= "class $sub extends $sup\n{\n";
                            $classes .= "    function __construct() { parent::__construct(); }\n";
                            continue;
                        }

                        if ($skip)
                        {
                            continue;
                        }

                        $classes .= $buffer;

                    }
                    fclose($fp);
                }
                closedir($dir);
            }

            if ($count)
            {
                // echo("<pre>$classes</pre>");
                eval($classes);
                eval("\$um = new SB_UserManager$count();");
            }
            else
            {
                $um = new SB_UserManager();
            }
        }

        return $um;
    }

    function initUser(&$rec)
    {
        $this->user = $rec;
        $this->uid = $rec['uid'];
        $this->username = $rec['username'];
        $this->email = $rec['email'];
        $this->name = SB_safeVal($rec,'name');
        $this->comment = SB_safeVal($rec,'comment');
        $this->verified = $rec['verified'];
        $this->approved = $rec['approved'];
        $this->demo = $rec['demo'];
        $this->explodeParams($rec['params'],'user');

        if ($this->getParam('user','use_hiding') && $this->getParam('user','hidden_folders'))
        {
            $ids = explode(':',$this->getParam('user','hidden_folders'));
            $this->hiddenFolders = array();
            foreach ($ids as $id)
            {
                $this->hiddenFolders[$id] = 1;
            }
        }
    }

    function setCookie($name, $value='', $expires=null, $httponly=false)
    {
        if (!$this->useCookies)
        {
            return;
        }

        if ($expires===null)
        {
            // Default expiration 7 days
            $expires = time()+60*60*24*7;
        }

        if (!$value)
        {
            // Remove now
            $expires = time()-60*60;
        }

        if (version_compare(PHP_VERSION, "5.2.0", ">="))
        {
            // set HttpOnly if PHP supports it
            setcookie($name, $value, $expires, "/", "", isset($_SERVER["HTTPS"]), $httponly);
        }
        else
        {
            setcookie($name, $value, $expires, "/", "", isset($_SERVER["HTTPS"]));
        }
        $_COOKIE[$name] = $value;
    }

    function explodeParams(&$params, $prefix)
    {
        $default = array();

        switch ($prefix)
        {
            case 'config':
                $default['auth']='';
                $default['allow_contact']=1;
                $default['allow_sign_up']=1;
                $default['allow_user_groups']=0;
                $default['allow_user_trees']=1;
                $default['allow_user_tree_deletion']=1;
                $default['allow_anonymous_export']=1;
                $default['default_groups']='Family|Friends|Public';
                $default['public_groups']='Public';
                $default['max_session_time']=60*60*24*365; // 1 year
                $default['comment_impex']=0;
                $default['comment_limit']=1024;
                $default['integrator_url']=base64_encode('http://my.sitebar.org/integrator.php');
                $default['max_icon_age']=30;
                $default['max_icon_cache']=1000;
                $default['max_icon_size']=20000;
                $default['max_icon_user']=100;
                $default['feed_reader_url']= base64_encode('http://www.google.com/reader/preview/*/feed/%s');
                $default['search_engine_url']= base64_encode('http://www.google.com/search'.
                        '?q=%SEARCH%'.
                        '&sourceid=sitebar-search'.
                        '&start=0'.
                        '&ie=utf-8'.
                        '&oe=utf-8');
                $default['search_engine_ico']= base64_encode('http://www.google.com/favicon.ico');
                $default['allow_custom_search_engine']=1;
                $default['sender_email']='';
                $default['show_statistics']=1;
                $default['skin']='Modern';
                $default['use_compression']=1;
                $default['use_conv_engine']=1;
                $default['use_favicon_cache']=1;
                $default['use_hit_counter']=1;
                $default['use_mail_features']=1;
                $default['use_nice_url']=1;
                $default['use_outbound_connection']=1;
                $default['users_must_verify_email']=0;
                $default['users_must_be_approved']=0;
                $default['version_check_interval']=60*60*24*30;
                $default['web_search_user_agents']=base64_encode('Googlebot|Slurp|Scooter|MSNBOT');
                $default['filter_users']=0;
                $default['filter_groups']=0;
                break;

            case 'user':
            case 'tmp':
                // Settings for anonymous user are fetched always first
                // this actually just saves some time.
                $default = $this->params['default'];
                break;

            case 'default':
            default:
                $default['allow_info_mails']=1;
                $default['auto_close']=1;
                $default['auto_retrieve_favicon']=1;
                $default['default_folder']='';
                $default['default_search']='all';
                $default['default_search_tool']='backend';
                $default['default_url']='http://';
                $default['expert_mode']=0;
                $default['extern_commander']=0;
                $default['feed_reader_url']= '';
                $default['has_link']=0;
                $default['hidden_folders']='';
                $default['hide_xslt']=0;
                $default['link_sort_mode']='abc';
                $default['load_all_nodes']=0;
                $default['menu_icon']=0;
                $default['mix_mode']='nodes';
                $default['paste_mode']='ask';
                $default['pm_notification']=0; // Private message notification
                $default['private_over_ssl_only']=0;
                $default['show_acl']=1;
                $default['show_logo']=1;
                $default['use_favicons']=1;
                $default['use_hiding']=1;
                $default['use_search_engine']=1;
                $default['use_search_engine_iframe']=1;
                $default['use_tooltips']=1;
                $default['use_trash']=1;
                break;
        }

        // Clear old values
        $this->params[$prefix] = $default;

        // If we have some params then explode them
        if ($params)
        {
            foreach (explode(';',$params) as $param)
            {
                $pair = explode('=',$param);
                $key = array_shift($pair);
                $value = array_shift($pair);
                $this->setParam($prefix,$key,$value);
            }
        }

        // Post processing
        switch ($prefix)
        {
            case 'config':
                if (!strlen($this->getParam('config','sender_email')))
                {
                    $admin = $this->getUser(SB_ADMIN);
                    if ($admin['email']!='')
                    {
                        $this->setParam('config', 'sender_email', $admin['email']);
                    }
                }

                if (!$this->getParam('config', 'use_outbound_connection'))
                {
                    $this->setParam('config', 'use_favicon_cache', 0);
                    $this->setParam('config', 'version_check_interval', 0);
                }
                if ($this->getParam('config', 'auth'))
                {
                    $this->setParam('config', 'allow_sign_up', 0);
                }
                if (!$this->getParam('config', 'use_mail_features'))
                {
                    $this->setParam('config', 'users_must_verify_email', 0);
                }
                break;

            case 'user':
                if (!$this->getParam('config','use_hit_counter'))
                {
                    if (!in_array($this->getParam('user','link_sort_mode'),array('abc','added')))
                    {
                        $this->setParam('user', 'link_sort_mode', 'abc');
                    }
                }

                if ($this->getParam('user', 'link_sort_mode')=='visit')
                {
                    $this->setParam('user', 'link_sort_mode', 'waiting');
                }

                if (!$this->getParam('config', 'use_outbound_connection') ||
                    !$this->getParam('user', 'use_favicons'))
                {
                    $this->setParam('user', 'auto_retrieve_favicon', 0);
                }

                if (!$this->getParam('config', 'allow_custom_search_engine'))
                {
                    $this->setParam('user', 'search_engine_url', $this->getParam('config','search_engine_url'));
                    $this->setParam('user', 'search_engine_ico', $this->getParam('config','search_engine_ico'));
                }

                if ($this->getParam('user', 'search_engine_url')=='')
                {
                    $this->setParam('user', 'search_engine_url', $this->getParam('config','search_engine_url'));
                    $this->setParam('user', 'search_engine_ico', $this->getParam('config','search_engine_ico'));
                }

                if ($this->getParamB64('user', 'popup_params')=='')
                {
                    $this->setParamB64('user', 'popup_params', 'resizable=yes,dependent=yes,width=210,height=360,top=200,left=300,titlebar=yes,scrollbars=yes');
                }

                if ($this->getParam('user', 'feed_reader_url')=='')
                {
                    $this->setParam('user', 'feed_reader_url', $this->getParam('config','feed_reader_url'));
                }

                if ($this->isAnonymous() && isset($_COOKIE['SB3SETTINGS']))
                {
                    foreach (explode(';', $_COOKIE['SB3SETTINGS']) as $param)
                    {
                        list($key,$value) = explode('=',$param);
                        $this->setParam('user', $key, $value);
                    }
                }
                break;
        }
    }

    function implodeParams($prefix)
    {
        $params = array();
        foreach ($this->params[$prefix] as $name => $value)
        {
            $params[] = $name.'='.$value;
        }
        return implode(';',$params);
    }

    function getParam($prefix, $name, $default=null)
    {
        return isset($this->params[$prefix][$name])
            ?$this->params[$prefix][$name]:$default;
    }

    function getParamB64($prefix, $name, $default=null)
    {
        return isset($this->params[$prefix][$name])
            ?base64_decode($this->params[$prefix][$name]):$default;
    }

    function getParamArray($prefix, $name, $separator='|')
    {
        $val = trim($this->getParam($prefix, $name, ''));
        $arr = array();
        if (strlen($val))
        {
            $arr = explode($separator, $val);
        }
        return $arr;
    }

    function getParamCheck($prefix, $name)
    {
        $value = $this->getParam($prefix,$name);
        if ($value == '-1')
        {
            $value = $this->getParam('default',$name);
        }
        return $value?null:'';
    }

    function setParam($prefix, $name, $value)
    {
        $this->params[$prefix][$name] = $value;
    }

    function setParamB64($prefix, $name, $value)
    {
        $this->params[$prefix][$name] = base64_encode($value);
    }

    function isAnonymous()
    {
        return $this->uid == SB_ANONYM;
    }

    function isAdmin()
    {
        if (!$this->user)        return false;
        if ($this->uid == SB_ADMIN) return true;

        static $isAdmin = null;

        if ($isAdmin === null)
        {
            $rset = $this->db->select('g.gid',
                'sitebar_group g, sitebar_member m',
                array('m.uid'=>$this->uid, '^1'=> 'AND g.gid=m.gid AND g.gid=' . SB_ADMIN_GROUP));

            $rec = $this->db->fetchRecord($rset);
            $isAdmin = is_array($rec);
        }

        return $isAdmin;
    }

    function isOwner($gid = null)
    {
        $groups = $this->getOwnGroups($this->uid);

        if (!count($groups))
        {
            return false;
        }

        return $gid?in_array($gid, array_keys($groups)):true;
    }

    function canUseMail()
    {
        return $this->verified && $this->getParam('config','use_mail_features');
    }

    function accessDenied()
    {
        $this->error('Access denied!');

        if (!$this->verified && $this->getParam('config','users_must_verify_email'))
        {
            $this->warn('This SiteBar server requires your email address to be verified in order to use some functions.');
            $this->warn('Please click on the "%s" command to finish the verification procedure.', 'Verify Email');
        }
    }

    function isAuthorized($command, $ignoreAnonymous=false, $gid=null, $nid=null, $lid=null)
    {
        $acl = null;
        $node = null;
        $link = null;
        $readOnly = false;

        if ($lid)
        {
            $tree =& SB_Tree::staticInstance();
            $link = $tree->getLink($lid);
            $nid = $link->id_parent;

            if ($link->private && !$tree->inMyTree($nid))
            {
                return false;
            }
        }

        if ($nid)
        {
            $tree =& SB_Tree::staticInstance();
            $node = $tree->getNode($nid);
            $readOnly = $node->id_parent && !$node->parentHasRight('update');

            if (!$node)
            {
                return false;
            }

            $acl =& $node->getACL();

            if (!$acl)
            {
                return false;
            }

            if ($node && $node->deleted_by != null)
            {
                if ($command != 'Purge Folder' && $command != 'Undelete')
                {
                    return false;
                }
            }
        }

        if (!$this->isAnonymous())
        {
            $mustApprove = $this->getParam('config','users_must_be_approved');
            $mustVerify = $this->getParam('config','users_must_verify_email');

            // Hide commands if we are not setup completely
            if ($mustVerify && !$this->verified || $mustApprove && !$this->approved)
            {
                //
                switch ($command)
                {
                    case 'Browse Folder':
                    case 'Bookmark News':
                    case 'All Bookmarks':
                    case 'Open Integrator':
                    case 'Add Page Bookmarklet':

                    case 'Contact Admin':
                    case 'Display Topic':
                    case 'Download Bookmarks':
                    case 'Email Bookmark':
                    case 'Help':
                    case 'Log Out':
                    case 'Verify Email':
                    case 'Email Verified':
                    case 'Invalid Token':
                        break;

                    default:
                        $command = 'N/A';
                }
            }
        }

        // Check if we have plugin that changes rights
        foreach ($this->plugins as $plugin)
        {
            if (in_array($command, $plugin['authorization']))
            {
                $execute = $plugin['prefix'] . 'IsAuthorized';
                $result = $execute($this, $command, $ignoreAnonymous, $gid, $node, $acl, $link);

                if ($result !== null)
                {
                    return $result;
                }
            }
        }

        // If !$acl then we just ask for command list.
        switch ($command)
        {
            case 'Add Page Bookmarklet':
            case 'Display Topic':
            case 'Email Bookmark':
            case 'Email Verified':
            case 'Help':
            case 'Invalid Token':
            case 'New Password':
            case 'Open Integrator':
                return true;

            case 'Set Up':
                return !$this->setupDone;

            case 'Sign Up':
                return ($this->isAnonymous() || $ignoreAnonymous)
                    && $this->getParam('config','allow_sign_up');

            case 'Log In':
                return $this->isAnonymous() || $ignoreAnonymous;

            case 'Log Out':
                return !$this->isAnonymous() || $ignoreAnonymous;
            case 'Reset Password':
                return $this->isAnonymous() &&
                       $this->getParam('config','use_mail_features');

            case 'Verify Email':
                return !$this->isAnonymous() &&
                       !$this->verified &&
                       !$this->demo &&
                       $this->email!='' &&
                       $this->getParam('config','use_mail_features');

            case 'Browse Folder':
            case 'Bookmark News':
            case 'All Bookmarks':
                return !$this->getParam('user','hide_xslt') && (!$acl || $acl['allow_select']);

            case 'Contact Admin':
                return $this->getParam('config','use_mail_features') &&
                       ($this->getParam('config','allow_contact') || !$this->isAnonymous());

            case 'Add Bookmark':
            case 'Get Bookmark Information':
            case 'Add Folder':
            case 'Mark as Default':
                return !$acl || $acl['allow_insert'];

            case 'Paste': // Paste does its own checking later
            case 'Import Bookmarks':
                return !$acl || $acl['allow_insert'];

            case 'Hide Folder':
            case 'Unhide Subfolders':
            case 'Unhide Trees':
                return !$this->isAnonymous() &&
                    $this->getParam('user','use_hiding');

            case 'Copy':
            case 'Copy Bookmark':
                return !$acl || $acl['allow_select'];

            case 'Export Bookmarks':
            case 'Download Bookmarks':
            case 'Show Feed URL':
                return (!$this->isAnonymous() || $this->getParam('config','allow_anonymous_export'))
                    && (!$acl || $acl['allow_select']);

            case 'Custom Order':
                return !$acl || ($acl['allow_update'] && !$readOnly);

            case 'Folder Properties':
            case 'Properties':
                return !$acl || ($acl['allow_update']);

            case 'Validate Bookmarks':
            case 'Validation':
                return !$acl || ($acl['allow_update'] && $this->getParam('config','use_outbound_connection'));

            case 'Export Description':
                // Select is enough but, currently update is necessary
                return !$acl || ($acl['allow_select']);

            case 'Import Description':
                return !$acl || ($acl['allow_update'] && $this->getParam('config','comment_impex'));

            case 'Delete Bookmark':
                return !$acl || ($acl['allow_delete']);

            case 'Delete Folder':
                return !$acl || ($acl['allow_delete']);

            case 'Delete Tree':
                return !$acl || $this->isAdmin() ||
                       (  $acl['allow_delete'] && $this->getParam('config','allow_user_tree_deletion'));

            case 'Purge Folder':
                return $this->getParam('user','use_trash') && (!$acl || $acl['allow_delete']);

            case 'Undelete':
                return $this->getParam('user','use_trash') && (!$acl || ($acl['allow_delete'] && $acl['allow_insert']));

            case 'Maintain Trees':
            case 'Order of Trees':
            case 'User Settings':
            case 'Private Messages':
                return !$this->isAnonymous();

            case 'Session Settings':
                return $this->isAnonymous();

            case 'Personal Data':
                // Either we are number 1 user, or we have SiteBar authorization
                return !$this->isAnonymous() && ($this->uid==SB_ADMIN || !strlen($this->getParam('config', 'auth')));

            case 'Unhide Folders':
                return !$this->isAnonymous();

            case 'Delete Account':
                return !$this->isAnonymous() && !$this->demo && $this->uid != SB_ADMIN;

            case 'Create Tree':
                return !$this->isAnonymous() &&
                       ($this->getParam('config','allow_user_trees') || $this->isAdmin());

            case 'Active Users':
            case 'Approve All Users':
            case 'Approve User':
            case 'Approve Users':
            case 'Create User':
            case 'Default User Settings':
            case 'Delete All Inactive Users':
            case 'Delete Inactive Users':
            case 'Delete User':
            case 'Export Bookmarks Settings':
            case 'Favicon Management':
            case 'Filter Users':
            case 'Inactive Users':
            case 'Maintain Users':
            case 'Modify User':
            case 'Add User to Group':
            case 'Remove User from Group':
            case 'Modify User Settings':
            case 'Most Active Users':
            case 'Pending Unverified Users':
            case 'Pending User':
            case 'Pending Users':
            case 'Pending Users':
            case 'Pending Verified Users':
            case 'Purge Cache':
            case 'Reject All Users':
            case 'Reject Users':
            case 'Show All Icons':
            case 'SiteBar Settings':
                return $this->isAdmin();

            case 'Send Message to User':
                return !$this->isAnonymous();

            case 'Send Message to All':
                return $this->isAdmin();

            case 'Create Group':
            case 'Filter Groups':
            case 'Maintain Groups':
                return $this->isAdmin() || (!$this->isAnonymous() && $this->getParam('config','allow_user_groups'));

            case 'Folder Sharing':
            case 'Invite Members':
            case 'Edit Members':
            case 'Maintain Group':
            case 'Leave Group':
            case 'Accept Membership':
            case 'Reject Membership':
                return !$this->isAnonymous();

            case 'Delete Group':
            case 'Group Properties':
            case 'Send Message to Members':
                return $this->isAdmin() || (!$this->isAnonymous() && $this->isOwner($gid));
        }

        return false;
    }

    function canMove($sid,$tid,$isnode=true)
    {
        if ($this->isAuthorized(($isnode?'Delete Folder':'Delete Bookmark'), false, null, $sid))
        {
            $tree = SB_Tree::staticInstance();
            $sroot = $tree->getRootNode($sid);
            $troot = $tree->getRootNode($tid);

            if ($sroot->id == $troot->id)
            {
                return true;
            }
            else // Another tree and the source tree does not have purge right
            {
                return $this->isAuthorized('Purge Folder', false, null, $sid);
            }
        }

        return false;
    }

    function & inPlaceCommands()
    {
        static $commands = array
        (
            'Accept Membership',
            'Email Verified',
            'Invalid Token',
            'Log In',
            'Log Out',
            'Reject Membership',
            'Set Up',
            'Sign Up',
        );
        return $commands;
    }

    // expires as delta time in seconds
    function login($username, $pass, $expires=0)
    {
        $auth = $this->getParam('config', 'auth');
        $added = array();
        $rec = null;

        // We have another setting and do not know the user or we know him and he is not admin
        $useAltAuth = strlen($auth) && (!is_array($rec));

        // Plugin based authorization
        if ($useAltAuth)
        {
            $rec = $this->getUserByUsername($username);
            if  ($rec['uid'] == SB_ADMIN)
            {
                $useAltAuth = false;
            }
        }

        // Plugin based authorization
        if ($useAltAuth)
        {
            $file = './plugins/' . $auth . '/auth.inc.php';
            if (!is_file($file))
            {
                $this->error('Authentication plugin %s missing!', $auth);
                return false;
            }

            include_once($file);
            if (!authenticate($this, $username, $pass, $added))
            {
                $this->error('Unknown username or wrong password!');
                return false;
            }
        }
        else
        {
            $rec = $this->getUserByUsername($username, $pass);
        }

        // We have either wrong password or we do not exists
        if (!is_array($rec))
        {
            // Still ok, create new user.
            if ($useAltAuth)
            {
                if (!strlen($added['name']))
                {
                    $added['name'] = $username;
                }

                // Auto add user to database
                $uid = $this->signUp(
                    $username,
                    'NOPASSWORD',
                    $added['email'],
                    $added['name'],
                    $added['comment'],
                    $createdByAdmin=true,
                    $verified=true,
                    $demoAccount=false,
                    $lang=null);

                if (!$uid)
                {
                    return false;
                }

                $tree =& SB_Tree::staticInstance();
                $tree->addRoot($uid, $username);

                return $this->login($username, $pass, $expires);
            }
            else
            {
                $this->error('Unknown username or wrong password!');
            }

            return false;
        }

        $this->initUser($rec);
        unset($this->user['pass']); // Security

        // Noone from outside can reconstruct the password, because
        // only half of its md5 is used to generate another md5 and
        // hence we use password noone from outside can guess the code.
        // Is it obscure, unsercure or slow? Please tell me.
        $code = md5(substr(md5($pass),6,18).date('r').$username);

        $expires = ($expires?$expires+time():0);

        $this->db->insert('sitebar_session', array(
            'uid' => $this->uid,
            'code' => $code,
            'created' => array('now' => null),
            'expires' => $expires,
            'ip' => $_SERVER['REMOTE_ADDR']
        ));

        $this->setCookie('SB3AUTH', $code, $expires, TRUE);
        $this->remote = false;
        return true;
    }

    function logout()
    {
        $this->user = null;
        $this->setCookie('SB3AUTH');
    }

    function isLogged()
    {
        if (!isset($_COOKIE['SB3AUTH']))
        {
            return false;
        }

        // Check if we have valid session
        $rset = $this->db->select('uid', 'sitebar_session',
            array('code' => $_COOKIE['SB3AUTH'],
                '^1' => 'AND (expires <= 0 OR expires>=unix_timestamp())'));

        $rec = $this->db->fetchRecord($rset);

        // Delete invalid cookie
        if (!is_array($rec))
        {
            $this->setCookie('SB3AUTH');
            return false;
        }

        // Do we want to login on behalf of someone?
        global $SITEBAR;
        if ($rec['uid']==SB_ADMIN && isset($SITEBAR['login_as']) && $SITEBAR['login_as']!==null)
        {
            $this->log("\nI:",'Login as ' . $SITEBAR['login_as']);
            $rec['uid'] = $SITEBAR['login_as'];
        }
        else
        {
            // - first update some statistics
            $this->db->update('sitebar_user', array
            (
                'visits' => array('visits+'=>'1'),
				'visited' => array('now'=>null),
				'last_ip' => $_SERVER['REMOTE_ADDR'], 
            )
            ,array
            (
                'uid' => $rec['uid']
            ));
        }

        $rset = $this->db->select(null, 'sitebar_user', array('uid' => $rec['uid']));

        $rec = $this->db->fetchRecord($rset);

        // User deleted?
        if (!is_array($rec))
        {
            $this->setCookie('SB3AUTH');
            return false;
        }

        $this->initUser($rec);
        unset($this->user['pass']); // Security

        return true;
    }

    function setUp($username,$pass,$email,$name)
    {
        $rset = $this->db->update('sitebar_user',
            array(
                'username' => $username,
                'email' => $email,
                'pass' => array('md5' => $pass),
                'name' => $name,
                'verified' => 1,
            ),
            array('uid'=>SB_ADMIN));

        return $this->login($username, $pass);
    }

    function saveConfiguration()
    {
        $rset = $this->db->update('sitebar_config',
            array('params' => $this->implodeParams('config')));

        return true;
    }

/*** User functions ***/

    function signUp($username, $pass, $email, $name, $comment, $lang=null)
    {
        if (preg_match('/[&<>,\'"]/',$username))
        {
            $this->error('Username must not contain characters %s!', array('&lt;, &gt;, comma, single and double quote'));
            return false;
        }

        if ($this->getUserByUsername($username))
        {
            $this->error('This username is already used, select another one!');
            return false;
        }

        if (strlen(trim($email)) && $this->getUserByEmail($email))
        {
            $this->error('This email is already used, select another one!');
            return false;
        }

        $params = '';

        if ($lang)
        {
            $params = 'lang='.$lang;
        }

        $this->db->insert('sitebar_user', array(
            'username' => $username,
            'pass' => array('md5' => $pass),
            'email' => $email,
            'name' => $name,
            'comment' => $comment,
            'verified' => 0,
            'approved' => ($this->getParam('config', 'users_must_be_approved')?0:1),
            'demo' => 0,
            'params' => $params
        ));

        $newUID = $this->db->getLastId();

        if ($this->getParam('config','use_mail_features'))
        {
            // If verification is not required, we must check whether the user should
            // verify because of pending membership. However not when he must verify anyway.
            if (!$this->getParam('config','users_must_verify_email'))
            {
                $this->showEmail = true;
                $user = $this->getUser($newUID);
                $this->showEmail = false;

                $paraName = 'usermanager::signup_info';
                $paraAtt = array($user['completename'],SB_Page::absBaseUrl());

                if ($this->getParam('config', 'users_must_be_approved'))
                {
                    $paraName = 'usermanager::signup_approval';
                    $paraAtt[] = $this->getApproveUserUrl($username);
                    $paraAtt[] = $this->getRejectUserUrl($username);
                    $paraAtt[] = $this->getPendingUsersUrl();
                }

                $this->mailToAdmins('SiteBar: New SiteBar User', $paraName, $paraAtt, '', '', $lang);
            }
        }

        // Always greater then zero
        return $newUID;
    }

    function mailToAdmins($subject, $bodyid, $bodyparams, $from_name='', $from_email='', $lang=null)
    {
        $case = '';
        if ($subject == 'SiteBar: Contact Admin')
        {
            $caseNum = intval($this->db->getData('admin','case'))+1;
            $this->db->setData('admin','case',$caseNum);
            $case = sprintf(' [#%05d]', $caseNum);
        }

        $admins = $this->getMembers(SB_ADMIN_GROUP);
        foreach ($admins as $uid => $user)
        {
            $this->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->getParam('tmp', 'lang'));
            $this->sendMail($user, SB_T($subject).$case, SB_P($bodyid, $bodyparams), $from_name, $from_email);
        }
        SB_SetLanguage($lang?$lang:$this->getParam('user','lang'));
    }

    function getVerificationUrl($uid='')
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();
        return $token->createVerifyToken($uid);
    }

    function getPendingUsersUrl()
    {
        return SB_Page::absBaseUrl().
            'command.php'.
            '?command=Pending%20Users';
    }

    function getApproveUserUrl($username)
    {
        return SB_Page::absBaseUrl().
            'command.php'.
            '?command=Approve%20User'.
            '&username='.$username;
    }

    function getRejectUserUrl($username)
    {
        return SB_Page::absBaseUrl().
            'command.php'.
            '?command=Reject%20User'.
            '&username='.$username;
    }

    function decodeValue($value, $header=false)
    {
        if ($header)
        {
            return '=?UTF-8?B?'.base64_encode($value).'?=';
        }
        else
        {
            $tmp = str_replace("\n", "\x0D\x0A", $value);
            return stripslashes($tmp);
        }
    }

    function sendMail($user, $subject, $msg, $from_name='', $from_email='', $cc=false)
    {
        $headers  = "Content-Type: text/plain; ".CHARSET."\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        $sender   = $this->getParam('config','sender_email');
        $email    = $user['email'];

        if (!$email)
        {
            return false;
        }

        if (!$from_email)
        {
            $from_name = SB_T('SiteBar Server');
            $from_email = $sender;
        }

        if ($from_name)
        {
            $headers .= sprintf("From: \"%s\" <%s>\n",
                    $this->decodeValue($from_name, true), $from_email);
        }
        else
        {
            $headers .= sprintf("From: %s\n", $from_email);
        }

        if ($cc)
        {
            $headers .= sprintf("bcc: %s\n", $from_email);
        }

        $headers .= sprintf("Reply-to: \"%s\" <%s>\n",
                $this->decodeValue($from_name, true), $from_email);
        $headers .= sprintf("Sender: \"%s\" <%s>\n",
                $this->decodeValue(SB_T('SiteBar Server'), true), $sender);
        $headers .= sprintf("Return-path: <%s>\n", $sender);

        // Do not set "To:" - it would duplicate mails.
        if (!mail($email,
            $this->decodeValue($subject, true),
            $this->decodeValue($msg), $headers))
        {
            return false;
        }

        return true;
    }

    function privateMessage($params)
    {
        $gid = isset($params['gid']) && $params['gid'] ? $params['gid'] : null;

        $isModerator = $gid && $this->isModerator($gid);
        $isAdmin = $this->isAdmin();
        $role = ($isModerator||$isAdmin) && isset($params['from_role']) ? $params['from_role'] : 'user';

        $db =& SB_Database::staticInstance();

        $insert = array
        (
            'uid' => $this->uid,
            'gid' => $gid,
            'sent' => array('now'=>null),
            'role' => $role,
            'format' => $isAdmin && $params['format']? $params['format']:'plain',
            'to_label' => $params['to_label'],
            'subject' => $params['subject'],
            'message' => $params['message']
        );

        $db->insert('sitebar_message', $insert);
        $mid = $db->getLastId();

        if ($isAdmin && $params['expires'])
        {
            $insert['expires'] = $params['expires'];
        }

        $counter = 0;

        $safe_mode = in_array(strtolower(ini_get('safe_mode')),array("1", "on", "yes", "true"));
        if (!$safe_mode)
        {
            // We need more time if our database is slow
            set_time_limit(intval(count($params['to_list'])/20)+10);
        }

        $insert = array('mid'=>$mid);

        // Insert recipients
        foreach ($params['to_list'] as $uid => $user)
        {
            if ($uid == SB_ANONYM)
            {
                continue;
            }

            $userparams = $user['params'];
            $this->explodeParams($userparams, 'tmp');

            if (($isModerator||$isAdmin) && isset($params['respect']) && !$this->getParam('tmp','allow_info_mails'))
            {
                continue;
            }

            SB_SetLanguage($this->getParam('tmp','lang'));

            $counter++;
            $insert['uid'] = $uid;
            $db->insert('sitebar_message_folder', $insert);

            if ($params['pm_notification']
            && $user['verified']
            && $this->getParam('config','use_mail_features')
            && $this->getParam('tmp','pm_notification')) {
                $subject = SB_T('SiteBar: Private Message Notification');
                $msg = SB_P('command::pm_notification', array($params['subject'], SB_Page::absBaseUrl()));
                $this->sendMail(array('email'=>$user['email']), $subject, $msg);
            }
        }

        SB_SetLanguage($this->getParam('user','lang'));
        $insert['folder'] = 'outbox';

        // Insert senders
        if (($isModerator||$isAdmin) && $role!='user')
        {
            $gid = $role=='admins'?SB_ADMIN_GROUP:$gid;

            foreach ($this->getMembers($gid) as $uid => $user)
            {
                $userparams = $user['params'];
                $this->explodeParams($userparams, 'tmp');
                SB_SetLanguage($this->getParam('tmp','lang'));

                $counter++;
                $insert['uid'] = $uid;
                $db->insert('sitebar_message_folder', $insert);
            }
        }
        else
        {
            $insert['uid'] = $this->uid;
            $db->insert('sitebar_message_folder', $insert);
        }

        SB_SetLanguage($this->getParam('user','lang'));
    }

    function removeUser($uid)
    {
        $tree =& SB_Tree::staticInstance();

        $this->db->clearUserData($uid);

        $this->ignoreWarnings(true);
        $tree->deleteUsersTrees($uid);
        $this->ignoreWarnings(false);

        $groups = $this->getUserGroups($uid);
        foreach ($groups as $gid => $group)
        {
            $this->removeGroup($gid);
        }

        $this->db->delete('sitebar_user', array('uid' => $uid));
        return true;
    }

    function deleteAccount()
    {
        return $this->removeUser($this->uid);
    }

    function personalData($username, $pass, $email, $name, $comment)
    {
        // Email changed
        if ($email != $this->email)
        {
            if ($this->verified)
            {
                $this->verified = 0;
            }

            if (strlen(trim($email)) && $this->getUserByEmail($email))
            {
                $this->error('This email is already used, select another one!');
                return false;
            }
        }

        if ($username != $this->username)
        {
            $rset = $this->db->select(null, 'sitebar_user', array(
                'ucase(username)' => array('ucase' => $username)));

            $user = $this->db->fetchRecord($rset);

            if (is_array($user))
            {
                $this->error('This username is already used. Did you forget your password?');
                return false;
            }
        }

        $this->db->update('sitebar_user',
            array
            (
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'comment' => $comment,
                'verified' => $this->verified,
            ),
            array('uid'=>$this->uid));

        $this->username = $username;
        $this->email = $email;

        if ($pass)
        {
            $this->changePassword($this->uid, $pass);
            $this->login($username, $pass);
        }

        return true;
    }

    function saveUserParams($uid=null, $prefix='user')
    {
        if ($uid===null)
        {
            $uid = $this->uid;
        }

        if ($uid==SB_ANONYM && !$this->isAdmin())
        {
            $this->mailToAdmins('SiteBar: Alert', 'usermanager::alert',
                array('Default User Settings changed by non-priviledged user!'));
            return;
        }

        $this->db->update('sitebar_user',
            array('params' => $this->implodeParams($prefix)),
            array('uid'=>$uid));
    }

    function modifyUser($uid, $pass, $columns)
    {
        if ($pass)
        {
            $this->changePassword($uid, $pass);
        }

        $this->db->update('sitebar_user', $columns, array('uid'=>$uid));
    }

    function checkPassword($uid, $pass)
    {
        $auth = $this->getParam('config', 'auth');
        $useAltAuth = strlen($auth) && ($uid != SB_ADMIN);

        // Plugin based authorization
        if ($useAltAuth)
        {
            $addedRealName = '';
            $addedComment = '';

            $user = $this->getUser($uid);

            include_once('./plugins/' . $auth . '/auth.inc.php');
            return authenticate($this, $user['username'], $pass, $addedRealName, $addedComment);
        }
        else
        {
            $rset = $this->db->select(null,'sitebar_user', array(
                'pass' => array('md5' => $pass),
                '^1' => 'AND',
                'uid'=>$uid));

            return is_array($this->db->fetchRecord($rset));
        }
    }

    function changePassword($uid, $pass)
    {
        $this->db->update('sitebar_user',
            array('pass' => array('md5' => $pass)),
            array('uid'=>$uid));
    }

    function useUserFilter()
    {
        return $this->getParam('config','filter_users');
    }

    function useGroupFilter()
    {
        return $this->getParam('config','filter_groups');
    }

    function firstSession($uid)
    {
        $rset = $this->db->select('min(created) signup', 'sitebar_session', array('uid' => $uid));
        $rec = $this->db->fetchRecord($rset);
        return $rec['signup'];
    }


    function enrichUser(&$rec)
    {
         $fullname = $rec['username'];

         if ($rec['name'])
         {
             $fullname .= ' - '. $rec['name'];
         }

         $rec['fullname'] = $fullname;

         $fullnamehtml = $fullname;

         if ($rec['email'] && ($this->isAdmin() || $this->showEmail ))
         {
             $fullname .= ' <'. $rec['email'] . '>';
             $fullnamehtml .= ' &lt;'. $rec['email']. '&gt;';
         }

         $rec['completename'] = $fullname;
         $rec['completenamehtml'] = $fullnamehtml;
    }

    function enrichUsers(&$users)
    {
        foreach ($users as $uid => $rec)
        {
            $this->enrichUser($rec);
            $users[$uid] = $rec;
        }
    }

    function getUser($uid)
    {
        $rset = $this->db->select(null, 'sitebar_user', array('uid' => $uid));
        $user = $this->db->fetchRecord($rset);
        $this->enrichUser($user);
        return $user;
    }

    function &getUsers()
    {
        $rset = $this->db->select('uid, username, email, verified, approved, name, params',
            'sitebar_user', null, 'ucase(username)');
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->enrichUsers($users);
        return $users;
    }

    function &getMatchingUsers($uregexp)
    {
        $rset = $this->db->select('uid, username, email, verified, approved, name, params',
            'sitebar_user', null, 'ucase(username)');
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $this->enrichUser($rec);

            if (strlen($uregexp))
            {
                $fullname = '#' . $rec['uid'] . ' ' . $rec['completenamehtml'];
                if (!preg_match($uregexp, $fullname))
                {
                    continue;
                }
            }

            $users[$rec['uid']] = $rec;
        }

        return $users;
    }

    function getUserByUsername($username, $pass='')
    {
        $where = array('ucase(username)'=>array('ucase'=>$username));

        if (strlen($pass))
        {
            $where['^1'] = 'AND';
            $where['pass'] = array('md5' => $pass);
        }

        $rset = $this->db->select(null, 'sitebar_user', $where);
        return $this->db->fetchRecord($rset);
    }

    function getUserByEmail($email)
    {
        $rset = $this->db->select(null, 'sitebar_user', array('ucase(email)'=>array('ucase'=>$email)));
        return $this->db->fetchRecord($rset);
    }

    function getPending($verified=-1)
    {
        $where = array('approved'=>0);

        if ($verified!=-1)
        {
            $where['^1'] = 'AND';
            $where['verified'] = $verified;
        }

        $rset = $this->db->select('uid, username, email, verified, name, params', 'sitebar_user', $where, 'ucase(username)');
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->enrichUsers($users);
        return $users;
    }

    function getUsersUsingVisited($days, $cmp, $order)
    {
        $rset = $this->db->select
        (
            'uid, username, email, name, visited, visits',
            'sitebar_user',
            'visited '.$cmp.' DATE_ADD( now() , INTERVAL -'.intval($days).' DAY)',
            $order
        );
        $users = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if ($rec['uid'] == SB_ANONYM) continue;
            $users[$rec['uid']] = $rec;
        }

        $this->enrichUsers($users);
        return $users;
    }

/*** Group functions ***/

    function addGroup($columns)
    {
        $rset = $this->db->select(null, 'sitebar_group', array(
            'name' => $columns['name'], '^1' => 'AND', 'uid' =>$columns['uid'] ));

        $group = $this->db->fetchRecord($rset);

        if (is_array($group))
        {
            $this->error('Group name "%s" is already used!', array($group['name']));
            return false;
        }

        $this->db->insert('sitebar_group', $columns);

        $gid = $this->db->getLastId();
        // Always greater then zero
        return $gid;
    }

    function removeGroup($gid)
    {
        $this->db->delete('sitebar_acl', array('gid'=>$gid));
        $this->db->delete('sitebar_member', array('gid'=>$gid));
        $this->db->delete('sitebar_group', array('gid'=>$gid));
    }

    function updateGroup($gid, $columns)
    {
        $this->db->update('sitebar_group', $columns, array('gid'=>$gid));
    }

    function addMember($gid, $uid)
    {
        $this->db->purgeCache('acl_nodes', $uid);
        $this->db->purgeCache('vis_nodes', $uid);

        $this->db->insert('sitebar_member', array('gid' => $gid, 'uid' => $uid, 'invitator' => $this->uid),
            array(1062)); // Ignore duplicate membership

        if ($this->db->getErrorCode()!=1062) {
            //$this->privateMessage(KOKO); // TODO
        }
    }

    function removeMember($gid, $uid)
    {
        $this->db->purgeCache('acl_nodes', $uid);
        $this->db->purgeCache('vis_nodes', $uid);

        $this->db->delete('sitebar_member',
            array('gid'=>$gid, '^1'=>'AND', 'uid'=>$uid));
    }

    function updateMember($gid, $uid, $columns)
    {
        if (isset($columns['confirmed']))
        {
            $this->db->purgeCache('acl_nodes', $uid);
            $this->db->purgeCache('vis_nodes', $uid);
        }
        $this->db->update('sitebar_member', $columns, array('gid'=>$gid, '^1'=>'AND', 'uid'=>$uid));
    }

    function isModerator($gid = null)
    {
        $groups = $this->getModeratedGroups($this->uid);

        if (!count($groups))
        {
            return false;
        }

        return $gid?in_array($gid, array_keys($groups)):true;
    }

    function getModeratedGroups($uid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $rset = $this->db->select('g.gid, g.name',
            'sitebar_group g natural join sitebar_member m',
            array('g.uid'=>$uid, '^1'=> 'AND', 'moderator'=>1 ), 'name');

        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        foreach ($this->getOwnGroups($uid) as $gid => $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        return $groups;
    }

    function getMembers($gid)
    {
        $where = array('gid'=>$gid, '^1'=>'AND u.uid=m.uid');
        $rset = $this->db->select('m.*, username, email, verified, approved, name, params',
            'sitebar_user u, sitebar_member m', $where, 'ucase(username)');
        $members = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $members[$rec['uid']] = $rec;
        }

        $this->enrichUsers($members);
        return $members;
    }

    function enrichGroups(&$groups)
    {
        static $default_groups = null;

        if ($default_groups === null)
        {
            $default_groups = $this->getParamArray('config','default_groups');
        }

        foreach ($groups as $gid => $rec)
        {
            if (in_array($rec['name'],$default_groups))
            {
                $rec['name'] = SB_C('groupname', $rec['name']);
            }

            $user = $this->getUser($rec['uid']);
            if (!isset($rec['own']))
            {
                $rec['own'] = 0;
            }

            if ($rec['uid'] != $this->uid)
            {
                $rec['completename'] = '<' . $user['username'] . '> ';
                $rec['completenamehtml'] = '&lt;' . $user['username'] . '&gt; ';
            }
            else
            {
                $rec['completename'] = '';
                $rec['completenamehtml'] = '';
            }

            $rec['completename'] .= $rec['name'];
            $rec['completenamehtml'] .= $rec['name'];
            $groups[$gid] = $rec;
        }
    }

    function getGroup($gid)
    {
        $rset = $this->db->select(null, 'sitebar_group', array( 'gid'=> $gid), 'uid, name');
        $groups = $this->db->fetchRecords($rset);
        $this->enrichGroups($groups);
        return $groups[0];
    }

    function getGroups()
    {
        $rset = $this->db->select('g.*', 'sitebar_group g, sitebar_user u', 'g.uid=u.uid', 'username, name');
        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        $this->enrichGroups($groups);
        return $groups;
    }

    function getUserGroups($uid=null, $gid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $groups = $this->getOwnGroups($uid, $gid);

        $where = array('m.uid'=>$uid,'^1'=>'AND g.gid=m.gid AND confirmed=1');

        if ($gid !== null)
        {
            $where['^2'] = 'AND';
            $where['g.gid'] = $gid;
        }

        $rset = $this->db->select('g.*,m.share,m.moderator', 'sitebar_group g, sitebar_member m', $where, 'name');

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        $this->enrichGroups($groups);
        return $groups;
    }

    function getPendingGroups()
    {
        $groups = array();

        $where = array('m.uid'=>$this->uid,'^1'=>'AND g.gid=m.gid AND confirmed=0');
        $rset = $this->db->select('g.*,m.invitator', 'sitebar_group g, sitebar_member m', $where, 'name');

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $groups[$rec['gid']] = $rec;
        }

        $this->enrichGroups($groups);

        return $groups;
    }

    function getOwnGroups($uid=null, $gid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $where = array('uid'=>$uid);

        if ($gid !== null)
        {
            $where['^1'] = 'AND';
            $where['gid'] = $gid;
        }

        $rset = $this->db->select('gid, name, comment, uid', 'sitebar_group', $where, 'name');

        $groups = array();

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $rec['own'] = 1;
            $rec['share'] = 1;
            $rec['moderator'] = 1;

            $groups[$rec['gid']] = $rec;
        }

        $this->enrichGroups($groups);
        return $groups;
    }

    function getPublicGroups($uid=null)
    {
        if (!$uid)
        {
            $uid = $this->uid;
        }

        $where = array('uid'=>$uid);

        $rset = $this->db->select('gid, name, comment, uid', 'sitebar_group', $where, 'name');

        $groups = array();

        $publicGroups = $this->getParamArray('config','public_groups');

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if (in_array($rec['name'], $publicGroups))
            {
                $groups[$rec['gid']] = $rec;
            }
        }

        return $groups;
    }

/*** Plugin functions ***/

    function loadPlugins()
    {
        $this->plugins = array();
        $this->pluginPaths = array();

        $dirName = "./plugins";

        if (is_dir($dirName) && ($dir = opendir($dirName)))
        {
            while (($plugin = readdir($dir)) !== false)
            {
                $plugdir = $dirName.'/'.$plugin;

                if (!is_dir($plugdir))
                {
                    continue;
                }

                $authfile = $plugdir.'/auth.inc.php';

                if (is_file($authfile) && $this->getParam('config', 'auth') != $plugin)
                {
                    continue;
                }

                $plugfile = $plugdir.'/command.inc.php';

                if (is_file($plugfile))
                {
                    include($plugfile);
                    $this->pluginPaths[] = $plugdir;

                    $plugin['dir'] = $plugdir;

                    // $plugin gets injected
                    $this->plugins[] = $plugin;
                }
            }
            closedir($dir);
        }

        if (count($this->plugins))
        {
            $l =& SB_Localizer::staticInstance();
            $l->setPlugins($this->pluginPaths);
        }
    }

    function messengerGetNewCount()
    {
        $res = $this->db->select('count(*) newcount', 'sitebar_message_folder',
            array('uid'=>$this->uid, '^1'=>"AND folder='inbox' AND flag='new'"));
        $rec = $this->db->fetchRecord($res);
        return intval($rec['newcount']);
    }
}
?>
