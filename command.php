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

// Backward compatibility with plugins
$_REQUEST['command'] = str_replace('Link','Bookmark', isset($_REQUEST['command'])?$_REQUEST['command']:'');

/******************************************************************************/
/******************************************************************************/
/******************************************************************************/

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/usermanager.inc.php');
require_once('./inc/tree.inc.php');

/**
* Change the line below to command.cgi, if you have backend problems with
* importing bookmarks or other security related problems or your server
* runs PHP in a 'safe mode' :
*/
define( 'FORM_ACTION_EXECUTOR', 'command.php');
/*
* Example of command.cgi (create manually, save as "command.cgi" and
* upload to the same directory as this file is :
* --- BEGIN ---
* #!/usr/bin/php
* <?php include("command.php");
* --- END ---
*/

/******************************************************************************/

class SB_CommandWindow extends SB_ErrorHandler
{
    var $command;
    var $um;
    var $tree;

    var $reload = false;
    var $close = false;

    var $fields = array();
    var $message = '';
    var $nobuttons = false;
    var $bookmarklet = false;
    var $onLoad = 'SB_initCommander()';
    var $showWithErrors = false;
    var $skipBuild = false;
    var $skipCommand = false;
    var $forward = false;
    var $getInfo = false;
    var $useToolTips = null;
    var $writingOptionalFields = false;

    var $persistentParams = array('target','mode','w');

    function __construct()
    {
        $this->command = SB_reqVal('command');

        if (!$this->command)
        {
            $this->error('Missing command!');
        }

        if (strlen(SB_reqVal('button')))
        {
            $this->command= SB_reqVal('button');
        }

        if (SB_reqChk('weblinks'))
        {
            $this->bookmarklet = true;
        }

        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();

        $this->useToolTips = $this->um->getParam('user','use_tooltips');
        $this->handleCommand();
    }

    function handleCommand()
    {
        if (!$this->um->isAuthorized($this->command,
            in_array($this->command, array('Log In', 'Log Out', 'Sign Up')),
            SB_reqValInt('command_gid'), SB_reqValInt('nid_acl'), SB_reqValInt('lid_acl')))
        {
            $bld = 'build' . $this->shortName();
            $cmd = 'command' . $this->shortName();

            if (!method_exists($this,$bld) && !method_exists($this,$cmd))
            {
                $this->command = 'Unknown command!';
            }

            $this->um->accessDenied();
            return;
        }

        // For logout we do not build the form and just execute
        // Do is set on build forms (if not set another form is opened)
        if (!$this->forward && (SB_reqVal('do') ||
           in_array($this->command,array('Log Out'))))
        {
            $this->reload = !$this->um->getParam('user','extern_commander');
            $this->close = $this->um->getParam('user','auto_close');

            // Here check for mandatory fields
            $execute = 'mandatory' . $this->shortName();
            if (method_exists($this, $execute))
            {
                $mandatoryFields = $this->$execute();
                if (count($mandatoryFields) && !$this->checkMandatoryFields($mandatoryFields))
                {
                    $this->goBack();
                    return;
                }
            }

            $execute = 'command' . $this->shortName();
            $this->forward = false;

            foreach ($this->um->plugins as $plugin)
            {
                if (isset($plugin['command_pre']) && in_array($this->command, $plugin['command_pre']))
                {
                    $execute = $plugin['prefix'].'CommandPre'.$this->shortName();
                    $execute($this);
                }
            }

            // Here execute the command
            if (!$this->skipCommand && method_exists($this, $execute))
            {
                $this->$execute();
            }

            foreach ($this->um->plugins as $plugin)
            {
                if (isset($plugin['command']) && in_array($this->command, $plugin['command']))
                {
                    $execute = $plugin['prefix'].'Command'.$this->shortName();
                    $execute($this);
                }
            }

            if ($this->forward)
            {
                $this->handleCommand();
            }
        }
        else
        {
            $this->handleCommandBuild();
        }
    }

    function handleCommandBuild()
    {
        $built = false;

        $execute = 'build' . $this->shortName();

        if (method_exists($this, $execute))
        {
            $fields = $this->$execute();
            $built = true;
        }

        foreach ($this->um->plugins as $plugin)
        {
            if (in_array($this->command, $plugin['build']))
            {
                $execute = $plugin['prefix'].'Build'.$this->shortName();
                $execute($this, $fields);
                $built = true;
            }
        }

        if (!$this->skipBuild)
        {
            if (!$built || !count($fields))
            {
                if (!$this->hasErrors())
                {
                    $this->error('Unknown command!');
                }
            }
            else
            {
                $this->fields = $fields;
            }
        }
    }

    function shortName()
    {
        return str_replace(' ','',$this->command);
    }

    function forwardCommand($command)
    {
        if (!$this->hasErrors() && !$this->message)
        {
            $this->fields  = array();
            $this->command = $command;
            $this->forward = true;
        }
    }

    function goBack()
    {
        // We cannot repair error in this case because we would
        // lost additional infomation.
        if (SB_reqChk('bookmarklet') && $this->command='Log In')
        {
            $this->bookmarklet = true;
            return;
        }

        $this->showWithErrors = true;
        $execute = 'build' . $this->shortName();

        if (method_exists($this, $execute))
        {
            $fields = $this->$execute();
        }

        foreach ($this->um->plugins as $plugin)
        {
            if (in_array($this->command, $plugin['build']))
            {
                $execute = $plugin['prefix'].'Build'.$this->shortName();
                $execute($this, $fields);
            }
        }

        foreach ($fields as $name => $params)
        {
            if (isset($fields[$name]) && !strstr($name,'-raw') && isset($fields[$name]['name']) )
            {
                $fields[$name]['value'] = SB_reqVal($fields[$name]['name']);
            }
        }

        $this->fields = $fields;
    }

    function inPlace()
    {
        return !$this->bookmarklet &&
            (in_array($this->command, $this->um->inPlaceCommands()) ||
             !$this->um->getParam('user','extern_commander'));
    }

    function markHasLink()
    {
        if (!$this->um->isAnonymous() && !$this->um->getParam('user','has_link'))
        {
            $this->um->setParam('user','has_link',1);
            $this->um->saveUserParams();
        }
    }

    function getParams($html=true)
    {
        $params = array();
        $params[] = 'uniq=' . time();

        foreach ( $this->persistentParams as $param)
        {
            if (isset($_REQUEST[$param]))
            {
                $params[] = $param.'='.$_REQUEST[$param];
            }
        }

        return '?' . implode($html?'&amp;':'&',$params);
    }

    function getFieldParams($params,$filter=null)
    {
        static $tabindex = 1;

        if (!isset($params['maxlength']) && isset($params['name']))
        {
            if ($params['name'] == 'name' || $params['name'] == 'email' || $params['name'] == 'username')
            {
                $params['maxlength'] = 50;
            }
        }

        if (array_key_exists('disabled', $params)
        &&  isset($params['type'])
        &&  $params['type']=='text')
        {
            unset($params['disabled']);
            $params['readonly'] = null;

            if (isset($params['class']))
            {
                $params['class'] .= ' readonly';
            }
            else
            {
                $params['class'] = 'readonly';
            }
        }

        $txt = '';

        if (!array_key_exists('disabled', $params)
        &&  !array_key_exists('readonly', $params)
        &&  !array_key_exists('hidden', $params)
        &&   isset($params['type'])
        &&   $params['type']=='text')
        {
            if ($tabindex==1 && !$this->writingOptionalFields)
            {
                $txt .= 'id="focused" ';
            }
            $tabindex++;
        }

        foreach ($params as $param => $value)
        {
            if ($value!=='' && $param[0]!='_')
            {
                if ($param=='type' && $value=='textarea')
                {
                    continue;
                }

                if ($param=='mandatory' || $param=='optional')
                {
                    continue;
                }

                if ($filter && $filter != $param)
                {
                    continue;
                }

                if ($param=='title' && $this->useToolTips)
                {
                    $param='x_title';
                    $txt .= SB_Page::toolTip();
                    $value = SB_Page::quoteValue($value);
                }

                if ($param=='value')
                {
                    $value = SB_Page::quoteValue($value);
                }
                $txt .= $param . ($value?'="' . $value . '" ':' ');
            }
        }
        return $txt;
    }

    function getToolTip($params)
    {
        if (!isset($params['title']))
        {
            return '';
        }

        $txt = '';

        $param = 'title';
        if ($this->useToolTips)
        {
            $param='x_title';
            $txt .= SB_Page::toolTip();
        }

        $txt .= $param.'="'. $params['title'] . '" ';
        return $txt;
    }

    function checkFile($name)
    {
        if (isset($_FILES[$name]['name']) && !$_FILES[$name]['name'])
        {
            // We cannot do this directly because it would be always missing
            $this->checkMandatoryFields(array($name));
            return false;
        }

        if (!is_uploaded_file($_FILES[$name]['tmp_name']) || !$_FILES[$name]['size'])
        {
            $this->error('Invalid filename or other upload related problem: %s!',
                array( SB_safeVal($_FILES[$name],'error')));
            $this->goBack();
            return false;
        }

        return true;
    }

    function _getAuthMethod()
    {
        $auths = array('');
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

                $plugfile = $plugdir.'/auth.inc.php';

                if (is_file($plugfile))
                {
                    $auths[] = $plugin;
                }
            }
            closedir($dir);
        }

        return count($auths) > 1 ? $auths : array();
    }

    function _buildAddBookmarkNode($node, $level, $defaultFolder)
    {
        foreach ($node->getChildren() as $childNode)
        {
            if ($childNode->type_flag!='n')
            {
                continue;
            }
            echo '<option class="fldList'.$level.'" '.(!$childNode->hasRight('insert')?'class="noinsert"':'').
                 ($childNode->id==$defaultFolder?' selected ':'').
                 ' value='.$childNode->id.'>'.
                 str_repeat('&nbsp;&nbsp;&nbsp;',$level) . $childNode->name,
                 '</option>'."\n";
            $this->_buildAddBookmarkNode($childNode, $level+1, $defaultFolder);
        }
    }

    function _buildAddBookmark($params)
    {
?>
        <select class="fldList" name="nid_acl">
<?php
        $defaultFolder = $this->um->getParam('user','default_folder');

        foreach ($this->tree->loadRoots($this->um->uid) as $root)
        {
            echo '<option class="'. ($root->hasRight('insert')?'fldList':'noinsert') .'"'.
                 ($root->id==$defaultFolder?' selected':'').
                 ' value="'.$root->id.'">['.$root->name.']</option>'."\n";

            // Load just folders
            $this->tree->loadNodes($root, false, 'insert', true);
            $this->_buildAddBookmarkNode($root, 1, $defaultFolder);
        }
?>
        </select>
<?php
    }

    function _buildSkinList($select=null)
    {
        if ($select == null || $select == '')
        {
            $select = SB_Skin::get();
        }

        if ($dir = opendir('./skins'))
        {
            $skins = array();
            while (($dirName = readdir($dir)) !== false)
            {
                if (!is_dir('./skins/'.$dirName) || !file_exists('./skins/'.$dirName.'/hook.inc.php')) continue;
                $skins[] = $dirName;
            }
            closedir($dir);

            sort($skins);
            foreach ($skins as $skin)
            {
                echo '<option '. ($select==$skin?'selected':'') .
                     ' value="' . $skin . '">' . $skin . "</option>\n";
            }
        }
    }

    function _buildLangList($select=null)
    {
        $l =& SB_Localizer::staticInstance();

        foreach ($l->getLanguages() as $lang)
        {
            $dir = $lang['dir'] . str_repeat("&nbsp;", 5-strlen($lang['dir']));

            echo '<option class="fixed" '. ($select==$lang['dir']?'selected':'') .
                 ' value="' . $lang['dir'] . '">' . $dir .  " " . $lang['language'] . "</option>\n";
        }
    }

    function _buildAutoLangList($select=null)
    {
        echo '<option class="fixed" '. ($select==null?'selected':'') .
             ' value="">' . SB_T('Auto detection') . "</option>\n";

        $this->_buildLangList($select);
    }

    function _buildUserList($select=null, $exclude=null)
    {
        foreach ($this->um->getMatchingUsers($this->getUserFilterRegexp()) as $uid => $rec)
        {
            if ($uid == $exclude) continue;

            echo '<option '. ($select==$uid?'selected':'') .
                ' value="' . $uid . '">' . SB_Page::quoteValue($rec['completenamehtml']) . "</option>\n";
        }
    }

    function _buildUserCheck($params)
    {
        $id = 'l_'.$params['record']['uid'];
        $attr = ' name=\'' .$params['record']['uid'].'\' '.
            (isset($params['checked'])?' checked':'').
            (isset($params['disabled'])?' disabled':'');

        $idurl = '';

        if ($this->um->isAdmin())
        {
            $idurl = ' [<a href="?command=Modify%20User&amp;uid='.$params['record']['uid'].'">'.$params['record']['uid'].'</a>]';
        }
?>
        <tr class='userCheck'>
            <td class="check">
                <input id="<?php echo $id?>" type="checkbox" value="1" <?php echo $attr?>>
            </td>
            <td colspan="2">
                <label for="<?php echo $id?>"><?php echo $params['record']['username']?></label><?php echo $idurl ?>
            </td>
        </tr>
<?php
        if ($this->um->isAdmin() && $params['record']['email'])
        {
?>
        <tr>
            <th colspan="2"><?php echo SB_T('E-mail') ?>:</th>
            <td> <?php echo $params['record']['email']?></td>
        </tr>
<?php
        }

        if ($params['record']['name'])
        {
?>
        <tr>
            <th colspan="2"><?php echo SB_T('Real Name') ?>:</th>
            <td> <?php echo $params['record']['name']?></td>
        </tr>
<?php
        }

        if (isset($params['signup']))
        {
?>
        <tr>
            <th colspan="2"><?php echo SB_T('First Visit') ?>:</th>
            <td> <?php echo $params['signup']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Last Visit') ?>:</th>
            <td> <?php echo $params['record']['visited']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Visit Count') ?>:</th>
            <td> <?php echo $params['record']['visits']?></td>
        </tr>
        <tr>
            <th colspan="2"><?php echo SB_T('Bookmark Count') ?>:</th>
            <td> <?php echo $params['links']?></td>
        </tr>
<?php
        }
    }

    function _buildGroupList($select=null)
    {
        $gregexp = null;

        if (SB_reqChk('gregexp'))
        {
            $gregexp = SB_reqVal('gregexp');
            if (!strlen($gregexp) || $gregexp[0] != '/')
            {
                $gregexp = '/'.$gregexp.'/i';
            }
        }

        $groups = $this->um->getOwnGroups($this->um->uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            if (!$this->um->isAdmin() && !in_array($gid, array_keys($groups))) continue;

            if ($gregexp)
            {
                if (!preg_match($gregexp, $rec['completename']))
                {
                    continue;
                }
            }

            echo '<option '. ($select==$gid?'selected':'') .' value="' . $gid . '">' .
                $rec['completenamehtml'] . "</option>\n";
        }
    }

    function _buildGroupCandidateList($select=null)
    {
        $gregexp = null;

        if (SB_reqChk('gregexp'))
        {
            $gregexp = SB_reqVal('gregexp');
            if (!strlen($gregexp) || $gregexp[0] != '/')
            {
                $gregexp = '/'.$gregexp.'/i';
            }
        }

        $groups = $this->um->getUserGroups(SB_reqVal('uid'));

        $count = 0;

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            if (in_array($gid, array_keys($groups))) continue;

            if ($gregexp)
            {
                if (!preg_match($gregexp, $rec['completename']))
                {
                    continue;
                }
            }

            $count++;
            echo '<option '. ($select==$gid?'selected':'') .' value="' . $gid . '">' .
                $rec['completenamehtml'] . "</option>\n";
        }

        if ($count==0)
        {
            echo "<option value=\"-1\">&lt;".SB_T('No groups to join!')."&gt;</option>\n";
        }
    }

    function _buildGroupMultipleList($select=null)
    {
        $gregexp = null;

        if (SB_reqChk('gregexp'))
        {
            $gregexp = SB_reqVal('gregexp');
            if ($gregexp[0] != '/')
            {
                $gregexp = '/'.$gregexp.'/i';
            }
        }

        $groups = $this->um->getOwnGroups($this->um->uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            if ($gregexp)
            {
                if (!preg_match($gregexp, $rec['long_name']))
                {
                    continue;
                }
            }

            if (!$this->um->isAdmin() && !in_array($gid, array_keys($groups))) continue;

            echo '<option '. ($select==$gid?'selected':'') .' value="' . $gid . '">' .
                $rec['completenamehtml'] . "</option>\n";
        }
    }

    function _buildFolderOrder($params)
    {
?>
        <tr>
            <td>
                <input class="order" value="<?php echo $params['order']?>"
                    name="id<?php echo $params['id']?>" maxlength="5">
            </td>
            <td>
                <?php echo $params['name']?>
            </td>
        </tr>
<?php
    }

    function _buildFavicon($lid, $favicon)
    {
        $wrong = SB_Skin::imgsrc('link_wrong_favicon');
        $txt = '';

        $binary = (substr($favicon,0,7) == 'binary:');

        if ($this->um->getParam('config', 'use_favicon_cache'))
        {
            $link = $this->tree->getLink($lid);
            if ($link->favicon)
            {
                $cached = 'favicon.php?';

                if ($binary)
                {
                    $cached .= $favicon;
                }
                else
                {
                    $cached .= md5($favicon) . '=' . $lid . '&amp;refresh=' . SB_StopWatch::getMicroTime();
                }

                $txt .= SB_T('Cached: ') . '<img class="favicon" alt="" height=16 width=16 src="'.$cached.'" onerror="this.src=\''.$wrong.'\'">';
                $txt .= '&nbsp;';
            }
        }

        if (!$binary)
        {
            $txt .= SB_T("Original: ") . '<img alt="" src="'.$favicon.'" onerror="this.src=\''.$wrong.'\'">';
        }

        return '<div>'.$txt."</div>\n";
    }

    function _buildSendEmail($label=null, $checkRCPT=false)
    {
        $fields = array();
        $fields[$label?$label:'Message'] = array('name'=>'message', 'type'=>'textarea', 'rows'=>5, 'mandatory'=>true);

        if ($checkRCPT)
        {
            $fields['-hidden000-'] = array('name'=>'checkrcpt', 'value'=>1);
            $fields['Respect Allow Info Mail'] =
                array('name'=>'respect', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_respect'));
            $fields['Only to Verified Emails'] =
                array('name'=>'verified', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_to_verified'));
        }

        return $fields;
    }

    function _commandSendEmail($to, $subject, $group=null)
    {
        // Prefetch to have it in our language
        $okStr    = SB_T('%s - ok.');
        $errorStr = SB_T('%s - error!');

        $message  = stripslashes(SB_reqVal('message'));

        foreach ($to as $uid => $user)
        {
            $userparams = $user['params'];
            $this->um->explodeParams($userparams, 'tmp');

            if (SB_reqVal('checkrcpt'))
            {
                if (SB_reqChk('respect') && !$this->um->getParam('tmp','allow_info_mails'))
                {
                    continue;
                }

                if (SB_reqChk('verified') && !$user['verified'])
                {
                    continue;
                }
            }

            SB_SetLanguage($this->um->getParam('tmp','lang'));

            $body = '';
            if ($group)
            {
                $body = SB_P('command::contact_group',array($group, $message, SB_Page::absBaseUrl()));
            }
            else
            {
                $body = SB_P('command::contact',array($message, SB_Page::absBaseUrl()));
            }

            if (!$this->um->email || !$this->checkEmailCorrectness($this->um->email))
            {
                continue;
            }

            $ret = $this->um->sendMail($user, SB_T($subject), $body, $this->um->name, $this->um->email);

            // No translation here
            if ($ret)
            {
                $this->warn('%s', sprintf($okStr, $user['completenamehtml']));
            }
            else
            {
                $this->error('%s', sprintf($errorStr, $user['completenamehtml']));
            }
        }

        SB_SetLanguage($this->um->getParam('user','lang'));
    }

    function checkCookie()
    {
        if (!isset($_COOKIE['SB3COOKIE']))
        {
            $this->error('You have to enable cookies in order to log-in or sign-up!');
            return false;
        }
        return true;
    }

    function checkEmailCorrectness($email)
    {
        if (!strstr($email,'@'))
        {
            $this->error('The e-mail %s does not look correctly!', $email);
            return false;
        }
        return true;
    }

    function enrichFields()
    {
        $hasOptional = false;

        foreach (array('mandatory','optional') as $property)
        {
            $execute = $property . $this->shortName();
            $result = array();

            if (method_exists($this, $execute))
            {
                $result = $this->$execute();
            }

            foreach ($this->fields as $name => $params)
            {
                if (is_array($params))
                {
                    if (!isset($params[$property]) && isset($this->fields[$name]['name']))
                    {
                        $this->fields[$name][$property] = in_array($this->fields[$name]['name'], $result);
                    }
                    if ($property == 'optional' && isset($this->fields[$name][$property]) && $this->fields[$name][$property])
                    {
                        $hasOptional = true;
                    }
                }
            }
        }

        return $hasOptional;
    }

    function writeFields($optional, &$customButton, &$enabled)
    {
        $this->writingOptionalFields = $optional;
        $expertMode = $this->um->getParam('user','expert_mode');

        foreach ($this->fields as $name => $params)
        {
            $optionalField = !$expertMode && (is_array($params) && isset($params['optional']) && $params['optional']);

            if ($optionalField && !$optional)
            {
                continue;
            }

            if (!$optionalField && $optional)
            {
                continue;
            }

            if (!is_array($params))
            {
                if (strpos($name,'-raw')===0)
                {
                    echo $params;
                }
                else
                {
?>
<div class="label"><?php echo $params?></div>
<?php
                }

                continue;
            }

            $star = '';

            if (isset($params['mandatory']) && $params['mandatory'])
            {
                $star = '<span class="mandatory">&#42;</span>';
            }
?>
<div>
<?php

            if (!isset($params['type']))
            {
                $params['type'] = 'text';
            }

            $disabled = !$params || array_key_exists('disabled', $params);

            // Is at least one field enabled
            $enabled = ($name[0] != '-' && !$disabled) || $enabled;

            // If we have disabled field then keep the value that would
            // be otherwise lost. Needed to go back.
            if ($disabled && $params['type'] == 'text')
            {
                $params['value'] = str_replace('"',"'",$params['value']);
?>
    <input type="hidden" name="<?php echo SB_safeVal($params,'name') ?>" value="<?php echo $params['value']?>">
<?php
                $params['name'] = ''; // Don't use name with disabled fields.
            }

            if ($name[0] == '-')
            {
                $params['value'] = str_replace('"',"'",$params['value']);
?>
    <input type="hidden" name="<?php echo $params['name']?>" value="<?php echo $params['value']?>">
<?php
            }
            elseif (isset($params['type']) &&  ($params['type'] == 'checkbox' || $params['type'] == 'radio'))
            {
                $id = 'l_'.(isset($params['name'])?$params['name']:'_noname');
                $params['id'] = $id;
                if (!isset($params['value']))
                {
                    $params['value'] = 1;
                }
?>
    <div class="check" <?php echo $this->getToolTip($params)?>>
        <input <?php echo $this->getFieldParams($params)?>>
        <label for="<?php echo $id?>"><?php echo isset($params['-raw'])?$name:SB_T($name)?></label>
    </div>
<?php
            }
            elseif (isset($params['type']) && $params['type'] == 'select')
            {
                unset($params['type']);
?>
    <div class="label"><?php echo SB_T($name).$star?></div>
    <div class="data">
        <select <?php echo $this->getFieldParams($params)?>>
<?php
            $method = $params['_options'];
            $this->$method(
                isset($params['_select'])?$params['_select']:null,
                isset($params['_exclude'])?$params['_exclude']:null
                );
?>
        </select>
    </div>
<?php
            }
            elseif (isset($params['type']) && $params['type'] == 'selectextern')
            {
                unset($params['type']);
?>
    <div class="label"><?php echo SB_T($name).$star?></div>
    <div class="data">
        <select <?php echo $this->getFieldParams($params)?>>
<?php
            $params['_options'](
                isset($params['_select'])?$params['_select']:null,
                isset($params['_exclude'])?$params['_exclude']:null
                );
?>
        </select>
    </div>
<?php
            }
            elseif (isset($params['type']) &&  $params['type'] == 'callback')
            {
                if (isset($params['show_label']) && $params['show_label'])
                {
?>
                    <div class="label"><?php echo SB_T($name).$star?></div>
<?php
                }

                $this->{$params['function']}(isset($params['params'])?$params['params']:null);
            }
            elseif (isset($params['type']) &&  $params['type'] == 'callbackextern')
            {
                $params['function'](isset($params['params'])?$params['params']:null);
            }
            elseif (isset($params['type']) &&  ($params['type'] == 'button') || ($params['type'] == 'addbutton'))
            {
                if ($this->um->isAuthorized($name,false,null,SB_reqValInt('nid_acl'),SB_reqValInt('lid_acl')))
                {
                    if ($params['type'] == 'button')
                    {
                        $customButton = true;
                    }
?>
    <div>
        <input class="button customButton"
               type="button"
               onclick="this.form.button.value=this.getAttribute('x_value');this.form.submit();"
               x_value="<?php echo $name?>"
               value="<?php echo SB_T($name)?>">
    </div>
<?php
                }
            }
            elseif (isset($params['type']) && $params['type'] == 'textarea')
            {
                unset($params['type']);
                if (!isset($params['rows']))
                {
                    $params['rows'] = 5;
                }
                if (!isset($params['cols']))
                {
                    $params['cols'] = 1;
                }
?>
    <div class="label" <?php echo $this->getFieldParams($params,'title')?>><?php echo SB_T($name).$star?></div>
    <div class="data">
        <textarea <?php echo $this->getFieldParams($params)?>><?php echo isset($params['value'])?$params['value']:''?></textarea>
    </div>
<?php
            }
            else
            {
?>
    <div class="label"><?php echo SB_T($name).$star?></div>
    <div class="data">
        <input <?php echo $this->getFieldParams($params)?>>
        <input type="hidden" name="label_<?php echo $params['name']?>" value="<?php echo $name?>">
    </div>
<?php
            }
?>
</div>
<?php
        }
    }

    function getReferer()
    {
        return SB_safeVal($_REQUEST,'referer', SB_safeVal($_SERVER,'HTTP_REFERER'));
    }

    function writeForm()
    {
        $customButton = false;
        if ($this->useToolTips)
        {
?>
<div id='toolTip'></div>
<?php
        }

?>
<form method="POST" enctype="multipart/form-data" action="<?php echo FORM_ACTION_EXECUTOR ?>">
    <input type="hidden" name="command" value="<?php echo $this->command?>">
    <input type="hidden" name="button" value="">
    <input type="hidden" name="referer" value="<?php echo $this->getReferer() ?>">
<?php

        foreach ( $this->persistentParams as $param)
        {
            $value = SB_safeVal($_REQUEST, $param);
            if ($value)
            {
?>
        <input type="hidden" name="<?php echo $param?>" value="<?php echo $value?>">
<?php
            }
        }

        $enabled = false;

        // Add missing propeties
        $hasOptional = $this->enrichFields() && !$this->um->getParam('user','expert_mode');

        $this->writeFields($optional=false, $customButton, $enabled);

        if ($hasOptional)
        {
?>
<div id="showMore" onclick='SB_toggleMore(true);'><?php echo SB_T('Show Advanced Controls') ?></div>
<div id="showLess" onclick='SB_toggleMore(false);'><?php echo SB_T('Hide Advanced Controls') ?></div>
<div id="optionalFields">
<?php
        }

        $this->writeFields($optional=true, $customButton, $enabled);

        if ($hasOptional)
        {
?>
</div>
<?php
        }


        if (!$customButton)
        {
?>
    <div class="buttons">
        <input class="button" type="submit" name="do" value="<?php echo SB_T('Submit')?>">
<?php
            if ($enabled) :
?>
        <input class="button" type="reset" value="<?php echo SB_T('Reset')?>">
<?php
            endif;
?>
    </div>
<?php
        }

?>
</form>
<?php
    }

    function checkMandatoryFields($fields)
    {
        $ok = true;

        foreach ($fields as $field)
        {
            if (!SB_reqVal($field))
            {
                $ok = false;
            }
        }

        if (!$ok)
        {
            $this->error('Please fill mandatory fields!');
            $this->goBack();
        }

        return $ok;
    }

/* PART: Auth */

    function mandatoryLogIn()
    {
        return array('username','pass');
    }

    function buildLogIn()
    {
        $fields = array();

        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');

        SB_SetLanguage($lang);

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$lang, 'onChange'=>'this.form.submit()');

        $fields['Username'] = array('name'=>'username');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Remember Me'] = array('name'=>'expires','type'=>'select',
            '_options'=>'_buildExpirationList');

        if (SB_reqChk('forward'))
        {
            $fields['--hidden1--'] = array('name'=>'forward','value'=>SB_reqVal('forward'));
        }

        if ($this->showWithErrors)
        {
            $fields['Reset Password'] = array('type'=>'addbutton');
        }

        return $fields;
    }

    function _buildExpirationList()
    {
        $expiration = array
        (
            'Until I close browser' =>0,
            '12 hours' =>60*60*12,
            '6 days'   =>60*60*24*6,
            '1 month'  =>60*60*24*30,
            'Maximum session time' => $this->um->getParam('config','max_session_time'),
        );

        foreach ($expiration as $label => $value)
        {
            if ($value > $this->um->getParam('config','max_session_time'))
            {
                break;
            }

            echo '<option value="' . $value. '">' . SB_T($label). "</option>\n";
        }
    }

    function commandLogIn()
    {
        if (!$this->checkCookie())
        {
            $this->goBack();
            return;
        }

        $expires = min(SB_reqVal('expires'),$this->um->getParam('config','max_session_time'));

        if (!$this->um->login(SB_reqVal('username'), SB_reqVal('pass'), $expires))
        {
            $this->goBack();
            return;
        }

        // This should handle login from translator.php, we should avoid external redirect
        if (SB_reqChk('forward') && strpos(SB_reqVal('forward'),'/') === false)
        {
            header('Location: '.SB_reqVal('forward'));
            exit;
        }

        if (SB_reqChk('bookmarklet'))
        {
            $this->command = 'Add Bookmark';
            $this->fields = $this->buildAddBookmark();
        }
        else
        {
            $this->reload = true;
            $this->close = true;
        }
    }

    function commandLogOut()
    {
        $this->um->logout();
        $this->reload = true;
        $this->close = true;
    }

/* PART: Bookmark */

    /* Retrieve available link information. */
    function buildGetBookmarkInformation()
    {
        $this->command = SB_reqVal('origin');
        $execute = 'build'.str_replace(' ','',$this->command);
        $this->getInfo = true;

        $fields = $this->$execute();

        if ($this->hasErrors(E_WARNING) && !$this->hasErrors(E_ERROR))
        {
            $this->showWithErrors = true;
        }
        return $fields;
    }

    function mandatoryAddBookmark()
    {
        return $this->mandatoryProperties();
    }

    function optionalAddBookmark()
    {
        return $this->optionalProperties();
    }

    function buildAddBookmark()
    {
        $fields = array();
        $node = null;
        $favicon = '';
        $name = SB_reqVal('name');
        $comment = SB_reqVal('comment');
        $is_feed = SB_reqVal('is_feed');

        if (SB_reqChk('nid_acl') && SB_reqVal('bookmarklet')!=1)
        {
            $node = $this->tree->getNode(SB_reqValInt('nid_acl'));
            $fields['-hidden0-'] = array('name'=>'nid_acl','value'=>$node->id);
            $fields['Parent Folder'] = array('name'=>'parent',
                'value'=>$node->name,'disabled'=>null);
            if (!$node) return null;
        }
        else
        {
            $this->bookmarklet = true;

            if (SB_reqVal('bookmarklet')!=1)
            {
                $cp = SB_reqVal('cp');

                // If we have empty cp or undefined use iso
                if (!strlen($cp) || $cp=='undefined')
                {
                    $cp = "iso-8859-1";
                }

                require_once('./inc/converter.inc.php');
                $c = new SB_Converter($this->um->getParam('config','use_conv_engine'),$cp);
                $name = $c->utf8RawUrlDecode($name);
            }

            if ($this->um->isAnonymous())
            {
                $this->command = 'Log In';
                $fields = $this->buildLogIn();
                $fields['-hidden0-'] = array('name'=>'bookmarklet','value'=>1);
                $fields['-hidden1-'] = array('name'=>'name','value'=>$name);
                $fields['-hidden2-'] = array('name'=>'url','value'=>SB_reqVal('url'));
                $fields['-hidden3-'] = array('name'=>'cp','value'=>SB_reqVal('cp'));
                return $fields;
            }

            $fields['Parent Folder'] = array('type'=>'callback','function'=>'_buildAddBookmark');
            $fields['Create New Sub Folder'] = array('name'=>'newfolder');
            $fields['Remember as Default'] = array('name'=>'default_folder','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_default_folder'));

            if (strlen($this->um->getParam('user','default_folder')))
            {
                $fields['Remember as Default']['checked'] = null;
            }

            $fields['-hidden0-'] = array('name'=>'bookmarklet','value'=>1);
            $this->nobuttons = true;

            // If we want to get favicon on submit, then do it better now
            // we will get more information.
            if ($this->um->getParam('user','auto_retrieve_favicon'))
            {
                $this->getInfo = true;
            }
        }

        $fields = array_merge($fields,$this->buildProperties());

        if ($fields['URL']['value'] == '')
        {
            $fields['URL']['value'] = $this->um->getParam('user','default_url');
        }

        if ($name && empty($fields['Bookmark Name']['value']) )
        {
            $fields['Bookmark Name']['value'] = $name;
        }

        if ($is_feed)
        {
            $fields['Feed Bookmark']['checked'] = null;
        }

        if ($this->hasErrors(E_WARNING) && !$this->hasErrors(E_ERROR))
        {
            $this->showWithErrors = true;
        }

        return $fields;
    }

    function commandAddBookmark()
    {
        $nid = SB_reqValInt('nid_acl',true);
        $node = $this->tree->getNode($nid);
        if (!$node) return;

        if (SB_reqChk('bookmarklet'))
        {
            if (strlen(SB_reqVal('newfolder'))>0)
            {
                $newnode = $this->tree->addNode($nid, SB_reqVal('newfolder'));
                if ($this->hasErrors())
                {
                    return;
                }
                $nid = $newnode;
            }
        }

        // Get values entered by the user
        $url = SB_reqVal('url');
        $favicon = SB_reqVal('favicon');
        $name = SB_reqVal('name');
        $is_feed = SB_reqVal('is_feed');

        // If we have bookmarklet we have already received the icon
        if (!SB_reqChk('bookmarklet') && !$favicon && $this->um->getParam('user','auto_retrieve_favicon'))
        {
            $this->ignoreWarnings();
            require_once('./inc/pageparser.inc.php');
            $page = new SB_PageParser( $url, array('FAVURL'));
            $page->getInformation(array('FAVURL'));
            $this->ignoreWarnings(false);

            if (!$page->isDead && $page->errorCode['FAVURL']<PP_ERR)
            {
                $favicon = $page->info['FAVURL'];
                $favurl   = 'favicon.php?' . md5($favicon) . '=' . SB_reqValInt('lid_acl');
                $this->message = SB_T('Favicon <img src="%s"> found at url %s.', array($favurl, $url));
            }
            else
            {
                $this->message = SB_T('Favicon not found!');
            }
        }

        $insert = array
        (
            'name'=>$name,
            'url'=>$url,
            'favicon'=>$favicon,
            'target'=>SB_reqVal('link_target'),
            'private'=>SB_reqVal('private')?1:0,
            'is_feed'=>SB_reqVal('is_feed')?1:0,
            'comment'=>SB_reqVal('comment'),
            'validate'=>SB_reqVal('novalidate')?0:1,
        );

        $this->tree->addLink($nid, $insert);
        $this->markHasLink();

        if (SB_reqChk('bookmarklet'))
        {
            if (SB_reqChk('default_folder'))
            {
                $this->um->setParam('user','default_folder', $nid);
            }
            $this->um->saveUserParams();
            $this->bookmarklet = true;
            $this->nobuttons = true;
            $this->message =
                SB_T("Link has been added.<p>You must reload your SiteBar in order to see added link!");
        }
    }

    function commandMarkasDefault()
    {
        $this->um->setParam('user','default_folder',SB_reqValInt('nid_acl'));
        $this->um->saveUserParams();
        exit;
    }

/******************************************************************************/

    function mandatoryProperties()
    {
        static $fields = array
        (
            'name',
            'url',
        );
        return $fields;
    }

    function optionalProperties()
    {
        static $fields = array
        (
            'link_target',
            'favicon',
            'novalidate',
            'private',
            'is_feed',
        );
        return $fields;
    }

    function buildProperties()
    {
        $fields = array();
        $link = null;

        if ($this->command!='Add Bookmark')
        {
            $link = $this->tree->getLink(SB_reqValInt('lid_acl'));
            if (!$link) return null;
        }
        else
        {
            $link = new SB_Tree_Link(array());
        }

        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>$link->id);
        $fields['URL'] = array('name'=>'url');

        if ($this->command!='Delete Bookmark')
        {
            /* Show the 'Retrieve Info' button only in case it has not been yet
             * performed
             */
            $fields['Get Bookmark Information'] = array('type'=>'addbutton');
            $fields['-hidden4-'] = array('name'=>'origin','value'=>$this->command);
        }

        $fields['Bookmark Name'] = array('name'=>'name', 'maxlength'=>255);

        $size = strlen($link->comment);
        $MAXSIZETOEDIT = 4096;

        if ($size<=$MAXSIZETOEDIT)
        {
            $fields['Description'] = array('name'=>'comment', 'type'=>'textarea');
        }
        else
        {
            $fields['-raw1-'] = SB_T("Description too long for inplace editing, please use export feature!");
        }

        if ($this->um->getParam('user','use_favicons'))
        {
            $fields['Favicon'] = array('name'=>'favicon', 'maxsize'=>32000);
            $fields['-raw2-'] = '';
        }

        if (strlen(SB_reqVal('url')))
        {
            $link->url = SB_reqVal('url');
        }

        if ($this->getInfo && strlen(SB_reqVal('url')))
        {
            $link->name = SB_reqVal('name');
            $link->comment = SB_reqVal('comment');
            $link->favicon = SB_reqVal('favicon');

            /* Try to get the title and favicon */
            require_once('./inc/pageparser.inc.php');
            $page = new SB_PageParser( $link->url );

            if ($page->getInformation(array('CHARSET', 'TITLE', 'FAVURL','DESC','KEYWORDS')))
            {
                $cp = 'iso-8859-1';

                if ($page->errorCode['CHARSET']<PP_ERR)
                {
                    $cp = $page->info['CHARSET'];
                }

                require_once('./inc/converter.inc.php');
                $c = new SB_Converter($this->um->getParam('config','use_conv_engine'),$cp);


                if (isset($page->info['TITLE']))
                {
                    $link->name = $c->utf8RawUrlDecode($page->info['TITLE']);
                }

                if (!$link->comment && isset($page->info['DESC']))
                {
                    $link->comment = $c->utf8RawUrlDecode($page->info['DESC']);
                }

                if ($this->um->getParam('user','use_favicons'))
                {
                    if (!$link->favicon && isset($page->info['FAVURL']))
                    {
                        $link->favicon = $page->info['FAVURL'];

                        /* Show the retrieved favicon. */
                        if ($this->command=='Add Bookmark')
                        {
                            /* Show the retrieved favicon. */
                            $wrong = SB_Skin::imgsrc('link_wrong_favicon');
                            $fields['-raw2-'] = "<div><img class='favicon' alt='' src='".$link->favicon."' onerror='this.src=\"$wrong\"'></div>";
                        }
                        else
                        {
                            $fields['-raw2-'] = $this->_buildFavicon(SB_reqValInt('lid_acl'), $link->favicon);
                        }
                    }
                }
            }
        }

        $fields['URL']['value'] = $link->url;
        $fields['Bookmark Name']['value'] = $link->name;
        $fields['Description']['value'] = $link->comment;

        if ($this->um->getParam('user','use_favicons'))
        {
            if ($this->command!='Add Bookmark')
            {
                $favicon = $link->favicon;

                if (substr($link->favicon,0,7) == 'binary:')
                {
                    require_once('./inc/faviconcache.inc.php');
                    $fc = & SB_FaviconCache::staticInstance();
                    $favicon = 'data:image/x-icon;base64,'.base64_encode($fc->faviconGet($link->favicon, null));
                }

                if ($link->favicon)
                {
                    $fields['-raw2-'] = $this->_buildFavicon($link->id, $link->favicon);
                }
            }

            $fields['Favicon']['value'] = $link->favicon;
        }

        $size = strlen($link->comment);
        $MAXSIZETOEDIT = 4096;

        if ($size<=$MAXSIZETOEDIT)
        {
            $fields['Description'] = array('name'=>'comment',
                'type'=>'textarea','value'=>$link->comment);
        }
        else
        {
            $fields['-raw1-'] = SB_T("Description too long for inplace editing, please use export feature!");
        }

        $fields['Feed Bookmark'] = array('name'=>'is_feed','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_is_feed'));
        if ($link->is_feed)
        {
            $fields['Feed Bookmark']['checked'] = null;
        }

        if ($this->command=='Add Bookmark' || $this->tree->inMyTree($link->id_parent))
        {
            $fields['Private'] = array('name'=>'private','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_private'));
            if ($link->private)
            {
                $fields['Private']['checked'] = null;
            }
        }

        if ($link->is_dead)
        {
            $fields['Dead Bookmark'] = array('name'=>'is_dead_check','type'=>'checkbox','checked'=>null,
                'title'=>SB_P('command::tooltip_is_dead_check'));
            $fields['-hidden2-'] = array('name'=>'is_dead','type'=>'hidden','value'=>1);
        }

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $fields['Exclude From Validation'] = array('name'=>'novalidate','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_novalidate'));
            if (!$link->validate)
            {
                $fields['Exclude From Validation']['checked'] = null;
            }
        }

        $fields['Target'] = array('name'=>'link_target', 'value'=>$link->target);

        if ($this->command!='Delete Bookmark')
        {
            if (($this->um->getParam('config','comment_impex') && strlen($link->comment)>0)
            ||  strlen($link->comment)>=$MAXSIZETOEDIT)
            {
                $fields['Export Description'] = array('name'=>'command','type'=>'addbutton');
            }

            if ($this->um->getParam('config','comment_impex'))
            {
                $fields['Import Description'] = array('name'=>'command','type'=>'addbutton');
            }
        }

        if ($this->command=='Properties')
        {
            $fields['Delete Bookmark'] = array('type'=>'addbutton');
        }

        return $fields;
    }

    function commandProperties()
    {
        if (SB_reqVal('private'))
        {
            $link = $this->tree->getLink(SB_reqValInt('lid_acl'));
            if (!$link) return;
            if (!$this->tree->inMyTree($link->id_parent))
            {
                $this->um->accessDenied();
                return;
            }
        }

        $limit = $this->um->getParam('config','comment_limit');

        if ($limit && $limit<strlen(SB_reqVal('comment')))
        {
            $this->error('The description length exceeds maximum length of %s bytes!', array($limit));
            return;
        }

        $favicon = SB_reqVal('favicon');

        if ($this->um->getParam('config','use_favicon_cache'))
        {
            require_once('./inc/faviconcache.inc.php');
            $fc = & SB_FaviconCache::staticInstance();

            if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $favicon, $reg))
            {
                $favicon = $fc->saveFaviconBase64($reg[2]);
            }
            else
            {
                // Delete old URL favicon from cache on update to allow new version
                $fc->purge(SB_reqValInt('lid_acl'));
            }
        }

        $update = array
        (
            'name'=>SB_reqVal('name'),
            'url'=>SB_reqVal('url'),
            'favicon'=>$favicon,
            'target'=>SB_reqVal('link_target'),
            'private'=>SB_reqVal('private')?1:0,
            'is_feed'=>SB_reqVal('is_feed')?1:0,
            'comment'=>SB_reqVal('comment'),
            'validate'=>SB_reqVal('novalidate')?0:1,
        );

        if (SB_reqVal('is_dead') && !SB_reqVal('is_dead_check'))
        {
            $update['is_dead'] = 0;
        }

        $this->tree->updateLink(SB_reqValInt('lid_acl', true), $update);
    }

/******************************************************************************/

    function optionalDeleteBookmark()
    {
        return $this->optionalProperties();
    }

    function buildDeleteBookmark()
    {
        $fields = $this->buildProperties();

        foreach ($fields as $name => $value)
        {
            if (!is_array($fields[$name]) || (isset($fields[$name]['type']) && $fields[$name]['type']=='hidden'))
            {
                continue;
            }

            if (isset($fields[$name]['name']) && !strstr($name,'-raw'))
            {
                $fields[$name]['disabled'] = null;
            }
        }

        return $fields;
    }

    function commandDeleteBookmark()
    {
        $link = $this->tree->getLink(SB_reqValInt('lid_acl'));

        if (!$link)
        {
            return;
        }

        $this->tree->removeLink($link->id);
        $node = $this->tree->getNode($link->id_parent);

        if (!$node)
        {
            return;
        }

        if (!$this->um->getParam('user','use_trash') && $node->hasRight('purge'))
        {
            $this->tree->purgeNode($link->id_parent);
        }
    }

/* PART: Folder */

    function _buildFolderSortMode($select=null)
    {
        $modes = array
        (
            'user',
            'custom',
            'abc',
            'added',
            'changed',
        );

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $modes[] = 'visited';
            $modes[] = 'hits';
            $modes[] = 'waiting';
        }

        foreach ($modes as $mode)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . SB_T($this->tree->sortModeLabel[$mode]) . "</option>\n";
        }
    }

    function mandatoryAddFolder()
    {
        return array('name');
    }

    function buildAddFolder()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));
        if (!$node) return null;

        if ($this->command == 'Add Folder')
        {
            $fields['Parent Folder'] = array('name'=>'parent','value'=>$node->name, 'disabled'=>null);
        }

        $fields['Folder Name'] = array('name'=>'name','maxlength'=>255);
        $fields['Sort Mode'] = array('name'=>'sort_mode','type'=>'select',
                '_options'=>'_buildFolderSortMode', '_select'=>$node->sort_mode);

        $fields['Description'] = array('name'=>'comment', 'type'=>'textarea');
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        if ($this->command != 'Add Folder')
        {
            $fields['Folder Name']['value'] = $node->name;
            $fields['Description']['value'] = $node->comment;
        }

        return $fields;
    }

    function commandAddFolder()
    {
        $nid = $this->tree->addNode(SB_reqValInt('nid_acl'),SB_reqVal('name'),
            SB_reqVal('comment'), SB_reqVal('sort_mode'));
    }

    function buildHideFolder()
    {
        $this->skipBuild = true;
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');
        $this->um->hiddenFolders[SB_reqValInt('nid_acl')] = 1;
        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();
    }

    function buildUnhideSubfolders()
    {
        $this->skipBuild = true;
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');

        $parent = $this->tree->getNode(SB_reqValInt('nid_acl'));

        $this->tree->loadNodes($parent, false, 'select', true);

        foreach ($parent->getNodes() as $node)
        {
            if (isset($this->um->hiddenFolders[$node->id]))
            {
                unset($this->um->hiddenFolders[$node->id]);
            }
        }

        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();
    }

    function mandatoryFolderProperties()
    {
        return $this->mandatoryAddFolder();
    }

    function buildFolderProperties()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));

        $fields = $this->buildAddFolder();

        if ( $node->id_parent && !$node->parentHasRight('update') )
        {
            foreach ($fields as $name => $param)
            {
                if ($name[0] != '-')
                {
                    $fields[$name]['disabled'] = null;
                }
            }
        }

        $fields['Custom Order'] = array('type'=>'addbutton');
        $fields['Delete Folder'] = array('type'=>'addbutton');
        $fields['Import Bookmarks'] = array('type'=>'addbutton');
        $fields['Export Bookmarks'] = array('type'=>'addbutton');
        $fields['Validate Bookmarks'] = array('type'=>'addbutton');
        $fields['Folder Sharing'] = array('type'=>'addbutton');

        if ($node->id_parent==0 && $this->um->isAdmin())
        {
            if ($this->um->useUserFilter() && !SB_reqChk('uregexp'))
            {
                $fields['Filter User RegExp'] = array('name'=>'uregexp');
                $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Folder Properties');
                $fields['Filter Users'] = array('type'=>'button');
            }

            if (!$this->um->useUserFilter() || SB_reqChk('uregexp'))
            {
                $fields['Tree Owner'] = array('name'=>'uid','type'=>'select',
                    '_options'=>'_buildUserList', '_select'=>SB_reqVal('uid'));
            }
        }

        return $fields;
    }

    function commandFolderProperties()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));
        if ($node->id_parent && !$node->parentHasRight('update'))
        {
            return;
        }

        $nid = SB_reqValInt('nid_acl');

        $columns = array
        (
            'name' => SB_reqVal('name'),
            'sort_mode' => SB_reqVal('sort_mode'),
            'comment'=> SB_reqVal('comment'),
        );

        $this->tree->updateNode( $nid, $columns);

        if (SB_reqVal('uid'))
        {
            $this->tree->updateNodeOwner( $nid, SB_reqVal('uid'));
        }
    }

    function buildCustomOrder()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));
        $this->tree->loadNodes($node);

        $fields['-raw1-'] = "<table cellpadding='0'>";

        foreach ($node->getChildren() as $child)
        {
            $id = $child->type_flag.$child->id;
            $fields[$id] = array
            (
                'type'=>'callback',
                'function'=>'_buildFolderOrder',
                'params'=>array('name'=>$child->name,'id'=>$id,'order'=>$child->order),
            );
        }

        $fields['-raw2-'] = "</table>";
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        return $fields;
    }

    function commandCustomOrder()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));
        $this->tree->loadNodes($node);

        $order = array();

        foreach ($node->getChildren() as $child)
        {
            $id = $child->type_flag.$child->id;
            $order[] = $id.'~'.intval(SB_reqVal('id'.$id));
        }

        $columns = array
        (
            'custom_order' => implode(':',$order),
            'sort_mode' => 'custom',
        );

        $this->tree->updateNode($node->id, $columns);
        $this->forwardCommand('Folder Properties');
    }

    function _deleteContentOnly(&$node)
    {
        if ($node->id_parent)
        {
            return !$node->parentHasRight('delete');
        }
        else
        {
            return !$this->um->getParam('config','allow_user_tree_deletion');
        }
    }

    function buildDeleteFolder()
    {
        $fields = $this->buildDeleteTree();
        $fields['Delete Content Only'] = array('name'=>'content','type'=>'checkbox',
            'title'=>SB_P('command::tooltip_delete_content'));

        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));

        if ($this->_deleteContentOnly($node))
        {
            $fields['Delete Content Only']['checked'] = null;
            $fields['Delete Content Only']['disabled'] = null;
        }

        return $fields;
    }

    function commandDeleteFolder()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl', true));
        $deleteContentOnly = SB_reqVal('content') || $this->_deleteContentOnly($node);

        $this->tree->removeNode(SB_reqValInt('nid_acl'), $deleteContentOnly);

        if (!$this->um->getParam('user','use_trash') && $node->hasRight('purge'))
        {
            $this->tree->purgeNode(SB_reqValInt('nid_acl'));
        }
    }

    function buildPurgeFolder()
    {
        return $this->buildDeleteTree();
    }

    function commandPurgeFolder()
    {
        $this->tree->purgeNode(SB_reqValInt('nid_acl'));
    }

    function buildUndelete()
    {
        return $this->buildDeleteTree();
    }

    function commandUndelete()
    {
        $this->tree->undeleteNode(SB_reqValInt('nid_acl'));
    }

    function _buildPasteMode($params)
    {
?>
    <div class="label"><?php echo SB_T('Paste Mode')?></div>
    <input id='pm_copy' value="Copy" type="radio" name="mode" <?php echo $params['canMove']?'':'checked'?>>
    <label for='pm_copy'><?php echo SB_T('Copy (Keep Source)')?></label><br>
    <input id='pm_move' value="Move" type="radio" name="mode" <?php echo $params['canMove']?'checked':'disabled'?>>
    <label for='pm_move'><?php echo SB_T('Move (Delete Source)')?></label><br>
<?php
    }

    function buildPaste()
    {
        $fields = array();
        $sourceId   = SB_reqVal('sid',true);
        $sourceIsNode = SB_reqVal('stype',true);
        $sourceObj  = null;
        $targetID = SB_reqValInt('nid_acl',true);
        $targetNode = $this->tree->getNode($targetID);
        $sourceNodeId = $sourceId;

        if ($sourceIsNode)
        {
            $sourceObj = $this->tree->getNode($sourceId);
            if (!$this->um->isAuthorized('Copy', false, null, $sourceId))
            {
                $this->um->accessDenied();
                return;
            }

            $parents = $this->tree->getParentNodes($targetID);

            if (in_array($sourceId, $parents))
            {
                $this->warn('Cannot move folder to its subfolder!');
                return;
            }
        }
        else
        {
            $sourceObj = $this->tree->getLink($sourceId);
            $sourceNodeId = $sourceObj->id_parent;

            if (!$this->um->isAuthorized('Copy Bookmark', false, null, null, $sourceId))
            {
                $this->um->accessDenied();
                return;
            }

            if ($sourceObj->id_parent == $targetNode->id)
            {
                $this->warn('Link already is in the target folder!');
                return;
            }
        }

        $canMove = $this->um->canMove($sourceNodeId,$targetNode->id,$sourceIsNode);

        if ($this->um->getParam('user','paste_mode')!='ask')
        {
            $this->skipBuild = true;
            $this->reload = !$this->um->getParam('user','extern_commander');
            $this->close = $this->um->getParam('user','auto_close');

            $move = $canMove && $this->um->getParam('user','paste_mode')=='move';
            $this->executePaste($targetNode->id, $sourceId, $sourceIsNode, $move);
            return;
        }

        $fields[$sourceIsNode?SB_T('Source Folder Name'):SB_T('Copy Bookmark')] =
            array('name'=>'sidname', 'value'=>$sourceObj->name, 'disabled' => null);
        $fields['Target Folder Name'] =
            array('name'=>'tidname', 'value'=>$targetNode->name, 'disabled' => null);

        if ($sourceIsNode)
        {
            $fields['Content Only'] = array('name'=>'content','type'=>'checkbox',
                'title'=>SB_P('command::tooltip_paste_content'));
        }


        $fields['Mode'] = array('type'=>'callback', 'function'=>'_buildPasteMode',
            'params'=>array('canMove'=>$canMove));

        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$targetNode->id);
        $fields['-hidden2-'] = array('name'=>'sid','value'=>$sourceId);
        $fields['-hidden3-'] = array('name'=>'stype','value'=>$sourceIsNode);

        return $fields;
    }

    function commandPaste()
    {
        $targetID = SB_reqValInt('nid_acl');
        $sourceId   = SB_reqVal('sid',true);
        $sourceIsNode = SB_reqVal('stype',true);
        $move = SB_reqVal('mode',true)=='Move';

        $this->executePaste($targetID, $sourceId, $sourceIsNode, $move, SB_reqVal('content'));
    }

    function executePaste($targetID, $sourceId, $sourceIsNode, $move, $contentOnly=false)
    {
        $targetNode = $this->tree->getNode($targetID);
        $sourceObj  = null;

        if ($sourceIsNode)
        {
            $sourceObj = $this->tree->getNode($sourceId);
            if (!$this->um->isAuthorized('Copy', false, null, $sourceId) ||
                ($move && !$this->um->canMove($sourceId, $targetNode->id, true)))
            {
                $this->um->accessDenied();
                return;
            }

            if ($move)
            {
                $this->tree->moveNode( $sourceId, $targetNode->id, $contentOnly);
            }
            else
            {
                $this->tree->copyNode( $sourceId, $targetNode->id, $contentOnly);
            }
        }
        else
        {
            $sourceObj = $this->tree->getLink($sourceId);
            if (!$this->um->isAuthorized('Copy Bookmark', false, null, null, $sourceId) ||
                ($move && !$this->um->canMove($sourceObj->id_parent, $targetNode->id, false)))
            {
                $this->um->accessDenied();
                return;
            }

            if ($move)
            {
                $this->tree->moveLink( $sourceId, $targetNode->id);
            }
            else
            {
                $this->tree->copyLink( $sourceId, $targetNode->id);
            }
        }
    }

/* PART: Mesenger */

    function _buildMessengerFormatting($select=null)
    {
        $um =& SB_UserManager::staticInstance();

        $formats = array();
        $formats['html'] = 'HTML';
        $formats['plain'] = 'Plain Text';

        foreach ( $formats as $format => $label)
        {
            echo '<option '. ($select==$format?'selected':'') .
                 ' value="' . $format . '">' . $label . "</option>\n";
        }
    }

    function _buildMessengerFrom($select=null)
    {
        $froms = array();

        if (SB_reqChk('command_gid') && $this->um->isModerator(SB_reqVal('command_gid')))
        {
            $froms['moderator'] = 'Group Moderator';
        }

        if ($this->um->isAdmin())
        {
            $froms['admins'] = 'Administrators';
        }

        $froms['user'] = 'Current User';

        foreach ( $froms as $from => $label)
        {
            echo '<option '. ($select==$from?'selected':'') .
                 ' value="' . $from . '">' . $label . "</option>\n";
        }
    }

    function _buildMessengerCommon(&$fields, $to)
    {
        $fields['--hidden1-'] = array('name'=>'uid', 'value'=>SB_reqVal('uid'));
        $fields['--hidden2-'] = array('name'=>'command_gid', 'value'=>SB_reqVal('command_gid'));

        $isModerator = SB_reqChk('command_gid') && $this->um->isModerator(SB_reqVal('command_gid'));

        if ($isModerator || $this->um->isAdmin())
        {
            $fields['From'] =  array('name'=>'from','type'=>'select','_options'=>'_buildMessengerFrom');
            $fields['To (Just Label)'] =  array('name'=>'to','value'=>$to);
        }
        else
        {
            $fields['To'] =  array('disabled'=>1, 'name'=>'to','value'=>$to);
        }

        $fields['Subject'] = array('name'=>'subject');

        if (SB_reqChk('inre'))
        {
            $where = array('mid'=>intval(SB_reqVal('inre')));
            $db =& SB_Database::staticInstance();
            $res = $db->select('subject','sitebar_message', $where);
            if ($res)
            {
                $rec = $db->fetchRecord($res);
                $subject = $rec['subject'];

                if (strpos($subject, SB_T('Re:')) != 0)
                {
                    $subject = SB_T('Re:') . ' ' . $subject;
                }

                $where['^1'] = 'AND';
                $where['uid'] = $this->um->uid;
                if ($db->select(null,'sitebar_message_folder',$where))
                {
                    $fields['Subject']['value'] = $subject;
                }
            }
        }

        $fields['Message'] = array('name'=>'message', 'type'=>'textarea', 'rows'=>5);

        if ($this->um->isAdmin())
        {
            $fields['--raw1-'] = '<p><a target="_blank" href="http://www.fckeditor.net/demo/default.html">FCKeditor - WYSIWYG</a></p>';

            $fields['Formatting'] = array('name'=>'format','type'=>'select','_options'=>'_buildMessengerFormatting');

            $fields['Respect Allow Info Mail'] = array
            (
                'name'=>'respect',
                'type'=>'checkbox',
                'checked'=>0,
                'title'=>SB_P('command::tooltip_respect')
            );

            $fields['Expiration'] = array
            (
                'name'=>'expires',
                'value'=>date('Y-m-d', mktime(0,0,0,date('m')+1,date('d'),date('Y')) )
            );
        }
    }

    function buildSendMessagetoUser()
    {
        $fields = array();
        $fromuser = $this->um->getUser(intval(SB_reqVal('uid')));
        $this->_buildMessengerCommon($fields, $fromuser['fullname']);
        return $fields;
    }

    function buildSendMessagetoAll()
    {
        $fields = array();
        $this->_buildMessengerCommon($fields, SB_T('All Users'));
        $groups = $this->um->getGroups();
        $fields['Excludes Members of Groups'] = array('name'=>'gids[]','type'=>'select','_options'=>'_buildGroupMultipleList','size'=>count($groups),'multiple'=>null);
        return $fields;
    }

    function buildSendMessagetoMembers()
    {
        $fields = array();
        $group = $this->um->getGroup(SB_reqVal('command_gid', true));
        $this->_buildMessengerCommon($fields, SB_T('Members of %s Group', $group['name']));
        return $fields;
    }

    function buildSendMessagetoModerators()
    {
        $fields = array();
        $group = $this->um->getGroup(SB_reqVal('command_gid', true));
        $this->_buildMessengerCommon($fields, SB_T('Moderators of %s Group', $group['name']));
        return $fields;
    }

    function _commandMessengerCommon(&$to, $pm_notification=false)
    {
        if ($this->hasErrors())
        {
            return;
        }

        $params = array(
            'to_label' => SB_reqVal('to'),
            'to_list' => $to,
            'subject' => SB_reqVal('subject'),
            'message' => SB_reqVal('message'),
            'expires' => SB_reqVal('expires'),
            'pm_notification' => $pm_notification,
            'gid' => SB_reqChk('command_gid')?SB_reqVal('command_gid'):null);

        if (SB_reqChk('from'))
        {
            $params['from_role'] = SB_reqVal('from');
        }
        if (SB_reqChk('respect'))
        {
            $params['respect'] = SB_reqVal('respect');
        }
        if ($this->um->isAdmin())
        {
            $params['format'] = SB_reqVal('format');
        }

        $counter = $this->um->privateMessage($params);

        if ($counter>1)
        {
            $this->warn('Sent to %s recipients.', $counter);
        }
    }

    function commandSendMessagetoUser()
    {
        $uid = SB_reqVal('uid', true);
        $to = array($uid => $this->um->getUser($uid));
        $this->_commandMessengerCommon($to, true);
    }

    function commandSendMessagetoAll()
    {
        $to = $this->um->getUsers();
        if (SB_reqChk('gids'))
        {
            foreach (SB_reqVal('gids') as $gid)
            {
                foreach ($this->um->getMembers($gid) as $uid => $rec)
                {
                    if (isset($to[$uid]))
                    {
                        unset($to[$uid]);
                    }
                }
            }
        }
        $this->_commandMessengerCommon($to);
    }

    function commandSendMessagetoMembers()
    {
        $to = $this->um->getMembers(SB_reqVal('command_gid', true));
        $this->_commandMessengerCommon($to, true);
    }

    function commandSendMessagetoModerators()
    {
        $to = $this->um->getMembers(SB_reqVal('command_gid', true), true);
        $this->_commandMessengerCommon($to, true);
    }


/* PART: Other */

    function _buildAuthList($select=null)
    {
        foreach ($this->_getAuthMethod() as $auth)
        {
            echo '<option '. ($select==$auth?'selected':'') .
                 ' value="' . $auth . '">' . (strlen($auth)?$auth:'SiteBar') . "</option>\n";
        }
    }

    function _buildVersionCheckInterval($select=null)
    {
        $intervals = array
        (
            'Disabled' =>0,
            '12 hours'  =>60*60*12,
            '1 month' =>60*60*24*30,
        );

        foreach ($intervals as $label => $value)
        {
            echo '<option '. ($select==$value?'selected':'') .
                 ' value="' . $value. '">' . SB_T($label). "</option>\n";
        }
    }

    function _buildIntegSelector($select=null)
    {
        $integs = array
        (
            'Keep Current URL' => '',
            'Local Installation' => 'integrator.php',
            'my.sitebar.org [Stable]' => 'http://my.sitebar.org/integrator.php',
            'beta.sitebar.org [SVN]' => 'http://beta.sitebar.org/integrator.php',
        );

        foreach ($integs as $label => $url)
        {
            echo '<option value="' . $url . '">' . SB_T($label) . "</option>\n";
        }
    }

    function mandatorySiteBarSettings()
    {
        return array('sender_email');
    }

    function optionalSiteBarSettings()
    {
        static $fields = array
        (
            'allow_custom_search_engine',
            'allow_user_groups',
            'allow_user_tree_deletion',
            'allow_user_trees',
            'comment_impex',
            'comment_limit',
            'default_groups',
            'public_groups',
            'filter_groups',
            'filter_users',
            'integrator_url_sel',
            'integrator_url',
            'max_session_time',
            'search_engine_ico',
            'search_engine_url',
            'show_statistics',
            'use_compression',
            'use_conv_engine',
            'use_hit_counter',
            'use_mail_features',
            'use_nice_url',
            'use_outbound_connection',
            'web_search_user_agents',
        );

        return $fields;
    }

    function buildSiteBarSettings()
    {
        $fields = array();

        if (count($this->_getAuthMethod()))
        {
            $fields['Authentication Method'] = array('name'=>'auth','type'=>'select',
                '_options'=>'_buildAuthList', '_select'=>$this->um->getParam('config','auth'));
        }

        $fields['Allow Anonymous Contact'] = array('name'=>'allow_contact', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_contact'),
            'title'=>SB_P('command::tooltip_allow_contact'));

        $fields['Allow Custom Web Search Engine'] = array('name'=>'allow_custom_search_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_custom_search_engine'),
            'title'=>SB_P('command::tooltip_allow_custom_search_engine'));

        $fields['Allow Sign Up'] = array('name'=>'allow_sign_up', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_sign_up'),
            'title'=>SB_P('command::tooltip_allow_sign_up'));

        $fields['Description Import/Export'] = array('name'=>'comment_impex', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','comment_impex'),
            'title'=>SB_P('command::tooltip_comment_impex'));

        $fields['Default Groups'] = array('name'=>'default_groups',
            'value'=>$this->um->getParam('config','default_groups'),
            'title'=>SB_P('command::tooltip_default_groups'));

        $fields['Public Groups'] = array('name'=>'public_groups',
            'value'=>$this->um->getParam('config','public_groups'),
            'title'=>SB_P('command::tooltip_public_groups'));

        $fields['Filter Users'] = array('name'=>'filter_users', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','filter_users'),
            'title'=>SB_P('command::tooltip_filter_users'));

        $fields['Filter Groups'] = array('name'=>'filter_groups', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','filter_groups'),
            'title'=>SB_P('command::tooltip_filter_groups'));

        $fields['Integrator URL Selector'] = array('name'=>'integrator_url_sel', 'type'=>'select',
                'onchange'=>'if (this.value.length) this.form.integrator_url.value = this.value',
                '_options'=>'_buildIntegSelector', '_select'=>0);

        $fields['Integrator URL'] = array('name'=>'integrator_url',
            'value'=>$this->um->getParamB64('config','integrator_url'),
            'title'=>SB_P('command::tooltip_integrator_url'));

        $fields['Link Description Length'] = array('name'=>'comment_limit',
            'value'=>$this->um->getParam('config','comment_limit'),
            'title'=>SB_P('command::tooltip_comment_limit'));

        $fields['Maximum Session Time (sec)'] = array('name'=>'max_session_time',
            'value'=>$this->um->getParam('config','max_session_time'),
            'title'=>SB_P('command::tooltip_max_session_time'));

        $fields['Sender E-mail'] = array('name'=>'sender_email',
            'value'=>$this->um->getParam('config','sender_email'),
            'title'=>SB_P('command::tooltip_sender_email'));

        $fields['Show Statistics'] = array('name'=>'show_statistics', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','show_statistics'),
            'title'=>SB_P('command::tooltip_show_statistics'));

        $fields['Users Can Create Trees'] = array('name'=>'allow_user_trees', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_trees'),
            'title'=>SB_P('command::tooltip_allow_user_trees'));

        $fields['Users Can Delete Trees'] = array('name'=>'allow_user_tree_deletion', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_tree_deletion'),
            'title'=>SB_P('command::tooltip_allow_user_tree_deletion'));

        $fields['Users Can Create Groups'] = array('name'=>'allow_user_groups', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','allow_user_groups'),
            'title'=>SB_P('command::tooltip_allow_user_groups'));

        $fields['Use Conversion Engine'] = array('name'=>'use_conv_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_conv_engine'),
            'title'=>SB_P('command::tooltip_use_conv_engine'));

        $fields['Use Compression'] = array('name'=>'use_compression', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_compression'),
            'title'=>SB_P('command::tooltip_use_compression'));

        $fields['Use E-mail Features'] = array('name'=>'use_mail_features', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_mail_features'),
            'title'=>SB_P('command::tooltip_use_mail_features'));

        $fields['Use Nice URL'] = array('name'=>'use_nice_url', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_nice_url'),
            'title'=>SB_P('command::tooltip_use_nice_url'));

        $fields['Use Outbound Connection'] = array('name'=>'use_outbound_connection', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_outbound_connection'),
            'title'=>SB_P('command::tooltip_use_outbound_connection'));

        $fields['Use Hit Counter'] = array('name'=>'use_hit_counter', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_hit_counter'),
            'title'=>SB_P('command::tooltip_hits'));

        $fields['Users Must Be Approved'] = array('name'=>'users_must_be_approved', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','users_must_be_approved'),
            'title'=>SB_P('command::tooltip_users_must_be_approved'));

        $fields['Users Must Verify E-mail'] = array('name'=>'users_must_verify_email', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','users_must_verify_email'),
            'title'=>SB_P('command::tooltip_users_must_verify_email'));

        $fields['Version Check Interval'] = array('name'=>'version_check_interval', 'type'=>'select',
            '_options'=>'_buildVersionCheckInterval',
            '_select'=>$this->um->getParam('config','version_check_interval'),
            'title'=>SB_P('command::tooltip_version_check_interval'));

        $fields['Web Search User Agents'] = array('name'=>'web_search_user_agents',
            'value'=>$this->um->getParamB64('config','web_search_user_agents'),
            'title'=>SB_P('command::tooltip_web_search_user_agents'));

        $fields['Web Search Engine URL'] = array('name'=>'search_engine_url',
            'value'=>$this->um->getParamB64('config','search_engine_url'),
            'title'=>SB_P('command::tooltip_search_engine_url'));

        $fields['Web Search Engine Icon'] = array('name'=>'search_engine_ico',
            'value'=>$this->um->getParamB64('config','search_engine_ico'),
            'title'=>SB_P('command::tooltip_search_engine_ico'));

        $fields['Export Bookmarks Settings'] = array('type'=>'addbutton');
        $fields['Favicon Management'] = array('type'=>'addbutton');

        return $fields;
    }

    function commandSiteBarSettings()
    {
        $checks = array
        (
            'allow_contact',
            'allow_sign_up',
            'allow_custom_search_engine',
            'allow_user_trees',
            'allow_user_tree_deletion',
            'allow_user_groups',
            'comment_impex',
            'filter_users',
            'filter_groups',
            'show_statistics',
            'use_compression',
            'use_conv_engine',
            'use_hit_counter',
            'use_mail_features',
            'use_nice_url',
            'use_outbound_connection',
            'users_must_be_approved',
            'users_must_verify_email',
        );

        $values = array
        (
            'auth',
            'comment_limit',
            'default_groups',
            'public_groups',
            'max_session_time',
            'sender_email',
            'version_check_interval',
        );

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $ua = SB_reqVal('web_search_user_agents');
        if (strlen($ua))
        {
            if ($ua[0] != '/')
            {
                $ua = '/' . $ua . '/i';
            }

            // Would be caugth by error handler
            preg_match($ua, '');

            if ($this->hasErrors())
            {
                $this->error('Invalid regular expresssion!');
                $this->goBack();
                return;
            }
        }

        $valuesB64 = array
        (
            'integrator_url',
            'search_engine_url',
            'search_engine_ico',
            'web_search_user_agents'
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('config', $check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $value)
        {
            $this->um->setParam('config', $value, SB_reqVal($value));
        }
        foreach ($valuesB64 as $check)
        {
            $this->um->setParamB64('config', $check, SB_reqVal($check));
        }

        $this->um->saveConfiguration();
    }

    function buildVersionCheck()
    {
        $fields = array();
        $fields['-raw-'] = 'Version check';
        return $fields;
    }

    function commandVersionCheck()
    {
        $this->forwardCommand('SiteBar Settings');
    }

/******************************************************************************/

    function buildExportBookmarksSettings()
    {
        $fields = array();

        $values = array();

        require_once('./inc/writer.inc.php');

        foreach (SB_WriterInterface::settingItems() as $name)
        {
            $values[$name] = SB_WriterInterface::settingsValue($name);
        }

        $fields['Title for Root'] = array('name'=>'feed_root_name', 'value'=>$values['feed_root_name'],);
        $fields['Title Format for Selected Folder'] = array('name'=>'feed_folder_title', 'value'=>$values['feed_folder_title'],);
        $fields['Link'] = array('name'=>'feed_link', 'value'=>$values['feed_link'],);
        $fields['Description'] = array('name'=>'feed_desc', 'value'=>$values['feed_desc'],);
        $fields['Copyright'] = array('name'=>'feed_copyright', 'value'=>$values['feed_copyright'],);
        $fields['Webmaster Email'] = array('name'=>'feed_webmaster', 'value'=>$values['feed_webmaster'],);
        $fields['Managing Editor'] = array('name'=>'feed_managing_editor', 'value'=>$values['feed_managing_editor'],);

        $fields['Allow Anonymous Exports'] = array('name'=>'allow_anonymous_export', 'type'=>'checkbox',
            'value'=>1,
            'checked'=>$this->um->getParamCheck('config','allow_anonymous_export'),
            'title'=>SB_P('command::tooltip_allow_anonymous_export'));

        // Never external
        $this->um->setParam('user','extern_commander',0);

        return $fields;
    }

    function commandExportBookmarksSettings()
    {
        $checks = array
        (
            'allow_anonymous_export',
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('config',$check, SB_reqVal($check));
        }

        require_once('./inc/writer.inc.php');

        foreach (SB_WriterInterface::settingItems() as $name)
        {
            $this->um->setParamB64('config',$name, SB_reqVal($name));
        }

        $this->um->saveConfiguration();
        $this->forwardCommand('SiteBar Settings');
    }

/******************************************************************************/

    function buildFaviconManagement()
    {
        $fields = array();

        $fields['Use the Favicon Cache'] = array('name'=>'use_favicon_cache', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck('config','use_favicon_cache'),
            'title'=>SB_P('command::tooltip_use_favicon_cache'));
        $fields['Maximal Icons Total'] = array('name'=>'max_icon_cache',
            'value'=>$this->um->getParam('config','max_icon_cache'),
            'title'=>SB_P('command::tooltip_max_icon_cache'));
        $fields['Maximal Icon Size'] = array('name'=>'max_icon_size',
            'value'=>$this->um->getParam('config','max_icon_size'),
            'title'=>SB_P('command::tooltip_max_icon_size'));
        $fields['Maximal Icon Age'] = array('name'=>'max_icon_age',
            'value'=>$this->um->getParam('config','max_icon_age'),
            'title'=>SB_P('command::tooltip_max_icon_age'));

        $fields['Purge Cache'] = array('type'=>'addbutton');
        $fields['Show All Icons'] = array('type'=>'addbutton');

        return $fields;
    }

    function commandFaviconManagement()
    {
        $values = array
        (
            'max_icon_cache',
            'max_icon_size',
            'max_icon_age',
        );

        foreach ($values as $value)
        {
            $this->um->setParam('config',$value, SB_reqVal($value));
        }

        $this->um->setParam('config','use_favicon_cache', SB_reqVal('use_favicon_cache'));

        $this->um->saveConfiguration();

    }

    function buildPurgeCache()
    {
        $fields = array();

        $fields['-raw1-'] = SB_P('command::purge_cache');

        return $fields;
    }

    function commandPurgeCache()
    {
        require_once('./inc/faviconcache.inc.php');
        $fc = & SB_FaviconCache::staticInstance();
        $fc->purge();
    }

    function buildShowAllIcons()
    {
        $fields = array();

        $carpet = '';

        require_once('./inc/faviconcache.inc.php');

        $fc = & SB_FaviconCache::staticInstance();

        $cacheItems = $fc->faviconGetAll();

        foreach ($cacheItems as $item)
        {
            $favicon = 'favicon.php?' . $item['ckey'];

            $carpet .= '<img class="favicon" height=16 width=16 alt="" src="'.$favicon.'">'."\n";
        }

        $fields['-raw1-'] = $carpet;

        return $fields;
    }

/******************************************************************************/

    function _buildTreeList()
    {
        foreach ($this->tree->loadRoots(true, false) as $root)
        {
            if ($root->deleted_by != null) continue;
            echo '<option value="' . $root->id . '">'. $root->name . "</option>\n";
        }
    }

    function buildMaintainTrees()
    {
        $fields = array();
        $fields['Create Tree'] = array('type'=>'button');
        $fields['Unhide Trees'] = array('type'=>'button');
        $fields['Order of Trees'] = array('type'=>'button');
        $fields['Export Bookmarks'] = array('type'=>'button');

        $fields['-hidden1-'] = array('name'=>'doall', 'value'=>1);

        if ($this->um->getParam('config','allow_user_tree_deletion') || $this->um->isAdmin())
        {
            $fields['Select Tree'] = array('name'=>'nid_acl','type'=>'select', '_options'=>'_buildTreeList');
            $fields['Delete Tree'] = array('type'=>'button');
        }

        // Dirty, to allow forward back
        unset($_REQUEST['nid_acl']);

        return $fields;
    }

    function mandatoryCreateTree()
    {
        return array('treename');
    }

    function buildCreateTree()
    {
        $fields = array();

        $fields['Tree Name'] = array('name'=>'treename');
        $fields['Description'] = array('name'=>'comment');

        if ($this->um->isAdmin())
        {
            if ($this->um->useUserFilter() && !SB_reqChk('uregexp'))
            {
                $fields['Filter User RegExp'] = array('name'=>'uregexp');
                $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Create Tree');
                $fields['Filter Users'] = array('type'=>'button');
            }

            if (!$this->um->useUserFilter() || SB_reqChk('uregexp'))
            {
                $fields['Owner'] = array('name'=>'uid','type'=>'select',
                    '_options'=>'_buildUserList', '_select'=>SB_reqVal('uid'));
            }
        }

        return $fields;
    }

    function commandCreateTree()
    {
        $uid = SB_reqVal('uid');

        if (!$this->um->isAdmin())
        {
            $uid = $this->um->uid;
        }

        $this->tree->addRoot($uid, SB_reqVal('treename'), SB_reqVal('comment'));

        $this->forwardCommand('Maintain Trees');
    }

    function buildUnhideTrees()
    {
        $fields['-raw1-'] = "<table cellpadding='0'>";
        $count = 0;

        foreach ($this->tree->loadRoots(true) as $root)
        {
            if ($root->hidden)
            {
                $fields[$root->name] = array('name'=>'nid_'.$root->id,'type'=>'checkbox');
                $count++;
            }
        }

        if (!$count)
        {
            $this->warn('There are no hidden trees!');
        }

        $fields['-raw2-'] = "</table>";

        return $fields;
    }

    function commandUnhideTrees()
    {
        foreach ($this->tree->loadRoots(true) as $root)
        {
            if ($root->hidden && SB_reqVal('nid_'.$root->id))
            {
                unset($this->um->hiddenFolders[$root->id]);
            }
        }

        $this->um->setParam('user','hidden_folders', implode(':',array_keys($this->um->hiddenFolders)));
        $this->um->saveUserParams();

        $this->forwardCommand('Maintain Trees');
    }

    function buildOrderOfTrees()
    {
        $fields['-raw1-'] = "<table cellpadding='0'>";

        foreach ($this->tree->loadRoots() as $root)
        {
            $label = $root->name;
            $fields[$label] = array
            (
                'type'=>'callback',
                'function'=>'_buildFolderOrder',
                'params'=>array('name'=>$root->name,'id'=>$root->id,'order'=>$root->order),
            );
        }

        $fields['-raw2-'] = "</table>";

        return $fields;
    }

    function commandOrderOfTrees()
    {
        $order = array();

        foreach ($this->tree->loadRoots() as $root)
        {
            $order[] = $root->id.'~'.intval(SB_reqVal('id'.$root->id));
        }

        $this->um->setParam('user', 'root_order', implode(':',$order));
        $this->um->saveUserParams();
        $this->forwardCommand('Maintain Trees');
    }

    function buildDeleteTree()
    {
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));
        if (!$node) return null;

        $fields['Folder Name'] = array('name'=>'name','value'=>$node->name, 'disabled'=>null);
        $fields['Description'] = array('name'=>'comment', 'type'=>'textarea',
            'value'=>$node->comment, 'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        return $fields;
    }

    function commandDeleteTree()
    {
        $this->tree->removeNode(SB_reqValInt('nid_acl'), false);
        if ($this->um->getParam('user','use_trash'))
        {
            $this->tree->purgeNode(SB_reqValInt('nid_acl'));
        }
        SB_unsetVal('nid_acl');
        $this->forwardCommand('Maintain Trees');
    }

/******************************************************************************/

    function mandatorySetUp()
    {
        static $fields = array
        (
            'username',
            'pass',
            'pass_repeat',
            'email',
            'realname',
        );

        return array_merge($fields, $this->mandatorySiteBarSettings());
    }

    function optionalSetUp()
    {
        static $fields = array
        (
            'allow_custom_search_engine',
            'allow_user_groups',
            'allow_user_tree_deletion',
            'allow_user_trees',
            'comment_impex',
            'comment_limit',
            'max_session_time',
            'search_engine_ico',
            'search_engine_url',
            'show_statistics',
            'use_compression',
            'use_conv_engine',
            'use_hit_counter',
            'use_mail_features',
            'use_nice_url',
            'use_outbound_connection',
        );

        return array_merge($fields, $this->optionalSiteBarSettings());
    }

    function buildSetUp()
    {
        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');
        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildAutoLangList', '_select'=>$lang);

        $fields['Username'] = array('name'=>'username');
        $fields['Admin Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Admin Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['E-mail'] = array('name'=>'email');
        $fields['Real Name'] = array('name'=>'realname');

        return array_merge($fields, $this->buildSiteBarSettings());
    }

    function commandSetUp()
    {
        SB_SetLanguage(SB_reqVal('lang'));

        if (SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
            $this->goBack();
            return;
        }

        if ($this->um->setUp(SB_reqVal('username'),SB_reqVal('pass'),SB_reqVal('email'),SB_reqVal('realname')))
        {
            $this->um->setParam('user','lang', SB_reqVal('lang'));
            $this->um->saveUserParams();
            $this->commandSiteBarSettings();

            $this->reload = true;
            $this->close = false;
            $this->message = SB_P('command::welcome',
                array(SB_reqVal('realname'),'',SB_T('Show Menu Icon'),SB_T('User Settings')));
        }
    }

/******************************************************************************/

    function buildHelp()
    {
        $fields = array();
        $topics = SB_GetHelpTopics();

        $fields['Help Topic'] = array('class'=>'help', 'name'=>'topic','type'=>'select',
            'size'=> (SB_reqChk('topic')?1:count($topics)),
            '_options'=>'_buildHelpTopicList', '_select'=>SB_reqVal('topic'));
        $fields['Display Topic'] = array('type'=>'button','value'=>'Help');

        if (SB_reqChk('topic'))
        {
            $fields['-raw1-'] = '<h3>' . $topics[SB_reqVal('topic')] . '</h3>';
            $fields['Topic'] = array('type'=>'callbackextern',
                'function'=>'SB_GetHelp', 'params'=>array('topic'=>SB_reqVal('topic')));
        }
        return $fields;
    }

    function buildDisplayTopic()
    {
        $this->command = 'Help';
        return $this->buildHelp();
    }

    function _buildHelpTopicList($select=null)
    {
        foreach (SB_GetHelpTopics() as $value => $label)
        {
            if (intval($value) % 100)
            {
                $label = '&nbsp;-&nbsp;' . $label;
            }

            echo '<option '.($select==$value?'selected':'').
                 ' value="' . $value. '">' . $label. "</option>\n";
        }
    }

/******************************************************************************/

    function mandatoryContactAdmin()
    {
        static $fields = array('message');

        if ($this->um->isAnonymous() || $this->um->email == '')
        {
            $fields[] = 'email';
        }

        return $fields;
    }

    function buildContactAdmin()
    {
        $fields = array();
        if ($this->um->isAnonymous() || $this->um->email == '')
        {
            $fields['Your E-mail'] = array('name'=>'email');
        }
        $ctx = SB_reqVal('ctx', false, NULL);
        if ($ctx) {
            $fields['-hidden-'] = array('name'=>'ctx', 'value'=>$ctx);
        }
        
        return array_merge($fields,$this->_buildSendEmail('Feedback or Other Comment'));
    }

    function commandContactAdmin()
    {
        $name = '';
        $email = '';

        if ($this->um->isAnonymous())
        {
            $email = SB_reqVal('email');
            $parts = explode('@',$email);
            if (count($parts) != 2 || !getmxrr($parts[1],$mxr)) {
                $this->error('This does not look like a valid email!');
                $this->goBack();
                return;
            }
            $name = '';
        }
        else
        {
            $name = $this->um->username;
            if (strlen($this->um->name))
            {
                $name = $name . " - " . $this->um->name;
            }
            $email = $this->um->email;
        }

        $comment = SB_reqVal('message');

        if (preg_match('/(<a |\[(url|link))/i',$comment)) {
            $this->error('Sorry, your comment looks like spam!');
            $this->goBack();
            return;
        } 

        if (preg_match('/(<a |\[(url|link))/i',$comment)) {
            $this->error('Sorry, your comment looks like spam!');
            $this->goBack();
            return;
        }

        if (strlen($comment)>140) {
            $this->error('Sorry, only 140 characters allowed!');
            $this->goBack();
            return;
        }

        $ctx = SB_reqVal('ctx', false, 'no');
        $added = sprintf(' [ctx=%s, ip=%s]', $ctx, $_SERVER['REMOTE_ADDR']);

        $this->um->mailToAdmins(
            'SiteBar: Contact Admin' . $added,
            'command::contact',
            array($comment,SB_Page::absBaseUrl()),
            $name,
            $email);
    }

/******************************************************************************/

    function mandatorySignUp()
    {
        static $fields = array
        (
            'username',
            'pass',
            'pass_repeat',
        );

        if ($this->um->getParam('config','users_must_verify_email'))
        {
            $fields[] = 'email';
        }

        return $fields;
    }

    function optionalSignUp()
    {
        static $fields = array
        (
            'realname',
            'comment',
        );

        if (!$this->um->getParam('config','users_must_verify_email'))
        {
            $fields[] = 'email';
            $fields[] = 'verify_email';
        }

        return $fields;
    }

    function buildSignUp()
    {
        $fields = array();

        $lang = SB_reqChk('lang')?SB_reqVal('lang'):$this->um->getParam('user','lang');

        SB_SetLanguage($lang);

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$lang, 'onChange'=>'this.form.submit()');

        $fields['Username'] = array('name'=>'username');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['E-mail'] = array('name'=>'email');

        if ($this->command == 'Sign Up' && $this->um->getParam('config','use_mail_features'))
        {
            $fields['Verify E-mail'] = array
            (
                'name'=>'verify_email',
                'type'=>'checkbox',
            );

            if ($this->um->getParam('config','users_must_verify_email'))
            {
                $fields['Verify E-mail']['disabled'] = null;
                $fields['Verify E-mail']['checked'] = null;
            }
        }

        $fields['Real Name'] = array('name'=>'realname');
        $fields['Comment'] = array('name'=>'comment');

        foreach ($fields as $label => $rec)
        {
            if (SB_reqChk($fields[$label]['name']))
            {
                $fields[$label]['value'] = SB_reqVal($fields[$label]['name']);
            }
        }

        return $fields;
    }

    function commandSignUp()
    {
        SB_SetLanguage(SB_reqVal('lang'));

        if (!$this->checkCookie())
        {
            $this->goBack();
            return;
        }

        if (SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        $mustVerify = $this->um->getParam('config','users_must_verify_email');

        if ($this->um->getParam('config','use_mail_features') && ( SB_reqChk('verify_email') || $mustVerify))
        {
            $this->checkEmailCorrectness(SB_reqVal('email'));
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $uid = $this->um->signUp(
            trim(SB_reqVal('username')),
            SB_reqVal('pass'),
            trim(SB_reqVal('email')),
            SB_reqVal('realname'),
            SB_reqVal('comment'),
            SB_reqVal('lang'));

        if ($uid)
        {
            $this->tree->addRoot($uid, SB_reqVal('username'));

            if ($this->um->getParam('config','use_mail_features') && ( SB_reqChk('verify_email') || $mustVerify))
            {
                if (!$this->_sendVerificationEmail($uid, array('email'=>SB_reqVal('email')), $mustVerify))
                {
                    $this->error('Cannot send verification email!');
                }
            }

            $mustApprove = $this->um->getParam('config','users_must_be_approved');

            $this->um->login(SB_reqVal('username'), SB_reqVal('pass'));
            $this->reload = true;
            $this->close = false;

            $vermsg = '';

            if ($mustVerify && $mustApprove)
            {
                $vermsg = SB_P('command::signup_verify_approve');
            }
            else if ($mustVerify)
            {
                $vermsg = SB_P('command::signup_verify');
            }
            else if ($mustApprove)
            {
                $vermsg = SB_P('command::signup_approve');
            }

            $params = array(
                SB_reqVal('username'),
                $vermsg,
                SB_T('Show Menu Icon'),
                SB_T('User Settings'),
            );

            $this->message = SB_P('command::welcome',$params);
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }
    }

/******************************************************************************/

    function _sendVerificationEmail($uid, $user, $mustVerify=false)
    {
        $subject = SB_T('SiteBar: Email Verification');
        $msg = SB_P(($mustVerify? 'command::verify_email_must':'command::verify_email'),
            array($this->um->getVerificationUrl($uid)));
        // Verify email
        return $this->um->sendMail($user, $subject, $msg);
    }

    function buildVerifyEmail()
    {
        $this->_sendVerificationEmail($this->um->uid, $this->um->user);
        $this->warn('Verification e-mail has been sent to your e-mail address!');
        return array();
    }

    function commandEmailVerified()
    {
        $this->nobuttons = true;
        $this->reload = false;
        $this->close = false;

        $this->message = SB_T('E-mail %s verified!', array(SB_reqVal('email')));

        $user = $this->um->getUserByEmail('email');

        if ($this->um->getParam('config', 'users_must_be_approved') && !$user['approved'])
        {
            $this->message .= '<p>' . SB_T('Your account will be activated as soon as one of the administrators approves it.');
        }
    }

    function commandInvalidToken()
    {
        $this->nobuttons = true;
        $this->reload = false;
        $this->close = false;
        $this->message = SB_T('Invalid or expired token received! All pending tokens were deleted.');
    }

    function buildResetPassword()
    {
        $fields = array();
        $fields['Username'] = array('name'=>'username', 'value'=>SB_reqVal('username'));
        $fields['E-mail'] = array('name'=>'email', 'value'=>SB_reqVal('email'));
        $fields['-raw1-'] = SB_P('command::reset_password_hint');
        return $fields;
    }

    function commandResetPassword()
    {
        $user = null;
        $test = 0;

        foreach (array('username','email') as $item)
        {
            if (strlen(SB_reqVal($item)))
            {
                $test++;
                $value = SB_reqVal($item);
                if ($item=='username')
                {
                    $user = $this->um->getUserByUsername($value);
                }
                else
                {
                    $user = $this->um->getUserByEmail($value);
                }
                if ($user==null)
                {
                    if ($item=='username')
                    {
                        $this->error('User with username "%s" does not exist!', $value);
                    }
                    else
                    {
                        $this->error('User with email "%s" does not exist!', $value);
                    }
                    $this->goBack();
                    return;
                }
            }
        }

        if (!$test)
        {
            $this->error('One of the two fields must be filled!');
            $this->goBack();
            return;
        }

        if ($user['demo'])
        {
            $this->um->accessDenied();
            return;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();

        $subject = SB_T('SiteBar: Reset Password');
        $msg = SB_P('command::reset_password', array
        (
            $user['email'],
            $token->createResetToken($user['uid']),
            SB_Page::absBaseUrl(),
        ));
        $this->um->sendMail($user, $subject, $msg);

        $this->reload = false;
        $this->close = false;
    }

    function mandatoryNewPassword()
    {
        return array('pass1','pass2');
    }

    function buildNewPassword()
    {
        $user = $this->um->getUser(SB_reqVal('uid', true));

        $fields = array();

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>$user['uid']);
        $fields['-hidden2-'] = array('name'=>'token', 'value'=>SB_reqVal('token', true),'disabled'=>null);

        $fields['Username'] = array('name'=>'email', 'value'=>$user['username'],'disabled'=>null);
        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'],'disabled'=>null);
        $fields['Real Name'] = array('name'=>'realname','value'=>$user['name'],'disabled'=>null);
        $fields['Password'] = array('name'=>'pass1','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass2','type'=>'password');

        return $fields;
    }

    function commandNewPassword()
    {
        if (SB_reqVal('pass1') != SB_reqVal('pass2'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        require_once('./inc/token.inc.php');
        $token = SB_Token::staticInstance();

        $uid = SB_reqVal('uid', true);

        if ($token->validate($uid, SB_reqVal('token', true)))
        {
            $token->invalidateTokens($uid);
            $this->um->changePassword($uid, SB_reqVal('pass1'));
            $this->reload = false;
            $this->close = false;
            $this->message = SB_T('Password has been changed!');
        }
        else
        {
            $this->commandInvalidToken();
        }
    }

/******************************************************************************/

    function getUserFilterRegexp()
    {
        static $uregexp = null;

        if ($uregexp === null)
        {
            if (strlen(SB_reqVal('uregexp')))
            {
                $uregexp = SB_reqVal('uregexp');
                if ($uregexp[0] != '/')
                {
                    $uregexp = '/'.$uregexp.'/i';
                }
            }
            else
            {
                $uregexp = '';
            }
        }

    return $uregexp;
    }

    function matchesUserFilter(&$userRec)
    {
    $uregexp = $this->getUserFilterRegexp();

        if (strlen($uregexp))
        {
            $fullname = '#' . $userRec['uid'] . ' ' . $userRec['completename'];
            if (!preg_match($uregexp, $fullname))
            {
                return false;
            }
        }

        return true;
    }

    function buildFilterUsers()
    {
        $command = SB_reqVal('forward', true);
        if (!$this->um->isAuthorized($command))
        {
            $this->um->accessDenied();
        }

        $this->command = $command;
        $this->skipBuild = false;
        $this->handleCommandBuild();
        $this->skipBuild = true;
    }

    function buildMaintainUsers()
    {
        $fields = array();

        $fields['Default User Settings'] = array('type'=>'addbutton');
        $fields['Create User'] = array('type'=>'button');

        if ($this->um->useUserFilter() && !SB_reqChk('uregexp'))
        {
            $fields['Filter User RegExp'] = array('name'=>'uregexp');
            $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Maintain Users');
            $fields['Filter Users'] = array('type'=>'button');
        }

        $fields['Pending Users'] = array('type'=>'button');
        $fields['Pending Verified Users'] = array('type'=>'button');
        $fields['Pending Unverified Users'] = array('type'=>'button');
        $fields['Activity Period'] = array('name'=>'aperiod','value'=>30);
        $fields['Active Users'] = array('type'=>'button');
        $fields['Most Active Users'] = array('type'=>'button');
        $fields['Inactive Users'] = array('type'=>'button');
        $fields['Send Message to All'] = array('type'=>'button');

        if (!$this->um->useUserFilter() || SB_reqChk('uregexp'))
        {
            $fields['Select User'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList', '_select'=>SB_reqVal('uid'));
            $fields['Modify User'] = array('type'=>'button');
            $fields['Modify User Settings'] = array('type'=>'button');
            $fields['Delete User'] = array('type'=>'button');
            $fields['Send Message to User'] = array('type'=>'button');
            $fields['Add User to Group'] = array('type'=>'button');
            $fields['Remove User from Group'] = array('type'=>'button');
        }
        return $fields;
    }

    function buildPendingUsers($verified = -1)
    {
        $fields = array();
        $members = $this->um->getPending($verified);

        if (!count($members))
        {
            $this->warn("No users are pending!");
            return;
        }

        $fields['-hidden1-'] = array('name'=>'verified', 'value'=> $verified);
        $fields['Approve All Users'] = array('type'=>'button');
        $fields['Reject All Users'] = array('type'=>'button');

        $fields['-raw1-'] = "<table class='users'>";

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $fields[$rec['username']] = array
            (
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array('name'=>$uid,'record'=>$rec),
            );
        }

        $fields['-raw2-'] = "</table>";

        $fields['Approve Users'] = array('type'=>'button');
        $fields['Reject Users'] = array('type'=>'button');

        return $fields;
    }

    function buildPendingVerifiedUsers()
    {
        return $this->buildPendingUsers(1);
    }

    function buildPendingUnverifiedUsers()
    {
        return $this->buildPendingUsers(0);
    }

    function _buildPendingUsers($approve, $all, $username=null)
    {
        $members = array();

        if ($username!=null)
        {
            $user = $this->um->getUserByUsername($username);

            if ($user==null)
            {
                $this->warn('User with username "%s" has already been rejected!', $username);
                return;
            }

            $members = array($user['uid']=>$user);
        }
        else
        {
            $members = $this->um->getPending(SB_reqVal('verified'));
        }

        foreach ($members as $uid => $rec)
        {
            if (!$all && !SB_reqChk($uid))
            {
                continue;
            }

            $subject = '';
            $body = '';

            $user = $this->um->getUser($uid);

            if ($user==null)
            {
                $this->warn('User with uid %d has already been rejected!', $uid);
                continue;
            }

            $this->um->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->um->getParam('tmp','lang'));

            if (isset($user['approved']) && $user['approved'])
            {
                $this->warn('User %s has already been approved!',
                    array($user['completenamehtml']));
                continue;
            }

            if ($approve)
            {
                if ($this->um->getParam('config','users_must_verify_email')
                &&  (!isset($user['verified']) || !$user['verified']))
                {
                    $this->warn('User "%s" cannot be approved because user email "%s" has not been verified!',
                        array($user['username'], $user['email']));
                    continue;
                }

                $subject = 'SiteBar: Account Request Approved';
                $body = 'command::account_approved';
                $this->um->modifyUser($uid, null, array( 'approved'=>1 ));

                $this->warn('User %s approved.',
                    array($user['completenamehtml']));
            }
            else
            {
                $subject = 'SiteBar: Account Request Rejected';
                $body = 'command::account_rejected';
                $this->um->removeUser($uid);
            }

            if ($this->um->getParam('config', 'use_mail_features'))
            {
                // No email on unverified users
                if ($approve || (isset($user['verified']) && $user['verified']))
                {
                    $this->um->sendMail($user, SB_T($subject),
                        SB_P($body, array($user['username'], SB_Page::absBaseUrl())));
                }
            }
        }

        SB_SetLanguage($this->um->getParam('user','lang'));

        if (!$this->hasErrors())
        {
            $this->error('No action taken!');
        }

        $this->skipBuild = true;
        return array();
    }

    function buildApproveAllUsers()
    {
        return $this->_buildPendingUsers(true,true);
    }
    function buildApproveUser()
    {
        return $this->_buildPendingUsers(true,true,SB_reqVal('username',true));
    }
    function buildApproveUsers()
    {
        return $this->_buildPendingUsers(true,false);
    }
    function buildRejectAllUsers()
    {
        return $this->_buildPendingUsers(false,true);
    }
    function buildRejectUser()
    {
        return $this->_buildPendingUsers(true,true,SB_reqVal('username',true));
    }
    function buildRejectUsers()
    {
        return $this->_buildPendingUsers(false,false);
    }

    function _buildUserActivity(&$fields, &$members)
    {
        $fields['User Count'] = array('name'=>'usercount', 'disabled'=>null, 'value'=>0);
        $fields['-hidden1-'] = array('name'=>'aperiod', 'value'=>SB_reqVal('aperiod'));
        $fields['-raw1-'] = "<table class='users'>";

        foreach ($members as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

            $fields['User Count']['value']++;
            $fields[$rec['username']] = array
            (
                'type'=>'callback',
                'function'=>'_buildUserCheck',
                'params'=>array
                (
                    'name'=>$uid,
                    'record'=>$rec,
                    'signup'=>$this->um->firstSession($uid),
                    'links' =>$this->tree->getLinkCount($uid),
                ),
            );
        }

        $fields['-raw2-'] = "</table>";
    }

    function buildInactiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'<','visited ASC');

        if (!count($members))
        {
            $this->warn("No users are inactive!");
            return;
        }

        if ($this->um->getParam('config', 'use_mail_features'))
        {
            $fields['Send E-mail about Deletion'] =
                array('name'=>'inform', 'type'=>'checkbox', 'checked'=>null);
            $fields['Respect Allow Info Mail'] =
                array('name'=>'respect', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_respect'));
            $fields['Only to Verified Emails'] =
                array('name'=>'verified', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_to_verified'));
        }

        $fields['Delete All Inactive Users'] = array('type'=>'button');
        $this->_buildUserActivity($fields, $members);
        $fields['Delete Inactive Users'] = array('type'=>'button');

        return $fields;
    }

    function buildMostActiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'>','visits DESC');
        $this->_buildUserActivity($fields, $members);
        return $fields;
        return $this->buildActiveUsers();
    }

    function buildActiveUsers()
    {
        $fields = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'>','visited DESC');
        $this->_buildUserActivity($fields, $members);
        return $fields;
    }

    function _buildDeleteInactiveUsers($all)
    {
        $members = array();
        $members = $this->um->getUsersUsingVisited(SB_reqVal('aperiod', true),'<=','visits DESC');

        foreach ($members as $uid => $rec)
        {
            if (!$all && !SB_reqChk($uid))
            {
                continue;
            }

            $subject = '';
            $body = '';

            $user = $this->um->getUser($uid);
            $this->um->explodeParams($user['params'], 'tmp');
            SB_SetLanguage($this->um->getParam('tmp','lang'));

            $subject = 'SiteBar: Inactive Account Deleted';
            $body = 'command::account_deleted';
            $this->um->removeUser($uid);

            if ($this->um->getParam('config', 'use_mail_features'))
            {
                $sentEmail = true;

                if (SB_reqVal('inform'))
                {
                    if (SB_reqChk('respect') && !$this->um->getParam('tmp','allow_info_mails'))
                    {
                        $sentEmail = false;
                    }

                    if (SB_reqChk('verified') && !$user['verified'])
                    {
                        $sentEmail = false;
                    }
                }

                // No email on unverified users
                if ($sentEmail)
                {
                    $this->um->sendMail($user, SB_T($subject),
                        SB_P($body, array($user['email'], SB_Page::absBaseUrl())));
                }
            }

            $this->warn('Account %s deleted.', array($user['completenamehtml']));
        }

        SB_SetLanguage($this->um->getParam('user','lang'));

        if (!$this->hasErrors())
        {
            $this->error('No action taken!');
        }

        $this->skipBuild = true;
        return array();
    }

    function buildDeleteInactiveUsers()
    {
        return $this->_buildDeleteInactiveUsers(false);
    }

    function buildDeleteAllInactiveUsers()
    {
        return $this->_buildDeleteInactiveUsers(true);
    }

    function mandatoryCreateUser()
    {
        return $this->mandatorySignUp();
    }

    function buildCreateUser()
    {
        $fields = array();
        $fields['Username'] = array('name'=>'username');
        $fields['E-mail'] = array('name'=>'email');
        $fields['Real Name'] = array('name'=>'realname');
        $fields['Comment'] = array('name'=>'comment');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['E-mail Verified'] = array('name'=>'verified', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_verified'));
        $fields['Account Approved'] = array('name'=>'approved', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_approved'));
        $fields['Demo Account'] = array('name'=>'demo', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_demo'));

        $fields['E-mail Verified']['checked'] = null;
        $fields['Account Approved']['checked'] = null;

        return $fields;
    }

    function commandCreateUser()
    {
        if (SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $uid = $this->um->signUp(
            trim(SB_reqVal('username')),
            SB_reqVal('pass'),
            trim(SB_reqVal('email')),
            SB_reqVal('realname'),
            SB_reqVal('comment'),
            SB_reqVal('lang'));

        if ($uid)
        {
            $this->tree->addRoot($uid, SB_reqVal('username'));

            $this->um->modifyUser($uid, SB_reqVal('pass'),
                array
                (
                    'verified' => (SB_reqVal('verified')?1:0),
                    'approved' => (SB_reqVal('approved')?1:0),
                    'demo' =>     (SB_reqVal('demo')?1:0)
                ));
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $this->forwardCommand('Maintain Users');
    }

    function buildModifyUser()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        $uid = intval(SB_reqVal('uid'));

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return null;
        }

        $fields = array();
        $user = $this->um->getUser($uid);
        $fields['Username'] = array('name'=>'username', 'value'=>$user['username'], 'disabled' => null);
        $fields['User ID'] = array('name'=>'uid', 'value'=>$user['uid'], 'disabled' => null);
        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email']);
        $fields['Real Name'] = array('name'=>'realname', 'value'=>$user['name']);
        $fields['Comment'] = array('name'=>'comment', 'value'=>$user['comment']);
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass_repeat','type'=>'password');
        $fields['E-mail Verified'] = array('name'=>'verified', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_verified'));
        $fields['Account Approved'] = array('name'=>'approved', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_approved'));
        $fields['Demo Account'] = array('name'=>'demo', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_demo'));
        $fields['First Visit'] = array('name'=>'visited', 'value'=>$this->um->firstSession($uid), 'disabled'=>null);
        $fields['Last Visit'] = array('name'=>'visited', 'value'=>$user['visited'], 'disabled'=>null);
        $fields['Visit Count'] = array('name'=>'visits', 'value'=>$user['visits'], 'disabled'=>null);
        $fields['Bookmark Count'] = array('name'=>'visits', 'value'=>$this->tree->getLinkCount($uid), 'disabled'=>null);

        if ($user['verified'])
        {
            $fields['E-mail Verified']['checked'] = null;
        }

        if ($user['approved'])
        {
            $fields['Account Approved']['checked'] = null;
        }

        if ($user['demo'])
        {
            $fields['Demo Account']['checked'] = null;
        }

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>$uid);

        return $fields;
    }

    function commandModifyUser()
    {
        if (SB_reqChk('pass') && SB_reqVal('pass') != SB_reqVal('pass_repeat'))
        {
            $this->error('The password was not repeated correctly!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $this->um->modifyUser(SB_reqVal('uid',true), SB_reqVal('pass'),
            array
            (
                'name' =>     SB_reqVal('realname'),
                'email' =>    SB_reqVal('email'),
                'comment' =>  SB_reqVal('comment'),
                'verified' => (SB_reqVal('verified')?1:0),
                'approved' => (SB_reqVal('approved')?1:0),
                'demo' =>     (SB_reqVal('demo')?1:0)
            ));

        $this->forwardCommand('Maintain Users');
    }

    function buildAddUsertoGroup()
    {
        $fields = array();

        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>SB_reqVal('uid'));

        if ($this->um->useGroupFilter() && !SB_reqChk('gregexp'))
        {
            $fields['Filter Group RegExp'] = array('name'=>'gregexp');
            $fields['-hidden2-'] = array('name'=>'forward', 'value'=>'Add User to Group');
            $fields['Filter Groups'] = array('type'=>'button');
        }
        else
        {
            $fields['Select Group'] = array('name'=>'command_gid','type'=>'select','_options'=>'_buildGroupCandidateList','_select'=>SB_reqVal('command_gid'));
        }

        return $fields;
    }

    function commandAddUsertoGroup()
    {
        $uid = SB_reqVal('uid', true);
        $gid = SB_reqVal('command_gid', true);

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return;
        }

        if (intval($gid) == -1)
        {
            $this->error('No groups to join!');
            return;
        }

        $this->um->addMember($gid, $uid);
        $this->forwardCommand('Maintain Users');
    }

    function buildRemoveUserfromGroup()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        $uid = SB_reqVal('uid');

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return null;
        }

        $fields = array();
        $fields['-hidden1-'] = array('name'=>'uid','value'=>$uid);
        $userGroups = $this->um->getUserGroups($uid);
        $ownUserGroups = $this->um->getOwnGroups($uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            $isUserGroup = in_array($gid, array_keys($userGroups));
            $isOwnUserGroup = in_array($gid, array_keys($ownUserGroups));
            $name = $rec['completenamehtml'];

            if (!$isUserGroup)
            {
                continue;
            }

            $fields[$name] =  array('name'=>'gid_'.$gid,'type'=>'checkbox','checked'=>null);

            if ($isOwnUserGroup)
            {
                $fields[$name]['disabled'] = null;
            }
        }
        return $fields;
    }

    function commandRemoveUserfromGroup()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return;
        }

        $uid = SB_reqVal('uid');

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return;
        }

        $userGroups = $this->um->getUserGroups($uid);
        $ownUserGroups = $this->um->getOwnGroups($uid);

        foreach ($this->um->getGroups() as $gid => $rec)
        {
            $isUserGroup = in_array($gid, array_keys($userGroups));
            $isOwnUserGroup = in_array($gid, array_keys($ownUserGroups));
            $checked = SB_reqVal('gid_'.$gid)==1;

            if (!$isUserGroup || $isOwnUserGroup)
            {
                continue;
            }
            if ($isUserGroup && !$checked)
            {
                $this->um->removeMember($gid, $uid);
            }
        }

        $this->forwardCommand('Maintain Users');
    }

    function optionalModifyUserSettings()
    {
        return $this->optionalCommonUserSettings();
    }

    function buildModifyUserSettings()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        $uid = SB_reqVal('uid');

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return null;
        }

        $fields = array();
        $fields['-hidden1-'] = array('name'=>'uid','value'=>$uid);

        $prefix = 'tmp';
        $user = $this->um->getUser($uid);
        $this->um->explodeParams($user['params'],$prefix);

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildAutoLangList', '_select'=>$this->um->getParam($prefix,'lang'));

        $this->_buildCommonUserSettings($prefix, $fields);
        return $fields;
    }

    function commandModifyUserSettings()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return;
        }

        $uid = SB_reqVal('uid');

        if ($uid == SB_ADMIN)
        {
            $this->error('Cannot modify administrator!');
            return;
        }

        $prefix = 'tmp';
        $user = $this->um->getUser($uid);

        $this->_commandGatherUserSettings($prefix);
        $this->um->saveUserParams($uid,$prefix);
        $this->forwardCommand('Maintain Users');
    }

    function buildDeleteUser()
    {
        if (!SB_reqChk('uid'))
        {
            $this->error('No user was selected!');
            return null;
        }

        if ($this->um->uid == SB_reqVal('uid',true))
        {
            $this->error('Use "%s" command to delete own account!', SB_T('Delete Account'));
            return null;
        }

        $fields = array();
        $user = $this->um->getUser(SB_reqVal('uid'));
        $fields['Username'] = array('name'=>'username', 'value'=>$user['username'], 'disabled' => null);
        $fields['E-mail'] = array('name'=>'email', 'value'=>$user['email'], 'disabled' => null);
        $fields['Real Name'] = array('name'=>'realname', 'value'=>$user['name'], 'disabled' => null);
        $fields['-hidden1-'] = array('name'=>'uid', 'value'=>SB_reqVal('uid'));

        if (count($this->tree->getUserRoots(SB_reqVal('uid'))))
        {
            $fields['New Tree Owner'] = array('name'=>'owner','type'=>'select',
                '_options'=>'_buildUserList', '_exclude'=>SB_reqVal('uid'), '_select'=>$this->um->uid);
        }
        return $fields;
    }

    function commandDeleteUser()
    {
        if (!$this->um->removeUser(SB_reqVal('uid',true)))
        {
            return;
        }
        if (SB_reqChk('owner'))
        {
            $this->tree->changeOwner(SB_reqVal('uid'), SB_reqVal('owner'));
        }

        $this->forwardCommand('Maintain Users');
    }

    function mandatoryDeleteAccount()
    {
        return array('pass');
    }

    function buildDeleteAccount()
    {
        $fields = array();
        $fields['-raw1-'] = SB_P('command::delete_account');
        $fields['Password'] = array('name'=>'pass','type'=>'password');
        return $fields;
    }

    function commandDeleteAccount()
    {
        if (SB_reqChk('pass') && SB_reqVal('pass') && !$this->um->checkPassword($this->um->uid,SB_reqVal('pass')))
        {
            $this->error('Invalid password!');
        }

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        if ($this->um->deleteAccount())
        {
            $this->commandLogOut();
        }
    }

    function optionalCommonUserSettings()
    {
        static $fields = array
        (
            'auto_close',
            'auto_retrieve_favicon',
            'default_search',
            'default_search_tool',
            'default_url',
            'extern_commander',
            'expert_mode',
            'hide_xslt',
            'feed_reader_url',
            'load_all_nodes',
            'link_sort_mode',
            'mix_mode',
            'popup_params',
            'private_over_ssl_only',
            'pm_notification',
            'search_engine_ico',
            'search_engine_url',
            'show_acl',
            'show_logo',
            'show_public',
            'use_favicons',
            'use_hiding',
            'use_search_engine',
            'use_search_engine_iframe',
            'use_tooltips',
            'use_trash',
            'use_new_window',
        );

        return $fields;
    }

    function _buildCommonUserSettings($prefix, &$fields)
    {
        $fields['Default Search In'] = array('name'=>'default_search','type'=>'select',
            '_options'=>'_buildSearchPrefix', '_select'=>$this->um->getParam($prefix,'default_search'));
        $fields['Default Search Tool'] = array('name'=>'default_search_tool','type'=>'select',
            '_options'=>'_buildSearchTool', '_select'=>$this->um->getParam($prefix,'default_search_tool'));
        $fields['Default Bookmark Sort Mode'] = array('name'=>'link_sort_mode','type'=>'select',
            '_options'=>'_buildLinkSortMode', '_select'=>$this->um->getParam($prefix,'link_sort_mode'));
        $fields['Default URL'] = array('name'=>'default_url',
            'value'=>$this->um->getParam($prefix,'default_url'));
        $fields['Order of Folders v. Bookmarks'] = array('name'=>'mix_mode','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam($prefix,'mix_mode'),
            'title'=>SB_P('command::tooltip_mix_mode'));
        $fields['Paste Mode'] = array('name'=>'paste_mode','type'=>'select',
            '_options'=>'_buildPasteModeSetting', '_select'=>$this->um->getParam($prefix,'paste_mode'));
        $fields['Skin'] = array('name'=>'skin','type'=>'select',
            '_options'=>'_buildSkinList', '_select'=>$this->um->getParam($prefix,'skin'));

        $fields['Allow Info Mail'] = array('name'=>'allow_info_mails',
            'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'allow_info_mails'),
            'title'=>SB_P('command::tooltip_allow_info_mails'));

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $fields['Auto Retrieve Favicon'] = array('name'=>'auto_retrieve_favicon', 'type'=>'checkbox',
                'checked'=>$this->um->getParamCheck($prefix,'auto_retrieve_favicon'),
                'title'=>SB_P('command::tooltip_auto_retrieve_favicon'));
        }

        $fields['Decorate Shared Folders'] = array('name'=>'show_acl', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'show_acl'),
            'title'=>SB_P('command::tooltip_show_acl'));

        $fields['Expert Mode'] = array('name'=>'expert_mode', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'expert_mode'),
            'title'=>SB_P('command::tooltip_expert_mode'));

        $fields['Faster Command Execution'] = array('name'=>'extern_commander', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'extern_commander'),
            'title'=>SB_P('command::tooltip_extern_commander'));

        $fields['Feed Reader URL'] = array('name'=>'feed_reader_url',
            'value'=>$this->um->getParamB64($prefix,'feed_reader_url'));

        $fields['Hide XSLT Features'] = array('name'=>'hide_xslt', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'hide_xslt'),
            'title'=>SB_P('command::tooltip_hide_xslt'));

        $fields['Load All Folders'] = array('name'=>'load_all_nodes', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'load_all_nodes'),
            'title'=>SB_P('command::tooltip_load_all_nodes'));

        $fields['Load Private Bookmarks Over SSL Only'] = array('name'=>'private_over_ssl_only', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'private_over_ssl_only'),
            'title'=>SB_P('command::tooltip_private_over_ssl_only'));

        $fields['Open Links in New Window'] = array('name'=>'use_new_window', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_new_window'),
            'title'=>SB_P('command::tooltip_use_new_window'));

        if ($this->um->getParam('config','use_mail_features')) {
            $fields['Private Message Notification'] = array('name'=>'pm_notification', 'type'=>'checkbox',
                'checked'=>$this->um->getParamCheck($prefix,'pm_notification'),
                'title'=>SB_P('command::tooltip_pm_notification'));
        }

        $fields['Pop-up Window Parameters'] = array('name'=>'popup_params',
            'value'=>$this->um->getParamB64($prefix,'popup_params'),
            'title'=>SB_P('command::tooltip_popup_params'));

        $fields['Skip Execution Messages'] = array('name'=>'auto_close', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'auto_close'),
            'title'=>SB_P('command::tooltip_auto_close'));

        $fields['Show Logo'] = array('name'=>'show_logo', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'show_logo'),
            'title'=>SB_P('command::tooltip_show_logo'));

        $fields['Show Menu Icon'] = array('name'=>'menu_icon', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'menu_icon'),
            'title'=>SB_P('command::tooltip_menu_icon'));

        $fields['Show Web Search Engine Results Inline'] = array('name'=>'use_search_engine_iframe', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_search_engine_iframe'),
            'title'=>SB_P('command::tooltip_use_search_engine_iframe'));

        $fields['Show Favicons'] = array('name'=>'use_favicons', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_favicons'),
            'title'=>SB_P('command::tooltip_use_favicons'));

        $fields['Use Folder Hiding'] = array('name'=>'use_hiding', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_hiding'),
            'title'=>SB_P('command::tooltip_use_hiding'));

        $fields['Use SiteBar Tooltips'] = array('name'=>'use_tooltips', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_tooltips'),
            'title'=>SB_P('command::tooltip_use_tooltips'));

        $fields['Use Trash'] = array('name'=>'use_trash', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_trash'),
            'title'=>SB_P('command::tooltip_use_trash'));

        $fields['Use Web Search Engine'] = array('name'=>'use_search_engine', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_search_engine'),
            'title'=>SB_P('command::tooltip_use_search_engine'));

        if ($this->um->getParam('config', 'allow_custom_search_engine'))
        {
            $fields['Web Search Engine URL'] = array('name'=>'search_engine_url',
                'value'=>$this->um->getParamB64($prefix,'search_engine_url'));
            $fields['Web Search Engine Icon'] = array('name'=>'search_engine_ico',
                'value'=>$this->um->getParamB64($prefix,'search_engine_ico'));
        }
    }

    function optionalUserSettings()
    {
        return $this->optionalCommonUserSettings();
    }

    function buildUserSettings()
    {
        $prefix = 'user';
        $fields = array();

        $fields['Personal Data'] = array('type'=>'addbutton');
        $fields['Delete Account'] = array('type'=>'addbutton');

        if ($this->um->demo)
        {
            foreach ($fields as $name => $field)
            {
                $fields[$name]['disabled'] = null;
            }
        }

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$this->um->getParam($prefix,'lang'));

        $this->_buildCommonUserSettings($prefix, $fields);
        return $fields;
    }

    function optionalDefaultUserSettings()
    {
        return $this->optionalCommonUserSettings();
    }

    function buildDefaultUserSettings()
    {
        $prefix = 'default';
        $fields = array();

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildAutoLangList', '_select'=>$this->um->getParam($prefix,'lang'));

        $this->_buildCommonUserSettings($prefix, $fields);
        return $fields;
    }

    function optionalSessionSettings()
    {
        return $this->optionalCommonUserSettings();
    }

    function buildSessionSettings()
    {
        $prefix = 'user';

        $fields = array();

        $fields['Language'] = array('name'=>'lang','type'=>'select', 'class'=>'fixed',
            '_options'=>'_buildLangList', '_select'=>$this->um->getParam($prefix,'lang'));
        $fields['Default Search In'] = array('name'=>'default_search','type'=>'select',
            '_options'=>'_buildSearchPrefix', '_select'=>$this->um->getParam($prefix,'default_search'));
        $fields['Default Bookmark Sort Mode'] = array('name'=>'link_sort_mode','type'=>'select',
            '_options'=>'_buildLinkSortMode', '_select'=>$this->um->getParam($prefix,'link_sort_mode'));
        $fields['Order of Folders v. Bookmarks'] = array('name'=>'mix_mode','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam($prefix,'mix_mode'),
            'title'=>SB_P('command::tooltip_mix_mode'));
        $fields['Skin'] = array('name'=>'skin','type'=>'select',
            '_options'=>'_buildSkinList', '_select'=>$this->um->getParam($prefix,'skin'));

        $fields['Show Favicons'] = array('name'=>'use_favicons', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_favicons'),
            'title'=>SB_P('command::tooltip_use_favicons'));

        $fields['Use SiteBar Tooltips'] = array('name'=>'use_tooltips', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'use_tooltips'),
            'title'=>SB_P('command::tooltip_use_tooltips'));

        $fields['Show Menu Icon'] = array('name'=>'menu_icon', 'type'=>'checkbox',
            'checked'=>$this->um->getParamCheck($prefix,'menu_icon'),
            'title'=>SB_P('command::tooltip_menu_icon'));

        return $fields;
    }

    function _buildPasteModeSetting($select=null)
    {
        $modes = array
        (
            'ask'  => SB_T('Ask'),
            'copy' => SB_T('Copy'),
            'move' => SB_T('Move or Copy'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildSearchPrefix($select=null)
    {
        $modes = array
        (
            'all'  => SB_T('All'),
            'name' => SB_T('Name'),
            'url'  => SB_T('URL'),
            'desc' => SB_T('Description'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildSearchTool($select=null)
    {
        $modes = array
        (
            'filter' => SB_T('Frontend Filter'),
            'backend' => SB_T('Backend Search'),
            'web'  => SB_T('Web Search'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildMixMode($select=null)
    {
        $modes = array
        (
            'nodes' => SB_T('Folders First'),
            'links' => SB_T('Bookmarks First'),
        );

        foreach ($modes as $mode => $label)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . $label . "</option>\n";
        }
    }

    function _buildLinkSortMode($select=null)
    {
        $modes = array
        (
            'abc',
            'added',
            'changed',
        );

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $modes[] = 'visited';
            $modes[] = 'hits';
            $modes[] = 'waiting';
        }

        foreach ($modes as $mode)
        {
            echo '<option '. ($select==$mode?'selected':'') .
                 ' value="' . $mode . '">' . SB_T($this->tree->sortModeLabel[$mode]) . "</option>\n";
        }
    }

    function _commandGatherUserSettings($prefix)
    {
        $checks = array
        (
            'auto_close',
            'expert_mode',
            'extern_commander',
            'hide_xslt',
            'load_all_nodes',
            'menu_icon',
            'private_over_ssl_only',
            'show_acl',
            'show_logo',
            'use_favicons',
            'use_hiding',
            'use_search_engine',
            'use_search_engine_iframe',
            'use_tooltips',
            'use_new_window',
            'use_trash',
        );

        if ($this->um->getParam('config','use_outbound_connection'))
        {
            $checks[] = 'auto_retrieve_favicon';
        }
        if ($this->um->getParam('config','use_mail_features'))
        {
            $checks[] = 'pm_notification';
        }

        $values = array
        (
            'default_search',
            'default_search_tool',
            'link_sort_mode',
            'mix_mode',
            'lang',
            'paste_mode',
            'skin',
            'default_url',
        );

        $valuesB64 = array
        (
            'feed_reader_url',
            'popup_params'
        );

        if ($this->um->getParam('config', 'allow_custom_search_engine'))
        {
            $valuesB64[] = 'search_engine_url';
            $valuesB64[] = 'search_engine_ico';
        }

        foreach ($checks as $check)
        {
            $this->um->setParam($prefix, $check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $check)
        {
            $this->um->setParam($prefix, $check, SB_reqVal($check));
        }
        foreach ($valuesB64 as $check)
        {
            $this->um->setParamB64($prefix, $check, SB_reqVal($check));
        }

        $this->um->setParam($prefix,'allow_info_mails', SB_reqVal('allow_info_mails'));

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        // Have the behaviour immediately
        $this->reload = !$this->um->getParam($prefix,'extern_commander');
        $this->close = $this->um->getParam($prefix,'auto_close');
    }

    function commandUserSettings()
    {
        $prefix = 'user';
        $oldExternCommander = $this->um->getParam($prefix, 'extern_commander');
        $this->_commandGatherUserSettings($prefix);
        $this->um->saveUserParams();
        $this->um->setParam($prefix, 'extern_commander', $oldExternCommander);
    }

    function commandDefaultUserSettings()
    {
        $prefix = 'default';
        $this->_commandGatherUserSettings($prefix);
        $this->um->saveUserParams(SB_ANONYM, $prefix);
    }

    function commandSessionSettings()
    {
        $checks = array
        (
            'use_favicons',
            'use_tooltips',
            'menu_icon',
        );

        $values = array
        (
            'lang',
            'default_search',
            'link_sort_mode',
            'mix_mode',
            'skin',
        );

        foreach ($checks as $check)
        {
            $this->um->setParam('user',$check, SB_reqVal($check)?1:0);
        }
        foreach ($values as $check)
        {
            $this->um->setParam('user',$check, SB_reqVal($check));
        }

        // Have the behaviour immediately
        $this->reload = !$this->um->getParam('user','extern_commander');
        $this->close = $this->um->getParam('user','auto_close');

        $this->um->setCookie('SB3SETTINGS', $this->um->implodeParams('user'), 0);
    }

    function mandatoryPersonalData()
    {
        $fields = array
        (
            'username',
        );

        if ($this->um->getParam('config','users_must_verify_email') || $this->um->isAdmin())
        {
            $fields[] = 'email';
        }

        if ($this->um->isAdmin())
        {
            $fields[] = 'realname';
        }

        return $fields;
    }

    function buildPersonalData()
    {
        $fields = array();

        $fields['Username'] = array('name'=>'username', 'value'=>$this->um->username);
        $fields['Old Password'] = array('name'=>'pass','type'=>'password');
        $fields['Password'] = array('name'=>'pass1','type'=>'password');
        $fields['Repeat Password'] = array('name'=>'pass2','type'=>'password');
        $fields['E-mail'] = array('name'=>'email', 'value'=>$this->um->email);
        $fields['Real Name'] = array('name'=>'realname','value'=>$this->um->name);
        $fields['Comment'] = array('name'=>'comment','value'=>$this->um->comment);

        if ($this->um->demo)
        {
            foreach ($fields as $name => $field)
            {
                $fields[$name]['disabled'] = null;
            }
        }

        return $fields;
    }

    function commandPersonalData()
    {
        if (SB_reqVal('pass1') != SB_reqVal('pass2'))
        {
            $this->error('The password was not repeated correctly!');
        }

        $mfields = array('username');

        // When changing password or email, old password must be specified
        if (SB_reqVal('pass1') || (SB_reqVal('username') != $this->um->username))
        {
            $mfields[] = 'pass';

            if (strlen(SB_reqVal('pass')) && !$this->um->checkPassword($this->um->uid,SB_reqVal('pass')))
            {
                $this->error('Old password is invalid!');
            }
        }

        $this->checkMandatoryFields($mfields);

        if ($this->hasErrors())
        {
            $this->goBack();
            return;
        }

        $this->um->personalData(
            SB_reqVal('username'),
            ($this->um->demo?null:SB_reqVal('pass1')),
            SB_reqVal('email'),
            SB_reqVal('realname'),
            SB_reqVal('comment'));

        $this->forwardCommand('User Settings');
    }

/******************************************************************************/

    function buildFilterGroups()
    {
        return $this->buildFilterUsers();
    }

    function buildMaintainGroups()
    {
        $fields = array();

        $fields['Create Group'] = array('type'=>'button');
        $fields['Send Message to Groups'] = array('type'=>'button');

        $groups = $this->um->getOwnGroups($this->um->uid);
        if (count($groups))
        {
            if ($this->um->useGroupFilter() && !SB_reqChk('gregexp'))
            {
                $fields['Filter Group RegExp'] = array('name'=>'gregexp');
                $fields['-hidden-'] = array('name'=>'forward', 'value'=>'Maintain Groups');
                $fields['Filter Groups'] = array('type'=>'button');
            }
            else
            {
                $fields['Select Group'] = array('name'=>'command_gid','type'=>'select','_options'=>'_buildGroupList','_select'=>SB_reqVal('command_gid'));
                $fields['Group Properties'] = array('type'=>'button');
                $fields['Delete Group'] = array('type'=>'button');
                $fields['Send Message to Members'] = array('type'=>'button');
                $fields['Invite Members'] = array('type'=>'button');

                if ($this->um->useUserFilter())
                {
                    $fields['Filter User RegExp'] = array('name'=>'uregexp', 'value'=>SB_reqVal('uregexp'));
                }

                $fields['Edit Members'] = array('type'=>'button');
            }
        }
        return $fields;
    }

    function buildMaintainGroup()
    {
        $fields = array();

        $group = $this->um->getGroup(SB_reqVal('command_gid', true));

        // !!Check owner or moderator
        $members = $this->um->getMembers(SB_reqVal('command_gid'));

        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        $fields['-hidden2-'] = array('name'=>'uregexp','value'=>SB_reqVal('uregexp'));
        $fields['Group Properties'] = array('type'=>'button');
        $fields['Delete Group'] = array('type'=>'button');

        if (count($members))
        {
            $fields['Send Message to Members'] = array('type'=>'button');
        }

        $fields['Invite Members'] = array('type'=>'button');

        if (count($members))
        {
            if ($this->um->useUserFilter())
            {
                $fields['Filter User RegExp'] = array('name'=>'uregexp', 'value'=>SB_reqVal('uregexp'));
            }

            $fields['Edit Members'] = array('type'=>'button');
        }
        return $fields;
    }

    function buildGroupProperties()
    {
        $fields = $this->buildCreateGroup();

        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        foreach ($fields as $name => $params)
        {
            if ($params['name'] &&  isset($group[$params['name']]))
            {
                $fields[$name]['value'] = $group[$params['name']];
            }
        }

        if ($this->um->isAdmin())
        {
            $fields['Owner'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList','_select'=>$group['uid']);
        }

        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);

        return $fields;
    }

    function commandGroupProperties()
    {
        $columns = array('name'=>SB_reqVal('name'), 'comment'=>SB_reqVal('comment'));

        if ($this->um->isAdmin())
        {
            $columns['uid'] = SB_reqVal('uid', true);
        }

        $this->um->updateGroup(SB_reqVal('command_gid'), $columns);
        $this->forwardCommand('Maintain Groups');
    }

    function buildDeleteGroup()
    {
        $fields = array();
        if (SB_reqVal('command_gid') == SB_ADMIN_GROUP)
        {
            $this->error('Cannot delete administrators group!');
            return $fields;
        }

        $group = $this->um->getGroup(SB_reqVal('command_gid'));
        $fields['Group Name'] = array('name'=>'name','value'=>$group['name'],'disabled'=>null);
        $fields['Comment'] = array('name'=>'comment','value'=>$group['comment'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        return $fields;
    }

    function commandDeleteGroup()
    {
        $this->um->removeGroup(SB_reqVal('command_gid'));

        $this->forwardCommand('Maintain Groups');
    }

    function buildCreateGroup()
    {
        $fields = array();
        $fields['Group Name'] = array('name'=>'name');
        $fields['Comment'] = array('name'=>'comment');

        if ($this->um->isAdmin())
        {
            $fields['Owner'] = array('name'=>'uid','type'=>'select',
                '_options'=>'_buildUserList','_select'=>$this->um->uid);
        }

        return $fields;
    }

    function commandCreateGroup()
    {
        $owner = $this->um->uid;

        if ($this->um->isAdmin())
        {
            $owner = SB_reqVal('uid');
        }

        if (preg_match('/[<>"]/',SB_reqVal('name')))
        {
            $this->error('Group name must not contain following characters [%s]!', '&lt;&gt;&quot;');
            return;
        }

        $this->um->addGroup(
            array('name'=>SB_reqVal('name'),'comment'=>SB_reqVal('comment'),'uid'=>$owner));

        $this->forwardCommand('Maintain Groups');
    }

/******************************************************************************/

    function mandatoryEmailBookmark()
    {
        return array('to');
    }

    function buildEmailBookmark()
    {
        $fields = array();
        $link = $this->tree->getLink(SB_reqValInt('lid_acl'));
        if (!$link) return null;

        $fields['--hidden1--'] = array('name'=>'lid_acl', 'value'=> SB_reqValInt('lid_acl'));

        if ($this->um->canUseMail())
        {
            $fields['From'] = array('name'=>'from',
                'value'=> $this->um->email, 'disabled' => null);
            $fields['To'] =
                array('name'=>'to');

            $fields['Bookmark Name'] = array('name'=>'name','value'=>$link->name,'disabled'=>null);
            $fields['URL']       = array('name'=>'url','value'=>$link->url,'disabled'=>null);
            $fields['Description'] = array('name'=>'comment','type'=>'textarea','value'=>$link->comment);
            $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>$link->id);
        }

        $fields['-raw1-'] = SB_P('command::email_link_href',
            array(htmlspecialchars($link->name),htmlspecialchars($link->url),SB_Page::absBaseUrl()));
        return $fields;
    }

    function commandEmailBookmark()
    {
        if (!$this->um->canUseMail())
        {
            $this->warn('Please click on the link presented below to send the email!');
            $this->goBack();
            return;
        }

        $link = $this->tree->getLink(SB_reqValInt('lid_acl'));
        if (!$link) return null;

        $subject = SB_T('SiteBar: Web site') . ' ' . $link->name;

        $msg = SB_P('command::email_link',array($link->name, $link->url, SB_reqVal('comment'), SB_Page::absBaseUrl()));
        $this->um->sendMail(array('email'=>SB_reqVal('to')), $subject, $msg, $this->um->name, $this->um->email);
    }

    function buildExportDescription()
    {
        $fields['Decode Using'] = array('type'=>'callback', 'function'=>'_buildDecodeUsing');
        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>SB_reqValInt('lid_acl'));

        return $fields;
    }

    function _buildDecodeUsing($params)
    {
?>
        <div class="label">Decode Using</div>
        <input value="base64" type="radio" name="type" checked>MIME Base64<br>
        <input value="text" type="radio" name="type">No decoding<br>
<?php
    }

    function commandExportDescription()
    {
        $link = $this->tree->getLink(SB_reqValInt('lid_acl'));
        if (!strlen($link->comment))
        {
            $this->error('Cannot export empty description!');
        }

        if ($this->hasErrors())
        {
            return;
        }

        switch (SB_reqVal('type'))
        {
            case 'base64':
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $link->name . '"');
                header('Content-Transfer-Encoding: binary');
                echo base64_decode($link->comment);
                break;

            case 'text':
                header('Content-Type: text/plain');
                header('Content-Disposition: attachment; filename="' . $link->name . '"');
                header('Content-Transfer-Encoding: binary');
                echo $link->comment;
                break;
        }

        exit; // Really break program here
    }

    function buildImportDescription()
    {
        $fields['Description File'] = array('type'=>'file','name'=>'file');
        $fields['Encode Using'] = array('type'=>'callback', 'function'=>'_buildEncodeUsing');
        $fields['-hidden1-'] = array('name'=>'lid_acl','value'=>SB_reqValInt('lid_acl'));
        return $fields;
    }

    function _buildEncodeUsing($params)
    {
?>
        <div class="label">Encode Using</div>
        <input value="base64" type="radio" name="type" checked>MIME Base64<br>
        <input value="text" type="radio" name="type">No encoding<br>
<?php
    }

    function commandImportDescription()
    {
        if (!$this->checkFile('file'))
        {
            return;
        }
        $filename = $_FILES['file']['tmp_name'];
        $link = $this->tree->getLink(SB_reqValInt('lid_acl'));

        if ($this->hasErrors())
        {
            return;
        }

        $limit = $this->um->getParam('config','comment_limit');

        if ($limit && $limit<filesize($filename))
        {
            $this->error('The description length exceeds maximum length of %s bytes!', array($limit));
            return;
        }

        $size = filesize($filename);
        $handle = fopen($filename, 'rb');
        $file_content = fread($handle,$size);
        fclose($handle);

        // File might not exist when closed
        $this->useHandler(false);
        @unlink($filename);
        $this->useHandler(true);

        $comment = '';

        switch (SB_reqVal('type'))
        {
            case 'base64':
                $comment = base64_encode($file_content);
                break;

            case 'text':
                $comment = $file_content;
                break;
        }

        $this->tree->updateLink($link->id, array( 'comment'=>$comment ));
    }

/******************************************************************************/

    function buildFolderSharing()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));

        $fields['Folder Name'] = array('name'=>'name','value'=>$node->name,'disabled'=>null);
        $fields['Sharing List'] = array('type'=>'callback',
            'function'=>'_buildSharingList', 'params'=>array('node'=>$node));

        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        $userurl = SB_Page::absBaseUrl().'user/'.$this->um->username;
        $dirurl = $userurl . '/dir/'. $node->id;

        if (!$this->um->getParam('config','use_nice_url'))
        {
            $userurl = SB_Page::absBaseUrl().'index.php?user='. $this->um->username;
            $dirurl = SB_Page::absBaseUrl().'index.php?user='. $this->um->username . '&amp;root=' . $node->id;
        }

        $fields['--label1-'] = SB_T("User Bookmarks");
        $fields['-raw1-'] = "<a target='_blank' href='$userurl'>$userurl</a>";
        $fields['--label2-'] = SB_T("This Folder");
        $fields['-raw2-'] = "<a target='_blank' href='$dirurl'>$dirurl</a>";
        return $fields;
    }

    function _buildSharingList($params)
    {
        $groups = $this->um->getGroups();
        // We may display a subset here
        $ownGroups = $this->um->getOwnGroups();
        $myGroups = $this->um->getUserGroups();
        $publicGroups = $this->um->getParamArray('config','public_groups');

        $node = $params['node'];

        if (count($ownGroups)==0 && $node->isMyTree())
        {
            $groups = $this->um->getParamArray('config','default_groups');
            foreach ($groups as $groupname)
            {
                $group = array('uid'=>$this->um->uid, 'name'=>$groupname);
                $this->um->addGroup($group);
            }

            $groups = $this->um->getGroups();
            // We may display a subset here
            $ownGroups = $this->um->getOwnGroups();
            $myGroups = $this->um->getUserGroups();
        }

        $expertMode = $this->um->getParam('user','expert_mode');

        // Should we use expert mode?
        foreach ($groups as $gid => $rec)
        {
            $acl = $node->getGroupACL($gid);
            $parentACL = $node->getParentACL($gid);

            if (!$acl)
            {
                $acl = $parentACL;
            }

            $aclSum    = $acl['allow_insert'] +
                         $acl['allow_update'] +
                         $acl['allow_delete'];

            $parentSum = $parentACL['allow_insert'] +
                         $parentACL['allow_update'] +
                         $parentACL['allow_delete'];

            if ( ($aclSum>0 && $aclSum<3) || ($parentSum>0 && $parentSum<3))
            {
                $expertMode = true;
            }
        }

?>
    <table cellpadding='1'>
        <tr>
<?php
        if ($expertMode):
?>
            <th class="group"><?php echo SB_T('Group')?></th>
            <th class="right"><?php echo SB_T('R')?></th>
            <th class="right"><?php echo SB_T('A')?></th>
            <th class="right"><?php echo SB_T('M')?></th>
            <th class="right"><?php echo SB_T('D')?></th>
<?php
        else:
?>
            <th class="group"><?php echo SB_T('Group')?></th>
            <th class="right"><?php echo SB_T('Read')?></th>
            <th class="right"><?php echo SB_T('Write')?></th>
<?php
        endif;
?>
        </tr>
<?php
        foreach ($groups as $gid => $rec)
        {
            $isMyGroup = isset($myGroups[$gid]);
            $isOwnGroup = isset($ownGroups[$gid]);
            $isPublic = in_array($rec['name'], $publicGroups);

            $acl = $node->getGroupACL($gid);
            $parentACL = $node->getParentACL($gid);

            if (!$acl)
            {
                $acl = $parentACL;
            }

            $aclSum = $acl['allow_select'] +
                      $acl['allow_insert'] +
                      $acl['allow_update'] +
                      $acl['allow_delete'];

            $memberCanShare = $isOwnGroup || ($isMyGroup && $myGroups[$gid]['share']);
            $memberCanUnShare = $isOwnGroup || ($isMyGroup && $myGroups[$gid]['moderator']);

            $canShare = $node->isMyTree() && $memberCanShare;
            $canUnShare = $aclSum && ($node->isMyTree() || $memberCanUnShare);

            if (!$canShare && !$canUnShare && !$isMyGroup)
            {
                continue;
            }

            $showGroup = false;

            $hasMembers = false;
            if ($memberCanUnShare)
            {
                $members = $this->um->getMembers($gid);
                $hasMembers = count($members);
                $members = null;
            }

            $params = "nid_acl={$node->id}&amp;command_gid=${gid}";

            $commands = array
            (
                array
                (
                    'command' => 'Send Message to User',
                    'enabled' => !$isOwnGroup,
                    'icon' => 'command_message',
                    'label' => SB_T('Send message to group owner'),
                    'uriparams' => 'uid='.$rec['uid'],
                ),
                array
                (
                    'command' => 'Invite Members',
                    'enabled' => !$isPublic && $memberCanUnShare,
                    'icon' => 'command_invite_members',
                    'uriparams' => $params,
                ),
                array
                (
                    'command' => 'Edit Members',
                    'enabled' => !$isPublic && $memberCanUnShare && $hasMembers,
                    'icon' => 'command_edit_members',
                    'uriparams' => $params,
                ),
                array
                (
                    'command' => 'Leave Group',
                    'enabled' => !$isPublic && !$isOwnGroup && $isMyGroup,
                    'icon' => 'command_leave_group',
                    'uriparams' => $params,
                ),
            );

?>
        <tr id="group<?php echo $gid ?>a" class="group" style="visibility:collapse">
            <td rowspan=<?php echo $expertMode?2:1 ?> class="group iconcommands">
<?php
            foreach ($commands as $command)
            {
                if (!isset($command['label']))
                {
                    $command['label'] = SB_T($command['command']);
                }

                $img = '<img src="'. SB_Page::relBaseUrl().'skins/'.$command['icon']. ($command['enabled']?'':'_inactive') .'.png" '.

                $linkopen = "";
                $linkclose = "";

                if ($command['enabled'])
                {
                    $img .=
                      'onmousedown="SB_buttonDown(this,true);" ' .
                      'onmouseup="SB_buttonUp(this,true);" ' .
                      'onmouseover="SB_buttonOver(this,true);'.($this->useToolTips?'SB_toolTip(this,event);':'').'" '.
                      'onmouseout="SB_buttonOut(this,true);'.($this->useToolTips?'SB_toolTipHide()':'').';" '.
                      ($this->useToolTips?'x_title':'title') . '="'.$command['label'].'" ';

                    $linkopen = '<a class="iconcommand" href="command.php?command='.$command['command'].'&amp;'.$command['uriparams'].'">';
                    $linkclose = '</a> ';
                }
                else
                {
                    $img .= $this->getToolTip(array('title'=>$command['label']));
                }

                echo $linkopen.$img.' />'.$linkclose.' ';
            }
?>
                <br><?php echo $isOwnGroup?$rec['name']:$rec['completenamehtml']?>
            </td>

<?php
            if ($expertMode):

                foreach ($this->tree->rights as $right)
                {
                    if ($parentACL && $parentACL['allow_'.$right])
                    {
                        $showGroup = true;
                    }
?>
            <td class="right">
                <input type="checkbox" disabled <?php echo $parentACL && $parentACL['allow_'.$right]?'checked':''?>>
            </td>
<?php
                }

            else:

                $readOnly = $parentACL && $parentACL['allow_select'];
                $readWrite = $parentACL && $parentACL['allow_insert'] && $parentACL['allow_update'] && $parentACL['allow_delete'];

                if ($readOnly || $readWrite)
                {
                    $showGroup = true;
                }
            endif;

            if ($expertMode) :
?>
        </tr>
        <tr id="group<?php echo $gid ?>b" style="visibility:collapse">
<?php
                foreach ($this->tree->rights as $right)
                {
                    $isSet = $acl && $acl['allow_'.$right];
                    $canChange = ((!$isSet && $canShare) || ($isSet && $canUnShare)) && ($right=='select' || !$isPublic);

                    if ($isSet || $canChange)
                    {
                        $showGroup = true;
                    }
?>
            <td class='right'>
                <input type='checkbox' value='1' <?php echo $canChange?'':'disabled'?>
                    name='<?php echo $right.'_'.$gid?>' <?php echo $isSet?'checked':''?>>
            </td>
<?php
                }
            else:

                $isSetRO = $acl && $acl['allow_select'];
                // Other rights must be set the same way when we are here
                $isSetRW = $acl && $acl['allow_update'];

                $canChangeRO = (!$isSetRO && $canShare) || ($isSetRO && $canUnShare);
                $canChangeRW = !$isPublic && (!$isSetRW && $canShare) || ($isSetRW && $canUnShare);

                if ( ($isSetRO || $canChangeRO) || ($isSetRW || $canChangeRW))
                {
                    $showGroup = true;
                }

?>
            <td class='right'>
               <input type='checkbox' value='1' <?php echo $canChangeRO?'':'disabled'?>
                    onchange='if (!this.checked) this.form.<?php echo 'rw_'.$gid?>.checked=false;'
                    name='<?php echo 'select_'.$gid?>' <?php echo $isSetRO?'checked':''?>>
            </td>
            <td class='right'>
               <input type='checkbox' value='1' <?php echo $canChangeRW?'':'disabled'?>
                    onchange='if (this.checked) this.form.<?php echo 'select_'.$gid?>.checked=true;'
                    name='<?php echo 'rw_'.$gid?>' <?php echo $isSetRW?'checked':''?>>
            </td>
<?php

        endif;
?>
        </tr>
<?php
            if ($showGroup)
            {
                echo "<script>SB_showShareGroup(${gid});</script>";
            }
        }

?>
    </table>
<?php
    if ($expertMode):
?>
    <div class="legend"><?php echo SB_P('command::security_legend')?></div>
<?php
    endif;
    }


    function commandFolderSharing()
    {
        $groups = $this->um->getGroups();
        $ownGroups = $this->um->getOwnGroups();
        $myGroups = $this->um->getUserGroups();

        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));
        $sameACL = true;
        $updated = 0;

        $expertMode = $this->um->getParam('user','expert_mode');

        foreach ($groups as $gid => $rec)
        {
            $isMyGroup = isset($myGroups[$gid]);
            $isOwnGroup = isset($ownGroups[$gid]);

            $parentACL = $node->getParentACL($gid);

            $oldacl = $node->getGroupACL($gid);
            $newacl = array();
            $newsum = 0;
            $same = true;

            $memberCanShare = $isOwnGroup || ($isMyGroup && $myGroups[$gid]['share']);
            $memberCanUnShare = $isOwnGroup || ($isMyGroup && $myGroups[$gid]['moderator']);

            $canShare = $node->isMyTree() && $memberCanShare;
            $canUnShare = $node->isMyTree() || $memberCanUnShare;

            if (!$canShare && !$canUnShare)
            {
                continue;
            }

            foreach ($this->tree->rights as $right)
            {
                $name = $right.'_'.$gid;

                $value = SB_reqVal($name)?1:0;

                if (!$expertMode && SB_reqVal('rw_'.$gid))
                {
                    $value = 1;
                }

                $parentValue = $parentACL?$parentACL['allow_'.$right]:0;
                $same = $same && $value==$parentValue;
                $newacl['allow_'.$right] = $value?1:0;
                $newsum += $value;
            }

            // We had right on the node before and we do not have right
            // to grant right but have right to remove it then check
            // that we are not cheating.
            if ($oldacl && $canUnShare && !$canShare)
            {
                foreach ($this->tree->rights as $right)
                {
                    if (intval($newacl['allow_'.$right]) > intval($oldacl['allow_'.$right]) )
                    {
                        $this->um->accessDenied();
                        return;
                    }
                }
            }

            // Remove empty acl
            if (!$newsum && $same)
            {
                $node->removeACL($gid);
            }
            else
            {
                $node->updateACL($gid, $newacl);
            }

            $updated++;
            $sameACL = $sameACL && $same;
        }

        // If complete group ACL is the same as parent then we can remove it
        if ($updated && $sameACL)
        {
            $node->removeACL();
        }
    }

    function buildInviteMembers()
    {
        $fields = array();

        $gid = SB_reqVal('command_gid', true);
        $groups = $this->um->getUserGroups($this->um->uid, $gid);
        if (!count($groups) || !$groups[$gid]['moderator'])
        {
            $this->um->accessDenied();
            return;
        }

        $group = $this->um->getGroup($gid);
        $owner = $group['uid'];

        $fields['Group Name'] = array('name'=>'group','value'=>$group['completename'],'disabled'=>null);
        $fields['Maintain Group'] = array('type'=>'addbutton');

        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>SB_reqVal('command_gid'));
        $fields['-hidden2-'] = array('name'=>'nid_acl','value'=>SB_reqValInt('nid_acl'));

        $fields['Invite Members'] = array('name'=>'members', 'type'=>'textarea', 'rows'=>8);
        if ($this->um->isAdmin())
        {
            $fields['Confirm Invited Members'] = array('name'=>'confirm', 'type'=>'checkbox', 'value'=>1);
        }
        $fields['-raw-comma-'] = SB_P('command::use_comma');

        return $fields;
    }

    function parseCommaAndEolList($string)
    {
        $string = preg_replace('/\n/m',',',$string);
        $items = array();

        foreach (explode(',',$string) as $item)
        {
            $item = trim($item);

            if (strlen($item))
            {
                $items[] = $item;
            }
        }

        return $items;
    }

    function commandInviteMembers()
    {
        $gid = SB_reqVal('command_gid');
        $groups = $this->um->getUserGroups($this->um->uid, $gid);
        if (!count($groups) || !$groups[$gid]['moderator'])
        {
            $this->um->accessDenied();
            return;
        }

        $group = $groups[$gid];
        $owner = $group['uid'];
        $members = $this->um->getMembers($gid);
        $confirmed = array();

        foreach ($this->parseCommaAndEolList(SB_reqVal('members')) as $item)
        {
            $user = $this->um->getUserByUsername($item);

            if (!$user)
            {
                $user = $this->um->getUserByEmail($item);
            }

            if (!$user)
            {
                $this->warn('Unknown user %s!', $item);
                continue;
            }

            if ($user['uid'] == $owner)
            {
                // Skip the owner
                continue;
            }

            $confirmed[] = $user['uid'];
            if (!isset($members[$user['uid']]))
            {
                $this->um->addMember($gid, $user['uid']);

                if ($this->um->isAdmin() && SB_reqVal('confirm'))
                {
                    $this->um->updateMember($gid, $user['uid'], array('confirmed'=>1));
                }
            }
            // Remove share and moderator flag from all
            $this->um->updateMember($gid, $user['uid'], array('share'=>0,'moderator'=>0));
        }
    }

    function _buildMemberSelect($params)
    {
        $id = 'id_'.$params['record']['uid'];

        $contributor = intval($params['record']['share']);
        $moderator = intval($params['record']['moderator']);

        $default = 'keep';
        if ($contributor&&!$moderator)
        {
            $default = 'contributor';
        }
        if ($moderator)
        {
            $default = 'moderator';
        }

        $options = array
        (
            "keep" => SB_T('Member'),
            "contributor" => SB_T('Contributor'),
            "moderator" => SB_T('Moderator'),
            "remove" => SB_T('Remove')
        );

?>
        <tr class='memberSelector'>
            <td id="<?php echo $id?>_r" class="<?php echo $default?>">
                <div class="label" id="<?php echo $id?>_l" onclick="SB_memberSelector('<?php echo $id?>',true)"><?php echo $params['record']['username']?></div>
                <div class="select" id="<?php echo $id?>_s">
                <select id="<?php echo $id?>_v" name="<?php echo $id?>" onchange="SB_onMemberSelectorChange('<?php echo $id?>')" onblur="SB_onMemberSelectorBlur('<?php echo $id?>')">
<?php
        foreach ($options as $value => $label)
        {
            echo "<option class='$value' value='$value' " . ($default==$value?'selected':'') . ">$label</option>\n";
        }
?>
                </select>
                </div>
            </td>
        </tr>
<?php
    }

    function buildEditMembers()
    {
        $fields = array();

        $gid = SB_reqVal('command_gid', true);
        $groups = $this->um->getUserGroups($this->um->uid, $gid);
        if (!count($groups) || !$groups[$gid]['moderator'])
        {
            $this->um->accessDenied();
            return;
        }

        $group = $this->um->getGroup($gid);
        $owner = $group['uid'];
        $members = $this->um->getMembers($gid);

        $fields['Group Name'] = array('name'=>'name','value'=>$group['completename'],'disabled'=>null);
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>$group['gid']);
        $fields['-hidden2-'] = array('name'=>'uregexp','value'=>SB_reqVal('uregexp'));
        $fields['Maintain Group'] = array('type'=>'addbutton');
        $fields['Invite Members'] = array('type'=>'addbutton');
        $fields['Member Count'] = array('name'=>'mbr_count','value'=>count($members),'disabled'=>null);

        $invitee = 0;
        $fields['-raw1-'] = '<table class="users"><tr><th>' . SB_T('Change Member Status') . '</th></tr>';
        foreach ($members as $uid => $user)
        {
            if (!$user['confirmed'])
            {
                $invitee++;
                continue;
            }

            if (!$this->matchesUserFilter($user))
            {
                continue;
            }

            $label = $user['username'];
            $fields[$label] = array
            (
                'type'=>'callback',
                'function'=>'_buildMemberSelect',
                'params'=>array('name'=>$uid,'record'=>$user),
            );
        }
        $fields['-raw2-'] = "</table>";

        if ($invitee)
        {
            $fields['-raw3-'] = '<table class="users"><tr><th>' . SB_T('Change Invitee Status') . '</th></tr>';
            foreach ($members as $uid => $user)
            {
                if (!$this->matchesUserFilter($user) || $user['confirmed'])
                {
                    continue;
                }

                $label = $user['username'];
                $fields[$label] = array
                (
                    'type'=>'callback',
                    'function'=>'_buildMemberSelect',
                    'params'=>array('name'=>$uid,'record'=>$user),
                );
            }
            $fields['-raw4-'] = "</table>";
        }

        return $fields;
    }

    function commandEditMembers()
    {
        $gid = SB_reqVal('command_gid');
        $groups = $this->um->getUserGroups($this->um->uid, $gid);
        if (!count($groups) || !$groups[$gid]['moderator'])
        {
            $this->um->accessDenied();
            return;
        }
        $group = $groups[$gid];
        $owner = $group['uid'];

        $members = $this->um->getMembers($gid);

        foreach ($members as $uid => $user)
        {
            if (!$this->matchesUserFilter($user))
            {
                continue;
            }

            if (!SB_reqChk('id_'.$uid))
            {
                continue;
            }

            switch (SB_reqVal('id_'.$uid, true))
            {
                case 'remove':
                    $this->um->removeMember($gid, $uid);
                    break;
                case 'keep':
                    $this->um->updateMember($gid, $uid, array('share'=>0,'moderator'=>0));
                    break;
                case 'contributor':
                    $this->um->updateMember($gid, $uid, array('share'=>1,'moderator'=>0));
                    break;
                case 'moderator':
                    $this->um->updateMember($gid, $uid, array('share'=>1,'moderator'=>1));
                    break;
            }
        }
    }

    function buildLeaveGroup()
    {
        $fields = array();

        $group = $this->um->getGroup(SB_reqVal('command_gid',true));

        $fields['Group Name'] = array('name'=>'group','value'=>$group['completenamehtml'],'disabled'=>null);
        $fields['-raw1-'] = SB_P('command::leave_group');
        $fields['-hidden1-'] = array('name'=>'command_gid','value'=>SB_reqVal('command_gid'));

        return $fields;
    }

    function commandLeaveGroup()
    {
        $this->um->removeMember(SB_reqVal('command_gid',true), $this->um->uid);
    }

    function commandAcceptMembership()
    {
        $gid = SB_reqVal('gid');
        $this->um->updateMember($gid, $this->um->uid, array('confirmed'=>1));
    }

    function commandRejectMembership()
    {
        $gid = SB_reqVal('gid');
        $this->um->removeMember($gid, $this->um->uid);
    }

/******************************************************************************/

    function buildValidateBookmarks()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));
        if (!$node) return null;

        $fields['Folder Name'] = array('name'=>'name','maxlength'=>255,
            'disabled'=>null, 'value'=>$node->name);
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);
        $fields['Include Subfolders'] = array('name'=>'subfolders', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_subfolders'));
        $fields['Ignore HTTPS'] = array('name'=>'ignore_https', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_ignore_https'));
        $fields['Ignore Recently Tested'] = array('name'=>'ignore_recently', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_ignore_recently'));
        $fields['Recent Time Expressed in Seconds'] = array('name'=>'recent_time', 'value'=>60*60);

        if ($this->um->getParam('user', 'use_favicons'))
        {
            $fields['Discover Missing Favicons'] = array('name'=>'discover_favicons', 'type'=>'checkbox', 'checked'=>null,
                'title'=>SB_P('command::tooltip_discover_favicons'));

            if ($this->um->getParam('config', 'use_favicon_cache'))
            {
                $fields['Delete Invalid Favicons'] = array('name'=>'delete_favicons', 'type'=>'checkbox', 'checked'=>null,
                    'title'=>SB_P('command::tooltip_delete_favicons'));
            }
        }

        return $fields;
    }

    function commandValidateBookmarks()
    {
        $this->forwardCommand('Validation');
    }

    function buildValidation()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));
        if (!$node) return null;

        require_once('./inc/validator.inc.php');
        $validator = new SB_Validator();
        $this->tree->loadLinkFilter = '';

        if (SB_reqVal('ignore_recently'))
        {
            $this->tree->loadLinkFilter =
                'UNIX_TIMESTAMP(tested) < ' . (mktime() - SB_reqVal('recent_time'));
            if (SB_reqVal('ignore_https'))
            {
                $this->tree->loadLinkFilter .= ' AND ';
            }
        }
        if (SB_reqVal('ignore_https'))
        {
            $this->tree->loadLinkFilter .= "url NOT LIKE 'https://%'";
        }

        if (SB_reqVal('subfolders'))
        {
            $this->tree->loadNodes($node);
        }
        else
        {
            $this->tree->loadLinks($node);
        }

        $validator->buildValidate($node, $fields,
            SB_reqVal('discover_favicons'),
            SB_reqVal('delete_favicons'));

        if (!$validator->linkCount)
        {
            if (SB_reqVal('ignore_recently'))
            {
                $this->warn('All links recently validated!');
            }
            else
            {
                $this->warn('No links in the folder!');
            }
        }

        return $fields;
    }

/******************************************************************************/

    function buildImportBookmarks()
    {
        $fields = array();
        $node = $this->tree->getNode(SB_reqValInt('nid_acl',true));

        $dirName = './inc/loaders';
        $dir = opendir($dirName);

        require_once('./inc/loader.inc.php');

        $floaders = array();

        while (($fileName = readdir($dir)) !== false)
        {
            if (preg_match('/(\w+)\.inc\.php/i', $fileName, $reg))
            {
                $name = $reg[1];

                require_once($dirName.'/'.$fileName);

                $floaders[$name] = SB_safeVal($SB_loader_title,$name);
            }
        }
        closedir($dir);
        asort($floaders);

        $loaders['auto'] = array('Auto detection', true);
        $loaders['b_msie'] = array('MS Internet Explorer', false);
        $loaders['b_mozilla'] = array('Mozilla Firefox', false);
        $loaders['b_opera'] = array('Opera', false);
        $loaders['separator'] = array('---', false);

        foreach ($floaders as $file=>$label)
        {
            $loaders[$file] = array($label, false);
        }

        $fields['Target Folder Name'] = array('value'=>$node->name,'disabled'=>null);
        $fields['Bookmark File'] = array('type'=>'file','name'=>'file');
        $fields['Select Input Format'] = array('name'=>'loader','type'=>'callback',
            'function'=>'_buildFeedBuildList',
            'params'=>array('name'=>'loader', 'title'=>'Select Input Format','values'=>$loaders));

        if (SB_Page::isMSIE())
        {
            $fields['-raw1-'] = SB_P('command::import_bk_ie_hint') . '<br>';
        }

        $fields['Rename Duplicate Bookmarks'] = array('name'=>'rename', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_rename'));
        $fields['Codepage'] = array('type'=>'callback', 'function'=>'_buildCodepage');
        $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>$node->id);

        return $fields;
    }

    function _buildCodepage()
    {
        if (!$this->um->getParam('config','use_conv_engine'))
        {
            return;
        }

        require_once('./inc/converter.inc.php');

        $cnv = new SB_Converter();

        function _cmdlangCmp(&$a, $b)
        {
            return (strcmp($a[1], $b[1]));
        }

        uasort($cnv->languages, '_cmdlangCmp');
        reset($cnv->languages);
?>
    <div class="label"><?php echo SB_T('Codepage')?></div>
    <select class="language" name="cp">
<?php
        echo "\t\t" . '<option value="utf-8">'. SB_T('Default (%s)', 'utf-8') . '</option>' . "\n";


        foreach ($cnv->languages as $key => $value)
        {
            if ($cnv->getEngine()==SB_CHARSET_IGNORE && !($value[2] == 'iso-8859-1'))
            {
                continue;
            }

            $lang_name = ucfirst(substr(strstr($value[0], '|'), 1));
            echo "\t\t" . '<option value="' . $value[2] . '">' .
                $lang_name .' (' . $key . ')</option>' . "\n";
        }
?>
    </select>
<?php

        if ($cnv->getEngine()==SB_CHARSET_IGNORE)
        {
            echo SB_P('command::noiconv');
        }
    }

    function commandImportBookmarks()
    {
        require_once('./inc/loader.inc.php');

        if (!$this->checkFile('file'))
        {
            return;
        }

        $filename = $_FILES['file']['tmp_name'];
        $bm = new SB_Loader($this->um->getParam('config','use_conv_engine'),SB_reqVal('cp'));
        $type = SB_reqVal('loader');
        $bm->loadFile($filename, ($type=='auto'?null:$type));

        // If not loaded message will be recorded and we go out
        if (!$bm->success)
        {
            return;
        }

        $this->message = SB_T(
            'Imported %s link(s) into %s folder(s) from the bookmark file.',
            array($bm->importedLinks, $bm->importedFolders));

        $this->tree->importTree(SB_reqValInt('nid_acl'), $bm->root, SB_reqChk('rename'));
        $this->markHasLink();
    }

    function optionalExportBookmarks()
    {
        static $fields = array
        (
            'mix',
            'max',
            'len',
            'exr',
            'flat',
            'igp',
            'sd',
            'hits',
            'cmd',
            'username',
            'pass',
        );

        return $fields;
    }

    function buildExportBookmarks()
    {
        $fields = array();

        $writers = array();
        $dirName = './inc/writers';
        $dir = opendir($dirName);

        require_once('./inc/writer.inc.php');

        while (($fileName = readdir($dir)) !== false)
        {
            if (preg_match('/(\w+)\.inc\.php$/i', $fileName, $reg))
            {
                $name = $reg[1];

                require_once($dirName.'/'.$fileName);

                if (!SB_safeVal($SB_writer_hidden,$name))
                {
                    $writers[$name] = array(SB_safeVal($SB_writer_title,$name),SB_safeVal($SB_writer_default,$name));
                }
            }
        }
        closedir($dir);

        asort($writers);

        $fields['Select Output Format'] = array('name'=>'writer','type'=>'callback',
            'function'=>'_buildFeedBuildList',
            'params'=>array('name'=>'w', 'title'=>SB_T('Select Output Format'),'values'=>$writers));

        if (SB_Page::isMSIE())
        {
            $fields['-raw1-'] = SB_P('command::export_bk_ie_hint') . '<br>';
        }

        $fields['Codepage'] = array('type'=>'callback', 'function'=>'_buildCodepage');

        $fields['Sort Mode'] = array('name'=>'sort','type'=>'select',
                '_options'=>'_buildFolderSortMode', '_select'=>'custom');

        $fields['Order of Folders v. Bookmarks'] = array('name'=>'mix','type'=>'select',
            '_options'=>'_buildMixMode', '_select'=>$this->um->getParam('user','mix_mode'));

        $fields['Limit Number of Bookmarks'] = array('name'=>'max');
        $fields['Limit Description Length'] = array('name'=>'len');

        if ($this->um->getParam('config','use_hit_counter'))
        {
            $fields['Use Hit Counter'] = array('name'=>'hits', 'type'=>'checkbox',
                'title'=>SB_P('command::tooltip_hits'));
        }

        $fields['Exclude Root Folder'] = array('name'=>'exr', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_exclude_root'));
        $fields['Ignore Private Bookmarks'] = array('name'=>'igp', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_private'));
        $fields['Include Subfolders'] = array('name'=>'sd', 'type'=>'checkbox', 'checked'=>null,
            'title'=>SB_P('command::tooltip_subdir'));
        $fields['Flatten the Hierarchy'] = array('name'=>'flat', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_flat'));

        if (!SB_reqChk('doall'))
        {
            $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>SB_reqValInt('nid_acl'));
        }
        else
        {
            $fields['-hidden1-'] = array('name'=>'doall','value'=>1);
        }

        $fields['Add SiteBar Commands'] = array('name'=>'cmd', 'type'=>'checkbox',
            'title'=>SB_P('command::tooltip_cmd'));

        $fields['Download Bookmarks'] = array('type'=>'button');

        $fields['Username'] = array('name'=>'username');
        $fields['Password (visible to others)'] = array('name'=>'pass');
        $fields['Show Feed URL'] = array('type'=>'button');

        if (!count($writers))
        {
            $this->error("No feed available!");
        }

        return $fields;
    }

    function _buildExportUrl()
    {
        $url = SB_Page::absBaseUrl() . 'index.php';
        $params = array();

        if (!SB_reqChk('sd'))
        {
            $params[] = 'sd=0';
        }

        if (!SB_reqChk('hits') && $this->um->getParam('config','use_hit_counter'))
        {
            $params[] = 'hits=0';
        }

        // Add value
        foreach (array('w', 'sort', 'username', 'pass', 'max', 'len', 'cmd', 'exr', 'igp', 'flat', 'cp', 'mix') as $check)
        {
            if (SB_reqChk($check) && strlen(SB_reqVal($check)))
            {
                if ($check == 'w' && SB_reqVal($check) == 'sitebar') continue;
                if ($check == 'sort' && SB_reqVal($check) == 'custom') continue;
                if ($check == 'cp' && SB_reqVal($check) == 'utf-8') continue;
                $params[] = $check.'='.SB_reqVal($check);
            }
        }

        if (SB_reqChk('nid_acl') && SB_reqValInt('nid_acl')>0)
        {
            $params[] = 'root=' . SB_reqValInt('nid_acl');
        }

        if (count($params))
        {
            $url .= '?' . implode('&amp;', $params);
        }

        return $url;
    }

    function buildDownloadBookmarks()
    {
        $url = str_replace('&amp;', '&', $this->_buildExportUrl()) . '&mode=download';
        header('Location: '.$url);
        exit; // Really break program here
    }

    function buildShowFeedURL()
    {
        $fields = array();

        $url = $this->_buildExportUrl();

        $fields['Copy'] = array('name'=>'copy', 'value'=>str_replace('&amp;', '&',$url));
        $fields['-label1-'] = SB_T('Open in New Window');
        $fields['-raw1-'] = "<a href='$url' target='_blank'>$url</a>";

        $url .= '&amp;mode=plain';

        $fields['-label2-'] = SB_T('Open as Plain Text');
        $fields['-raw2-'] = "<a href='$url' target='_blank'>$url</a>";

        if (!SB_reqChk('doall'))
        {
            $fields['-hidden1-'] = array('name'=>'nid_acl','value'=>SB_reqValInt('nid_acl'));
        }
        else
        {
            $fields['-hidden1-'] = array('name'=>'doall','value'=>1);
        }

        $fields['Export Bookmarks'] = array('type'=>'button');

        return $fields;
    }

    function _buildFeedBuildList($params)
    {
    ?>
        <div class="label"><?php echo SB_T($params['title'])?></div>
        <div class="data">
            <select name="<?php echo SB_T($params['name'])?>">
    <?php
            foreach ($params['values'] as $name => $label)
            {
                switch ($name)
                {
                    case 'b_msie': $name='netscape'; break;
                    case 'b_opera': $name='opera'; break;
                    case 'b_mozilla': $name='netscape'; break;
                    case 'separator': $name='auto'; break;
                }
                echo '<option value="' . $name . '"'. ($label[1]?' selected':'').'>' . SB_T($label[0]) . "</option>\n";
            }
    ?>
            </select>
        </div>
    <?php
    }
}


/******************************************************************************/
/******************************************************************************/
/******************************************************************************/

$cw = new SB_CommandWindow();
SB_Skin::set($cw->um->getParam('user','skin'));

// On error no reloading and no closing
if ($cw->hasErrors())
{
    $cw->reload = false;
    $cw->close = false;
}

$isIIS = strstr($_SERVER['SERVER_SOFTWARE'],'IIS');
$metaClose = false;
$metaTag = '<meta name="viewport" content="width=320, user-scalable=no">'."\n";

if ($cw->close && $isIIS && in_array($cw->command, $cw->um->inPlaceCommands()))
{
    $metaClose = true;
    $metaTag .=
        '<meta http-equiv="refresh" content="0;url=index.php'.
        $cw->getParams()."\">\n";
}

// On command success when auto close is required and we do not use IIS with
// in place commands.
if ($cw->close && !$cw->fields && !$metaClose)
{
    // When in place just reload
    if ($cw->inPlace())
    {
        $ref = $cw->getReferer();
        if (strlen($ref)) {
            header('Location: ' . $ref);
        }

        SB_redirect('index.php'.$cw->getParams(false));
    }
    // When not in place then close
    else
    {
        $cw->onLoad = 'window.close()';
    }
}

/**
 * I do not need instance, I just need to call static functions.
 * As of PHP 4.3.1 it will generate strange warning in case
 * bookmarkmanager issued an error() on import(). I cannot see
 * any relevance because SB_Page does not inherit from SB_ErrorHandler.
 * But it is indeed related to SB_ErrorHandler (when removing & from
 * declaration of getErrors() it works, but errors cannot be
 * reported then. Too curious for reporting and PHP 5 adds
 * static members what should solve the problem in future.
 */
$page = new SB_Page();
$page->head('Commander', 'siteBarCmdWin', null, $cw->onLoad, $metaTag);

$errId = ($cw->hasErrors() && $cw->hasErrors(E_ERROR))?'error':'warn';
$onlineHelp = 'http://sitebar.org/help.php?command='.urlencode($cw->command).'&amp;version='.STATIC_VERSION.'&amp;lang='.SB_GetLanguage();
?>
<div id="<?php echo ($cw->hasErrors()?$errId:'command').'Head'?>" class="cmnTitle">
<div id="help" onclick="SB_openHelp('<?php echo $onlineHelp ?>')">?</div>
<div id="command"><?php echo SB_T($cw->command)?></div>
</div>
<div id="<?php echo ($cw->hasErrors()?$errId:'command').'Body'?>">
<?php
    if ($cw->hasErrors())
    {
        $cw->writeErrors(false);
        echo '<p>'."\r";
    }

    // If we have no errors or ignore them
    if (!$cw->hasErrors() || $cw->showWithErrors || $cw->hasHandledErrors()==$cw->hasErrors())
    {
        if ($cw->fields)
        {
            $noerrors = !$cw->hasErrors();

            $cw->writeForm();

            // Some late errors?
            if ($noerrors && $cw->hasErrors())
            {
                $cw->writeErrors(false);
            }
        }
        else
        {
            echo (strlen($cw->message)?$cw->message:SB_T('Successful execution!'));
        }
    }

    $buttonName = ($cw->command == 'Sign Up' && SB_reqVal('do')) ?'Enter SiteBar':'Return';

    if ($cw->inPlace()) :?>
    <div class="buttons">
        <input class="button" type="button" onclick="SB_reloadPageWithReferer('<?php echo $cw->getReferer()?>')" value="<?php echo SB_T($buttonName)?>">
    </div>
<?php endif?>
</div>
<?php if (!$cw->nobuttons && !$cw->inPlace()) :?>
<div id="foot">
<?php    if (!$cw->bookmarklet) :?>
    [<a href="javascript:window.opener.location.reload();window.close();"><?php echo SB_T('Reload SiteBar')?></a>]
<?php    endif?>
    [<a href="javascript:window.close();"><?php echo SB_T('Close')?></a>]
</div>
<?php endif;
$page->foot();
?>
