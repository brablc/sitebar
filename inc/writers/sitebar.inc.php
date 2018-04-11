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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['sitebar'] = 'SiteBar Tree Default';

require_once('./inc/writer.inc.php');
require_once('./inc/page.inc.php');

/******************************************************************************/

class SB_Writer_sitebar extends SB_WriterInterface
{
    var $linkMenu;
    var $nodeMenu;
    var $nodeDragMenu;
    var $linkDragMenu;
    var $userMenu;
    var $um;
    var $tree;
    var $hook;
    var $expandedNodes;
    var $treearr = array();

    var $iconnect;
    var $iempty;
    var $ijoin;
    var $ijoinl;
    var $ilink;
    var $ilinkp;
    var $ifeed;
    var $nmenu = null;
    var $lmenu = null;

    var $sortMode;
    var $useHitCounter = false;
    var $useToolTips = false;
    var $showACL;

    var $linkCount = 0;
    var $nodeCount = 0;
    var $loadOpenNodesOnly = true;

    var $appError = null;

    function __construct()
    {
        parent::__construct();

        if ($this->switches['hits']
        &&  !$this->um->isAnonymous())
        {
            $this->switches['shorten'] = true;
        }
    }

    function setOutputHandler()
    {
        // If we want to use compression and it is not used yet
        if ($this->um->getParam('config','use_compression')
        &&  !@ini_get('zlib.output_compression'))
        {
            ob_start('ob_gzhandler');
        }
    }

    function appError($msg, $arg=null)
    {
        $this->appError = $this->formatError($msg, $arg);
    }

    function allowAnonymous()
    {
        return true;
    }

    function run()
    {
        if ($this->um->getParam('user','load_all_nodes'))
        {
            $this->loadOpenNodesOnly = false;
        }

        $this->expandedNodes = $this->getExpandedNodes('SB3NODES');

        if (SB_safeVal($_REQUEST,'reload') == 'all')
        {
            // Temporarily disable hiding of folders
            $this->um->hiddenFolders = array();
            $this->loadOpenNodesOnly = false;
        }
        else
        {
            // Collapsed nodes will not load child nodes
            if ($this->loadOpenNodesOnly)
            {
                $this->tree->expandedNodes =& $this->expandedNodes;
            }
        }

        $useNiceUrl = $this->um->getParam('config','use_nice_url');

        $this->nodeMenu = array
        (
            array('name'=>'Add Bookmark','acl'=>'*i'),
            array('name'=>'Add Folder','acl'=>'*i'),
            array('name'=>'Browse Folder','acl'=>'*',
                'href'=>($useNiceUrl?'dir/':'index.php?w=dir&amp;root=').'cookie'),
            array('name'=>'Mark as Default','acl'=>'*i','callback'=>'SB_markDefault','optional'=>true),
            array('name'=>'All Bookmarks','acl'=>'*',
                'href'=>($useNiceUrl?'dir/':'index.php?w=dir&amp;flat=1&amp;root=').'cookie'.($useNiceUrl?'/flat':''),'optional'=>true),
            array('name'=>'Bookmark News','acl'=>'*',
                'href'=>($useNiceUrl?'news/':'news.php?root=').'cookie','optional'=>true),
            null,
            array('name'=>'Hide Folder','acl'=>'*','callback'=>'SB_nodeHide','optional'=>true),
            array('name'=>'Unhide Subfolders','acl'=>'*','optional'=>true),
            array('name'=>'Folder Properties','acl'=>'*u'),
            array('name'=>'Folder Sharing','acl'=>'*'),
            array('name'=>'Delete Folder','acl'=>'*d'),
            array('name'=>'Purge Folder','acl'=>'d','optional'=>true),
            array('name'=>'Undelete','acl'=>'i','optional'=>true),
            null,
            array('name'=>'Copy','acl'=>'*','callback'=>'SB_nodeCopy'),
            array('name'=>'Paste','acl'=>'*i_c'),
            null,
            array('name'=>'Import Bookmarks','acl'=>'*i'),
            array('name'=>'Export Bookmarks','acl'=>'*'),
        );

        $this->linkMenu = array
        (
            array('name'=>'Email Bookmark'),
            array('name'=>'Copy Bookmark','callback'=>'SB_linkCopy'),
            array('name'=>'Delete Bookmark','acl'=>'d'),
            null,
            array('name'=>'Properties','acl'=>'u')
        );

/* TODO
        $this->nodeDragMenu = array
        (
            array('name'=>'Move Into','acl'=>'*i_c'),
            array('name'=>'Move Contents Into','acl'=>'*i_c'),
            array('name'=>'Copy Into','acl'=>'*i_c'),
            array('name'=>'Copy Contents Into','acl'=>'*i_c'),
            null,
            array('name'=>'Move Before','acl'=>'*Z'),
            array('name'=>'Move After','acl'=>'*Z')
        );

        $this->linkDragMenu = array
        (
            array('name'=>'Move Into'),
            array('name'=>'Copy Into'),
            null,
            array('name'=>'Move Before'),
            array('name'=>'Move After')
        );
*/

        if ($this->um->setupDone)
        {
            $this->userMenu = array
            (
                array('name'=>'Log In'),
                array('name'=>'Sign Up'),
                array('name'=>'User Settings'),
                array('name'=>'Session Settings'),
                array('name'=>'Private Messages','href'=>'messenger.php'),
                array('name'=>'Verify Email'),
                null,
                array('name'=>'SiteBar Settings'),
                array('name'=>'Maintain Trees'),
                array('name'=>'Maintain Users'),
                array('name'=>'Maintain Groups'),
                null,
                array('name'=>'Open Integrator','href'=>'integrator.php'),
                array('name'=>'Bookmark News','href'=>'news.php'),
                null,
                array('name'=>'Contact Admin'),
                array('name'=>'Help'),
                array('name'=>'Log Out'),
            );
        }
        else
        {
            $this->userMenu = array
            (
                array('name'=>'Set Up'),
                array('name'=>'Help')
            );
        }

        // Check if we have additional commands
        foreach ($this->um->plugins as $plugin)
        {
            if (isset($plugin['context']) && $plugin['context'])
            {
                $execute = $plugin['prefix'] . 'Context';
                $execute($this->nodeMenu, $this->linkMenu, $this->userMenu);
            }
        }

        $this->iconnect = SB_Skin::img('connect');
        $this->iempty   = SB_Skin::img('empty');
        $this->ijoin    = SB_Skin::img('join');
        $this->ijoinl   = SB_Skin::img('join_last');
        $this->ilink    = SB_Skin::img('link');
        $this->ilinkp   = SB_Skin::img('link_private');
        $this->ifeed    = SB_Skin::img('feed');

        if ($this->um->getParam('user','menu_icon'))
        {
            $this->lmenu = '<img class="menu" src="'.SB_Skin::imgsrc('menu') . '" onclick="return SB_menuOn(event,this.parentNode);" alt="">';
            $this->nmenu = '<img class="menu" src="'.SB_Skin::imgsrc('menu') . '" onclick="return SB_menuOn(event,this.parentNode.parentNode.parentNode);" alt="">';
        }

        $this->sortMode = $this->um->getParam('user','link_sort_mode');
        $this->useHitCounter = $this->um->getParam('config','use_hit_counter');
        $this->useToolTips = $this->um->getParam('user','use_tooltips') && !SB_Page::isIPHONE();
        $this->showACL = $this->um->getParam('user','show_acl');
        if ($this->um->getParam('user','use_new_window'))
        {
            SB_Page::target('_blank');
        }

        if (!$this->useHitCounter)
        {
            if (!in_array($this->sortMode,array('abc','changed')))
            {
                $this->sortMode = 'abc';
            }
        }

        $this->setOutputHandler();
        parent::run();
    }

    function getExpandedNodes($cookieName)
    {
        $states = null;
        $nodes = array();

        if (isset($_COOKIE[$cookieName]))
        {
            $states = explode(':', $_COOKIE[$cookieName]);

            // Remove last element that is either marker ! or possibly incomplete
            array_pop($states);

            while ($node = array_pop($states))
            {
                $nodes[substr($node,1)] = $node{0};
            }
        }

        if ($this->switches['root'])
        {
            $nodes[$this->switches['root']] = 'Y';
        }

        $states = '';
        foreach ($nodes as $node => $val)
        {
            if ($val == 'Y')
            {
                $states .= $val.$node.':';
            }
        }

        $this->um->setCookie($cookieName, $states.'!');

        return $nodes;
    }

    function writeMenu($type, $items)
    {
?>
    <div id="<?php echo $type?>CtxMenu" class="menu">
<?php
        $prevSeparator = true;
        $optional = 0;
        $itemCount = 0;

        for ($i=0; $i<count($items); $i++)
        {
            if ($items[$i] && !$this->um->isAuthorized(SB_safeVal($items[$i],'name')))
            {
                continue;
            }

            if ($prevSeparator && !$items[$i])
            {
                continue;
            }

            $prevSeparator = ($items[$i]?false:true);

            if (SB_safeVal($items[$i],'optional',false))
            {
                $optional++;
            }

            $this->writeMenuItem($type.'menuItem'.($itemCount++), $items[$i]);
        }

        if ($optional)
        {
            echo '<div class="item more" onmouseover="SB_showOptional(\''.$type.'\',this);" x_acl="*">';
            echo SB_Skin::img("more");
            echo '</div>'."\n";
        }
?>
    </div>
<?php
    }

    function writeMenuItem($id, &$itemArray)
    {
        static $expertMode = null;

        if ($expertMode===null)
        {
            $expertMode = $this->um->getParam('user','expert_mode');
        }

        $command = SB_safeVal($itemArray,'name');
        $link = SB_safeVal($itemArray,'href');
        $callback = SB_safeVal($itemArray,'callback');
        $acl = SB_safeVal($itemArray,'acl');
        $optional = SB_safeVal($itemArray,'optional',false);
        $more = SB_safeVal($itemArray,'more',false);

        $class = 'item';
        if (!$command)
        {
            $class.= ' separator';
        }
        else if ($optional&&!$expertMode)
        {
            $class .= ' optional';
        }

        $div = "\t".'<div id="'.$id.'" class="'.$class.'"';

        if ($command)
        {
            $div .= ' onmouseover="SB_itemOn(this);"'.
                    ' onmouseout="SB_itemOff(this);"';
        }

        if ($command && !$link)
        {
            $div .=
                ' onclick="SB_itemDo(this'.($callback?',\''.$callback.'\'':''). ');"'.
                ' x_acl="'.$acl.'"'.
                ' x_cmd="'.$command.'"';
        }
        echo $div . '>';

        if ($link)
        {
            static $target;
            if ($target==null)
            {
                $target = SB_Page::target();
            }

            if (strstr($link,'http')!==0)
            {
                $link= SB_Page::absBaseUrl().$link;
            }

            echo '<a class="menuLink" href="'. $link .'"'. $target .' onclick="if (SB_gCtxMenu) SB_menuOff();">';
        }

        echo SB_T($command);

        if ($command=='Log Out')
        {
            echo ' ('.$this->um->username.')';
        }

        if ($link)
        {
            echo '</a>';
        }

        echo "</div>\r";
    }

    function getExtension()
    {
        return ".html";
    }

    function showChildren(&$node)
    {
        return SB_safeVal($this->expandedNodes,$node->id) == 'Y';
    }

    function wantLoadChildren(&$node)
    {
        return !$this->loadOpenNodesOnly || $this->showChildren($node);
    }

    function drawContentType()
    {
        header('Content-Type: ' . CONTENT_TYPE);
    }

    function drawHeadPage()
    {
        $inPlaceCmds = implode("','", $this->um->inPlaceCommands());

        SB_Page::head(
            null,
            null,
            "SB_initPage( new Array('$inPlaceCmds'));\nSB_gWinPrefs = '".$this->um->getParamB64('user','popup_params')."';",
            "SB_onLoad();",
            '<meta name="viewport" content="width=320, user-scalable=no, minimum-scale=1">'."\n");

        $style = '';

        if (SB_Page::isMSIE())
        {
            //JIGSAW doesn't validate
            $style = ' style="filter: alpha(opacity=50);"';
        }

        echo '<div id="dragNodeIcon"'.$style.'><img class="favicon" src="'.SB_Skin::imgsrc('node').'" alt=""></div>'."\r";
        echo '<div id="dragLinkIcon"'.$style.'><img class="favicon" src="'.SB_Skin::imgsrc('link').'" alt=""></div>'."\r";
        echo '<div id="hidden" class="hidden">'."\r";

        $this->drawJavaScriptData();

        // Optimization for MSIE to keep images in the cache
        if (SB_Page::isMSIE())
        {
            $images = array
            (
                'collapse',
                'connect',
                'empty',
                'filter',
                'join',
                'join_last',
                'link',
                'link_private',
                'link_wrong_favicon',
                'logo',
                'menu',
                'minus',
                'minus_last',
                'node',
                'node_open',
                'plus',
                'plus_last',
                'reload',
                'reload_all',
                'root',
                'root_deleted',
                'root_plus',
                'root_transparent',
                'search'
            );

            foreach ($images as $image)
            {
                echo '    '.SB_Skin::img($image)."\r";
            }
        }

        echo "</div>\r";
    }

    function drawJavaScriptData()
    {
        echo '<div id="sb_label_loading">'.SB_T('Loading ...').'</div>'."\r";
        echo '<div id="sb_absBaseUrl">'.SB_Page::absBaseUrl().'</div>'."\r";
        echo '<div id="sb_relBaseUrl">'.SB_Page::relBaseUrl().'</div>'."\r";
        echo '<div id="sb_skinDir">'.SB_Skin::webPath().'/</div>'."\r";
        $extern = $this->um->getParam('user','extern_commander')?'0':'1';
        echo '<div id="sb_externCommander">'.$extern.'</div>'."\r";
        $defaultSearch = $this->um->getParam('user','default_search');
        echo '<div id="sb_defaultSearch">'.$defaultSearch.'</div>'."\r";
    }

    function drawHeadLogo()
    {
        require_once('./'.SB_Skin::path().'/hook.inc.php');
        $this->hook = new SB_Hook();

        if ($this->um->getParam('user','show_logo'))
        {
            // Include skin hook file
            $this->hook->head();
        }
    }

    function drawToolBar()
    {
        // There must not be any place between the images, therefore
        // those funny tag endings.

        $coloring = 'onmousedown="SB_buttonDown(this);" ' .
                    'onmouseup="SB_buttonUp(this);" ' .
                    'onmouseover="SB_buttonOver(this);'.($this->useToolTips?'SB_toolTip(this,event);':'').'" '.
                    'onmouseout="SB_buttonOut(this);'.($this->useToolTips?'SB_toolTipHide()':'').';"';

        $title = ($this->useToolTips?'x_title':'title');

        $favicon = '';

        if ($this->um->getParam('user','use_search_engine'))
        {
            $favicon = $this->um->getParamB64('user','search_engine_ico');

            if ($this->um->getParam('config','use_favicon_cache'))
            {
                $favicon = SB_Page::cdnBaseUrl()."favicon.php?" . md5($favicon) . '=' . base64_encode($favicon);
            }
        }

        $usefilter = true;
?>
<div id="toolbarPlace" class="hidden"></div>
<div id="toolbar" class="cmnSubTitle">
    <div id="tlbSearch"><input id="fldSearch" class="siteBarPageBackground" type="text"
             onkeyup="SB_storeSearch(this); var e=(event?event:window.event); if (e.keyCode==13) SB_defaultSearch('<?php echo SB_Page::targetWindow() ?>','<?php echo $this->um->getParam('user','default_search_tool') ?>');"
             value="<?php echo SB_safeVal($_COOKIE, 'SB3SEARCH') ?>"><?php if ($usefilter) : ?><img id="btnFilter" src="<?php echo SB_Skin::imgsrc('filter')?>"
             <?php echo $title ?>="<?php echo SB_T('Filter Loaded Bookmarks')?>"
             onclick="SB_filter(true)" <?php echo $coloring?> alt="F"
       ><?php endif; if (!$this->um->getParam('user','hide_xslt') || $this->um->getParam('user','use_search_engine')) :?><a href="<?php echo SB_Page::absBaseUrl() ?>search.php" <?php echo SB_Page::target(); ?>
            ><img id="btnSearch" src="<?php echo SB_Skin::imgsrc('search')?>"
             <?php echo $title ?>="<?php echo SB_T('Backend Bookmark Search')?>"
             <?php echo $coloring?> alt=""
       ></a><?php endif; if ($this->um->getParam('user','use_search_engine')) :?><a href="<?php echo SB_Page::absBaseUrl() ?>search.php?web=1"
             <?php echo SB_Page::target();?>><img id="btnSearchWeb" src="<?php echo $favicon ?>"
             <?php echo $title ?>="<?php echo SB_T('Search Web')?>"
             <?php echo $coloring?> alt=""
      ></a><?php endif;?></div>
      <div id="tlbOther"><img id="btnCollapse" src="<?php echo SB_Skin::imgsrc('collapse')?>"
             <?php echo $title ?>="<?php echo SB_T('Collapse/Expand All')?>"
             onclick="SB_collapseAll();" <?php echo $coloring?> alt=""
       ><?php if ($this->um->getParam('user','use_hiding')) : ?><img id="btnReloadAll" src="<?php echo SB_Skin::imgsrc('reload_all')?>"
             <?php echo $title ?>="<?php echo SB_T('Reload with Hidden Folders')?>"
             onclick="SB_reloadAll();" <?php echo $coloring?> alt=""
       ><?php endif;?><img id="btnReload" src="<?php echo SB_Skin::imgsrc('reload')?>"
             <?php echo $title ?>="<?php echo SB_T('Reload')?>"
             onclick="SB_reloadPage();" <?php echo $coloring?> alt=""
       ></div>
</div>
<?php

        $msgFile = "./inc/message.inc.php";
        if (is_file($msgFile))
        {
            include($msgFile);
        }

        foreach ($this->um->plugins as $plugin)
        {
            if (isset($plugin['message']) && $plugin['message'])
            {
                include($plugin['dir'].'/message.inc.php');
            }
        }

        $messageCountNew = $this->um->messengerGetNewCount();

        if ($messageCountNew!=0)
        {
            $readurl = SB_Page::relBaseUrl().'messenger.php';
            $target  = SB_Page::target();
            $img     = SB_Page::relBaseUrl().'skins/msg_new.gif';
            $message = '';

            if ($messageCountNew == 1)
            {
                $message = SB_T("You have a new message!");
            }
            else
            {
                $message = SB_T("You have %d new messages!", array($messageCountNew));
            }

            echo <<<_DOC
<div class="cmnSubTitle" id="messengerInformation">
<a style="width:100%; color:black; text-decoration:none;" href="$readurl" $target>$message<img src="$img"></a>
</div>
_DOC;
        }

        $groups = $this->um->getPendingGroups();
        if (!$this->um->isAnonymous() && count($groups))
        {
            echo <<<_DOC
<div class="cmnSubTitle" id="pendingInvitation">
_DOC;

            foreach ($groups as $gid => $rec)
            {


                $user = $this->um->getUser($rec['invitator']);
                $message = SB_P('sitebar::invitation', array($user['fullname'], $rec['name']));

                $ahref = SB_Page::absBaseUrl().'command.php?command=Accept Membership&amp;do=yes&amp;gid='. $gid;
                $atext = SB_T('Accept');
                $rhref = SB_Page::absBaseUrl().'command.php?command=Reject Membership&amp;do=yes&amp;gid='. $gid;
                $rtext = SB_T('Reject');
                echo <<<_DOC
<div>
    <table>
        <tr>
          <td class='pendingInvitationLabel'>$message</td>
          <td class='pendingInvitationButtons'>
              <span class='accept'><a href='$ahref'>$atext</a></span><br>
              <span class='reject'><a href='$rhref'>$rtext</a></span>
          </td>
        </tr>
    </table>
</div>
_DOC;

            }
        }

        echo "</div>\n";
    }

    function drawWarning()
    {
        $show = 0;
        $message = '';

        if ($this->um->getParam('config', 'users_must_verify_email')
        &&  !$this->um->isAnonymous()
        &&  !$this->um->demo
        &&  !$this->um->verified
        )
        {
            if ($show)
            {
                $message .= "<p>";
            }

            $show++;

            $message = SB_P("sitebar::users_must_verify_email");
        }

        if ($show)
        {
?>
    <div id="warning">
        <?php echo $message ?>
    </div>
<?php
        }
    }

    function drawHead()
    {
        $this->drawHeadPage();
        if ($this->useToolTips)
        {
?>
<div id="toolTip"></div>
<?php
        }
        $this->writeMenu('node', $this->nodeMenu);
        $this->writeMenu('link', $this->linkMenu);
// TODO       $this->writeMenu('nodeDrag', $this->nodeDragMenu);
// TODO       $this->writeMenu('linkDrag', $this->linkDragMenu);
        $this->drawHeadLogo();

        $this->drawToolBar();
        $this->drawWarning();

        if ($this->appError)
        {
            echo <<<_DOC
<div id="warning">
$this->appError
</div>
_DOC;
        }

        if ($this->switches['user'] && strlen($this->switches['user']))
        {
            $message = SB_T("Hide bookmarks from %s!", $this->switches['user']);
            echo '
<div id="info"><a href="'.SB_Page::absBaseUrl().'?user=">'.$message.'</a></div>
';
        }

        if ($this->um->isAdmin())
        {
            $interval = intval($this->um->getParam('config','version_check_interval'));

            if ($interval>0 && !$this->hasErrors())
            {
                $lastVersionCheck = $this->um->db->getData('version','lastcheck');

                if (!$lastVersionCheck || $lastVersionCheck+$interval<time())
                {
                    require_once('./inc/pageparser.inc.php');

                    $page = new SB_PageParser( "http://sitebar.org/version.php");
                    $lines = $page->getContent();

                    if (!$this->hasErrors())
                    {
                        $this->um->db->setData('version','Version');
                        $this->um->db->setData('version','lastcheck', time());
                        $this->um->db->setData('version','failed_count');
                        foreach ($lines as $line)
                        {
                            if (preg_match("/^(.*)=(.*)$/", $line, $reg))
                            {
                                $this->um->db->setData('version',$reg[1], $reg[2]);
                            }
                        }
                    }
                    else
                    {
                        $errors =& $this->getErrors();
                        // Hide errors
                        $errors = array();

                        echo '<div id="versionCheck">';
                        echo SB_T('Error during version check!');
                        echo '<br>';
                        echo SB_T('Will try in %d hours again.', 6);
                        echo "</div>\r";

                        $this->um->db->setData('version','lastcheck', time()-$interval+60*60*6);
                        $this->um->db->setData('version','failed_count', intval($this->um->db->getData('version','failed_count'))+1);
                    }
                }

                if (!$this->um->db->getData('version','failed_count'))
                {
                    $lastVersion = $this->um->db->getData('version','Version');

                    if ($lastVersion && version_compare(SB_CURRENT_RELEASE, $lastVersion, '<'))
                    {
                        $this->um->db->setData('version','newversion', $lastVersion);
                        echo '<div id="versionCheck">';
                        $link = sprintf(' <a href="%s"'. SB_Page::target() .'>%s</a>',
                            $this->um->db->getData('version','Download URL'), $lastVersion);

                        echo SB_T('New version available') . ': ' . $link;
                        echo '<br>';
                        echo SB_T('Severity') . ': ' . $this->um->db->getData('version','Severity');
                        echo "</div>\r";
                    }
                }
            }
        }
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $showChildren = $this->showChildren($node);

        $node->aclstr = '';

        foreach ($node->getACL() as $right => $value)
        {
            if (!$value) continue;
            list($prefix, $name) = explode('_',$right);
            $node->aclstr .= $name{0};
        }

        if ($node->deleted_by)
        {
            $node->aclstr .= 'p';
        }

        if ($node->isRoot)
        {
            echo '<div class="tree">'."\r";
        }

        $nodename = 'n' . $node->id;

        /* Init images */
        $inode      = SB_Skin::img('node', 'n', $nodename);
        $inodeo     = SB_Skin::img('node_open', 'n', $nodename);
        $iplus      = SB_Skin::img('plus', 's', $nodename);
        $iplusl     = SB_Skin::img('plus_last', 's', $nodename);
        $iminus     = SB_Skin::img('minus', 's', $nodename);
        $iminusl    = SB_Skin::img('minus_last', 's', $nodename);

        $onclick = 'SB_node(event,this.parentNode)';

        if ($this->loadOpenNodesOnly)
        {
            $onclick = 'SB_nodeReload(event,this.parentNode)';
        }

        echo '<div id="' . $nodename . '"'.
             ' class="node"'.
             ' x_level="' . $node->level . '"'.
             ' x_acl="'. $node->aclstr . ($node->deleted_by?'':'*') .'"'.
             '><span'.
             ' onclick="'.$onclick.'"'.
             ' oncontextmenu="return SB_menuOn(event,this.parentNode)">';

        $this->nodeCount++;

        $hasChildren = $node->childrenCount() || (!$showChildren && $this->loadOpenNodesOnly);

        if (!$node->isRoot)
        {
            if ($hasChildren==0)
            {
                $iplus   = $this->ijoin;
                $iplusl  = $this->ijoinl;
                $iminus  = $this->ijoin;
                $iminusl = $this->ijoinl;
            }
            echo implode('',$this->treearr) .
                ($last?($showChildren?$iminusl:$iplusl)
                      :($showChildren?$iminus :$iplus));

            array_push($this->treearr,($last?$this->iempty:$this->iconnect));
        }
        else
        {
            if ($node->deleted_by==null)
            {
                $inodeo = SB_Skin::img('root', 'n', $nodename, 'root');
                if ($hasChildren==0)
                {
                    $inode  = $inodeo;
                }
                else
                {
                    $inode  = SB_Skin::img('root_plus', 'n', $nodename, 'root');
                }
            }
            else
            {
                $inode  = SB_Skin::img('root_deleted', 'n', $nodename, 'root');
                $inodeo = $inode;
            }
        }

        $decorated = $this->showACL && $node->hasACL();

        echo '<a id="a'.$nodename.'" name="n'.$node->id.'"'.
             ($decorated && !$node->isRoot?' class="acl"':'') .
             ($this->useToolTips?SB_Page::toolTip():'').
             ($node->comment?' '.($this->useToolTips?'x_':'').'title="'. $this->quoteAtt($node->comment) . '"':'') .
             ($this->um->getParam('user','menu_icon')?'':SB_Page::dragDropNode($node->id)).
             '>'.
             ($showChildren?$inodeo:$inode) .
             $this->nmenu .
             ($decorated && $node->isRoot?'<span class="acl">':'').
             $this->quoteText($node->name) .
             ($decorated && $node->isRoot?'</span>':'').
             "</a></span>\r".
             '<div id="c'. $nodename.'" class="children'. ($showChildren?'Expanded':'Collapsed') .'">'."\r";
    }

    function drawNodeClose(&$node)
    {
        echo "</div>\r";
        echo "</div>\r";

        if ($node->isRoot)
        {
            if ($node->myTree==SB_TREE_OWN
            &&  !$this->um->isAnonymous()
            &&  !$this->um->getParam('user','has_link'))
            {
                // Hide for other roots
                $this->um->setParam('user','has_link',1);

                // Make copy
                $nodeCopy = $node;
                $this->tree->loadNodes($nodeCopy, true);
                //
                if ($nodeCopy->childrenCount()==0)
                {
                    echo "<div class='tutorial'>\r";
                    echo SB_P('sitebar::tutorial', array(SB_T('Add Bookmark')))."\r";
                    echo "</div>\r";
                }
                else
                {
                    $this->um->saveUserParams();
                }
            }
            echo "</div>\r";
        }
        else
        {
            array_pop($this->treearr);
        }
    }

    function drawChildren(&$node)
    {
        if ($this->switches['flat'])
        {
            echo '<div class="root tree">'."\r";
        }

        $ret = parent::drawChildren($node);

        if ($this->switches['flat'])
        {
            echo "</div>\r";
        }

        return $ret;
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $linkname = 'l' . $link->id;

        echo '<div class="link" id="' . $linkname . '"'.
             ' onclick="return SB_lnk(event,this)"'.
             ' oncontextmenu="return SB_menuOn(event,this)"'.
             ' x_acl="'.$node->aclstr.'"'.
             '>';

        $ifavicon = '';

        if ($link->favicon && $this->um->getParam('user','use_favicons'))
        {
            if ($link->favicon && $this->um->getParam('config','use_favicon_cache'))
            {
                $favurl = SB_Page::cdnBaseUrl() . 'favicon.php?';

                if (substr($link->favicon,0,7) == 'binary:')
                {
                    $favurl .= $link->favicon;
                }
                else
                {
                    $favurl .= md5($link->favicon) . '=' . $link->id;
                }

                $link->favicon = $favurl;
            }

            // No height=16 width=16 - we want to keep the file small.
            $ifavicon ='<img class="favicon" alt="" src="'.$link->favicon.'" onerror="SB_WFI(this);">';
        }
        else
        {
            $ifavicon = $link->private?$this->ilinkp:($link->is_feed?$this->ifeed:$this->ilink);
        }

        if (!$this->switches['flat'])
        {
            echo implode("",$this->treearr) . ($last?$this->ijoinl:$this->ijoin);
        }

        $target = '';

        if ($link->target)
        {
            $target = ' target="'.$link->target.'"';
        }
        else
        {
            if (!$link->ignoreHits)
            {
                $target = ($link->target?$link->target:SB_Page::target());
            }
        }

        $sort_info = '';

        if (strlen($link->sort_info))
        {
            $sort_info = '<span class="sort_info">' . $link->sort_info . '&nbsp;</span>';
        }

        $class = '';

        if ($link->private)
        {
            $class .= ' private';
        }
        if ($link->is_dead)
        {
            $class .= ' dead';
        }

        $toolTip = ($link->comment?substr($link->comment,0,255).(strlen($link->comment)>255?'...':''):$link->origURL);

        echo ($this->lmenu?$ifavicon.$this->lmenu.$sort_info:'') .
             '<a rel="nofollow" id="a'. $linkname .'" '. ($this->useToolTips?'x_':'').'title="'. $this->quoteAtt($toolTip) . '" '.
             ($class?" class=\"$class\"":'') .
             'href="' . $this->quoteAtt($link->url) . '" '.
             'onmousedown="return SB_go(this,'.$link->id .')" '.
             ($this->useToolTips?SB_Page::toolTip():'').
             $target.
             (!$this->switches['flat']?SB_Page::dragDropLink($link->id_parent,$link->id):'').
             '>'.
             ($this->lmenu?'':$ifavicon.$sort_info). $this->quoteText($link->name) . '</a></div>'."\r";

        $this->linkCount++;
    }

    function drawFoot()
    {
        $this->writeMenu('user', $this->userMenu);

        $this->sw->stop();

        $stat = array();

        $timeDb = $this->um->db->sw->elapsed;
        if ($timeDb >= $this->sw->elapsed)
        {
            $timeDb = $this->sw->elapsed - 0.01;
        }


        if ($this->um->getParam('config','show_statistics')
        && (!$this->um->isAnonymous() || $this->um->getParam('config','allow_sign_up')))
        {
            $stat = array
            (
                'links_shown' => $this->linkCount,
                'nodes_shown' => $this->nodeCount,
                'queries' => $this->um->db->count,
                'time_db' => number_format($timeDb,2),
                'time_total' => number_format($this->sw->elapsed,2),
                'time_pct' => intval($timeDb/$this->sw->elapsed*100),
            );

            $this->um->statistics($stat);
            $this->tree->statistics($stat);
        }

        $this->hook->foot($this->um->config['release'].(SB_DEVELOPMENT?'-git':''),$stat,$this->um);

        $sponsor = new SB_SponsorInterface($this->hook);
        $file = './inc/sponsor.inc.php';
        if (is_file($file))
        {
            include_once($file);
            $sponsor = new SB_Sponsor($this->hook);
        }

?>
    <div id="sponsorSitebarBottom"><?php $sponsor->sitebarBottom(); ?></div>
<?php
        if ($this->hasErrors())
        {
            // Cannot be defined by skin
            echo '<div style="margin-top: 50px; color:yellow; background: red;">';
            $this->writeErrors();
            echo '</div>';
        }

        SB_Page::foot();
    }
}
?>
