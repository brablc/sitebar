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

$SB_writer_title['sitebar_ajax'] = 'SiteBar Tree AJAX Worker';
$SB_writer_hidden['sitebar_ajax'] = true;

require_once('./inc/writers/sitebar.inc.php');

class SB_Writer_sitebar_ajax extends SB_Writer_sitebar
{
    var $arrFilled = false;
    var $level = 0;

    function __construct()
    {
        parent::__construct();
        $this->switches['root'] = SB_reqVal('nid');
        $this->switches['exr'] = true;
        $this->level = intval(SB_reqVal('level'))-1;
    }

    function fillArray(&$node)
    {
        $this->arrFilled = true;

        for ($i=0; $i<$this->level; $i++)
        {
            array_push($this->treearr, $this->iempty);
        }

        $node->root->isRoot = false;
    }

/* Opera 8.5 does not support responseXML
    function drawContentType()
    {
        header('Content-Type: text/xml; charset=utf-8');
    }
*/

    function drawHead()
    {
        /* Opera 8.5 does not support responseXML
        $this->drawXMLPI();
        echo '<response><root>'.$this->switches['root'].'</root><data><![CDATA[';
        */
        echo $this->switches['root']."\r";
    }

    function drawFoot()
    {
        /* Opera 8.5 does not support responseXML
        echo ']]></data></response>'."\r";
        */
    }

    function drawNodeOpen(&$node, $last=false)
    {
        if (!$this->arrFilled)
        {
            $this->fillArray($node);
            $node->aclstr = SB_reqVal('acl');
        }

        $node->level += $this->level;
        parent::drawNodeOpen($node, $last);
    }

    function drawNodeClose(&$node)
    {
        parent::drawNodeClose($node);
    }

    function drawLink(&$node, &$link, $last=false)
    {
        static $aclstrSet = false;

        if (!$this->arrFilled)
        {
            $this->fillArray($node);
        }

        if (!$aclstrSet)
        {
            $node->aclstr = SB_reqVal('acl');
            $aclstrSet = true;
        }

        parent::drawLink($node, $link, $last);
    }
}
?>
