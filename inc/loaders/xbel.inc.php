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

$SB_loader_title['xbel'] = 'XBEL';

class SB_Loader_xbel extends SB_LoaderInterface
{
    var $bookmarksToolbarFolder;
    var $unfiledBookmarksFolder;

    function __construct($useEngine=true, $charSet=null)
    {
        parent::__construct($useEngine, $charSet);
    }

    function getNodeTag()
    {
        return 'folder';
    }

    function getLinkTag()
    {
        return 'bookmark';
    }

    function createNode($xmlTag)
    {
        $special = array();

        $id = SB_safeVal($xmlTag['attributes'],'id',null);
        if ($id == $this->bookmarksToolbarFolder)
            $special['is_toolbar'] = 1;
        if ($id == $this->unfiledBookmarksFolder)
            $special['is_unfiled'] = 1;

        foreach ($xmlTag['children'] as $index => $value)
        {
            if ($value['tag'] == 'title')
                $xmlTag['attributes']['name'] = $value['value'];
            if ($value['tag'] == 'desc')
                $xmlTag['attributes']['comment'] = $value['value'];
        }

        return new SB_Tree_Node($xmlTag['attributes'], $special);
    }

    function createLink($xmlTag)
    {
        $xmlTag['attributes']['url'] = $xmlTag['attributes']['href'];

        foreach ($xmlTag['children'] as $index => $value)
        {
            if ($value['tag'] == 'title')
                $xmlTag['attributes']['name'] = $value['value'];

            if ($value['tag'] == 'desc')
                $xmlTag['attributes']['comment'] = $value['value'];

            if ($value['tag'] == 'info')
            {
                foreach ($value['children'] as $index2 => $value2)
                {
                    if ($value2['tag'] == 'metadata')
                    {
                        if (isset($value2['attributes']['owner']) == "Mozilla")
                        {
                            if (isset($value2['attributes']['WebPanel']))
                            {
                                $xmlTag['attributes']['is_sidebar'] = $value2['attributes']['WebPanel'];
                            }
                            if (isset($value2['attributes']['FeedURL']))
                            {
                                $xmlTag['attributes']['url'] = $value2['attributes']['FeedURL'];
                                $xmlTag['attributes']['is_feed'] = 1;
                            }
                            if (isset($value2['attributes']['IconURI']))
                            {
                                $xmlTag['attributes']['favicon'] = $value2['attributes']['IconURI'];
                            }
                            else if (isset($value2['attributes']['Icon']))
                            {
                                if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $value2['attributes']['Icon'], $reg))
                                {
                                    $fc = & SB_FaviconCache::staticInstance();
                                    $xmlTag['attributes']['favicon'] = $fc->saveFaviconBase64($reg[2]);
                                }
                            }
                            // Icon management missing
                        }
                    }
                }
            }
        }

        $xmlTag['attributes']['changed'] = SB_safeVal($xmlTag['attributes'],'modified');

        return new SB_Tree_Link($xmlTag['attributes']);
    }

    function handleUnknownTag($xmlTag)
    {
        if ($xmlTag['tag'] == "metadata"
        && isset($xmlTag['attributes'])
        && isset($xmlTag['attributes']['SyncPlaces']))
        {
            $attr = $xmlTag['attributes'];
            $this->bookmarksToolbarFolder = SB_safeVal($attr,'BookmarksToolbarFolder');
            $this->unfiledBookmarksFolder = SB_safeVal($attr,'UnfiledBookmarksFolder');
        }
        return;
    }

}
