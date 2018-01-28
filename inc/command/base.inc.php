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

class SB_CommandWindowBase extends SB_ErrorHandler
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
            if ($value!=='' && $param{0}!='_')
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
        foreach ($this->um->getUsers() as $uid => $rec)
        {
            if (!$this->matchesUserFilter($rec))
            {
                continue;
            }

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
            if (!strlen($gregexp) || $gregexp{0} != '/')
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
            if (!strlen($gregexp) || $gregexp{0} != '/')
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
            if ($gregexp{0} != '/')
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
            $enabled = ($name{0} != '-' && !$disabled) || $enabled;

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

            if ($name{0} == '-')
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
            $this->$params['_options'](
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

                $this->$params['function'](isset($params['params'])?$params['params']:null);
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
}
