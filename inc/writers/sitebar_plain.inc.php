<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2006-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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

$SB_writer_title['sitebar_plain'] = 'SiteBar Javascript-Free Tree';
$SB_writer_hidden['sitebar_ajax'] = true;

require_once('./inc/writer.inc.php');

class SB_Writer_sitebar_plain extends SB_WriterInterface
{
    function __construct()
    {
        parent::__construct();
        $this->switches['hits'] = false;
    }

    function getExtension()
    {
        return ".html";
    }

    function drawContentType()
    {
        header('Content-Type: text/html; charset=' . $this->charSet);
    }

    function drawHead()
    {
?>
<html>
<head>
    <title>SiteBar Bookmarks</title>
    <meta name="keywords" content="bookmark manager, online bookmark manager, online bookmarks, favorites manager, online favorites, bookmark organizer, firefox bookmark manager, bookmark server">
    <meta name="description" content="Open Source Freeware Bookmark Server for Personal and Team Use.">
    <link rel="author" href="http://brablc.com/">
    <link rel="bookmark" href="http://sitebar.org/" title="online bookmark manager">
    <link rel="help" href="http://sitebar.org/userguide.php">
</head>
<body>
<p>This is a javascript free version of the content available at this <a href="index.php?w=sitebar">SiteBar</a> instance.
<dl>
<?php
    }

    function drawFoot()
    {
        echo '<p>';
        $link = '<a href="http://sitebar.org/" '.SB_Page::target().'>%s</a>';
        echo sprintf($link,'SiteBar ').sprintf($link,'Bookmark Manager');
?>
</body>
</html>
<?php
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $filler = str_repeat("\t", $node->level);

        $added = ($node->added?strtotime($node->added):mktime());

        echo $filler . '<dt><h3>' . $node->name . "</h3>\r";

        if ($node->comment)
        {
            echo $filler. '<dd>' . $node->comment . "</dd>\r";
        }
        echo $filler . "<dl>\r";
    }

    function drawNodeClose(&$node)
    {
        $filler = str_repeat("\t", $node->level);
        echo $filler . "</dl>\r";
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $filler = str_repeat("\t", $node->level);

        echo $filler . '<dt><a rel="nofollow" href="' . $link->url . '">' . $link->name . "</a>\r";

        if ($link->comment)
        {
           echo $filler.'<dd>'.$link->comment."</dd>\r";
        }
    }
}
?>
