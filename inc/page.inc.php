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
* Use for emergency process when Base URL is wrongly configured
* On most servers setting to empty string '' should be fine enough to
* enter SiteBar Settings and fix the problem.
*/
define( 'ABS_BASE_URL', null);

define( 'MIN_VERSION',  '4.1.0');
define( 'CHARSET',      'charset=UTF-8');
define( 'CONTENT_TYPE', 'text/html; '.CHARSET);
define( 'STATIC_VERSION', '3.4');

if (!function_exists('version_compare') || version_compare(phpversion(), MIN_VERSION, '<'))
{
    die('Please use at least PHP ' . MIN_VERSION . ' or download SiteBar release 3.0.2!');
}

/******************************************************************************/

if (get_magic_quotes_gpc()) // We need this until PHP 6.0?
{
   function stripslashes_deep($value)
   {
       $value = is_array($value)?array_map('stripslashes_deep', $value):stripslashes($value);
       return $value;
   }

   $_POST = array_map('stripslashes_deep', $_POST);
   $_GET = array_map('stripslashes_deep', $_GET);
   $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
   $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

/******************************************************************************/

function SB_reqVal($name, $mandatory=false, $default='')
{
    $is = SB_reqChk($name);
    if ($mandatory && !$is)
    {
        die('Expected field "'. $name .'" was not filled!');
    }
    return $is?$_REQUEST[$name]:$default;
}

function SB_reqValInt($name, $mandatory=false, $default='')
{
    $is = SB_reqChk($name);
    if ($mandatory && !$is)
    {
        die('Expected field "'. $name .'" was not filled!');
    }
    return $is?intval($_REQUEST[$name]):$default;
}

function SB_setVal($name, $value)
{
    $_REQUEST[$name]=$value;
}

function SB_unsetVal($name)
{
    unset($_REQUEST[$name]);
}

function SB_reqChk($name)
{
    return isset($_REQUEST[$name]);
}

function SB_safePath($include)
{
    // We only allow letters, numbers and space for file paths to be included
    if (!preg_match("/^[a-z0-9_ ]+$/i", $include))
    {
        die('Unsafe path for inclusion: How did you get here?');
    }
}

function SB_redirect($url)
{
    header('Location: ' . SB_Page::absBaseUrl() . $url);
    exit;
}

function SB_handleRootCookie($page='index.php')
{
    if (isset($_GET['root']) && $_GET['root']=='cookie') {
        $url = isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:$_SERVER['REQUEST_URI'];
        header('Location: ' . str_replace('cookie',$_COOKIE['SB3CTXROOT'],$url));
        exit;
    }
}

/******************************************************************************/

class SB_HookInterface extends SB_ErrorHandler
{
    function head()
    {
        // We must have it on one line for MS IE
        echo '<div id="logo"><a href="'.SB_Page::relBaseUrl().'integrator.php" '. SB_Page::target().'><img title="SiteBar Integrator" src="'. SB_Skin::imgsrc('logo').'" alt=""></a></div>'."\r";
    }

    function poweredBy($version, &$um)
    {
?>
    <div id='poweredBy'>
<?php
        $link = '<a href="http://sitebar.org/" target="_blank">%s</a>';
        if ($um->isAnonymous())
        {
            echo sprintf($link,'SiteBar ').sprintf($link,'Bookmark Manager');
        }
        else
        {
            echo SB_T('Powered by %s ver. %s', array("<strong>".sprintf($link,'SiteBar')."</a></strong>",$version));
        }
?>
    </div>
<?php
    }

    function designedBy()
    {
        $this->error('Please override designedBy for your custom skins!');
    }

    function statistics($statistics)
    {
        echo '<div id="stat">'. SB_A('hook::statistics', $statistics).'</div>';
    }

    function foot($version, $statistics, &$um)
    {

?>
<div id="tail">
    <div class="poweredBy">
<?php
        $this->poweredBy($version, $um);
?>
    </div>
    <div class="designedBy">
<?php
        $this->designedBy();
?>
    </div>
</div>
<?php

        if ($statistics)
        {
            $this->statistics($statistics);
        }
    }

    function getStyle($styleID)
    {
        return '';
    }
}

/******************************************************************************/

class SB_SponsorInterface
{
    var $hook = null;

    function __construct(&$hook)
    {
        $this->hook =& $hook;
    }

    function integratorVerticalRight()
    {
    }

    function buildAddLink()
    {
        return '';
    }

    function sitebarBottom()
    {
    }
}

/******************************************************************************/

class SB_Skin extends SB_ErrorHandler
{
    var $current = 'Modern';

    public static function & staticInstance()
    {
        static $skin = null;
        if (!$skin)
        {
            $skin = new SB_Skin();
        }

        return $skin;
    }

    public static function get()
    {
        $i =& SB_Skin::staticInstance();
        return $i->current;
    }

    public static function set($skin)
    {
        if ($skin)
        {
            static $i = null;
            if (!$i) $i =& SB_Skin::staticInstance();

            SB_safePath($skin);

            $dirName = './skins/' . $skin;

            if (is_dir($dirName) && is_file($dirName.'/hook.inc.php'))
            {
                $i->current = $skin;
            }
        }
    }

    public static function img($filename, $prefix='', $id='', $class=null)
    {
        $imgid = '';

        if ($prefix)
        {
            $imgid = ' id="i' . $prefix . $id . '"';
        }

        return '<img'.($class?' class="'.$class.'"':'') . $imgid .
               ' src="'. SB_Skin::imgsrc($filename) .'" alt="">';
    }

    public static  function imgsrc($filename)
    {
        return SB_Skin::webPath() . '/' . $filename . '.png';
    }

    public static function src($filename='')
    {
        return SB_Skin::webPath() . ($filename?'/':'') . $filename;
    }

    public static function path()
    {
        return 'skins/'. SB_Skin::get();
    }

    public static function webPath()
    {
        return SB_Page::cdnBaseUrl() . 'skins/'. rawurlencode(SB_Skin::get());
    }
}

class SB_Page extends SB_ErrorHandler
{
    public static function title()
    {
        return 'SiteBar';
    }

    // Backward compatibility
    public static function baseurl($override=null)
    {
        return SB_Page::absBaseUrlShort($override);
    }

    public static function absBaseUrlShort($override=null)
    {
        $url = SB_Page::absBaseUrl($override);
        return substr($url,0,strlen($url)-1);
    }

    public static function absBaseUrl($override=null)
    {
        static $url = null;

        if ($override!==null)
        {
            $url = $override;
        }

        global $SITEBAR;
        if (isset($SITEBAR['baseurl']) && $SITEBAR['baseurl']!==null)
        {
            $url = $SITEBAR['baseurl'];
        }

        if ($url === null)
        {
            $hostvar = isset($_SERVER['HTTP_HOST'])?'HTTP_HOST':'SERVER_NAME';
            $scripturl = isset($_SERVER['SCRIPT_URL'])?$_SERVER['SCRIPT_URL']:$_SERVER['SCRIPT_NAME'];
            $basedir = $_SERVER[$hostvar].dirname($scripturl);
            $https = $_SERVER['SERVER_PORT']!=80
                  && isset($_SERVER['HTTPS'])
                  && strtolower($_SERVER['HTTPS']) == 'on';
            $url = 'http' . ($https?'s':'') . '://' . $basedir;
        }

        if ($url{strlen($url)-1} != '/')
        {
            $url .= '/';
        }

        return $url;
    }

    public static function cdnBaseUrl($override=null)
    {
        static $url = null;

        if ($override!==null)
        {
            $url = $override;
        }

        global $SITEBAR;
        if (!isset($_SERVER['HTTPS']) && isset($SITEBAR['cdn']) && $SITEBAR['cdn']!==null)
        {
            $url = $SITEBAR['cdn'];
        }

        if ($url === null)
        {
            $url = self::absBaseUrl($override);
        }

        return $url;
    }
    
    public static function relBaseUrl($override=null)
    {
        static $url = null;

        if ($override!==null)
        {
            $url = $override;
        }

        if ($url === null)
        {
            $url = '';
        }

        if (strlen($url)>0 && $url{strlen($url)-1} != '/')
        {
            $url .= '/';
        }

        return $url;
    }

    public static function isMSIE()
    {
        static $isMSIE = null;

        if ($isMSIE === null)
        {
            $isMSIE = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'MSIE');
        }

        return $isMSIE;
    }

    public static function isIPHONE()
    {
        static $isIPHONE = null;

        if ($isIPHONE === null)
        {
            $isIPHONE = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'iPhone');
        }

        return $isIPHONE;
    }

    // Exclude Opera
    public static function isOPERA()
    {
        static $isOPERA = null;

        if ($isOPERA === null)
        {
            $isOPERA = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'Opera');
        }

        return $isOPERA;
    }

    public static function isGECKO()
    {
        static $isGECKO= null;

        if ($isGECKO=== null)
        {
            $isGECKO = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'Gecko');
        }

        return $isGECKO;
    }

    public static function dragDropNode($nid)
    {
        if (SB_Page::isOPERA())
        {
            return '';
        }

        return ' '.
            (SB_Page::isMSIE()?'ondragstart':'onmousedown').
            '="return SB_nodeDrag(event,'. $nid .');"'.
            ' onmouseup="return SB_nodeDrop(event,this.parentNode,'. $nid .');"'.
            (SB_Page::isGECKO()?' ondragover="return SBCFF_dragOver(event)" ondrop="return SBCFF_nodeDrop(event,this.parentNode,'. $nid .')"':'');
    }

    public static function dragDropLink($nid, $lid)
    {
        if (SB_Page::isOPERA())
        {
            return '';
        }

        return ' '.
            (SB_Page::isMSIE()?'ondragstart':'onmousedown').
            '="return SB_linkDrag(event,'. $lid .');"'.
            ' onmouseup="return SB_nodeDrop(event,this.parentNode,'. $nid .','. $lid . ');"'.
            (SB_Page::isGECKO()?' ondragover="return SBCFF_dragOver(event)" ondrop="return SBCFF_nodeDrop(event,this.parentNode,'. $nid .','. $lid .')"':'');
    }

    public static function toolTip()
    {
        return ' onmouseover="SB_toolTip(this,event);" onmouseout="SB_toolTipHide();" ';
    }

    public static function targetWindow()
    {
        static $trg = null;

        if ($trg === null)
        {
            $target = (SB_Page::isMSIE()||SB_Page::isOPERA()?'_main':'_content');
            if (isset($_REQUEST['target']))
            {
                $newtarget = $_REQUEST['target'];

                if (preg_match('/^\w+/', $newtarget))
                {
                    $target = $newtarget;
                }
            }
            $trg = $target;
        }
        return $trg;
    }

    public static function target($setdefault=null)
    {
        static $trg = null;

        if ($trg === null)
        {
            $trg = ' target="'.($setdefault?$setdefault:SB_Page::targetWindow()).'"';
        }
        return $trg;
    }

    public static function head($title, $bodyClass=null, $inscript=null, $onLoad=null, $meta=null)
    {
        // Media="All" is used to hide the styles from Netscape 4.x

        header('Content-Type: ' . CONTENT_TYPE);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/REC-html401/loose.dtd">

<html>
<head>
    <title>:: <?php echo SB_Page::title()?> :: <?php echo SB_T($title)?></title>
    <meta http-equiv="Content-Type" content="<?php echo CONTENT_TYPE?>">
    <meta name="keywords" content="bookmark manager, online bookmark manager, online bookmarks, favorites manager, online favorites, bookmark organizer, firefox bookmark manager, bookmark server">
    <meta name="description" content="Open Source Freeware Bookmark Server for Personal and Team Use.">
<?php echo $meta?>
    <link rel="shortcut Icon" href="<?php echo SB_Skin::webPath()?>/root_transparent.png">
    <link rel="author" href="http://brablc.com/">
    <link rel="bookmark" href="http://sitebar.org/" title="online bookmark manager">
    <link rel="help" href="http://sitebar.org/userguide.php">
<?php

/*      // This can only be enabled when caching is implemented FF fetches the links when page is visitied.

        $sortModes = array
        (
            'added'   => 'Recently Added',
            'changed' => 'Recently Modified',
            'visited' => 'Recently Visited',
            'hits'    => 'Most Popular',
            'waiting' => 'Waiting for Visit',
        );

        foreach( $sortModes as $mode => $sortLabel)
        {
?>
    <link rel="alternate" type="application/rss+xml"
          title="SiteBar Bookmarks [<?php echo $sortLabel?>]"
          href="<?php echo SB_Page::absBaseUrl()?>index.php?w=rss&amp;sort=<?php echo $mode?>&amp;max=20">
<?php
        }
*/
        self::headerContent($inscript);
?>
</head>
<body class="siteBar siteBarBaseFont siteBarPageBackground <?php echo $bodyClass?>" <?php echo ($onLoad?' onLoad="'.$onLoad.'"':'')?> onmouseup="SB_cancelDragging();">
<?php
    }

    static function headerContent($inscript)
    {
?>
    <link rel="stylesheet" type="text/css" href="<?php echo SB_Skin::webPath() ?>/sitebar.css?version=<?php echo STATIC_VERSION ?>" media="all">
    <script type="text/javascript" src="<?php echo SB_Page::absBaseUrl()?>js/sitebar.js?version=<?php echo STATIC_VERSION ?>"></script>
    <script type="text/javascript">
SB_gSkinDir = '<?php echo SB_Skin::webPath()?>/';
<?php echo $inscript."\n"?>
    </script>
<?php
    }

    function foot()
    {
?>
</body>
</html>
<?php
    }

    public static function quoteValue($value)
    {
        // XML entities: &lt; &gt; &amp; &quot;

        if ( preg_match('/[&<>"]/',$value) )
        {
            $entity = array('&amp;','&lt;','&gt;','&quot;');
            $char   = array('&','<','>','"');
            $value = str_replace($entity, $char, $value);
            $value = str_replace($char, $entity, $value);
        }

        return str_replace("\r\n",' ', $value);
    }
}
?>
