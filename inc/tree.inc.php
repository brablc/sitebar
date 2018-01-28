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
require_once('./inc/usermanager.inc.php');

define ('SB_TREE_UNKNOWN', -1);
define ('SB_TREE_OTHERS',   0);
define ('SB_TREE_OWN',      1);

define ('SB_ALL_LINKS_FOR_ID', null);

function SB_cleanUpLink($link)
{
    $link->hits = 0;
    $link->visited = null;
    return $link;
}

function SB_trOrderCmp(&$a, &$b)
{
    if ($a->order == $b->order)
    {
        return strcmp($a->name, $b->name);
    }
    return ($a->order > $b->order) ? 1 : -1;
}

class SB_Tree_Link extends SB_ErrorHandler
{
    var $id;
    var $id_parent;
    var $url;
    var $name = '';

    var $private = false;
    var $comment = '';
    var $favicon = '';
    var $sort_info = null;
    var $added = null;
    var $changed = null;
    var $visited = null;
    var $hits = null;
    var $tested = null;
    var $is_dead = null;
    var $is_feed = null;
    var $is_sidebar = null;
    var $validate = true;
    var $target = '';
    var $type = '';

    var $order = 1000;
    var $type_flag = 'l';

    function __construct($rlink)
    {
        // Map DB fields to class member variables
        static $map = array
        (
            'lid'=>'id',
            'nid'=>'id_parent',
            'url'=>'url',
            'name'=>'name',
            'target'=>'target',
            'private'=>'private',
            'added'=>'added',
            'changed'=>'changed',
            'visited'=>'visited',
            'hits'=>'hits',
            'tested'=>'tested',
            'is_dead'=>'is_dead',
            'is_feed'=>'is_feed',
            'is_sidebar'=>'is_sidebar',
            'comment'=>'comment',
            'favicon'=>'favicon',
            'validate'=>'validate',
            'sort_info'=>'sort_info',
            'order'=>'order',
            'type'=>'type',
        );

        foreach ($rlink as $col => $value)
        {
            if (isset($map[$col]))
            {
                $member = $map[$col];
                if (in_array($col, array('added','changed','modified','tested','visited'))) {
                    if (preg_match('/T/', $value)) {
                        $value = strftime('%Y-%m-%d %H:%M:%S', strtotime($value));
                    }
                }
                $this->$member = $value;
            }
        }
    }

    function getUrl()
    {
        static $reader = null;

        if ($this->is_feed)
        {
            if ($reader===null)
            {
                $um =& SB_UserManager::staticInstance();
                $reader = $um->getParamB64('user','feed_reader_url');
            }

            if ($reader!=='')
            {
                return sprintf($reader,urlencode($this->url));
            }
        }

        return $this->url;
    }
}

class SB_Tree_Node extends SB_ErrorHandler
{
    var $_nodes = array();
    var $_links = array();

    var $id;
    var $id_parent;
    var $name = '';

    var $comment = null;
    var $deleted_by = null;
    var $sort_mode = 'user';
    var $custom_order = null;
    var $type = null;

    var $order = 1;
    var $type_flag = 'n';

    var $parent = null;
    var $level = 0;
    var $myTree = SB_TREE_UNKNOWN;
    var $isRoot = false; // Set when calling loadRoots
    var $acl = null;
    var $aclstr = null;
    var $hasACL = false;

    var $added = null;    // Min from links
    var $changed = null;  // Max from links
    var $visited = null;  // Max from links

    var $special = null;  // Special attributes

    var $db;
    var $um;
    var $tree;

    function __construct($rnode=null, $special=null)
    {
        $this->db =& SB_Database::staticInstance();
        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();
        $this->special = $special;

        if ($rnode)
        {
            // Map DB fields to class member variables
            static $map = array
            (
                'nid'=>'id',
                'nid_parent'=>'id_parent',
                'name'=>'name',
                'comment'=>'comment',
                'deleted_by'=>'deleted_by',
                'custom_order'=>'custom_order',
                'order'=>'order',
                'sort_mode'=>'sort_mode',
                'type'=>'type',
            );

            foreach ($rnode as $col => $value)
            {
                if (isset($map[$col]))
                {
                    $member = $map[$col];
                    $this->$member = $value;
                }
            }
        }
    }

    function setParent(&$parent)
    {
        $this->parent =& $parent;
        $this->level = $parent->level+1;
        $this->myTree = $parent->myTree;
    }

    function updateDates(&$obj)
    {
        if (!$this->added   || $obj->added  <$this->added)   $this->added   = $obj->added;
        if (!$this->changed || $obj->changed>$this->changed) $this->changed = $obj->changed;
        if (!$this->visited || $obj->visited>$this->visited) $this->visited = $obj->visited;
    }

    function addLink($link)
    {
        $this->updateDates($link);
        $this->_links[] = $link;
    }

    function addNode(&$node)
    {
        $this->updateDates($node);
        $this->_nodes[] = $node;
    }

    function getLinks()
    {
        return $this->_links;
    }

    function getLinksSlice($count)
    {
        return array_slice($this->_links,0,$count);
    }

    function getNodes()
    {
        return $this->_nodes;
    }

    function getChildren()
    {
        $children = array();

        if ($this->um->getParam('user','mix_mode') == 'links')
        {
            foreach ($this->_links as $link)
            {
                $children[] = $link;
            }
        }

        foreach ($this->_nodes as $node)
        {
            $children[] = $node;
        }

        if ($this->um->getParam('user','mix_mode') != 'links')
        {
            foreach ($this->_links as $link)
            {
                $children[] = $link;
            }
        }

        if ($this->sort_mode == 'custom' && strlen($this->custom_order))
        {
            $order = array();
            $pairs = explode(':',$this->custom_order);
            foreach ($pairs as $pair)
            {
                list($id, $orderNo) = explode('~',$pair);
                $order[$id] = $orderNo;
            }

            $count = count($children);
            while ($count)
            {
                $count--;
                $key = $children[$count]->type_flag.$children[$count]->id;
                if (isset($order[$key]))
                {
                    $children[$count]->order = $order[$key];
                }
            }

            usort($children, 'SB_trOrderCmp');
        }

        return $children;
    }

    function nodeCount()
    {
        return count($this->_nodes);
    }

    function linkCount()
    {
        return count($this->_links);
    }

    function childrenCount()
    {
        return $this->linkCount() + $this->nodeCount();
    }

    function isVisible()
    {
        return array_key_exists($this->id, $this->tree->getVisibleNodes());
    }

    function hasACL()
    {
        return array_key_exists($this->id, $this->tree->getACLNodes());
    }

    function isMyTree()
    {
        $this->getACL();
        return $this->myTree==SB_TREE_OWN;
    }

    function hasRight($right='select')
    {
        // Populate $acl
        $this->getACL();
        return ($this->myTree==SB_TREE_OWN) || $this->acl['allow_'.$right];
    }

    function parentHasRight($right='select')
    {
        if ($this->id_parent)
        {
            $parent = $this->tree->getNode($this->id_parent);
            $acl =& $parent->getACL();

            if ($acl && !$acl['allow_'.$right])
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        return false;
    }

    function & getACL()
    {
        // Caching, cannot change between calls
        if ($this->acl !== null)
        {
            return $this->acl;
        }

        static $groups = null;
        $this->acl = array();
        $this->_setit($this->acl, 0);

        if ($this->myTree==SB_TREE_UNKNOWN)
        {
            // Check if it is not our own tree.
            // Yes suboptimal! When called from deep child folder rather
            // then loaded from root, it travels to root several times.
            $root = $this->tree->getRootNode($this->id);
            if ($this->um->uid == $this->tree->getRootOwner($root->id))
            {
                $this->myTree = SB_TREE_OWN;
            }
            else
            {
                $this->myTree = SB_TREE_OTHERS;
            }
        }

        // When we have all rights, do not go further
        if ($this->myTree==SB_TREE_OWN)
        {
            $this->_setit($this->acl, 1);

            // We must continue to see ACL for other groups
            if (!$this->um->getParam('user','show_acl'))
            {
                return $this->acl;
            }
        }

        // Get user groups - valid for the whole execution.
        if ($groups===null)
        {
            $groups = array_keys($this->um->getUserGroups());

            if ($this->tree->mergedUserId)
            {
                $groups = array_merge($groups, array_keys($this->um->getPublicGroups($this->tree->mergedUserId)));
            }
        }

        // We have no membership - no right.
        if ($this->myTree==SB_TREE_OTHERS && !count($groups))
        {
            return $this->acl;
        }

        if ($this->hasACL())
        {
            // We have delayed this to be able to decorate own tree.
            if ($this->myTree==SB_TREE_OWN)
            {
                return $this->acl;
            }

            // If group member
            if (count($groups))
            {
                // Black magic, select maximum value out of all groups
                $rset = $this->db->select(
                    array_values(array_map(array($this,'_maxit'), $this->tree->rights)),
                    'sitebar_acl',
                    array('nid'=>$this->id,
                          '^1'=>'AND gid IN ('.implode(',',$groups).')'));
                $this->acl = $this->db->fetchRecord($rset);
            }
        }
        else // We must take parent's ACL - we do not have own
        {
            // If the node has parent but not loaded, load it
            if ($this->id_parent && !$this->parent)
            {
                $parent = $this->tree->getNode($this->id_parent);
                $this->setParent($parent);
            }

            if ($this->parent)
            {
                // Recursive, take parent ACL if it has any.
                // Yes suboptimal! When called from deep child folder rather
                // then loaded from root, it travels to root several times.
                $this->acl = $this->parent->getACL();
                $this->myTree = $this->parent->myTree;
            }
        }

        return $this->acl;
    }

    function getGroupACL($gid)
    {
        $rset = $this->db->select(null, 'sitebar_acl',
            array( 'gid'=> $gid, '^1'=>'AND', 'nid'=>$this->id));
        return $this->db->fetchRecord($rset);
    }

    function getParentACL($gid)
    {
        $acl = null;
        $parent = null;

        if ($this->id_parent)
        {
            $parent = $this->tree->getNode($this->id_parent);
            $acl = $parent->getGroupACL($gid);
        }

        return $acl||!$parent?$acl:$parent->getParentACL($gid);
    }

    function removeACL($gid=null)
    {
        $this->db->purgeCache('acl_nodes');
        $this->db->purgeCache('vis_nodes');

        $this->tree->contentUpdated();

        $where = array('nid'=>$this->id);

        if ($gid!==null)
        {
            $where['^1'] = 'AND';
            $where['gid'] = $gid;
        }

        $rset = $this->db->delete('sitebar_acl', $where);
    }

    function updateACL($gid, $acl)
    {
        $this->removeACL($gid);

        $data = array( 'gid'=> $gid, 'nid'=>$this->id);
        foreach ($acl as $column => $value)
        {
            if (strstr($column, 'allow_'))
            {
                $data[$column] = $value;
            }
        }

        $this->db->insert('sitebar_acl', $data, array(1062));
    }

    function _maxit($right)
    {
        return "max(allow_$right) as allow_$right";
    }

    function _setit(&$rights, $flag, $exception=array())
    {
        foreach ($this->tree->rights as $right)
        {
            if (in_array($right, $exception)) continue;
            $rights['allow_'.$right] = $flag;
        }
    }
}

class SB_Tree extends SB_ErrorHandler
{
    var $db;
    var $um;
    var $rights = array('select','insert','update','delete');

    // Modifies default behavior of loadLinks()
    var $loadLinkFilter = '';
    var $sortMode = null;
    var $userSortMode = null;
    var $sortModeLabel = null;

    // Modifies default behavior of loadNodes()
    var $expandedNodes = null;
    var $maxLevel = -1;
    var $skipPrivate = false;
    var $syncMode = false;
    var $syncColumns = array();

    // Special sharing variables
    var $mergedUserId = null;

    function __construct()
    {
        $this->db =& SB_Database::staticInstance();
        $this->um =& SB_UserManager::staticInstance();

        $this->userSortMode = $this->um->getParam('user','link_sort_mode');
        $this->sortModeLabel = array
        (
            'user'    => 'User Default',
            'custom'  => 'Custom Order',
            'abc'     => 'Alphabetically',
            'added'   => 'Recently Added',
            'changed' => 'Recently Modified',
            'visited' => 'Recently Visited',
            'hits'    => 'Most Popular',
            'waiting' => 'Waiting for Visit',
        );
    }

    public static function & staticInstance()
    {
        static $tree;

        if (!$tree)
        {
            $tree = new SB_Tree();
        }

        return $tree;
    }

    function statistics(&$data)
    {
        $rset = $this->db->select('count(*) count', 'sitebar_root');
        $rec = $this->db->fetchRecord($rset);
        $data['roots_total'] = $rec['count'];
        $rset = $this->db->select('count(*) count', 'sitebar_link');
        $rec = $this->db->fetchRecord($rset);
        $data['links_total'] = $rec['count'];
        $rset = $this->db->select('count(*) count', 'sitebar_node');
        $rec = $this->db->fetchRecord($rset);
        $data['nodes_total'] = $rec['count'];
    }

/* Load existing tree */

    function loadRoots($includeHidden=false, $showAllTreesIfAdmin=false)
    {
        $uid = $this->um->uid;

        $order = array();
        foreach (explode(':',$this->um->getParam('user','root_order')) as $pair)
        {
            if ($pair)
            {
                list($id,$rank) = explode('~',$pair);
                $order[$id] = $rank;
            }
        }

        $roots = array();
        $select = 'n.*, n.nid';
        $from = 'sitebar_node n natural join sitebar_root r';
        $where = null;

        if (SB_ALL_LINKS_FOR_ID != $uid)
        {
            $where = array('uid'=>$uid);
        }

        $rset = $this->db->select( $select, $from, $where);

        // Load all own roots (small number)
        while (($root = $this->db->fetchRecord($rset)))
        {
            $root = new SB_Tree_Node($root);
            $root->myTree = SB_TREE_OWN;
            $root->isRoot = true;
            $root->order = isset($order[$root->id])?$order[$root->id]: ($root->myTree?0:1);
            $root->hidden = isset($this->um->hiddenFolders[$root->id]);

            if ($includeHidden || !$root->hidden)
            {
                $roots[] = $root;
            }
        }

        if (SB_ALL_LINKS_FOR_ID != $uid)
        {
            // Ignore deleted roots (of other owners)
            $where = array('^1'=>'uid <> '.$uid, '^2'=>'AND', 'deleted_by'=>null);

            // We use cache, if it is not defined now, it will be defined next time
            // !! PERFORMANCE
            // If users are playing too much with ACL, this would be slow as well,
            // because cache is always deleted.
            $vis_nodes = $this->db->getCache('vis_nodes',$uid);
            if (is_array($vis_nodes))
            {
                if (strlen($vis_nodes['cvalue'])>0)
                {
                    $where['^3']='AND n.nid in ('.$vis_nodes['cvalue'].')';
                }
            }

            $rset = $this->db->select( $select, $from, $where);

            // Check all roots - can be slow with many users
            while (($root=$this->db->fetchRecord($rset)))
            {
                $root = new SB_Tree_Node($root);
                $root->myTree = SB_TREE_OTHERS;
                $root->isRoot = true;
                $root->order = isset($order[$root->id])?$order[$root->id]:100;
                $root->hidden = isset($this->um->hiddenFolders[$root->id]);

                if ( (  ($showAllTreesIfAdmin && $this->um->isAdmin())
                     || ($root->hasRight() || $root->isVisible()) )
                &&   ($includeHidden || !$root->hidden))
                {
                    $roots[] = $root;
                }
            }
        }

        usort($roots, 'SB_trOrderCmp');
        return $roots;
    }

    function loadUserRoots($uid)
    {
        $this->mergedUserId = $uid;

        $roots = array();
        $select = 'n.*, n.nid';
        $from = 'sitebar_node n natural join sitebar_root r';
        $where = array('uid'=>$uid);
        $rset = $this->db->select( $select, $from, $where);

        // Load all user's roots (small number)
        while (($root = $this->db->fetchRecord($rset)))
        {
            $root = new SB_Tree_Node($root);
            $root->myTree = SB_TREE_OTHERS;
            $root->isRoot = true;
            $root->hidden = isset($this->um->hiddenFolders[$root->id]);

            $roots[] = $root;
        }

        usort($roots, 'SB_trOrderCmp');
        return $roots;
    }

    function loadNodes(&$parent, $loadLinks=true, $right='select', $includeHidden=false)
    {
        // If we are deleted then do not load child nodes
        if ($parent->deleted_by)
        {
            return;
        }

        $rset = $this->db->select( null, 'sitebar_node',
            array('nid_parent'=>$parent->id,
                '^1'=>'AND', 'deleted_by'=>null), 'name'); // COLLATE utf8_general_ci

        while (($rnode = $this->db->fetchRecord($rset)))
        {
            $node = new SB_Tree_Node($rnode);
            if ( $node->deleted_by) continue;
            $node->setParent($parent);

            if (($this->expandedNodes==null || SB_safeVal($this->expandedNodes,$node->id)=='Y')
            &&  ($this->maxLevel == -1 || $parent->level < $this->maxLevel)
            ||  !$node->hasRight($right))
            {
                // Must be twice inside this function: occurence 1
                // - here it limits the depth
                $this->loadNodes($node, $loadLinks, $right, $includeHidden);
            }

            // If we have direct right or visible children
            if (($node->hasRight($right) || $node->childrenCount())
            &&  ($includeHidden || !isset($this->um->hiddenFolders[$node->id])))
            {
                // Must be twice inside this function: occurence 2
                // - here it ensures it is properly stored for frontend
                $node->setParent($parent);
                $parent->addNode($node);
            }
        }

        if ($loadLinks)
        {
            $this->loadLinks($parent);
        }
    }

    function _sortUsingSortInfo($a, $b)
    {
        $as = $a['sort_info'];
        $bs = $b['sort_info'];

        if ($as==='-' && $bs !== '-')
        {
            return -1;
        }
        if ($as!=='-' && $bs === '-')
        {
            return 1;
        }
        return intval($as) - intval($bs);
    }

    function loadLinks(&$parent)
    {
        if (!$parent->hasRight() || $parent->deleted_by)
        {
            return;
        }

        $sortMode = $this->userSortMode;

        if ($parent->sort_mode != 'user')
        {
            $sortMode = $parent->sort_mode;
        }

        // If the sort mode is overridden then take this
        if ($this->sortMode)
        {
            $sortMode = $this->sortMode;
        }

        $where = array('nid'=>$parent->id, '^1'=>'AND', 'deleted_by'=>null);

        if (strlen($this->loadLinkFilter))
        {
            $where['^2'] = 'AND (' . $this->loadLinkFilter . ')';
        }

        if ( $parent->myTree!=SB_TREE_OWN || $this->skipPrivate)
        {
            $where['^3'] = 'AND';
            $where['private'] = '0';
        }

        $select  = null;
        $from    = 'sitebar_link';
        $orderBy = 'name'; // COLLATE utf8_general_ci
        $isdate = false;
        $datefmt = '%Y-%m-%d';
        $timefmt = '%H:%i:%s';
        $selectfmt  = "*, DATE_FORMAT(%s,'%s') date_info, DATE_FORMAT(%s,'%s') time_info";

        switch ($sortMode)
        {
            case 'added':
                $isdate = true;
                $select = sprintf($selectfmt, 'added', $datefmt, 'added', $timefmt);
                $orderBy = 'added DESC, name ASC';
                break;

            case 'changed':
                $isdate = true;
                $select = sprintf($selectfmt, 'changed', $datefmt, 'changed', $timefmt);
                $orderBy = 'changed DESC, name ASC';
                break;

            case 'visited':
                $isdate = true;
                $select = sprintf($selectfmt, 'visited', $datefmt, 'visited', $timefmt);
                $orderBy = 'visited DESC, name ASC';
                break;

            case 'hits':
                $select  = '*, hits sort_info';
                $orderBy = 'hits DESC, name ASC';
                break;

            case 'waiting':
                break;
        }

        $today = date('Y-m-d');

        $rset = $this->db->select( $select, $from, $where, $orderBy);
        $records = $this->db->fetchRecords($rset);

        // Man is this complicated, we need to check when it was
        // used last time by this user ...
        if ($sortMode == 'waiting')
        {
            $sortInfoMap = array();

            $localWhere = $where;
            $localWhere['^4'] = 'AND l.lid=v.lid AND uid='.$this->um->uid;

            // ... so we read only user's visits ...
            $rset = $this->db->select
            (
                'l.lid, TO_DAYS(v.visited) - TO_DAYS(now()) sort_info',
                'sitebar_link l, sitebar_visit v',
                $localWhere
            );

            // ... and store this information (number of days from last visit) ...
            while (($rec=$this->db->fetchRecord($rset)))
            {
                $sortInfoMap[$rec['lid']] = $rec['sort_info'];
            }

            // ... now walk through the links and add the sort_info ...
            $newRecords = array();
            foreach ($records as $rlink)
            {
                $lid = $rlink['lid'];
                $rlink['sort_info'] = isset($sortInfoMap[$lid])?$sortInfoMap[$lid]:'-';
                $newRecords[] = $rlink;
            }
            $records = $newRecords;

            // ... and now sort using the sort info
            usort($records, array($this, "_sortUsingSortInfo"));
        }

        foreach ($records as $rlink)
        {
            if ($isdate)
            {
                if ($rlink['date_info'] == $today)
                {
                    $rlink['sort_info'] = $rlink['time_info'];
                }
                else
                {
                    if ($rlink['date_info']!='0000-00-00')
                    {
                        $rlink['sort_info'] = $rlink['date_info'];
                    }
                }
            }
            else
            {
                if (isset($rlink['sort_info']) && $rlink['sort_info']==='0')
                {
                    $rlink['sort_info'] = '';
                }
            }
            $parent->addLink(new SB_Tree_Link($rlink));
        }

        unset($records);
    }

    function importTree($nid_parent, $node, $renameDuplicate=false, $linkCallBack=null, $nodeCallBack=null)
    {
        $this->purgeNode($nid_parent); // KISS - anything else is too complex

        $order = array();

        foreach ($node->getChildren() as $child)
        {
            if ($child->type_flag=='n')
            {
                if ($nodeCallBack)
                {
                    $child = $nodeCallBack($child);
                }

                $namedNode = $this->getNodeByName($nid_parent, $child->name);

                $nid = null;

                if (!$namedNode) // If we do not have the folder - create it!
                {
                    $nid = $this->addNode($nid_parent, $child->name, $child->comment, $child->sort_mode, $child->special);
                }
                else
                {
                    $nid = $namedNode->id;

                    // The folder exists, but has been deleted before
                    if ($namedNode->deleted_by!="")
                    {
                        // Recovery of deleted notes should not see any error messages
                        $this->ignoreWarnings(true);

                        // We want to use this again
                        $this->undeleteNode($nid);
                        // Delete its content so that deleted content it does not get visible
                        $this->removeNode($nid, true);

                        $this->ignoreWarnings(false);
                    }
                }

                $order[] = 'n'.$nid.'~'.intval($child->order);

                $this->importTree($nid, $child, $renameDuplicate, $linkCallBack, $nodeCallBack);
            }
            else
            {
                if ($linkCallBack)
                {
                    $child = $linkCallBack($child);
                }

                $lid = $this->addLink($nid_parent, $child, $renameDuplicate);

                $order[] = 'l'.$lid.'~'.intval($child->order);
            }
        }

        // If we have custom order save it
        if ($node->sort_mode=='custom')
        {
            $columns = array
            (
                'custom_order' => implode(':',$order),
                'sort_mode' => 'custom',
            );

            $this->updateNode($nid_parent, $columns);
        }
    }

    function & getACLNodes()
    {
        static $aclNodes = null;

        if ($aclNodes !== null)
        {
            return $aclNodes;
        }

        $aclNodes = array();

        // Read cached value
        $cached = $this->db->getCache('acl_nodes',$this->um->uid);

        if (is_array($cached))
        {
            if (strlen($cached['cvalue'])>0)
            {
                $nodes = explode(',',$cached['cvalue']);
                foreach ($nodes as $nid)
                {
                    $aclNodes[$nid] = true;
                }
            }
            $this->addMergedUserAclNodes($aclNodes);
            return $aclNodes;
        }

        static $gids = null;
        if ($gids === null)
        {
            $gids = array_keys($this->um->getUserGroups());
        }

        if (!count($gids))
        {
            $this->addMergedUserAclNodes($aclNodes);
            return $aclNodes;
        }

        $rset = $this->db->select('distinct nid', 'sitebar_acl',
                    array( '^1'=> 'gid in ('.implode(',',$gids).')'));

        $aclNodes = array();
        while (($rec=$this->db->fetchRecord($rset)))
        {
            $nid = $rec['nid'];
            $aclNodes[$nid] = true;
        }

        $this->db->setCache('acl_nodes',$this->um->uid, implode(',',array_keys($aclNodes)));
        $this->addMergedUserAclNodes($aclNodes);
        return $aclNodes;
    }

    // Add acl nodes which have sharing for public groups
    function addMergedUserAclNodes(&$aclNodes)
    {
        if (!$this->mergedUserId)
        {
            return;
        }
        $userNodes = $this->getMergedUserAclNodes();
        foreach ($userNodes as $nid => $value)
        {
            $aclNodes[$nid] = $value;
        }
    }

    function getMergedUserAclNodes()
    {
        static $aclNodes = null;

        if ($aclNodes !== null)
        {
            return $aclNodes;
        }

        $aclNodes = array();

        if (!$this->mergedUserId)
        {
            return $aclNodes;
        }

        $gids = array_keys($this->um->getPublicGroups($this->mergedUserId));

        if (!count($gids))
        {
            return $aclNodes;
        }

        $rset = $this->db->select('distinct nid', 'sitebar_acl',
                    array( '^1'=> 'gid in ('.implode(',',$gids).')'));

        while (($rec=$this->db->fetchRecord($rset)))
        {
            $nid = $rec['nid'];
            $aclNodes[$nid] = true;
        }

        return $aclNodes;
    }

    function & getVisibleNodes()
    {
        static $visibleNodes = null;

        if ($visibleNodes !== null)
        {
            return $visibleNodes;
        }

        $aclNodes = $this->getACLNodes();
        $visibleNodes = $aclNodes;

        // Read cached value
        $cached = $this->db->getCache('vis_nodes',$this->um->uid);

        if (is_array($cached))
        {
            if (strlen($cached['cvalue'])>0)
            {
                $nodes = explode(',',$cached['cvalue']);
                foreach ($nodes as $nid)
                {
                    $visibleNodes[$nid] = true;
                }
            }
            $this->addMergedUserVisibleNodes($visibleNodes);
            return $visibleNodes;
        }

        foreach ($aclNodes as $nid => $dummy)
        {
            $parents = $this->getParentNodes($nid);

            if ($parents===null)
            {
                $this->fatal('Node number %s has ACL record but does not exist!', array($nid));
            }

            foreach ($parents as $nid)
            {
                $visibleNodes[$nid] = true;
            }
        }

        $this->db->setCache('vis_nodes',$this->um->uid, implode(',',array_keys($visibleNodes)));
        $this->addMergedUserVisibleNodes($visibleNodes);
        return $visibleNodes;
    }

    function addMergedUserVisibleNodes(&$visibleNodes)
    {
        $aclNodes = $this->getMergedUserAclNodes();

        foreach ($aclNodes as $nid => $dummy)
        {
            $visibleNodes[$nid] = true;

            $parents = $this->getParentNodes($nid);

            if ($parents===null)
            {
                $this->fatal('Node number %s has ACL record but does not exist!', array($nid));
            }

            foreach ($parents as $nid)
            {
                $visibleNodes[$nid] = true;
            }
        }
    }

    function getNode($nid)
    {
        $rset = $this->db->select( null, 'sitebar_node', array('nid'=>$nid));
        $rnode = $this->db->fetchRecord($rset);

        if (!$rnode)
        {
            $this->error('Folder with id %s does not exist!', array($nid));
            return null;
        }

        return new SB_Tree_Node($rnode);
    }

    function getNodeByName($nid_parent, $name)
    {
        $rset = $this->db->select( null, 'sitebar_node',
            array('nid_parent'=>$nid_parent, '^1'=>'AND', 'name'=>$name));
        $rnode = $this->db->fetchRecord($rset);

        if (!$rnode)
        {
            return null;
        }

        return new SB_Tree_Node($rnode);
    }

    function getRootOwner($nid)
    {
        static $owners = array();

        if (isset($owners[$nid]))
        {
            return $owners[$nid];
        }

        $rset = $this->db->select( null, 'sitebar_root', array('nid'=>$nid));
        $rtree = $this->db->fetchRecord($rset);

        if (!$rtree)
        {
            $this->error('Tree has already been deleted!');
            return null;
        }

        $owners[$nid] = $rtree['uid'];

        return $owners[$nid];
    }

    function getLinkCount($uid, $nid=null)
    {
        if ($nid===null)
        {
            $count = 0;

            $rset = $this->db->select( 'nid', 'sitebar_root', array('uid'=>$uid));
            while (($root = $this->db->fetchRecord($rset)))
            {
                $count += $this->getLinkCount($uid, $root['nid']);
            }
            return $count;
        }

        $rset = $this->db->select( 'count(*) lnkcnt', 'sitebar_link', array
        (
            'nid'=>$nid,
            '^1'=>'AND',
            'deleted_by'=>null
        ));
        $rec = $this->db->fetchRecord($rset);
        $count = $rec['lnkcnt'];

        $rset = $this->db->select( 'nid', 'sitebar_node', array
        (
            'nid_parent'=>$nid,
            '^1'=>'AND',
            'deleted_by'=>null
        ));

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $count += $this->getLinkCount($uid, $rec['nid']);
        }

        return $count;
    }

    function deleteUsersTrees($uid)
    {
        $rset = $this->db->select( null, 'sitebar_root', array('uid'=>$uid));
        $roots = array();

        while (($rtree = $this->db->fetchRecord($rset)))
        {
            $nid = $rtree['nid'];
            $this->removeNode($nid, false);
            $this->purgeNode($nid);
        }

        $this->db->delete( 'sitebar_root', array('uid'=>$uid));
    }

    function getUserRoots($uid)
    {
        $rset = $this->db->select( null, 'sitebar_root', array('uid'=>$uid));
        $roots = array();

        while (($rtree = $this->db->fetchRecord($rset)))
        {
            $roots[] = $rtree['nid'];
        }

        return $roots;
    }

    function getRootNode($nid)
    {
        $node = $this->getNode($nid);
        $stack = array();

        while ($node->id_parent)
        {
            $child = $node;
            $node = $this->getNode($node->id_parent);
            $node->child = $child;
        }

        return $node;
    }

    function getParentNodes($nid)
    {
        $parents = array();

        $node = $this->getNode($nid);

        if (!$node)
        {
            return null;
        }

        while ($node && $node->id_parent)
        {
            $parents[] = $node->id_parent;
            $node = $this->getNode($node->id_parent);
        }

        return $parents;
    }

    function getOwner($nid)
    {
        $node = $this->getRootNode($nid);

        if (!$node)
        {
            return;
        }

        $rset = $this->db->select('uid', 'sitebar_root',
            array( 'nid' => $node->id));

        $rec = $this->db->fetchRecord($rset);

        if (!$rec)
        {
            $this->error('Tree has already been deleted!');
            return false;
        }

        // Always greater then zero
        return $rec['uid'];
    }

    function inMyTree($nid)
    {
        $root = $this->getRootNode($nid);
        $uid = $this->getRootOwner($root->id);
        return $uid == $this->um->uid;
    }

    function renameDeletedNode($nid_parent, $name)
    {
        $this->db->update( 'sitebar_node',
            array('name' => '_'.$name.'_'.time()),
            array('nid_parent' => $nid_parent,
                  '^1'=>'AND deleted_by IS NOT NULL AND',
                  'name'=>$name));

        return ($this->db->getAffectedRows()>=1);
    }

    function addNode($nid_parent, $name, $comment=null, $sortMode='user', $special=null)
    {
        $this->contentUpdated();

        $rset = $this->db->insert( 'sitebar_node',
            array( 'nid_parent' => $nid_parent,
                   'name'       => $name,
                   'comment'    => $comment,
                   'sort_mode'  => $sortMode,
            ),
            array(1062));

        // If we have duplicate
        if ($this->db->getErrorCode()==1062)
        {
            // Rename deleted folder to prevent collision
            if ($this->renameDeletedNode($nid_parent, $name))
            {
                return $this->addNode($nid_parent, $name, $comment, $sortMode, $special);
            }
            else
            {
                $this->error('Duplicate folder name "%s"!', array($name));
                return 0;
            }
        }

        $id = $this->db->getLastId();

        if ($special && count($special)) // Something like is_toolbar or is_unfiled
        {
            foreach ($special as $key => $value)
            {
                // This means we let user to have only one folder marked as toolbar and one as unfiled
                $this->db->setUserData('special', $this->um->uid, $key, $id);
            }
        }

        return $id;
    }

    function addRoot($uid, $name, $comment=null)
    {
        $uniqName = $name;

        // Check wheter this name is not used for any other root
        for ($i=1; ;$i++)
        {
            $rset = $this->db->select( null, 'sitebar_node',
                array('name'=>$uniqName, '^1'=>'AND', 'nid_parent'=>0));
            $rnode = $this->db->fetchRecord($rset);

            // If not exists then we can use it
            if (!$rnode)
            {
                break;
            }

            $uniqName = $name . ' ' . $i;
        }

        $this->addNode(0, $uniqName, $comment);

        $nid = $this->db->getLastId();
        $rset = $this->db->insert( 'sitebar_root', array( 'uid' => $uid, 'nid' => $nid));

        return $nid;
    }

    function removeNode($nid, $contentOnly)
    {
        $node = $this->getNode($nid);
        $where = array();
        $affected = 0;

        // If root node then content must be explicitly deleted
        if ($contentOnly || !$node->id_parent)
        {
            $this->db->update( 'sitebar_link',
                array( 'deleted_by'=>$this->um->uid,
                       'changed'=> array('now'=>'')),
                array( 'nid'=>$nid, '^1'=> 'AND deleted_by IS NULL'));

            $affected += $this->db->getAffectedRows();
        }

        if ($contentOnly)
        {
            $where['nid_parent'] = $nid;
        }
        else
        {
            $where['nid'] = $nid;
        }

        $where['^1'] = 'AND deleted_by IS NULL';

        $rset = $this->db->update( 'sitebar_node',
            array('deleted_by'=>$this->um->uid), $where);

        $affected += $this->db->getAffectedRows();

        if ($affected==0)
        {
            if ($contentOnly)
            {
                $this->warn('There is no content to be deleted!');
            }
            else
            {
                if (!$node->id_parent)
                {
                    $this->warn('Purge folder to remove it permanently!');
                }
                else
                {
                    $this->warn('Folder has already been deleted!');
                }
            }
        }

        return $rset;
    }

    function purgeNode($nid, $root_deleted_by=null)
    {
        $this->db->purgeCache('acl_nodes');
        $this->db->purgeCache('vis_nodes');

        $node = $this->getNode($nid);

        $onlydeleted = '';

        // If the folder is not deleted then purge only deleted links/folders
        if (!$root_deleted_by && !$node->deleted_by)
        {
            $onlydeleted = 'AND deleted_by IS NOT NULL';
        }

        $this->db->delete( 'sitebar_link',
            array('nid'=>$nid, '^1'=>$onlydeleted));

        // Select all deleted folders and purge them as well
        $rset = $this->db->select( 'nid, name', 'sitebar_node',
            array('nid_parent'=>$nid, '^1'=>$onlydeleted));

        foreach ($this->db->fetchRecords($rset) as $rnode)
        {
            $this->purgeNode($rnode['nid'],
                $root_deleted_by||$node->deleted_by);
        }

        // If we currently have deleted folder, them delete ACL and itself
        if ($root_deleted_by || $node->deleted_by)
        {
            $this->db->delete( 'sitebar_acl', array( 'nid' => $nid ));
            $this->db->delete( 'sitebar_node', array( 'nid' => $nid ));

            if ($node->id_parent==0)
            {
                $this->db->delete( 'sitebar_root', array( 'nid' => $nid ));
            }
        }
    }

    function undeleteNode($nid)
    {
        $node = $this->getNode($nid);
        $affected = 0;

        $this->db->update( 'sitebar_link',
            array( 'deleted_by'=>null,
                   'changed'=> array('now'=>'')),
            array( 'nid'=>$nid));
        $affected += $this->db->getAffectedRows();

        // Undelete child folders
        $rset = $this->db->update( 'sitebar_node',
        array('deleted_by'=>null), array('nid_parent'=>$nid));
        $affected += $this->db->getAffectedRows();

        // Undelete current node - can happen to root only
        $rset = $this->db->update( 'sitebar_node',
        array('deleted_by'=>null), array('nid'=>$nid));
        $affected += $this->db->getAffectedRows();

        if ($affected==0)
        {
            $this->warn('There is nothing to be undeleted!');
        }
        return $rset;
    }

    function updateNode($nid, $columns)
    {
        $this->contentUpdated();

        $rset = $this->db->update( 'sitebar_node', $columns, array( 'nid'  => $nid), array(1062));

        if ($this->db->getErrorCode()==1062)
        {
            $node = $this->getNode($nid);

            if ($this->renameDeletedNode($node->id_parent, $columns['name']))
            {
                return $this->updateNode($nid, $columns);
            }
            else
            {
                $this->error('Duplicate folder name "%s"!', array($columns['name']));
                return 0;
            }
        }

        return $rset;
    }

    function updateNodeOwner($nid, $uid)
    {
        $rset = $this->db->update( 'sitebar_root',
            array( 'uid' => $uid),
            array( 'nid'  => $nid));

        return $rset;
    }

    function moveNode( $nid, $nid_parent, $contentOnly=false)
    {
        if ($contentOnly)
        {
            $node = $this->getNode($nid);

            // Load source node to memory
            $this->loadNodes($node);

            foreach ($node->getNodes() as $childnode)
            {
                $this->moveNode($childnode->id, $nid_parent);
                if ($this->hasErrors())
                {
                    return 0;
                }
            }

            foreach ($node->getLinks() as $link)
            {
                $this->moveLink($link->id, $nid_parent);
                if ($this->hasErrors())
                {
                    return 0;
                }
            }
            return 1;
        }

        $node = $this->getNode($nid);

        if ($nid_parent == $node->id_parent)
        {
            $this->error('Cannot move to the same folder!');
            return 0;
        }

        if ($nid == $nid_parent)
        {
            $this->error('This operation would lead to broken database.');
            $this->error('Please note your last steps and contanct SiteBar development!');
            return 0;
        }

        // Just switch parent name
        $rset = $this->db->update( 'sitebar_node',
            array( 'nid_parent' => $nid_parent),
            array( 'nid'  => $nid),
            array(1062));

        if ($this->db->getErrorCode()==1062)
        {
            if ($this->renameDeletedNode($nid_parent, $node->name))
            {
                return $this->moveNode($nid, $nid_parent);
            }
            else
            {
                $this->error('Duplicate folder name "%s"!', array($node->name));
                return 0;
            }
        }
        elseif ($this->db->getAffectedRows()==0)
        {
            $this->error('Folder has already been deleted!');
        }

        // If root node
        if (!$this->hasErrors() && !$node->id_parent)
        {
            $this->db->delete( 'sitebar_root', array('nid' => $nid));
        }

        return $rset;
    }

    function copyNode( $nid, $nid_parent, $contentOnly=false)
    {
        $node = $this->getNode($nid);
        $parent = $this->getNode($nid_parent);
        $targetId = $nid_parent;

        // Load source node to memory
        $this->loadNodes($node);

        if (!$contentOnly)
        {
            // Create new parent folder with the same name as source
            $targetId = $this->addNode($parent->id, $node->name, $node->comment);
        }

        if (!$this->hasErrors())
        {
            // Import loaded tree to new parent
            $this->importTree($targetId, $node);
        }
    }

/* Manage tree operations with links */

    function getLink($lid)
    {
        $rset = $this->db->select( null, 'sitebar_link', array('lid'=>$lid));
        $rlink = $this->db->fetchRecord($rset);

        if (!$rlink)
        {
            $this->error('Link has already been deleted!');
            return null;
        }

        return new SB_Tree_Link($rlink);
    }


    function purgeDeletedLink($nid, $name)
    {
        $this->db->delete( 'sitebar_link',
            array('nid' => $nid,
                  '^1'=>'AND deleted_by IS NOT NULL AND ',
                  'name'=>$name,
                 ));

        return ($this->db->getAffectedRows()>=1);
    }

    function addLink($nid, $columns, $renameDuplicate=false)
    {
        if (is_object($columns))
        {
            $link = $columns;
            $columns = array
            (
                'name'=>$link->name?$link->name:'',
                'url'=>$link->url,
                'favicon'=>$link->favicon,
                'private'=>$link->private?1:0,
                'comment'=>$link->comment,
                'validate'=>$link->validate?1:0,
                'hits'=>$link->hits?$link->hits:0,
                'added'=>$link->added?$link->added:array('now' => ''),
                'is_feed'=>$link->is_feed?1:0,
                'is_sidebar'=>$link->is_sidebar?1:0,
            );

            if ($link->changed)
            {
                $columns['changed'] = $link->changed;
            }
            if ($link->tested)
            {
                $columns['tested'] = $link->tested;
            }
            if ($link->visited)
            {
                $columns['visited'] = $link->visited;
            }

        }
        else
        {
            $columns['added'] = array('now' => '');
        }

        $columns['nid'] = $nid;

        $this->contentUpdated();
        $rset = $this->db->insert( 'sitebar_link', $columns, array(1062));

        // Cannot insert because of an index
        if ($this->db->getErrorCode()==1062)
        {
            if ($this->syncMode)
            {
                // Select old link
                $rset = $this->db->select( null, 'sitebar_link',
                    array('nid'=>$nid,'^1'=>'AND','name'=>$columns['name']));
                $rlink = $this->db->fetchRecord($rset);

                $hasChanged = false;

                $selectedColumns = array();
                foreach ($this->syncColumns as $col)
                {
                    if ($rlink[$col] != $columns[$col])
                    {
                        $selectedColumns[$col] = $columns[$col];
                        $hasChanged = true;
                    }
                }

                if ($rlink['deleted_by']!="")
                {
                    $hasChanged = true;
                    $selectedColumns['deleted_by'] = null;
                }

                if ($hasChanged)
                {
                    $this->updateLink($rlink['lid'], $selectedColumns);
                }

                return $rlink['lid'];
            }


            if ($this->purgeDeletedLink($nid,$columns['name']))
            {
                return $this->addLink($nid, $columns);
            }
            elseif ($renameDuplicate)
            {
                $add = 1;

                if (preg_match("/^(.*) #(\d+)$/",$columns['name'],$reg))
                {
                    $add = intval($reg[2])+1;
                    $columns['name'] = $reg[1];
                }

                $columns['name'] = $columns['name']. ' #'. $add;

                return $this->addLink($nid, $columns, $renameDuplicate);
            }
            else // If we are here, then the item was not deleted and we signal error
            {
                $this->warn('Duplicate name "%s"!', array($columns['name']));
                return 0;
            }
        }

        return $this->db->getLastId();
    }

    function updateLink($lid, $columns, $changed=true)
    {
        $update = $columns;

        if ($changed)
        {
            $update['changed'] = array('now' => '');
            $this->contentUpdated();
        }

        $rset = $this->db->update( 'sitebar_link', $update, array( 'lid'  => $lid), array(1062));

        if ($this->db->getErrorCode()==1062)
        {
            $link = $this->getLink($lid);
            if ($this->purgeDeletedLink($link->id_parent,$columns['name']))
            {
                $this->updateLink($lid, $update);
            }
            else
            {
                $this->warn('Duplicate name "%s"!', array($columns['name']));
                return 0;
            }
        }
        elseif ($this->db->getAffectedRows()==0)
        {
            $this->error('Link has already been deleted!');
        }

        return $rset;
    }

    function contentUpdated()
    {
        static $done = 0;

        // We will update it only once per execution
        if (!$done)
        {
            $done++;
            $this->db->update( 'sitebar_config', array('changed'=>array('now' => '')));
        }
    }

    function countVisit($link)
    {
        $this->db->update( 'sitebar_link',
            array( 'hits'=> array('hits+'=>'1'), 'visited'=>array('now'=>null)),
            array( 'lid'  => $link->id));

        $this->db->update( 'sitebar_visit',
            array( 'visited'=> array('now'=>null)),
            array( 'lid'  => $link->id,
                   '^1'   => 'AND',
                   'uid'  => $this->um->uid));

        if (!$this->db->getAffectedRows())
        {
            // Ignore duplicates
            $this->db->insert( 'sitebar_visit',
                array( 'lid'  => $link->id,
                       'uid'  => $this->um->uid,
                       'visited' => array('now'=>null)),
                array(1062));
        }
    }

    function moveLink($lid, $nid)
    {
        $rset = $this->db->update( 'sitebar_link',
            array( 'nid'=> $nid),
            array( 'lid'  => $lid),
            array(1062));

        if ($this->db->getErrorCode()==1062)
        {
            $link = $this->getLink($lid);
            if ($this->purgeDeletedLink($nid,$link->name))
            {
                $this->moveLink($lid,$nid);
            }
            else
            {
                $this->warn('Duplicate name "%s" in the target folder!', array($link->name));
                return 0;
            }
        }
        elseif ($this->db->getAffectedRows()==0)
        {
            $this->error('Link has already been deleted!');
        }

        return $rset;
    }

    function copyLink($lid, $nid)
    {
        $link = $this->getLink($lid);

        if (!$link)
        {
            return;
        }

        return $this->addLink($nid, $link, true);
    }

    function removeLink($lid)
    {
        $rset = $this->db->update( 'sitebar_link',
            array( 'deleted_by'=>$this->um->uid,
                   'changed'=> array('now'=>'')),
            array( 'lid'=>$lid));

        if ($this->db->getAffectedRows()==0)
        {
            $this->error('Link has already been deleted!');
        }

        return $rset;
    }

    function purgeLink($lid)
    {
        $rset = $this->db->delete( 'sitebar_link', array( 'lid'=>$lid));
        if ($this->db->getAffectedRows()==0)
        {
            $this->error('Link has already been deleted!');
        }
        return $rset;
    }
}

?>
