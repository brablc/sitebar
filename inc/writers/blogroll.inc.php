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

// Thanks to the vanderwijk for an idea: http://backup-buzz.blogspot.com
// You will embed this on any place of your page by writing:
// <script type="text/javascript" src="http://localhost/index.php?w=blogroll"></script>
// - get proper url from "Export Bookmarks"

$SB_writer_title['blogroll'] = 'BlogRoll JS &lt;ul&gt;';

require_once('./inc/writer.inc.php');

class SB_Writer_blogroll extends SB_WriterInterface
{

    function __construct()
    {
        parent::__construct();
        $this->switches['flat'] = true;
    }

    function getExtension()
    {
        return ".html";
    }

    function drawContentType()
    {
        header('Content-Type: text/html; charset=' . $this->charSet);
    }

    function js($value)
    {
        return "document.writeln('" . str_replace("'","\\'",$value) . "');\r";
    }

    function drawHead()
    {
        echo $this->js('<ul>');
    }

    function drawLink(&$node, &$link, $last=false)
    {
        echo $this->js('<li><a href=\"' . $this->quoteAtt($link->url) . '\">' . $this->quoteAtt($link->name) . '<\/a><\/li>');
    }

    function drawFoot()
    {
        echo $this->js('<\/ul>');
    }
}
?>
