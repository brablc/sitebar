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

$SB_loader_title['rss'] = 'RSS 2.0';

class SB_Loader_rss extends SB_LoaderInterface
{
    public function __construct($useEngine = true, $charSet = null)
    {
        parent::__construct($useEngine, $charSet);
    }

    public function getNodeTag()
    {
        return 'channel';
    }

    public function getLinkTag()
    {
        return 'item';
    }

    public function createNode($xmlTag)
    {
        $attributes = array();

        foreach ($xmlTag['children'] as $index => $value) {
            switch ($value['tag']) {
                case 'title':
                    $attributes['name'] = $value['value'];
                    break;
            }
        }

        return new SB_Tree_Node($attributes);
    }

    public function createLink($xmlTag)
    {
        $attributes = array();

        foreach ($xmlTag['children'] as $index => $value) {
            switch ($value['tag']) {
                case 'title':
                    $attributes['name'] = $value['value'];
                    break;

                case 'link':
                    $attributes['url'] = $value['value'];
                    break;
            }
        }

        return new SB_Tree_Link($attributes);
    }
}
