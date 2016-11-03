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

$SB_writer_title['search'] = 'SiteBar Search [XBEL]';
$SB_writer_hidden['search'] = true;

require_once('./inc/writers/dir.inc.php');

class SB_Writer_search extends SB_Writer_dir
{
    var $wantLoad = true;
    var $search = '';
    var $type = '';
    var $found = 0;
    var $engineURL = '';

    function __construct()
    {
        parent::__construct();
        $this->switches['flat'] = 1;
        $this->tree->sortMode = 'hits';
        $this->search = SB_safeVal($_COOKIE,'SB3SEARCH');

        if (SB_reqChk('q')!='')
        {
            $this->search = SB_reqVal('q');
        }

        $this->type = $this->um->getParam('user','default_search');

        // Check search pattern
        if (preg_match("/^(url|desc|name|all):(.*)$/i", $this->search, $matches))
        {
            $this->type = $matches[1];

            // If we have pattern then use it
            if ($this->type == 'url'
            ||  $this->type == 'desc'
            ||  $this->type == 'name'
            ||  $this->type == 'all')
            {
                $this->search = $matches[2];
            }
        }

        $url = $this->um->getParamB64('user', 'search_engine_url');
        $url = str_replace('%SEARCH%', $this->search, $url);
        $url = str_replace('%BASEURL%', urlencode(SB_Page::absBaseUrlShort()), $url);
        $url = str_replace('%LOGO%', urlencode(SB_Page::absBaseUrl().SB_Skin::imgsrc('logo')), $url);

        $this->engineURL = $url;

        // We would not get here if no engine is specified
        if ($this->um->getParam('user', 'hide_xslt') || SB_reqVal("web")==1)
        {
            header('Location: ' . $this->engineURL);
            exit;
        }
    }

    function getShortTitle()
    {
        return SB_T('SiteBar Search Results');
    }

    function getLinkAttMap(&$bmkAtt, &$node, &$link)
    {
        parent::getLinkAttMap($bmkAtt, $node, $link);
        $bmkAtt['parent_id'] = $link->id_parent;
        $bmkAtt['parent_name'] = $this->quoteAtt($this->getParentName($link->id_parent));
    }

    function getParentName($id)
    {
        static $parentNames = array();

        if (!isset($parentNames[$id]))
        {
            $node = $this->tree->getNode($id);
            $parentNames[$id] = $node->name;
        }
        return $parentNames[$id];
    }

    function collectNode(&$node, &$collector)
    {
        $re = '/'.$this->search.'/i';

        foreach ($node->getChildren() as $child)
        {
            if ($child->type_flag=='n')
            {
                $this->collectNode($child, $collector);
            }
            else
            {
                $subject = '';

                if ($this->type=='url'  || $this->type=='all') $subject .= $child->url;
                if ($this->type=='name' || $this->type=='all') $subject .= $child->name;
                if ($this->type=='desc' || $this->type=='all') $subject .= $child->comment;

                if (preg_match($re, $subject))
                {
                    $collector->addLink($child);
                    $this->found++;
                }
            }
        }

        return true;
    }

    function transform()
    {
        parent::transform();

        if (!$this->found && $this->engineURL!='')
        {
            header('Location: ' . $this->engineURL);
            exit;
        }
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE xbel PUBLIC
    "+//IDN sitebar.org//DTD XML Bookmark Exchange Language for SiteBar Search 1.0//EN//XML"
    "http://sitebar.org/xml/xbel-sitebar-search-1.0.dtd"

[
    <!ATTLIST metadata
        style          CDATA #REQUIRED
        curdate        CDATA #REQUIRED
        imgnode        CDATA #IMPLIED
        imgnodeopen    CDATA #IMPLIED
        imglink        CDATA #IMPLIED
        search_engine_url        CDATA #IMPLIED
        search_engine_ico        CDATA #IMPLIED
        use_search_engine_iframe CDATA #IMPLIED
    >
]>
<?php
    }

    function drawStyleSheet()
    {
        echo '<?xml-stylesheet'.
             ' href="'. $this->getXSLPath('xbel2search') .'"'.
             ' type="text/xsl"?>' . "\r";
    }

    function getMetaDataAtt()
    {
        $att = parent::getMetaDataAtt();
        $att['style'] = $this->getSkinsPath('search.css');

        if ($this->um->getParam('user', 'use_search_engine'))
        {
            $att['search_engine_url'] = $this->quoteAtt($this->engineURL);
            $att['search_engine_ico'] = $this->um->getParamB64('user', 'search_engine_ico');
            $att['use_search_engine_iframe'] = ($this->um->getParam('user', 'use_search_engine_iframe')?1:0);
        }
        return $att;
    }
}
?>
