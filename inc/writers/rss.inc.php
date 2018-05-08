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
*/

$SB_writer_title['rss'] = 'RSS 2.0';

/******************************************************************************
 Original RSS specific code Markus Kniebes <mk@kniebes.net>
 ******************************************************************************/

require_once('./inc/writer.inc.php');

class SB_Writer_rss extends SB_WriterInterfaceXML
{
    function __construct()
    {
        parent::__construct();
    }

    function run()
    {
        $this->switches['flat'] = true;
        SB_WriterInterfaceXML::run();
    }

    function getExtension()
    {
        return ".rss";
    }

    function drawHead()
    {
        $this->drawXMLPI();

        $this->drawTagOpen('rss', array
        (
            'version' => '2.0',
            'xmlns:rss' => 'http://purl.org/rss/2.0/',
            //'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
            //'xmlns:content' => 'http://purl.org/rss/1.0/modules/content/',
        ));
        $this->drawTagOpen('channel');
        $this->drawTag('title', null, $this->quoteText($this->getTitle()));

        $desc = $this->settingsValue('feed_desc').' '.SB_Page::absBaseUrl();
        $this->drawTag('description', null, $this->quoteText($desc));
        $this->drawTagOpen('image');
        $this->drawTag('title', null, $this->quoteText($this->getTitle()));
        $this->drawTag('url', null, SB_Page::absBaseUrl() . SB_Skin::imgsrc('root_transparent'));
        $this->drawTag('link', null, $this->settingsValue('feed_link'));
        $this->drawTagClose('image');

        $this->drawTag('link', null, $this->settingsValue('feed_link'));
        $this->drawTag('managingEditor', null, $this->quoteText($this->settingsValue('feed_managing_editor')));
        $this->drawTag('webMaster', null, $this->quoteText($this->settingsValue('feed_webmaster')));
        $this->drawTag('copyright', null, $this->quoteText($this->settingsValue('feed_copyright')));
        $this->drawTag('language', null, str_replace('_','-',$this->um->getParam('user','lang')));
        $this->drawTag('generator', null, 'SiteBar ' . SB_CURRENT_RELEASE . ' (Bookmark Server; http://sitebar.org/)');

        // Time to live in minutes
        $this->drawTag('ttl', null, '60');
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->drawTagOpen('item');

        // Show number of hits in name - we want this info!
        if ($this->tree->sortMode == 'hits')
        {
            $link->name = sprintf('%05d - %s', $link->hits, $link->name);
        }

        $this->drawTag('title', null, $this->quoteText($link->name));
        // $this->drawTag('author', null, null);
        $this->drawTag('link', null, $this->quoteText($link->url));

        if (strlen($link->comment))
        {
            $this->drawTag('description', null, $this->quoteText($link->comment));
        }

        $date = '';
        $append = '';
        switch ($this->tree->sortMode)
        {
            case 'changed':
                $date = $link->changed;
                $append = '#' . $date;
                break;
            case 'tested':
                $date = $link->tested;
                $append = '#' . $date;
                break;
            case 'hits':
                $append = '#' . $link->hits;
                $date = $link->visited;
                break;
            case 'visited':
                $date = $link->visited;
                $append = '#' . $date;
                break;
            case 'added':
                $date = $link->added;
                break;
            default:
                $date = ($link->added>$link->changed?$link->added:$link->changed);
        }

        $this->drawTag('pubDate', null, $this->getDateRFC822($date));
        $this->drawTag('guid', null, $this->quoteText($link->origURL) . $append);
        $this->drawTagClose('item');
    }

    function drawFoot()
    {
        $this->drawTagClose('channel');
        $this->drawTagClose('rss');
    }
}
?>
