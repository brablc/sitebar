<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *  Copyright (C) 2004  Gunnar Wrobel <sitebar@gunnarwrobel.de>               *
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

require_once('./inc/faviconcache.inc.php');

$fc = & SB_FaviconCache::staticInstance();

$favicon_md5 = key($_GET);

$lid = $_GET[$favicon_md5];

if ('.'.$lid != '.'.intval($lid))
{
    // We may have encoded favicon URL there
    $lid = base64_decode($lid);
}

$fc->faviconReturn( $favicon_md5, $lid, isset($_GET['refresh']));
?>
