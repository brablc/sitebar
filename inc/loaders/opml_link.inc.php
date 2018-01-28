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

$SB_loader_title['opml_link'] = 'OPML Link Type';

class SB_Loader_opml_link extends SB_LoaderInterface
{
    function __construct($useEngine=true, $charSet=null)
    {
        parent::__construct($useEngine, $charSet);
    }

    function getAttributeMap()
    {
        static $map = array
        (
            'node' => array
            (
                'text' => 'name',
            ),
            'link' => array
            (
                'text' => 'name',
                'url'  => 'url',
            ),
        );

        return $map;
    }

    function createNode($xmlTag)
    {
        if (isset($xmlTag['attributes']['type']))
        {
            return null;
        }

        return parent::createNode(array('tag'=>'node', 'attributes'=>$xmlTag['attributes']));
    }

    function createLink($xmlTag)
    {
        return parent::createLink(array('tag'=>'link', 'attributes'=>$xmlTag['attributes']));
    }

    function getNodeTag()
    {
        return 'outline';
    }

    function getLinkTag()
    {
        return 'outline';
    }
}
