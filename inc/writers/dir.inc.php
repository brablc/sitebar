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
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['dir'] = 'SiteBar Directory [XBEL]';

require_once('./inc/writers/xbel.inc.php');

class SB_Writer_dir extends SB_Writer_xbel
{
    function __construct()
    {
        parent::__construct();
        $this->um->setParam('user','mix_mode','nodes');
    }

    function allowAnonymous()
    {
        return true;
    }

    function getMaxLevel()
    {
        return $this->switches['root']?2:1;
    }

    function load()
    {
        if (!$this->switches['flat'])
        {
            $this->tree->maxLevel = $this->getMaxLevel();
        }

        parent::load();

        // We want single rooted tree, add fake folder
        if (!$this->switches['root'] || $this->switches['flat'])
        {
            $oldroot = $this->root;
            $this->root = new SB_Tree_Node(array());
            $this->root->name = $oldroot->name;
            $this->root->comment = $oldroot->comment;
            $this->root->addNode($oldroot);
        }
    }

    function wantLoadChildren(&$node)
    {
        return $node->level<=$this->getMaxLevel();
    }

    function drawXMLPI()
    {
        parent::drawXMLPI();

    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE xbel PUBLIC
    "+//IDN sitebar.org//DTD XML Bookmark Exchange Language for SiteBar 1.0//EN//XML"
    "http://sitebar.org/xml/xbel-sitebar-1.0.dtd"
[
    <!ATTLIST metadata
        style          CDATA #REQUIRED
        curdate        CDATA #REQUIRED
        imgnode        CDATA #IMPLIED
        imgnodeopen    CDATA #IMPLIED
        imglink        CDATA #IMPLIED
    >
]>
<?php
    }

    function drawStyleSheet()
    {
        echo '<?xml-stylesheet'.
             ' href="'. $this->getXSLPath('xbel2dir') .'"'.
             ' type="text/xsl"?>' . "\r";
    }

    function getMetaDataAtt()
    {
        $att = parent::getMetaDataAtt();
        $att['style'] = $this->getSkinsPath('directory.css');
        $att['curdate'] = date('Y-m-d\TH:i:s');
        $att['imgnode'] = $this->getSkinsPath('node.png');
        $att['imgnodeopen'] = $this->getSkinsPath('node_open.png');
        $att['imglink'] = $this->getSkinsPath('link.png');
        return $att;
    }
}
?>
