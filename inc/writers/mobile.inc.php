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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['mobile'] = 'SiteBar for Mobile Devices';

require_once('./inc/writers/sitebar.inc.php');

/******************************************************************************/

class SB_Writer_mobile extends SB_Writer_sitebar
{
    function __construct()
    {
        parent::__construct();
    }

    function writeMenuItem($id, &$itemArray)
    {
        static $expertMode = null;

        if ($expertMode===null)
        {
            $expertMode = $this->um->getParam('user','expert_mode');
        }

        $command = SB_safeVal($itemArray,'name');
        $link = SB_safeVal($itemArray,'href');
        $callback = SB_safeVal($itemArray,'callback');
        $acl = SB_safeVal($itemArray,'acl');
        $optional = SB_safeVal($itemArray,'optional',false);
        $more = SB_safeVal($itemArray,'more',false);

        $class = 'item';
        if (!$command)
        {
            $class.= ' separator';
        }
        else if ($optional&&!$expertMode)
        {
            $class .= ' optional';
        }

        $div = "\t".'<div id="'.$id.'" class="'.$class.'"';

        if ($command)
        {
            $div .= ' onmouseover="SB_itemOn(this);"'.
                    ' onmouseout="SB_itemOff(this);"';
        }

        if ($command && !$link)
        {
            $div .=
                ' x_acl="'.$acl.'"'.
                ' x_cmd="'.$command.'"';
        }
        echo $div . '>';

        if ($link)
        {
            static $target;
            if ($target==null)
            {
                $target = SB_Page::target();
            }

            if (strstr($link,'http')!==0)
            {
                $link= SB_Page::absBaseUrl().$link;
            }

            echo '<a class="menuLink" href="'. $link .'"'. $target .'>';
        }
        else
        {
            echo '<a href="javascript:SB_itemDoAlt(\'' . $id . '\'' . ($callback?',\''.$callback.'\'':''). ')">';
        }

        echo SB_T($command);

        if ($command=='Log Out')
        {
            echo ' ('.$this->um->username.')';
        }

        if ($link)
        {
            echo '</a>';
        }

        echo "</div>\r";
    }

    function run()
    {
        $this->loadOpenNodesOnly = false;
        $this->um->setParam('user','menu_icon', true);
        parent::run();
    }

    function showChildren(&$node)
    {
        return true;
    }

    function wantLoadChildren(&$node)
    {
        return true;
    }
}
?>
