<?php

class SB_CommandWindowWorker extends SB_CommandWindowBase
{
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
        return array_merge($fields,$this->_buildSendEmail('Feedback or Other Comment'));
    }

    function commandContactAdmin()
    {
        $name = '';
        $email = '';

        if ($this->um->isAnonymous())
        {
            $email = SB_reqVal('email');
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

        $this->um->mailToAdmins(
            'SiteBar: Contact Admin',
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

        if ($user->demo)
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

    function matchesUserFilter(&$userRec)
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
