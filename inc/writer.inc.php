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

require_once('./inc/errorhandler.inc.php');
require_once('./inc/converter.inc.php');
require_once('./inc/tree.inc.php');
require_once('./inc/usermanager.inc.php');

$SB_writer_title = array();
$SB_writer_hidden = array();
$SB_writer_default = array();

class SB_WriterInterface extends SB_Converter
{
    var $um;
    var $tree;
    var $sw;

    var $nodes = array();
    var $path = '';
    var $root = null;
    var $user = null;
    var $tagLevel = 0;
    var $countLinks = 0;

    var $switches = array
    (
        'user' => null,
        'root' => null,
        'exr' => false, // Exclude root folder
        'max' => null,
        'username' => null,
        'pass' => null,
        'len' => null,
        'hits' => null,
        'shorten' => null,
        'cmd' => false,
        'mode' => null,
        'igp' => false,
        'flat' => false,
    );

    function __construct()
    {
        $this->um =& SB_UserManager::staticInstance();
        parent::__construct($this->um->getParam('config','use_conv_engine'));
        $this->tree =& SB_Tree::staticInstance();

        // Set the default value accordingly
        $this->switches['hits'] = $this->um->getParam('config','use_hit_counter');

        if (!isset($_SERVER['HTTPS']) && $this->um->getParam('user', 'private_over_ssl_only'))
        {
            $this->tree->skipPrivate = true;
        }

        SB_Skin::set($this->um->getParam('user','skin'));

        $this->sw = new SB_StopWatch();
        $this->sw->start();
    }

    function setLoader(&$loader)
    {
        $this->loader = $loader;
    }

    function settingItems()
    {
        static $values = array
        (
            'feed_copyright',
            'feed_desc',
            'feed_link',
            'feed_managing_editor',
            'feed_root_name',
            'feed_folder_title',
            'feed_webmaster',
        );

        return $values;
    }

    function settingsValueFmt($label, $att)
    {
        $fmt = $this->settingsValue($config);
        if (is_array($value))
        {
            $value = vsprintf( $fmt, $value);
        }
        else
        {
            $value = sprintf( $fmt, $value);
        }
    }

    function settingsValue($label)
    {
        $um =& SB_UserManager::staticInstance();
        $val = $um->getParamB64('config', $label);

        if ($val != '')
        {
            return $val;
        }

        switch ($label)
        {
            case 'feed_link':
                return SB_Page::absBaseUrl();
            case 'feed_root_name':
                return SB_T('SiteBar Bookmarks');
            case 'feed_folder_title':
                $baseurl = parse_url(SB_Page::absBaseUrl());
                $ft = '%s%s [' . $baseurl['host'];
                if (isset($baseurl['path']))
                {
                    $ft .= $baseurl['path'];
                }
                return $ft . ']';
            case 'feed_desc':
                return SB_T('Bookmarks from SiteBar installation at');

            case 'feed_managing_editor':
            case 'feed_webmaster':
                $user = $um->getUser(SB_ADMIN);
                return sprintf('%s (%s)', $um->getParam('config','sender_email'), $user['name']);

            default: return '';
        }
    }

    function fatal($msg, $arg=null)
    {
        header('Content-Type: text/plain');
        echo $this->formatError($msg, $arg);
        exit;
    }

    function appError($msg, $arg=null)
    {
        header('Content-Type: text/html');
        echo $this->formatError($msg, $arg);
        exit;
    }

    function allowAnonymous()
    {
        return $this->um->isAuthorized("Download Bookmarks");
    }

    function run()
    {
        if ($this->switches['username'] && $this->switches['pass'])
        {
            if ( ($this->um->isAnonymous() || $this->um->username != $this->switches['username'])
            &&  !$this->um->login($this->switches['username'], $this->switches['pass']))
            {
                $this->fatal('Access denied!');
            }
        }

        if (!$this->allowAnonymous())
        {
            $this->fatal('Anonymous feed not allowed!');
        }

        // If the server does not allow it then we cannot change it using parameters
        if ($this->switches['hits'] && !$this->um->getParam('config','use_hit_counter'))
        {
            $this->switches['hits'] = false;
        }

        $this->load();

        if ($this->switches['mode']=='plain')
        {
            header('Content-Type: text/plain; charset=' . $this->charSet);
        }
        else if ($this->switches['mode']=='download')
        {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $this->getTranslatedFileName() .'"');
            header('Content-Transfer-Encoding: binary');
        }
        else
        {
            $this->drawContentType();
            $this->drawCacheControl();
        }

        if ($this->switches['cmd'])
        {
            $links = array(new SB_Tree_Link(array('name'=>'Web Interface', 'url'=> SB_Page::absBaseUrl().'index.php')));

            if ($this->um->isAnonymous())
            {
                $links[] = $this->getCommandLink('Log In');
                $links[] = $this->getCommandLink('Sign Up');
            }
            else
            {
                $links[] = $this->getCommandLink('Add Bookmark', "+'&amp;name='+escape(document.title)+'&amp;url='+escape(location.href)");
                $links[] = $this->getCommandLink('Log Out');
            }

            $node = null;

            if ($this->switches['flat'])
            {
                $node =& $this->root;
            }
            else
            {
                $node = new SB_Tree_Node(array('nid'=>0, 'name'=>':: SiteBar Commander ::'));
                $node->level = 1;
                $node->isRoot = 1;
                $node->acl=array('allow_select'=>1);
            }

            foreach (array_reverse($links) as $link)
            {
                array_unshift($node->_links, $link);
            }

            if (!$this->switches['flat'])
            {
                array_unshift($this->root->_nodes, $node);
            }
        }

        $this->drawHead();
        $this->drawChildren($this->root);
        $this->drawFoot();
    }

    function load()
    {
        $this->root = new SB_Tree_Node(array());

        if ($this->switches['igp'])
        {
            $this->tree->skipPrivate = true;
        }

        if ($this->switches['user'])
        {
            $user = $this->um->getUserByUsername($this->switches['user']);

            if (!$user)
            {
                $this->appError("This user does not exist!");
            }
            else
            {
                $this->tree->mergedUserId = $user['uid'];
            }
        }

        if ($this->switches['root'])
        {
            $rootNode = $this->tree->getNode($this->switches['root']);

            if (!$rootNode)
            {
                $this->fatal('Invalid folder id!');
            }

            $rootNode->level = 1;
            $rootNode->isRoot = 1;

            $this->tree->loadNodes($rootNode, $this->switches['flat']);

            if ($this->switches['exr'])
            {
                $this->tree->loadLinks($rootNode);
                $this->root = $rootNode;
            }
            else
            {
                $this->root->addNode($rootNode);
            }
        }
        else
        {
            $roots = array();

            if ($this->tree->mergedUserId)
            {
                foreach ($this->tree->loadUserRoots($this->tree->mergedUserId) as $root)
                {
                    if ($root->isVisible())
                    {
                        $roots[$root->id] = $root;
                    }
                }
            }

            foreach ($this->tree->loadRoots() as $root)
            {
                $roots[$root->id] = $root;
            }

            foreach ($roots as $id => $eachRoot)
            {
                $eachRoot->level = 1;
                if ($this->wantLoadChildren($eachRoot))
                {
                    $this->tree->loadNodes($eachRoot, $this->switches['flat']);
                }
                $this->root->addNode($eachRoot);
            }
        }

        $this->transform();
    }

    function quoteAtt($value)
    {
        return htmlspecialchars($value);
    }

    function quoteText($value)
    {
        return $this->quoteAtt($value);
    }

    function getCommandLink($command, $add='')
    {
        $url = "javascript:void(window.open('".SB_Page::absBaseUrl()."command.php?command=$command$add',".
               "'sitebar_gCmdWin', ".
               "'resizable=yes,dependent=yes,width=210,height=360,top=200,left=300,titlebar=yes,scrollbars=yes'))";
        return new SB_Tree_Link(array('name'=>$command, 'url'=> $url));
    }

    function getFileName()
    {
        return $this->getShortTitle() . $this->getExtension();
    }

    function getTranslatedFileName()
    {
        return $this->getFileName();
    }

    function getExtension()
    {
        return ".txt";
    }

    function getShortTitle()
    {
        $name = '';

        if ($this->switches['root'])
        {
            if ($this->switches['flat'])
            {
                $name = $this->root->name;
            }
            else
            {
                // We have only one root in this case but placed in a fake root
                $nodes = $this->root->getNodes();
                $name = $nodes[0]->name;
            }
        }
        else
        {
            $name = sprintf($this->settingsValue('feed_root_name'));
        }

        return $name;
    }

    function getTitle()
    {
        $sortLabel = '';
        if ($this->tree->sortMode)
        {
            $sortLabel = ' - ' . SB_T($this->tree->sortModeLabel[$this->tree->sortMode]);
        }
        return vsprintf($this->settingsValue('feed_folder_title'), array( $this->getShortTitle(), $sortLabel));
    }

    function getDateISO8601($date)
    {
        $td = strtotime($date);
        // O directive does not contain colon
        $tz = date("O",$td);
        $tz = substr($tz,0,3).':'.substr($tz,3);
        return date("Y-m-d\TH:i:s", $td) . $tz;
    }

    function getGMDateISO8601($date)
    {
        return gmdate("Y-m-d\TH:i:s", strtotime($date)) . 'Z';
    }

    function getDateRFC822($date)
    {
        return str_replace(',  ', ', ', date("r", strtotime($date)));
    }

    function drawXMLPI()
    {
        echo '<?xml version="1.0" encoding="'. $this->charSet . "\"?>\r";
    }

    function drawCacheControl()
    {
        if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'Apache/2'))
        {
            header('Cache-Control: no-cache, pre-check=0, post-check=0, max-age=0');
        }
        else
        {
            header('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
        }

        header('Expires: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    }

    function getAttributes($att)
    {
        $attvalue = '';

        if ($att)
        {
            foreach($att as $key => $val)
            {
                if ($val!==null)
                {
                    $attvalue .= ' ' . $key . '="' . $val . '"';
                }
            }
        }

        return $attvalue;
    }

    function drawTagOpen($tag, $att=null)
    {
        echo str_repeat('  ', $this->tagLevel) . '<' . $tag . $this->getAttributes($att) . '>'."\r";
        $this->tagLevel++;
    }

    function drawTag($tag, $att=null, $value=null)
    {
        $attvalue = $this->getAttributes($att);

        if ($value)
        {
            echo str_repeat('  ', $this->tagLevel) . sprintf("<%s%s>%s</%s>\r", $tag, $attvalue, $value, $tag);
        }
        elseif ($attvalue)
        {
            echo str_repeat('  ', $this->tagLevel) . sprintf("<%s%s />\r", $tag, $attvalue);
        }
    }

    function drawTagClose($tag)
    {
        $this->tagLevel--;
        echo str_repeat('  ', $this->tagLevel) . "</$tag>\r";
    }

    function drawNode(&$node, $last=false)
    {
        $node->name = $this->fromUTF8($node->name);
        $node->comment = $this->fromUTF8($node->comment);

        if ($this->wantLoadChildren($node))
        {
            $this->tree->loadLinks($node);
        }

        $break = false;
        array_push($this->nodes, $node->id);
        $this->drawNodeOpen($node, $last);
        $break = $this->drawChildren($node);
        $this->drawNodeClose($node);
        array_pop($this->nodes);
        return $break;
    }

    function drawChildren(&$node)
    {
        $count = $node->childrenCount();

        foreach ($node->getChildren() as $child)
        {
            $count--;

            if ($child->type)
            {
                continue;
            }

            if ($child->type_flag=='n')
            {
                if (!$this->drawNode($child, $count==0))
                {
                    return false;
                }
            }
            else
            {
                $child->ignoreHits = false;
                $child->origURL = $child->url;

                if ($this->switches['hits'])
                {
                    $child->ignoreHits =
                        strlen($child->url)
                        &&
                        (
                            $child->url[0]=='j' && strpos($child->url,'javascript:')!==false
                            ||
                            $child->url[0]=='m' && strpos($child->url,'mailto:')!==false
                        );

                    if ($child->id && !$child->ignoreHits)
                    {
                        $child->url = 'go.php?id='.$child->id;
                    }
                }

                if ($this->switches['len']!==null)
                {
                    $child->comment = substr($child->comment, 0, $this->switches['len']);
                }

                $child->name = $this->fromUTF8($child->name);
                $child->comment = $this->fromUTF8($child->comment);

                $this->drawLink($node, $child, $count==0);
                $this->countLinks++;

                if ($this->switches['max'] !==null && $this->countLinks == $this->switches['max'])
                {
                    return false;
                }
            }
        }

        return true;
    }

/*** Loader functions ***/

    function transform()
    {
        if ($this->switches['flat'])
        {
            $newRoot = new SB_Tree_Node(array());

            // Use the root node if selected
            if ($this->switches['root'])
            {
                $newRoot->name = $this->root->_nodes[0]->name;
                $newRoot->comment = $this->root->_nodes[0]->comment;
            }
            $this->collectNode($this->root, $newRoot);
            $this->root = $newRoot;
            if ($this->tree->sortMode)
            {
                $this->sortLinks($this->tree->sortMode);
            }
        }
    }

    function sortLinks($sortMode)
    {
        // It is ugly that we touch private property of a Node, but it is so cute here :-)
        usort($this->root->_links, array($this, "sortLinks_" . $sortMode));
    }

    function sortLinks_abc($a, $b)
    {
        return strcmp($a->name, $b->name);
    }

    function sortLinks_added($a, $b)
    {
        return strcmp($b->added, $a->added);
    }

    function sortLinks_changed($a, $b)
    {
        return strcmp($b->changed, $a->changed);
    }

    function sortLinks_visited($a, $b)
    {
        return strcmp($b->visited, $a->visited);
    }

    function sortLinks_tested($a, $b)
    {
        return strcmp($b->tested, $a->tested);
    }

    function sortLinks_waiting($a, $b)
    {
        return intval($b->sort_info) - intval($a->sort_info);
    }

    function sortLinks_hits($a, $b)
    {
        return intval($b->hits) - intval($a->hits);
    }

    function collectNode(&$node, &$collector)
    {
        foreach ($node->getChildren() as $child)
        {
            if ($child->type_flag=='n')
            {
                $this->collectNode($child, $collector);
            }
            else
            {
                $collector->addLink($child);
            }
        }

        return true;
    }

    /***/

    function wantLoadChildren(&$node) { return true; }
    function drawContentType() {}
    function drawHead() {}
    function drawNodeOpen(&$node, $last=false) {}
    function drawNodeClose(&$node) {}
    function drawLink(&$node, &$link, $last=false) {}
    function drawFoot() {}
}

class SB_WriterInterfaceXML extends SB_WriterInterface
{
    function __construct()
    {
        parent::__construct();
    }

    function quoteAtt($value)
    {
        // XML entities: &lt; &gt; &amp; &apos; &quot;

        if ( preg_match('/[&<>\'"]/',$value) )
        {
            $entity = array('&amp;','&lt;','&gt;','&apos;','&quot;');
            $char   = array('&','<','>','\'','"');
            $value = str_replace($entity, $char, $value);
            $value = str_replace($char, $entity, $value);
        }

        return $value;
    }

    function quoteText($value)
    {
        return '<![CDATA[' . $value . ']]>';
    }

    function getExtension()
    {
        return ".xml";
    }

    function drawContentType()
    {
        header('Content-Type: application/xml; charset=utf-8');
    }
}

?>
