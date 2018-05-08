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
* Validated using W3C RDF Validation Service
* http://www.w3.org/RDF/Validator/
* Gives warning for ID without namespace.
*/

/******************************************************************************
 RDF specific code Kam Chiu LEUNG <mxeon@users.sourceforge.net>
 Download Mozilla/Firefox extension from http://mozlinker.sourceforge.net
 ******************************************************************************/

$SB_writer_title['rdf'] = 'RDF/RSS';

require_once('./inc/writer.inc.php');

class SB_Writer_rdf extends SB_WriterInterfaceXML
{
    function __construct()
    {
        parent::__construct();
    }

    function getExtension()
    {
        return ".rdf";
    }

    function drawContentType()
    {
        header('Content-Type: application/xml');
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawTagOpen('rdf:RDF', array
        (
            'xmlns:rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'xmlns:rss' => 'http://purl.org/rss/1.0/',
            'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
        ));

        $this->drawTagOpen('rdf:Description', array
        (
            'rdf:about' => $this->settingsValue('feed_link'),
        ));

        $this->drawTag("dc:title", null, $this->quoteText($this->getTitle()));

        $this->drawTagClose('rdf:Description');

        if (!$this->switches['root'])
        {
            $this->drawTagOpen('rdf:Seq', array
            (
                'ID' => 'n0',
                'rss:title' => $this->quoteAtt($this->getTitle()),
            ));
        }
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $this->drawTagOpen('rdf:li');
        $this->drawTagOpen('rdf:Seq', array
        (
            'ID' => 'n'.$node->id,
            'rss:title' => $this->quoteAtt($node->name),
        ));
    }

    function drawNodeClose(&$node)
    {
        $this->drawTagClose('rdf:Seq');
        $this->drawTagClose('rdf:li');
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->drawTagOpen('rdf:li');
        $this->drawTag('rss:item', array
        (
            'rss:title' => $this->quoteAtt($link->name),
            'rss:link' => $this->quoteAtt($link->url),
        ));
        $this->drawTagClose('rdf:li');
    }

    function drawFoot()
    {
        if (!$this->switches['root'])
        {
            $this->drawTagClose('rdf:Seq');
        }
        $this->drawTagClose('rdf:RDF');
    }
}
?>
