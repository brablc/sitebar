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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['xbel_std'] = 'XBEL 1.0 (Standard)';

require_once('./inc/writers/xbel.inc.php');

class SB_Writer_xbel_std extends SB_Writer_xbel
{
    function __construct()
    {
        parent::__construct();
    }

    function drawContentType()
    {
        header('Content-Type: text/xml; charset=utf-8');
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE xbel PUBLIC
    "+//IDN python.org//DTD XML Bookmark Exchange Language 1.0//EN//XML"
    "http://pyxml.sourceforge.net/topics/dtds/xbel-1.0.dtd">
<?php
    }

    function getNodeAttMap(&$nodeAtt, &$node)
    {
        $nodeAtt['id'] = 'n' . $node->id;

        if ($node->added)
        {
            $nodeAtt['added'] = $this->getDateISO8601($node->added);
        }
    }

    function getLinkAttMap(&$bmkAtt, &$node, &$link)
    {
        $bmkAtt['href'] = $this->quoteAtt($link->url);
        $bmkAtt['modified'] = $this->getDateISO8601($link->changed);
        $bmkAtt['visited'] = $this->getDateISO8601($link->visited);
    }
}
?>
