<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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
 Download WebLinks extension from your SiteBar index page
 ******************************************************************************/

$SB_writer_title['weblinks'] = 'WebLinks';

require_once('./inc/writer.inc.php');

class SB_Writer_weblinks extends SB_WriterInterface
{
    var $path = '';

    function __construct()
    {
        parent::__construct();
    }

    function fatal($msg, $arg=null)
    {
        die("**05" . parent::fatal($msg, $arg) . "\r");
    }

    function drawHead()
    {
        echo "++00Sucess\r";
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $this->path = implode('/', $this->nodes);

        $this->write(array
        (
            $this->path,
            'flags',
            $node->name,
        ));
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $this->path = implode('/', $this->nodes);
        $url = $link->url;

        if (!($url{0}=='j' && strpos($url,'javascript:')!==false))
        {
            $url = SB_Page::absBaseUrl().'go.php?id='.$link->id.'&url='.$link->url;
        }

        $this->write(array
        (
            $this->path.'/'.$link->id,
            'flags',
            $link->name,
            '',
            $this->quoteAtt($url),
        ));
    }

    function write($arr)
    {
        $str = implode('|', $arr);
        echo html_entity_decode($str) . "\r";
    }
}

?>
