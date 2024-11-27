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

// Handle ; as parameter separator
$params = explode(';', $_SERVER['QUERY_STRING']);

foreach ($params as $param) {
    list($key, $value) = explode('=', $param);
    $_GET[$key] = $value;
}

SB_safePath(rawurldecode($_GET['file']));
$file = $_GET['file'] . '.xsl.php';
$skin = $_GET['skin'];
SB_safePath(rawurldecode($skin));

$path = 'skins/' . $skin . '/' . $file;

if (!is_file($path)) {
    $path = 'skins/' . $file;
}

require_once($path);
