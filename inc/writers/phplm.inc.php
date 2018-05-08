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

/******************************************************************************
 Download PHP Layers Menu from http://phplayersmenu.sf.net
 ******************************************************************************/

$SB_writer_title['phplm'] = 'PHP Layers Menu';

require_once('./inc/writer.inc.php');

class SB_Writer_phplm extends SB_WriterInterface
{
    var $path = '';

    function __construct()
    {
        parent::__construct();
    }

    function fatal($text, $arg = null)
    {
        die(".|".$text);
    }

    function drawNodeOpen(&$node, $last=false)
    {
        if ($node->level==1 && $this->switches['root'])
        {
            return;
        }

        $this->path = implode('/', $this->nodes);

        $this->write(array
        (
            str_repeat('.',$node->level-1),
            $node->name,
            null,
            $node->comment
        ));
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->path = implode('/', $this->nodes);
        $comment = preg_replace("/[\n\r]/m",' ',$link->comment);

        if ($link->favicon
        &&  $this->um->getParam('user','use_favicons')
        &&  $this->um->getParam('config','use_favicon_cache'))
        {
            $link->favicon = SB_Page::absBaseUrl(). 'favicon.php?' . md5($link->favicon) . '=' . $link->id;
        }

        $this->write(array
        (
            str_repeat('.',$node->level),
            $link->name,
            $this->quoteAtt($link->url),
            $comment,
            $link->favicon,
        ));
    }

    function write($arr)
    {
        $str = implode('|', $arr);
        echo $str . "\n";
    }
}

?>
