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

$SB_writer_title['opml_rss'] = 'OPML RSS Type';

require_once('./inc/writers/opml_link.inc.php');

class SB_Writer_opml_rss extends SB_Writer_opml_link
{
    function __construct()
    {
        parent::__construct();
    }

    function getNodeAtt(&$node)
    {
        $att = array
        (
            'type' => 'rss',
            'text' => $this->quoteAtt($node->name),
            'title' => $this->quoteAtt($node->name),
            'description' => $this->quoteAtt($node->comment),
        );
        return $att;
    }

    function getLinkAtt(&$node, &$link)
    {
        $att = array
        (
            'type' => 'rss',
            'text' => $this->quoteAtt($link->name),
            'title' => $this->quoteAtt($link->name),
            'htmlURL' => $this->quoteAtt($link->url),
            'description' => $this->quoteAtt($link->comment),
        );

        return $att;
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE opml [
    <!ENTITY % opml_plain SYSTEM "http://static.userland.com/gems/radiodiscuss/opmlDtd.txt">
    <!ENTITY % OtherAttributes  "
        title       CDATA #REQUIRED
        htmlURL     CDATA #IMPLIED
        description CDATA #IMPLIED
    ">
    %opml_plain;
]>
<?php
    }
}
?>
