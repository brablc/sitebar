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

require_once('./inc/usermanager.inc.php');
require_once('./inc/tree.inc.php');
require_once('./inc/faviconcache.inc.php');

header("Content-type: text/plain; charset=UTF-8");

class SB_SanityCheck
{
    var $um;
    var $tree;
    var $db;
    var $checked = array();

    function __construct()
    {
        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();
        $this->db =& SB_Database::staticInstance();

        if (!$this->um->isLogged() || !$this->um->isAdmin())
        {
            die ("Access denied!");
        }
    }

    function run()
    {
        $doall = isset($_GET['do_all']);

        if ($doall || isset($_GET['do_deadusers']))
        {
            $this->deadusers();
        }
        if ($doall || isset($_GET['do_orphans']))
        {
            $this->orphans();
        }
        if ($doall || isset($_GET['do_aclorphans']))
        {
            $this->aclorphans();
        }
        if ($doall || isset($_GET['do_icons']))
        {
            $this->convertBinaryIcons();
        }
        if (isset($_GET['do_fix']))
        {
            $this->fix();
        }
        if (isset($_GET['do_fixgroups']))
        {
            $this->fixgroups();
        }
        if (isset($_GET['do_fixeveryone']))
        {
            $this->fixeveryone();
        }
        echo "Done.\r";
    }

    function strip_slashes()
    {
        echo "Strip tripple slashes in link names and descriptions ...\r";
        $rset = $this->db->select('lid, name, comment', 'sitebar_link');

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $update = array();
            $update['name'] = str_replace("\\\\","\\", $rec['name']);
            $update['comment'] = str_replace("\\\\","\\", $rec['comment']);

            if ($update['name'] != $rec['name'] || $update['comment'] != $rec['comment'])
            {
                $this->db->update( 'sitebar_link', $update, array( 'lid' => $rec['lid']), array(1062));
            }
        }

        echo "Strip tripple slashes in node names and descriptions ...\r";
        $rset = $this->db->select('nid, name, comment', 'sitebar_node');

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $update = array();
            $update['name'] = str_replace("\\\\","\\", $rec['name']);
            $update['comment'] = str_replace("\\\\","\\", $rec['comment']);

            if ($update['name'] != $rec['name'] || $update['comment'] != $rec['comment'])
            {
                $this->db->update( 'sitebar_node', $update, array( 'nid' => $rec['nid']), array(1062));
            }
        }
    }

    function _fix_zeroes(&$value)
    {
        $value = str_replace("\0",'\0', $value);
    }

    function _fix_slashes(&$value)
    {
        $value = str_replace("\\\\","\\", $value);
    }

    function _fix_apos(&$value)
    {
        $value = str_replace("&#39;","'", $value);
    }

    function _fix_nbsp(&$value)
    {
        $value = str_replace("&nbsp;"," ", $value);
    }

    function _fix_entities(&$value)
    {
        if ( preg_match('/[&<>\'"]/',$value) )
        {
            $entity = array('&amp;','&lt;','&gt;','&apos;','&quot;');
            $char   = array('&','<','>','\'','"');
            $value = str_replace($entity, $char, $value);
        }
    }

    function fix()
    {
        echo "Walk all links in database ...\r";
        $rset = $this->db->select('lid, name, comment, url', 'sitebar_link');

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $update = array();

            foreach (array('name','comment','url') as $column)
            {
                $decoded = $rec[$column];

                $this->_fix_zeroes($decoded);
                $this->_fix_slashes($decoded);
                $this->_fix_entities($decoded);
                $this->_fix_apos($decoded);
                $this->_fix_nbsp($decoded);

                if ($decoded != $rec[$column])
                {
                    echo '- '.$decoded."\r";
                    $update[$column] = $decoded;
                }
            }

            if (count($update))
            {
                $this->db->update( 'sitebar_link', $update, array( 'lid' => $rec['lid']), array(1062));
            }
        }

        echo "Walk all nodes in database ...\r";
        $rset = $this->db->select('nid, name, comment', 'sitebar_node');

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $update = array();

            foreach (array('name','comment') as $column)
            {
                $decoded = $rec[$column];

                $this->_fix_zeroes($decoded);
                $this->_fix_slashes($decoded);
                $this->_fix_entities($decoded);
                $this->_fix_apos($decoded);
                $this->_fix_nbsp($decoded);

                if ($decoded != $rec[$column])
                {
                    echo '- '.$decoded."\r";
                    $update[$column] = $decoded;
                }
            }

            if (count($update))
            {
                $this->db->update( 'sitebar_node', $update, array( 'nid' => $rec['nid']), array(1062));
            }
        }
    }

    function orphans()
    {
        echo "Fetch ids of all links in database ...\r";

        $rset = $this->db->select('DISTINCT nid', 'sitebar_link');

        echo "Traverse recursive all nodes and check\r";
        echo "  - whether the parent node exists,\r";
        echo "  - whether the node without parent is the root,\r";
        echo "  - whether there is a user for the node.\r";

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $this->checkNode($rec['nid']);
        }
    }

    function aclorphans()
    {
        echo "Fetch ids of all acl nodes in database ...\r";

        $rset = $this->db->select('DISTINCT nid', 'sitebar_acl');

        echo "Traverse recursive all nodes and check\r";
        echo "  - whether the parent node exists,\r";
        echo "  - whether the node without parent is the root,\r";
        echo "  - whether there is a user for the node.\r";

        while (($rec = $this->db->fetchRecord($rset)))
        {
            $this->checkNodeACL($rec['nid']);
        }
    }

    function deadusers()
    {
        echo "Delete users with no visits ...\r";

        $sql =<<<_SQL
SELECT u.uid, u.email
FROM `sitebar_user` u
WHERE u.uid > 2 AND visits = 0;
_SQL;

        $rset = $this->db->raw($sql);
        while (($rec = $this->db->fetchRecord($rset)))
        {
            echo "Deleting user #${rec['uid']} ${rec['email']}\r";
            $this->um->removeUser($rec['uid']);
        }
        echo "\n";
    }

    function fixgroups()
    {
        $default_groups = $this->um->getParamArray('config','default_groups');

        echo "For each user other than built in ...\r";

        $groups = implode("','",$default_groups);
        $groupCount = count($default_groups);
        $sql =<<<_SQL
SELECT u.uid, SUM( IF( g.name IN ('$groups'), 1, 0) ) DGROUPS, COUNT(g.gid) AGROUPS
FROM `sitebar_user` u LEFT OUTER JOIN `sitebar_group` g ON g.uid = u.uid
WHERE u.uid > 2
GROUP BY u.uid
HAVING DGROUPS<$groupCount AND AGROUPS<>0
_SQL;

        echo "Fixing users: ";
        $rset = $this->db->raw($sql);
        while (($rec = $this->db->fetchRecord($rset)))
        {
            echo $rec['uid'] . " ";
            foreach ($default_groups as $group)
            {
                $group = array('uid'=>$rec['uid'], 'name'=>$group);
                $this->um->addGroup($group);
            }
        }
        echo "\n";
    }

    function fixeveryone()
    {
        echo "Delete membership of other that built in users ...\r";
        $this->db->raw("DELETE FROM sitebar_member WHERE uid>2 AND gid=2");
        echo "Delete acl of other than built in roots ...\r";
        $this->db->raw("DELETE FROM sitebar_acl WHERE gid=2 and nid>2");
    }

    function convertBinaryIcons()
    {
        echo "Convert binary icons ...\r";

        $rset = $this->db->select('*', 'sitebar_link', "favicon LIKE 'data:image%'");

        $fc = & SB_FaviconCache::staticInstance();

        $converted = 0;

        while (($rec = $this->db->fetchRecord($rset)))
        {
            if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $rec['favicon'], $reg))
            {
                $update = array
                (
                    'favicon'=>$fc->saveFaviconBase64($reg[2]),
                );

                $this->tree->updateLink($rec['lid'], $update);
                $converted++;
            }
        }

        echo 'Converted '.$converted." favicons.\r";
    }

    function checkNode($nid)
    {
        if (isset($this->checked[$nid]))
        {
            return true;
        }

        $this->checked[$nid]++;

        $rset = $this->db->select('*', 'sitebar_node', array('nid'=>$nid));
        $rec = $this->db->fetchRecord($rset);

        if (is_array($rec))
        {
            if ($rec['nid_parent']==0)
            {
                echo "Root: " . $rec['name'] . "\r";
                $rset = $this->db->select('*', 'sitebar_root', array('nid'=>$nid));
                $root = $this->db->fetchRecord($rset);

                if (is_array($root))
                {
                    $rset = $this->db->select('*', 'sitebar_user', array('uid'=>$root['uid']));
                    $user = $this->db->fetchRecord($rset);

                    if (is_array($user))
                    {
                        echo "User: " . $user['name'] . '[' . $user['email'] . ']\r';
                    }
                    else
                    {
                        echo "!!! Orfan\r";
                    }
                }
                else
                {
                    echo "!!! Invisible\r";
                }
                return true;
            }

            if ($rec['nid'] == $rec['nid_parent'])
            {
                echo "!!! Recursive parent!\r";
            }

            return $this->checkNode($rec['nid_parent']);
        }

        echo "!!! Missing parent\r";
        return false;
    }

    function checkNodeACL($nid)
    {
        $rset = $this->db->select('*', 'sitebar_node', array('nid'=>$nid));
        $rec = $this->db->fetchRecord($rset);

        if (!is_array($rec))
        {
            echo "!!! Missing node: " . $nid . "\r";
        }
    }
}

$sc = new SB_SanityCheck();
$sc->run();

?>
