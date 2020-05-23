<?php

class SB_CommandWindowWorker extends SB_CommandWindowBase
{
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
}
