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

require_once('./inc/tree.inc.php');
require_once('./inc/converter.inc.php');

$SB_loader_title = array();
$SB_loader_default = array();

class SB_LoaderInterface extends SB_Converter
{
    var $importedLinks = 0;
    var $importedFolders = 0;
    var $level = null;
    var $childs = array();
    var $root;

    function __construct($useEngine=true, $charSet=null)
    {
        parent::__construct($useEngine, $charSet);
    }

    function getAttributeMap() { die('Abstract class.'); }
    function getNodeTag() { die('Abstract class.'); }
    function getLinkTag() { die('Abstract class.'); }

    function load(&$lines, &$root)
    {
        $this->root =& $root;

        $xml_parser = xml_parser_create($this->charSet);
        xml_set_object($xml_parser, $this);
        xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($xml_parser, XML_OPTION_SKIP_WHITE,   1);

        $data = implode("\n", $lines);
        unset($lines);

        $vals = array();
        $index = array();

        if (!xml_parse_into_struct($xml_parser, $data, $vals, $index))
        {
            $this->error("XML error: %s at line %d col %d", array
            (
                xml_error_string(xml_get_error_code($xml_parser)),
                xml_get_current_line_number($xml_parser),
                xml_get_current_column_number($xml_parser)
            ));
            return;
        }
        xml_parser_free($xml_parser);

        $i = 0;
        $xmlTree = $this->xmlGetChildren($vals, $i);
        $this->parseTree($this->root, $xmlTree);

        return true;
    }

    function getMappedAttributes(&$tag, &$attrs)
    {
        static $map = null;

        if ($map==null)
        {
            $map = $this->getAttributeMap();
        }

        $mappedAttrs = array();

        if (isset($map[$tag]))
        {
            foreach ($attrs as $attname => $attvalue)
            {
                if (isset($map[$tag][$attname]))
                {
                    $mappedAttrs[$map[$tag][$attname]] = $attvalue;
                }
            }
        }

        return $mappedAttrs;
    }

    function createNode($xmlTag)
    {
        return new SB_Tree_Node($this->getMappedAttributes($xmlTag['tag'], $xmlTag['attributes']));
    }

    function createLink($xmlTag)
    {
        return new SB_Tree_Link($this->getMappedAttributes($xmlTag['tag'], $xmlTag['attributes']));
    }

    function handleUnknownTag($xmlTag)
    {
        return;
    }

    function parseTree(&$parent, $xmlTree)
    {
        foreach ($xmlTree as $index => $value)
        {
            $node = null;

            switch ($value['tag'])
            {
                case $this->getNodeTag():

                    $node = $this->createNode($value);

                    if ($node!=null)
                    {
                        $node->setParent($parent);

                        if (isset($value['children']))
                        {
                            $this->parseTree($node, $value['children']);
                        }
                        break;
                    }

                case $this->getLinkTag():

                    $link = $this->createLink($value);
                    $parent->addLink($link);
                    break;

                default:
                    if (isset($value['children']))
                    {
                        $this->parseTree($parent, $value['children']);
                    }
                    else
                    {
                        $this->handleUnknownTag($value);
                    }
            }

            if ($node != null)
            {
                $parent->addNode($node);
            }
        }
    }

    function xmlGetChildren($vals, &$i)
    {
        $children = array();
        if (isset($vals[$i]['value']))
        {
            $children[] = $vals[$i]['value'];
        }
        while (++$i < count($vals))
        {
            switch ($vals[$i]['type'])
            {
                case 'cdata':
                    $children[] = $vals[$i]['value'];
                    break;
                case 'complete':
                    $children[] = array
                    (
                        'tag'        => $vals[$i]['tag'],
                        'attributes' => isset($vals[$i]['attributes'])?
                                        $vals[$i]['attributes'] : array(),
                        'value'      => isset($vals[$i]['value'])?
                                        $vals[$i]['value'] : null,
                    );
                    break;
                case 'open':
                    $children[] = array
                    (
                        'tag'        => $vals[$i]['tag'],
                        'attributes' => isset($vals[$i]['attributes'])?
                                        $vals[$i]['attributes'] : array(),
                        'children'   => $this->xmlGetChildren($vals, $i),
                    );
                    break;
                case 'close':
                    return $children;
            }
        }
    }
}

/******************************************************************************/

class SB_Loader extends SB_ErrorHandler
{
    var $root;
    // Content of the whole file - memory should not be problem
    var $lines = array();
    // Were bookmarks loaded?
    var $success = false;

    var $importedLinks = 0;
    var $importedFolders = 0;

    var $useEngine = true;
    var $charSet = null;

    function __construct($useEngine=true, $charSet=null)
    {
        if (!$charSet)
        {
            $charSet = 'utf-8';
        }

        $this->useEngine = $useEngine;
        $this->charSet = $charSet;
    }

    function loadFile($filename, $type=null)
    {
        if (!($fp = fopen($filename, 'r')))
        {
            $this->error('Cannot open file!');
            return;
        }

        $line = '';

        // PHP sucks again. fgets does not work as supposed,
        // we have to go to lower level and do end of line
        // detection ourselves.
        // We support all combinations of CR and LF for line ends.
        while (!feof($fp))
        {
            $line .= fread($fp,1024);

            while (preg_match("/(.*?)(\n\r|\r\n|\r|\n)(.*)/s", $line, $reg))
            {
                $this->lines[] = $reg[1];
                $line = $reg[3];
            }
        }
        fclose( $fp);

        // Last line
        $this->lines[] = $line;

        if (!count($this->lines))
        {
            $this->error('File is empty!');
            return;
        }

        $this->load($type);
    }

    function loadArray(&$array, $type=null)
    {
        $this->lines = $array;
        $this->load($type);
    }

    function load($type=null)
    {
        if (!$type)
        {
            if (stristr($this->lines[0], 'NETSCAPE-Bookmark-file-1'))
            {
                $type = 'netscape';
            }
            elseif (stristr($this->lines[0], 'Opera Hotlist version 2.0'))
            {
                $type = 'opera';
            }
            else
            {
                for ($i=0; $i<count($this->lines); $i++)
                {
                    if (preg_match('/<(\w+)\b.*>/', $this->lines[$i], $reg))
                    {
                        switch ($reg[1])
                        {
                            case 'xbel': $type = 'xbel'; break;
                            case 'feed': $type = 'atom'; break;
                            case 'opml': $type = 'opml_link'; break;
                            case 'rdf':  $type = 'rdf'; break;
                            case 'rss':  $type = 'rss'; break;
                        }
                    }
                }
            }
        }

        $loaderFile = './inc/loaders/'.$type.'.inc.php';
        if (preg_match('/^\w+$/', $type) && is_file($loaderFile))
        {
            $this->root = new SB_Tree_Node();
            require_once($loaderFile);
            eval(sprintf('$loaderObj = new SB_Loader_%s(%d);',
                $type, $this->useEngine?1:0));

            $loaderObj->setCharSet($this->charSet);

            if ($loaderObj->load($this->lines, $this->root))
            {
                $this->success = true;
                $this->importedLinks = $loaderObj->importedLinks;
                $this->importedFolders = $loaderObj->importedFolders;
            }
        }
        else
        {
            $this->error('Unknown bookmark file format!');
            return;
        }
    }
}
?>
