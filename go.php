<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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

require_once('./inc/tree.inc.php');
require_once('./inc/usermanager.inc.php');

$tree = SB_Tree::staticInstance();
$link = $tree->getLink($_GET['id']);

// We allow redirect only as long as the original link exists
if ($link)
{
    $node = $tree->getNode($link->id_parent);
    $acl =& $node->getACL();

    // But if it has been changed, we only let authorized users to see the new value
    if ($acl && $acl['allow_select'])
    {
        $url = $link->getUrl();

        if (strlen($url))
        {
            $url = str_replace('%SEARCH%', SB_safeVal($_COOKIE,'SB3SEARCH'), $url);
            $tree->countVisit($link);
            header('Location: '. $url );
            exit;
        }
    }

    header("HTTP/1.0 403 Forbidden");
    header('Content-type: text/plain; charset=utf-8');
    print SB_T('Access denied!');
    exit;
}

header("HTTP/1.0 410 Gone");
header('Content-type: text/plain; charset=utf-8');
print SB_T('Gone');
