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

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/usermanager.inc.php');

$um = SB_UserManager::staticInstance();

// If we are called the first time, without params and without cookies
if (!isset($_GET['url']) && !isset($_GET['lang']))
{
    SB_Skin::set($um->getParam('user','skin'));

    $url = $um->getParamB64('config','integrator_url');
    $url .= '?lang=' . $um->getParam('user','lang');
    $url .= '&skin=' . SB_Skin::get();
    $url .= '&version='. SB_CURRENT_RELEASE;
    $url .= '&url='. SB_Page::absBaseUrl();
    $url .= '&popup_params='. $um->getParam('user','popup_params');

    // Redirect to the central URL, or to the own URL with the information
    header('Location: ' . $url);
    exit;
}

// Now we have the information, we are on the right page and we will use cookies
// We will redirect using META tag later on to support all browsers
if (isset($_GET['url']))
{
    foreach (array('skin','version','url','popup_params') as $key)
    {
        $cookieName = 'sbi_'.$key;
        $_COOKIE[$cookieName] = $_REQUEST[$key];
        setcookie($cookieName, $_REQUEST[$key]);
    }
}

SB_Page::absBaseUrl($_COOKIE['sbi_url']);
SB_Skin::set($_COOKIE['sbi_skin']);
if (preg_match('/^\w+/', $_GET['lang']))
{
    SB_SetLanguage($_GET['lang']);
}
// $um->setParam('user',$_COOKIE['popup_params']);

if (isset($_REQUEST['install']))
{
    IEInstall();
    exit;
}

if (isset($_REQUEST['search_engine']))
{
    SearchEngine();
    exit;
}

// Redirect and keep cookies
$meta = null;
if (isset($_GET['url']))
{
    $meta = '<meta http-equiv="refresh" content="0;url=integrator.php?lang='.SB_GetLanguage().'">';
}

SB_Page::head('Integrator', 'siteBarIndex', null, null, $meta);

if (isset($_GET['url']))
{
    exit;
}

// Include skin hook file
include_once(SB_Skin::path().'/hook.inc.php');
$hook = new SB_Hook();

$sponsor = new SB_SponsorInterface($hook);
$file = './inc/sponsor.inc.php';
if (is_file($file))
{
    include_once($file);
    $sponsor = new SB_Sponsor($hook);
}

$browser = SB_reqVal('browser');

$browsers = array
(
    'firefox' => array
    (
        'label'    =>'Mozilla Firefox',
        'homepage' =>'http://www.mozilla.org/products/firefox/',
        'platforms'=>'9.0/All',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('sitebar_client','sitebar','hotlist','livebookmarks','search_engine','iframe','google'),
    ),
    'konqueror' => array
    (
        'label'    =>'Konqueror',
        'homepage' =>'http://www.konqueror.org/',
        'platforms'=>'3.x/Linux',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('sidebar_konqueror','iframe','google'),
    ),
    'opera' => array
    (
        'label'    =>'Opera Web Browser',
        'homepage' =>'http://www.opera.com/',
        'platforms'=>'9.5/WinXP',
        'usage' => SB_P('integrator::usage_opera'),
        'exclude'  =>array('dir'),
        'extra'  =>array('hotlist','iframe','google'),
    ),
    'msie' => array
    (
        'label'    =>'Microsoft Internet Explorer',
        'homepage' =>'http://www.microsoft.com/windows/ie/default.mspx',
        'platforms'=>'8.0/Windows',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('install', 'uninstall', 'searchbar','iframe','google'),
    ),
    'maxthon' => array
    (
        'label'    =>'Maxthon Tabbed Browser',
        'homepage' =>'http://www.maxthon.com/',
        'platforms'=>'1.1.120/WinXP',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('maxthon_sidebar','maxthon_toolbar','iframe','google'),
    ),
    'other' => array
    (
        'label'    =>'Linux Distro/Other Tools',
        'homepage' =>'',
        'platforms'=>'Gentoo,Debian/PHP Layers Menu',
        'usage' => '',
        'exclude'  =>array('dir','window','popup','addpage'),
        'extra'  =>array('gentoo','debian','phplm'),
    ),
);

$bookmarklet = "javascript:var w=window;var d=w.document;var cp=d.characterSet?d.characterSet:d.charset;".
    "w.open('" . SB_Page::absBaseUrl() . "command.php?command=Add%20Bookmark".
    "&amp;url='+escape(w.location.href)+'".
    "&amp;name='+escape(d.title)+".
    "(cp?'&amp;cp='+cp:''),'sbBmkWin','".
    $um->getParamB64('user','popup_params')."');void(0)";

$popup = "javascript:window.open('".SB_Page::absBaseUrl()."index.php" .
    "?target=_blank','sbPopWin',".
    "'directories=no,width=220,height=600,left=0,top=0,scrollbars=yes,location=no,menubar=no, status=no, toolbar=no');void(0)";

$urlParts = parse_url(SB_Page::absBaseUrl());
$uniqName = preg_replace("/[^\w]*/", "", $urlParts['host']);

$extra = array
(
    'sitebar_client' => array
    (
        'label' => 'SiteBar Client',
        'url' => 'https://addons.mozilla.org/firefox/3605/',
        'desc' => SB_P('integrator::hint_sitebar'),
    ),

    'livebookmarks' => array
    (
        'label' => 'Live Bookmarks',
        'url' => sprintf('%sindex.php?w=firefox&amp;mode=download', SB_Page::absBaseUrl()),
        'desc' => SB_P('integrator::hint_livebookmarks'),
    ),

    'sidebar' => array
    (
        'label' => 'Sidebar',
        'url' => sprintf("javascript:sidebar.addPanel('SiteBar','%sindex.php','')",SB_Page::absBaseUrl()),
        'desc' => SB_P('integrator::hint_sidebar'),
    ),

    'search_engine' => array
    (
        'label' => 'Add Search Engine',
        'url' => sprintf("javascript:void(window.sidebar.addSearchEngine('%s', '%s', '%s', '%s'))",
                    SB_Page::absBaseUrl().'integrator.php?lang='.SB_GetLanguage() . '&amp;search_engine=/sitebar'.$uniqName.'.src',
                    SB_Page::absBaseUrl().''.SB_Skin::imgsrc('root_transparent').'?rename=/sitebar'.$uniqName.'.png',
                    strlen($um->getParamB64('config','feed_root_name'))?$um->getParamB64('config','feed_root_name'):'SiteBar',
                    SB_T("Bookmarks")),
        'desc' => SB_P('integrator::hint_search_engine'),
    ),

    'sidebar_mozilla' => array
    (
        'label' => 'Sidebar',
        'url' => sprintf("javascript:sidebar.addPanel('SiteBar','%sindex.php','')",SB_Page::absBaseUrl()),
        'desc' => SB_P('integrator::hint_sidebar_mozilla'),
    ),

    'sidebar_konqueror' => array
    (
        'label' => 'Sidebar',
        'url' => null,
        'desc' => SB_P('integrator::hint_sidebar_konqueror', SB_Page::absBaseUrl()),
    ),

    'hotlist' => array
    (
        'label' => 'Add to Panel',
        'url' => SB_Page::absBaseUrl().'index.php',
        'params' => array('title'=>'SiteBar', 'rel'=>'sidebar'),
        'desc' => SB_P('integrator::hint_hotlist'),
    ),

    'install' => array
    (
        'label' => 'Install',
        'url' => 'integrator.php?lang='.SB_GetLanguage() . '&amp;install=1',
        'desc' => SB_P('integrator::hint_install'),
    ),

    'uninstall' => array
    (
        'label' => 'Uninstall',
        'url' => 'integrator.php?lang='.SB_GetLanguage() . '&amp;install=0',
        'desc' => SB_P('integrator::hint_uninstall'),
    ),

    'searchbar' => array
    (
        'label' => 'Show in Search Bar',
        'url' => sprintf("javascript:void(_search=open('%sindex.php','_search'))", SB_Page::absBaseUrl()),
        'desc' => SB_P('integrator::hint_searchbar'),
    ),

    'maxthon_sidebar' => array
    (
        'label' => 'Sidebar Plugin',
        'url' => sprintf("http://sitebar.org/plugin/maxthon/?sidebar=%s", SB_Page::absBaseUrlShort()),
        'desc' => SB_P('integrator::hint_maxthon_sidebar'),
    ),

    'maxthon_toolbar' => array
    (
        'label' => 'Toolbar Plugin',
        'url' => sprintf("http://sitebar.org/plugin/maxthon/?toolbar=%s", SB_Page::absBaseUrlShort()),
        'desc' => SB_P('integrator::hint_maxthon_toolbar'),
    ),

    'gentoo' => array
    (
        'label' => 'Gentoo Ebuild',
        'url' => 'http://www.gentoo-portage.com/www-apps/sitebar',
        'desc' => SB_P('integrator::hint_gentoo'),
    ),

    'debian' => array
    (
        'label' => 'Debian',
        'url' => 'http://packages.debian.org/unstable/web/sitebar',
        'desc' => SB_P('integrator::hint_debian'),
    ),

    'phplm' => array
    (
        'label' => 'PHP Layers Menu',
        'url' => 'http://phplayersmenu.sourceforge.net/',
        'desc' => SB_P('integrator::hint_phplm', sprintf('%sindex.php?w=phplm', SB_Page::absBaseUrl())),
    ),

);

$general = array
(
    'addpage' => array
    (
        'label' => 'Add Page to SiteBar',
        'url' => $bookmarklet,
        'desc' => SB_P('integrator::hint_addpage'),
    ),

    'window' => array
    (
        'label' => 'SiteBar',
        'url' => SB_Page::absBaseUrl().'index.php',
        'desc' => SB_P('integrator::hint_window'),
    ),
    'dir' => array
    (
        'label' => 'SiteBar Directory',
        'url' => SB_Page::absBaseUrl().'index.php?w=dir',
        'desc' => SB_P('integrator::hint_dir'),
    ),
    'popup' => array
    (
        'label' => 'SiteBar Pop-up',
        'url' => $popup,
        'desc' => SB_P('integrator::hint_popup'),
    ),
    'iframe' => array
    (
        'label' => 'SiteBar iframe',
        'url' => SB_Page::absBaseUrl().'iframe.php',
        'desc' => str_replace('<IFRAME>','&lt;IFRAME&gt;',
                      SB_P('integrator::hint_iframe', array(SB_Page::absBaseUrl().'iframe.php'))),
    ),
    'google' => array
    (
        'label' => 'Google Widget',
        'url' => SB_Page::absBaseUrl().'google.php',
        'desc' => SB_P('integrator::hint_google', array(SB_Page::absBaseUrl().'google.php')),
    ),
);

?>

<div id="main">
<div id="launcher">

  <div>
    <div id="home">
      <a href="http://sitebar.org/"><img alt="" title="<?php echo SB_T('SiteBar Homepage')?>" src="<?php echo SB_Skin::imgsrc('logo')?>"></a>
      <br>
      [<a href="http://sitebar.org/"><?php echo SB_T('SiteBar Homepage')?></a>]
    </div>

    <div id="tip"><?php echo SB_P('integrator::welcome')?></div>
  </div>

  <div>

    <h2><?php echo SB_T('SiteBar Integrator')?></h2>
    <p>
<?php

        echo SB_P('integrator::header');
?>
    </p>
    <table>
        <tr>
            <th><?php echo SB_T('Browser/Category')?></th>
            <th colspan="2"><?php echo SB_T('Version/Platform')?></th>
        </tr>
<?php
    $lang = SB_GetLanguage();

    foreach ($browsers as $id => $param)
    {
        echo "<tr>\r";
            echo "<td><a".($browser == $id?" class=\"selected\"":"")." href=\"integrator.php?lang=$lang&amp;browser=$id\" title=\"".SB_T('Integration Instructions')."\">".SB_T($param['label'])."</a></td>\r";
            echo "<td>${param['platforms']}</td>\n";
            echo "<td>";
            if (isset($param['homepage']) && $param['homepage']!='')
            {
                echo "[<a href=\"${param['homepage']}\">Homepage</a>]";
            }
            else
            {
                echo "&nbsp;";
            }
            echo "</td>\r";
        echo "</tr>\r";
    }

?>
    </table>

    <p class="comment">
<?php
        if ($browser == '')
        {
            echo SB_P('integrator::hint');
        }
        else
        {
            echo '<a href="integrator.php?lang='.SB_GetLanguage().'">'.SB_T('Usage Tips for All Browsers').'</a>';
        }
?>
    </p>

    <h2>
<?php
        if ($browser == '')
        {
            echo SB_T('Usage Tips for All Browsers');
        }
        else
        {
            echo SB_T('Usage/Integration Tips for %s', array($browsers[$browser]['label']));
        }
?>
    </h2>
<?php

        if ($browser != '')
        {
            if ( $browsers[$browser]['usage'] != '')
            {
                echo '<p class="browsertip">'."\r".
                     $browsers[$browser]['usage'].
                     "</p>\r";
            }
        }

?>

    <table id="tips">
        <tr>
            <th class="tip"><?php echo SB_T('Tip')?></th>
            <th class="desc"><?php echo SB_T('Description')?></th>
        </tr>
<?php

    foreach ($extra as $id => $params)
    {
        if (!isset($browsers[$browser]['extra']) || !in_array($id, $browsers[$browser]['extra']))
        {
            continue;
        }

        $urlparams = '';
        if (isset($params['params']))
        {
            foreach ($params['params'] as $att => $val)
            {
                $urlparams .= " $att='" . $val . "'";
            }
        }

        echo "<tr>\n";
            if ($params['url'])
            {
                echo "<td class='extra'><a $urlparams href=\"${params['url']}\">".SB_T($params['label'])."</a></td>\n";
            }
            else
            {
                echo "<td class='extra'>".SB_T($params['label'])."</td>\n";
            }
            echo "<td class='desc'>${params['desc']}</td>\n";
        echo "</tr>\n";
    }

    foreach ($general as $id => $params)
    {
        if (isset($browsers[$browser])
        &&  isset($browsers[$browser]['exclude'])
        &&  in_array($id, $browsers[$browser]['exclude']))
        {
            continue;
        }

        echo "<tr>\r";
            if ($params['url'])
            {
                echo "<td class=\"general\"><a href=\"${params['url']}\">".SB_T($params['label'])."</a></td>\r";
            }
            else
            {
                echo "<td class=\"general\">".SB_T($params['label'])."</td>\r";
            }
            echo "<td class=\"desc\">${params['desc']}</td>\r";
        echo "</tr>\r";
    }

?>
    </table>
    <p class="comment">
<?php

        echo SB_P('integrator::hint_bookmarklet');
?>
    </p>
  </div>
</div>
<div id="trailer">
    <?php echo SB_P('integrator::copyright3') ?>
</div>
</div>
<div id="sponsorIntegratorVerticalRight"><?php $sponsor->integratorVerticalRight(); ?></div>

<?php
SB_Page::foot();

function IEInstall()
{
    $install = $_REQUEST['install'];

    $code     = '{3F218DFB-00FF-297C-4D54-57696C4A6F6F}';
    $title    = 'SiteBar';
    $url      = SB_Page::absBaseUrl().'index.php';
    $reg      = '';
    $filename = '';
    $ctxUrl   = SB_Page::absBaseUrl().'ctxmenu.php';

    require_once('./inc/converter.inc.php');

    $charsetKey = 'Charset in MS Windows';
    $c = new SB_Converter(!$um || $um->getParam('config','use_conv_engine'),
        (SB_T($charsetKey)==$charsetKey?null:SB_T($charsetKey)));

    $addLink = $c->fromUTF8(SB_T('Add Link to SiteBar'));
    $addPage = $c->fromUTF8(SB_T('Add Page to SiteBar'));

    if ($install)
    {
        $filename = "InstallSiteBar.reg";

// See http://msdn.microsoft.com/workshop/browser/ext/tutorials/explorer.asp

        $reg = <<<__INSTALL
REGEDIT4

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code]
@="$title"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Implemented Categories]

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Implemented Categories\\{00021493-0000-0000-C000-000000000046}]

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\InProcServer32]
@="shdocvw.dll"
"ThreadingModel"="Apartment"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Instance]
"CLSID"="{4D5C8C2A-D075-11d0-B416-00C04FB90376}"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Instance\\InitPropertyBag]
"Url"="$url"

[-HKEY_CURRENT_USER\\Software\\Classes\\Component Categories\\{00021493-0000-0000-C000-000000000046}\\Enum]

[-HKEY_CURRENT_USER\\Software\\Classes\\Component Categories\\{00021494-0000-0000-C000-000000000046}\\Enum]

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addLink]
"Contexts"=hex:22
"Flags"=hex:01
@="$ctxUrl?add=link"

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addPage]
"Contexts"=hex:01
"Flags"=hex:01
@="$ctxUrl?add=page"

[HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Internet Explorer\\Explorer Bars\\$code]
"BarSize"=hex:B4
"Name"="$title"

[HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Internet Explorer\\Extensions\\{23F5C49C-74DF-42BA-A194-FF92A3B59FED}]
"ButtonText" = "SiteBar"
"MenuText" = "SiteBar Panel"
"MenuStatusBar"="Display SiteBar Panel"
"Icon" = hex(2):25,53,79,73,74,65,6d,52,6f,6f,74,25,5c,73,79,73,74,65,6d,33,32,5c,73,68,65,6c,6c,33,32,2e,64,6c,6c,2c,31,37,33,00
"HotIcon" = hex(2):25,53,79,73,74,65,6d,52,6f,6f,74,25,5c,73,79,73,74,65,6d,33,32,5c,73,68,65,6c,6c,33,32,2e,64,6c,6c,2c,31,37,33,00
"CLSID" = "{E0DD6CAB-2D10-11D2-8F1A-0000F87ABD16}"
"BandCLSID" = "$code"
"Default Visible"="Yes"
__INSTALL;
    }
    else
    {
        $filename = 'UnInstallSiteBar.reg';
        $reg = <<<__UNINSTALL
REGEDIT4

[-HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code]
[-HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Internet Explorer\\Explorer Bars\\$code]
[-HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Internet Explorer\\Extensions\\{23F5C49C-74DF-42BA-A194-FF92A3B59FED}]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\Add Link to SiteBar]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\Add Page to SiteBar]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addLink]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addPage]
__UNINSTALL;
    }

    header('Content-Type: application/octet-stream'."\r");
    header('Content-Disposition: attachment; filename="'.$filename."\"\r");
    header('Content-Transfer-Encoding: binary'."\r");
    header('Content-Length: ' . strlen($reg)."\r");
    echo $reg;

    exit;
}

function SearchEngine()
{
    $um = SB_UserManager::staticInstance();

    $name = $um->getParamB64('config','feed_root_name');

    if (!strlen($name))
    {
        $name = 'SiteBar';
    }

?>
# SiteBar plug-in

<search
   name="<?php echo $name ?>"
   description="<?php echo SB_T('Search in SiteBar Bookmarks') ?>"
   method="GET"
   action="<?php echo SB_Page::absBaseUrl() ?>search.php"
   searchForm="<?php echo SB_Page::absBaseUrl() ?>index.php"
>

<input name="q" user>
<input name="sourceid" value="sitebar-search">

</search>
<?php
    exit;
}

?>
