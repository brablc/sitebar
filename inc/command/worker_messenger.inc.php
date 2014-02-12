<?php

class SB_CommandWindowWorker extends SB_CommandWindowBase
{
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
}