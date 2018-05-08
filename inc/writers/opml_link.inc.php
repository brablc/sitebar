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

$SB_writer_title['opml_link'] = 'OPML Link Type';

require_once('./inc/writer.inc.php');

class SB_Writer_opml_link extends SB_WriterInterfaceXML
{
    function __construct()
    {
        parent::__construct();
    }

    function getNodeAtt(&$node)
    {
        $att = array
        (
            'text' => $this->quoteAtt($node->name),
        );
        return $att;
    }

    function getLinkAtt(&$node, &$link)
    {
        $att = array
        (
            'type' => 'link',
            'text' => $this->quoteAtt($link->name),
            'url'  => $this->quoteAtt($link->url),
        );

        return $att;
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE opml [
    <!ENTITY % opml_plain SYSTEM "http://static.userland.com/gems/radiodiscuss/opmlDtd.txt">
    <!ENTITY % OtherAttributes  "url CDATA #IMPLIED">
    %opml_plain;
]>
<?php
    }

    /* Common functions for OPML */

    function getExtension()
    {
        return ".opml";
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawDOCTYPE();
        $this->drawTagOpen('opml',array('version'=>'1.0'));

        $this->drawTagOpen('head');
        $this->drawTag('title', null, $this->quoteText($this->getTitle()));

        if ($this->settingsValue('feed_owner_name'))
        {
            $this->drawTag('ownerName', null, $this->quoteText($this->settingsValue('feed_owner_name')));
        }

        if ($this->settingsValue('feed_owner_email'))
        {
            $this->drawTag('ownerEmail', null, $this->quoteText($this->settingsValue('feed_owner_email')));
        }
        $this->drawTagClose('head');
        $this->drawTagOpen('body');
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $this->drawTagOpen('outline', $this->getNodeAtt($node));
    }

    function drawNodeClose(&$node)
    {
        $this->drawTagClose('outline');
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->drawTag('outline', $this->getLinkAtt($node, $link));
    }

    function drawFoot()
    {
        $this->drawTagClose('body');
        $this->drawTagClose('opml');
    }
}
?>
