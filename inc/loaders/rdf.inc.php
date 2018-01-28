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

$SB_loader_title['rdf'] = 'RDF/RSS';

class SB_Loader_rdf extends SB_LoaderInterface
{
    function __construct($useEngine=true, $charSet=null)
    {
        parent::__construct($useEngine, $charSet);
    }

    function getAttributeMap()
    {
        static $map = array
        (
            'rdf:Seq' => array
            (
                'rss:title' => 'name',
            ),
            'rss:item' => array
            (
                'rss:title' => 'name',
                'rss:link'  => 'url',
            ),
        );

        return $map;
    }

    function getNodeTag()
    {
        return 'rdf:Seq';
    }

    function getLinkTag()
    {
        return 'rss:item';
    }
}
