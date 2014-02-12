<?php

class SB_CommandWindowWorker extends SB_CommandWindowBase
{
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

        if ($name)
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


                if (!$link->name && isset($page->info['TITLE']))
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
}