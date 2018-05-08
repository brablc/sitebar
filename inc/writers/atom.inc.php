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
* Validated using Feed SB_Validator
* http://feedvalidator.org/
* Date formats do not validate, but I think there is a bug invalidator.
*/

$SB_writer_title['atom'] = 'Atom 0.3';

require_once('./inc/writer.inc.php');

class SB_Writer_atom extends SB_WriterInterfaceXML
{
    function __construct()
    {
        parent::__construct();
        $this->switches['flat'] = true;
    }

    function getExtension()
    {
        return ".atom";
    }

    function drawContentType()
    {
        header('Content-Type: application/xml');
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawTagOpen('feed', array
        (
            'version' => '0.3',
            'xmlns' => 'http://purl.org/atom/ns#',
            'xml:lang' => str_replace('_','-',$this->um->getParam('user','lang')),
        ));
        $this->drawTag('title', null, $this->quoteText($this->getTitle()));
        $this->drawTag('link', array
        (
            'rel' => 'alternate',
            'type' => 'text/html',
            'href' => $this->settingsValue('feed_link'),
        ));

        $this->drawTagOpen('author');
        $this->drawTag('name', null, $this->quoteText($this->settingsValue('feed_managing_editor')));
        $this->drawTagClose('author');

        $this->drawTag('copyright', null, $this->quoteText($this->settingsValue('feed_copyright')));
        $this->drawTag('modified', null, $this->getGMDateISO8601($this->root->changed));
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->drawTagOpen('entry');
        $this->drawTag('title', null, $this->quoteText($link->name));
        $this->drawTag('link', array
        (
            'rel' => 'alternate',
            'type' => 'text/html',
            'href' => $this->quoteAtt($link->url),
        ));
        $this->drawTag('id', null, $this->quoteText($link->origURL));
        $this->drawTag('issued', null, $this->getDateISO8601($link->added));
        $this->drawTag('modified', null, $this->getGMDateISO8601($link->changed));
        $this->drawTag('content', null, $this->quoteText($link->comment));
        $this->drawTagClose('entry');
    }

    function drawFoot()
    {
        $this->drawTagClose('feed');
    }
}
?>
