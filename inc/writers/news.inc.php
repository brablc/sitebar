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

$SB_writer_title['news'] = 'SiteBar Bookmark News [XBEL]';
$SB_writer_hidden['news'] = true;

require_once('./inc/writers/dir.inc.php');

class SB_Writer_news extends SB_Writer_dir
{
    var $wantLoad = true;

    function __construct()
    {
        parent::__construct();
        $this->switches['flat'] = 1;
    }

    function drawStyleSheet()
    {
        echo '<?xml-stylesheet'.
             ' href="'. $this->getXSLPath('xbel2news') .'"'.
             ' type="text/xsl"?>' . "\r";
    }

    function getShortTitle()
    {
        $name = '';

        if ($this->switches['root'])
        {
            // We have only one root in this case but placed in a fake root
            $node = $this->tree->getNode($this->switches['root']);
            $name = $node->name;
        }
        else
        {
            $name = 'SiteBar';
        }

        return sprintf(SB_T('%s Bookmark News'), $name);
    }

    function load()
    {
        SB_WriterInterface::load();
        $this->wantLoad = false;

        $newroot = new SB_Tree_Node(array());
        $this->addSorted($newroot, 'hits');
        $this->addSorted($newroot, 'visited');
        $this->addSorted($newroot, 'added');
        $this->addSorted($newroot, 'changed');
        $this->root = $newroot;
    }

    function addSorted(&$root, $sortMode)
    {
        $this->sortLinks($sortMode);
        $sub = new SB_Tree_Node(array
        (
            'name'=>SB_T($this->tree->sortModeLabel[$sortMode]),
            'nid'=> $sortMode,
            'nid_parent' => ($this->switches['root']?$this->switches['root']:''),
        ));
        foreach ($this->root->getLinksSlice(10) as $link)
        {
            $sub->addLink($link);
        }
        $root->addNode($sub);
    }

    function wantLoadChildren(&$node)
    {
        return $this->wantLoad;
    }

    function getMetaDataAtt()
    {
        $att = parent::getMetaDataAtt();
        $att['style'] = $this->getSkinsPath('news.css');
        return $att;
    }

    function getLinkAttMap(&$bmkAtt, &$node, &$link)
    {
        parent::getLinkAttMap($bmkAtt, $node, $link);
        unset($bmkAtt['id']);
    }
}
?>
