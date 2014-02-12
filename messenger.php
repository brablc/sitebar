<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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

class Messenger extends SB_ErrorHandler
{
    var $um;
    var $db;
    var $folder = 'inbox';
    var $folders = array
    (
        'inbox'  => 'Inbox',
        'saved'  => 'Saved',
        'outbox' => 'Outbox',
    );
    var $displayedNew = 0;
    var $displayedAll = 0;
    var $ajax = false;

    function Messenger()
    {
        $this->ajax = SB_reqChk('ajax');

        $this->um = SB_UserManager::staticInstance();
        SB_Skin::set($this->um->getParam('user','skin'));

        $this->db =& $this->um->db;

        if (SB_reqChk('folder'))
        {
            $this->folder = SB_reqVal('folder');
        }
    }

    function update($mid, $folder, $flag)
    {
        $set = array();

        if ($folder)
        {
            $set['folder'] = $folder;
        }
        if ($flag)
        {
            $set['flag'] = $flag;
        }

        $where = array('uid'=>$this->um->uid,'^1'=>'AND','mid'=>$mid,'^2'=>'AND', 'folder'=>$this->folder);

        $this->db->update('sitebar_message_folder', $set, $where );
    }

    function getUrl($params=array())
    {
        $url = 'messenger.php';
        $paramsStr = '';
        foreach ($params as $label => $value)
        {
            $paramsStr .= '&amp;' . $label . '=' . $value;
        }
        if ($paramsStr)
        {
            $url .= '?'.$paramsStr;
        }

        return $url;
    }

    function drawHeader()
    {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/REC-html40/loose.dtd">

<html>
<head>
    <title><?php echo SB_T("Private Messages") ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="StyleSheet"    href="<?php echo SB_Skin::webPath().'/messenger.css'?>" type="text/css" media="all">
    <link rel="Shortcut Icon" href="<?php echo SB_Skin::webPath().'/root_transparent.png'?>">
    <link rel="Author"        href="http://brablc.com/">
    <script type="text/javascript" src="<?php echo SB_Page::absBaseUrl() . "/js/sitebar.js\"" ?>></script>
    <script type="text/javascript">
        var SB_messengerImgNew = '<?php echo SB_Page::absBaseUrl()?>/skins/msg_new.gif';
        var SB_messengerImgRead = '<?php echo SB_Page::absBaseUrl()?>/skins/msg_read.gif';

        function SB_messengerToggle()
        {
            var checkBoxes = document.getElementsByTagName('input');

            for (var i=0; i< checkBoxes.length; i++)
            {
                var cb = checkBoxes[i];
                if (cb.className && cb.className=='checkBox')
                {
                    cb.checked = !cb.checked;
                }
            }
        }

        function SB_messengerToggleItem(img,mid)
        {
            var http = SB_xmlHttpGet();

            // We have old browser
            if (!http)
            {
                return;
            }

            http.onreadystatechange = function()
            {
                if (SB_xmlHttpReady(http))
                {
                    var div = http.responseText.indexOf(';');
                    var mid = http.responseText.substr(0,div);
                    var img = http.responseText.substr(div+1);
                    var imgObj = document.getElementById('img'+mid);
                    imgObj.src = (img=='new'?SB_messengerImgNew:SB_messengerImgRead);
                }
            }

            var url = 'messenger.php?ajax=1&command['+(img.src.indexOf(SB_messengerImgNew)>-1?'mark':'unmark')+']=1&mid['+mid+']=1';
            SB_xmlHttpSend(http, url);
        }
    </script>

</head>
<body class="siteBar siteBarBaseFont siteBarPageBackground ">
    <div class="title cmnTitleColorInverse"><?php echo SB_T('Private Messages')?></div>
    <div class="folders">
<?php

        foreach ($this->folders as $folder => $label)
        {
            echo '[';
            if ($folder != $this->folder)
            {
                echo '<a style="color: black;" href="' . $this->getUrl(array('folder'=>$folder)) . '">';
            }
            echo SB_T($label);
            if ($folder != $this->folder)
            {
                echo '</a>';
            }
            echo ']';
        }

?>
    </div>
    <form method="post" action="">
    <div class="buttons">
    <input type="button" value="<?php echo SB_T("Toggle Selection"); ?>" onClick="SB_messengerToggle()">
<?php
            if ($this->folder=='inbox')
            {
?>
    <input name='command[mark]' type="submit" value="<?php echo SB_P('messenger::read'); ?>">
    <input name='command[unmark]' type="submit" value="<?php echo SB_P('messenger::unread'); ?>">
    <input name='command[save]' type="submit" value="<?php echo SB_P('messenger::save'); ?>">
<?php
            }

?>
    <input name='command[delete]' type="submit" value="<?php echo SB_P('messenger::delete'); ?>">
<?php
            if ($this->folder=='outbox' && $this->um->isAdmin())
            {
?>
    <input name='command[back]' type="submit" value="<?php echo SB_P('messenger::cancel'); ?>">
    <input name='command[expire]' type="submit" value="<?php echo SB_P('messenger::expire'); ?>">
<?php
            }
?>
    </div>
<?php
    }

    function drawBody()
    {
        $where = array
        (
            'ms.uid' => $this->um->uid,
            '^1' => "AND m.mid=ms.mid AND flag<>'deleted' AND",
            'folder' => $this->folder
        );

        $res = $this->db->select('*, m.uid sender, ms.uid recipient', 'sitebar_message m, sitebar_message_folder ms', $where);
        $midRecs = $this->db->fetchRecords($res);
        $command = SB_reqVal('command');
        $webMids = SB_reqVal('mid');
        $seenMid = array();

        foreach ($midRecs as $rec)
        {
            $mid = $rec['mid'];
            $uid = $rec['sender'];
            $fromuser = $this->um->getUser($uid);

            $role = $rec['role'];
            $to = $rec['to_label'];

            $date = $rec['sent'];
            $expires = $rec['expires'];
            $from = '';

            $subject = $rec['subject'];
            $message = $rec['message'];
            $format = $rec['format'];
            $folder = $rec['folder'];
            $flag = $rec['flag'];

            if (isset($seenMid[$mid]))
            {
                continue;
            }

            $seenMid[$mid] = 1;

            if (isset($webMids[$mid]))
            {
                if ($this->folder=='outbox')
                {
                    if (isset($command['back']))
                    {
                        $this->db->delete('sitebar_message',array('mid'=>$mid));
                        $this->db->delete('sitebar_message_folder',array('mid'=>$mid));
                        continue;
                    }
                    if (isset($command['expire']))
                    {
                        $this->db->update('sitebar_message_folder',array('flag'=>'expired'),array('mid'=>$mid));
                    }
                    if (isset($command['delete']))
                    {
                        $this->update($mid, 'outbox', 'deleted');
                        continue;
                    }
                }
                else
                {
                    if (isset($command['mark']))
                    {
                        $flag = 'read';
                        $this->update($mid, 'inbox', 'read');
                        if ($this->ajax)
                        {
                           echo $mid.';read';
                        }
                    }
                    if (isset($command['unmark']))
                    {
                        $flag = 'seen';
                        $this->update($mid, 'inbox', 'seen');
                        if ($this->ajax)
                        {
                           echo $mid.';new';
                        }
                    }
                    if (isset($command['save']))
                    {
                        $this->update($mid, 'saved');
                        continue;
                    }
                    if (isset($command['delete']))
                    {
                        $this->update($mid, null, 'deleted');
                        continue;
                    }
                }
            }

            switch ($as)
            {
                case 'admins':
                    $from = SB_T('Administrators').' ('.$fromuser['fullname'].')';
                    break;

                case 'moderator':
                    $gid = intval($this->db->getData('messenger', $mid.'_gid'));

                    if (!$this->um->isModerator($gid))
                    {
                        continue;
                    }

                    $group = $this->um->getGroup($gid);
                    $from = SB_T('Moderator of %s Group', $group['name']).' ('.$fromuser['fullname'].')';
                    break;

                default:
                    $from = $fromuser['fullname'];
                    break;
            }

            if ($this->folder=='inbox' || $this->folder=='saved')
            {
                $from = "<a title='".SB_T('Reply')."' href='command.php?command=Send Message to User&uid=$uid&inre=$mid'>".$from."</a>";
            }

            if ($format == 'html')
            {
                $message = stripslashes($message);
            }
            else
            {
                $message = "<pre>" . $message . "</pre>";
            }

            $highlight = '';
            $isnew = false;

            if ($folder=='inbox' && ($flag=='new' || $flag=='seen'))
            {
                $this->displayedNew++;
                $highlight = ' highlight';
                $isnew = true;

                if ($flag=='new')
                {
                    $this->update($mid,'inbox','seen');
                }
            }

            $img = SB_Page::relBaseUrl().sprintf('skins/msg_%s.gif',($isnew?'new':'read'));
            $checkbox = "<input class='checkBox' type='checkbox' name='mid[$mid]'>";

            if (!$this->ajax)
            {

?>
<div id='message<?php echo $mid ?>' class='message'>
<table class='cmnMenu'>
<tr>
    <td class='icon'><img id="img<?php echo $mid ?>" src="<?php echo $img ?>" <?php if ($this->folder=='inbox'):?>onclick='SB_messengerToggleItem(this,<?php echo $mid ?>)'<?php endif;?>></td>
    <td class='cmnMenuItem<?php echo $highlight ?>'><?php echo SB_T('From') ?></td>
    <td><?php echo $from ?></td>
</tr>
<?php
                if ($this->folder=='outbox' && $to)
                {
?>
<tr>
    <td class='check'><?php echo $checkbox; $checkbox = '&nbsp;'; ?></td>
    <td class='cmnMenuItem<?php echo $highlight ?>'><?php echo SB_T('To') ?></td>
    <td><?php echo $to ?></td>
</tr>
<?php
                }
?>
<tr>
    <td class='check'><?php echo $checkbox ?></td>
    <td class='cmnMenuItem<?php echo $highlight ?>'><?php echo SB_T('Date') ?></td>
    <td><?php echo $date ?></td>
</tr>
<tr>
    <td class='status'>&nbsp;</td>
    <td class='cmnMenuItem<?php echo $highlight ?>'><?php echo SB_T('Subject') ?></td>
    <td>
<?php
        echo stripslashes($subject);
?>
    </td>
</tr>
<?php
                if ($this->folder=='outbox')
                {
                    if ($expires != '0000-00-00 00:00:00')
                    {
?>
<tr>
    <td class='check'>&nbsp;</td>
    <td class='cmnMenuItem'><?php echo SB_T('Expiration') ?></td>
    <td><?php echo $expires ?></td>
</tr>
<?php
                    }

                    $states = array
                    (
                        'inbox_new'  => 'messenger::state_unread',
                        'inbox_seen' => 'messenger::state_seen',
                        'inbox_read' => 'messenger::state_read',
                        'saved'      => 'messenger::state_saved',
                        'deleted'    => 'messenger::state_deleted',
                        'expired'    => 'messenger::state_expired',
                    );
                    $statesWhere = array
                    (
                        'inbox_new'  => "folder='inbox' AND flag='new'",
                        'inbox_seen' => "folder='inbox' AND flag='seen'",
                        'inbox_read' => "folder='inbox' AND flag='read'",
                        'saved'      => "folder='saved'",
                        'deleted'    => "folder='trash'",
                        'expired'    => "folder='expired'",
                    );

                    $breakdown = '';
                    foreach ($states as $status => $label)
                    {
                        $res = $this->db->select('count(*) count', 'sitebar_message_folder', "mid=$mid AND ". $statesWhere[$status]);
                        $countRec = $this->db->fetchRecord($res);
                        if ($countRec['count']>0)
                        {
                            if (SB_reqVal('drill')==$status && is_string($webMids) && $mid==$webMids)
                            {
                                if ($breakdown != '')
                                {
                                    $breakdown .= '<br>';
                                }

                                $breakdown .= SB_P($label) . ": ";
                                $res = $this->db->select('uid', 'sitebar_message_folder', "mid=$mid AND ". $statesWhere[$status]);
                                foreach ($this->db->fetchRecords($res) as $uidRec)
                                {
                                    $user = $this->um->getUser($uidRec['uid']);

                                    if ($this->um->isAdmin())
                                    {
                                        $breakdown .= '<a href="command.php?command=Modify%20User&amp;uid='.$uidRec['uid'].'">'.$user['username'].'</a> ';
                                    }
                                    else
                                    {
                                        $breakdown .= $user['username'].' ';
                                    }
                                }
                                $breakdown .= "<br>";
                            }
                            else
                            {
                                $breakdown .= '<a class="states" href="'.$this->getUrl(array('folder'=>$this->folder,'mid'=>$mid,'drill'=>$status)).'">' . SB_P($label) . '</a> [' . $countRec['count']. '] ';
                            }
                        }
                    }
?>
<tr>
    <td class='status'>&nbsp;</td>
    <td class='cmnMenuItem'><?php echo SB_T("Status") ?></td>
    <td><?php echo $breakdown ?></td>
</tr>
<?php
                }
?>
<tr>
    <td class='message' colspan='3'><?php echo $message ?></td>
</tr>
</table>
</div>
<?php
            }
        }

        if ($this->folder=='inbox' && is_array($command))
        {
            $this->db->lock($tables=array('sitebar_data'=>'WRITE','sitebar_user_data'=>'WRITE'));
            $this->db->setUserData('messenger', $this->um->uid, 'new', $this->displayedNew);
            $this->db->unlock();
        }
    }


    function drawFoot()
    {
        $baseurl = SB_Page::absBaseUrl();
?>
    </form>
    <div class="footer cmnTitleColorInverse">
    <?php echo SB_T("Messages from SiteBar installation at"); ?>
    <a class="url" href="<?php echo $baseurl?>"><?php echo $baseurl?></a>
    </div>
</body>
</html>
<?php
    }

    function run()
    {
        if (!$this->ajax)
        {
            $this->drawHeader();
        }
        if (!$this->um->isAnonymous())
        {
            $this->drawBody();
        }
        if (!$this->ajax)
        {
            $this->drawFoot();
        }
        // If we have no errors or ignore them
        if (!$this->hasErrors())
        {
            $this->writeErrors(false);
        }
    }

}

$messenger = new Messenger();
$messenger->run();
