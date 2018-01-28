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

require_once('./inc/faviconcache.inc.php');

$SB_loader_title['netscape'] = 'Netscape Bookmark File';

class SB_Loader_netscape extends SB_LoaderInterface
{
    var $lines;

    function __construct($useEngine=true, $charSet=null)
    {
        parent::__construct($useEngine, $charSet);
    }

    function load(&$lines, &$root)
    {
        $this->lines =& $lines;
        return $this->loadNetscape($root);
    }

    function loadNetscape(&$parent)
    {
        while (($line = array_shift($this->lines))!==null)
        {
            if (preg_match('/<meta\s+http-equiv=["\']Content-Type["\']\s+'.
                'content=["\'].*?\bcharset=(.*?)["\']\s*>/i', $line, $reg))
            {
                if (strcasecmp($reg[1],$this->charSet))
                {
                    if ($this->useEngine && $this->getEngine()!=SB_CHARSET_IGNORE)
                    {
                        $this->setCharSet($reg[1]);
                        $this->warn('Character set overriden from document to %s!', array($reg[1]));
                    }
                    else
                    {
                        $this->warn('There is no conversion engine available to convert from %s character set!', array($reg[1]));
                    }
                }
            }

            $line = $this->toUTF8($line);

            // Open node
            if (preg_match('/<DT.*><H3([^>]*)>([^<]*)<\/H3>/i', $line, $reg ))
            {
                $rec = array();
                $params = $reg[1];
                $rec['name'] = $reg[2];

                if (strlen($rec['name'])==0)
                {
                  $rec['name'] = '?';
                }

                $this->_loadNetscapeComment($rec);

                $node = new SB_Tree_Node($rec);

                // Yes recursive!
                $this->loadNetscape($node);
                $parent->addNode($node);
                $this->importedFolders++;
                continue;
            }

            // Add link to current node
            if (preg_match('/<DT.*><A HREF="([^"]+)"([^>]*)>([^<]*)<\/A>/i',$line, $reg ))
            {
                $rec = array();
                $rec['url'] = $reg[1];
                $params = $reg[2];
                $rec['name'] = $reg[3];

                if (strlen($rec['name'])==0)
                {
                  $rec['name'] = $rec['url'];
                }

                // Take live feeds URL if exists instead of site url
                if (preg_match('/FEEDURL="([^"]+)"/i', $params, $reg))
                {
                    $rec['url'] = $reg[1];
                }
                if (preg_match('/ICON="([^"]+)"/i', $params, $reg))
                {
                    $rawdata = $reg[1];

                    if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $rawdata, $reg2))
                    {
                        $fc = & SB_FaviconCache::staticInstance();
                        $rec['favicon'] = $fc->saveFaviconBase64($reg2[2]);
                    }
                    else if (substr($rawdata,0,7) == "http://")
                    {
                        $rec['favicon'] = $rawdata;
                    }
                }
                $this->_loadNetscapeComment($rec);
                $parent->addLink(new SB_Tree_Link($rec));
                $this->importedLinks++;
                continue;
            }

            // Close node - break recursion
            if (stristr($line, "</DL>"))
            {
                return true;
            }
        }
        return true;
    }

    function _loadNetscapeComment(&$rec)
    {
        $line = array_shift($this->lines);
        if (preg_match('/<DD>(.*)/i', $line, $reg ))
        {
            $comment = $this->toUTF8($reg[1]);

            $line = array_shift($this->lines);
            while (count($this->lines) && !preg_match('/<\/?D[LT]>/i', $line ))
            {
                $comment .= "\r".$this->toUTF8($line);
                $line = array_shift($this->lines);
            }

            $rec['comment'] = $comment;
        }
        // Put it back, either it is not comment or it is next line
        array_unshift($this->lines,$line);
    }
}
?>
