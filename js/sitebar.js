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

/*** Global variables *********************************************************/

// Skin directory
var SB_gSkinDir = null;

// Pop-up window preferences
var SB_gWinPrefs = null;

// Base directory
var SB_gAbsBaseUrl = null;

// Image holder to fix problems with cache
var SB_gImageHolder = new Array();

// Currently selected context menu
var SB_gCtxMenu = null;

// Semaphore for ignoring bubbling of events using timers
var SB_gIgnore = 0;

// Timer for hiding context menu
var SB_gHideTimer = null;

// Object reference of the right clicked object
var SB_gTargetID = null;

// ID to be copied or moved
var SB_gSourceID = null;

// ID of the dragged object
var SB_gDraggedID = null;

// Object to show tool tip
var SB_gToolTipObj = null;
var SB_gToolTipTop = null;
var SB_gToolTipLeft = null;
var SB_gCoordUnit = '';

// Saved color
var SB_gDraggingStyleBG = null;
var SB_gDraggingStyleFG = null;
var SB_gDraggingStyleCR = null;

// Is source node? If not it is link.
var SB_gSourceTypeIsNode = null;

// Global variable to focus already opened window
var SB_gCmdWin = null;
var SB_gHelpWin = null;

// Should external window be used?
var SB_gAutoReload = true;

// In place commands
var SB_gInPlaceCommands = new Array();

// Previous opened parent - optimization
var SB_gPrevParent = null;

// Saved state of nodes
var SB_gState = null;

// Dragging style
var SB_gDragIconCSS = null;

// Filter state
var SB_gFilterActive = false;

var SB_gHighlighted = new Array();
var SB_gHidden = Array();

var SB_gToolTipTimer = null;

/*** Autoload *****************************************************************/

function SB_getCookie(name, defaultValue)
{
    var index = document.cookie.indexOf(name + '=');
    if (index == -1)
    {
        return defaultValue;
    }
    index = document.cookie.indexOf('=', index) + 1; // first character
    var endstr = document.cookie.indexOf(';', index);

    if (endstr == -1)
    {
        endstr = document.cookie.length; // last character
    }
    return unescape(document.cookie.substr(index, endstr));
}

SB_gState = SB_getCookie('SB3NODES','!');

/*** Toolbar functions ********************************************************/

function SB_buttonDown(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'pressed';
}

function SB_buttonUp(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'raised';
}

function SB_buttonOver(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = 'raised';
}

function SB_buttonOut(btn, force)
{
    if (btn == document.getElementById('btnFilter') && SB_gFilterActive && !force) return;
    btn.className = '';
}

function SB_storeSearch()
{
    var searchText = document.getElementById('fldSearch').value;
    document.cookie = 'SB3SEARCH='+encodeURIComponent(searchText)+";SameSite=None;Secure";
}

function SB_storePosition()
{
    document.cookie = 'SB3TOP='+SB_getTop()+";SameSite=None;Secure";
    document.cookie = 'SB3LEFT='+SB_getLeft()+";SameSite=None;Secure";
}

function SB_hasClass(obj, className)
{
    return obj.className.indexOf(className)!=-1;
}

/**
 * Add remove class name to the div
 */
function SB_class(obj, className, add)
{
    var startPos = obj.className.indexOf(className);

    if (add)
    {
        // We already have the class
        if (startPos != -1)
        {
            return;
        }

        obj.className += ' ' + className;
    }
    else
    {
        // We do not have it
        if (startPos == -1)
        {
            return;
        }

        var oldClass = obj.className;

        obj.className = obj.className.substr(0,startPos);

        if (obj.className.length>startPos+className.length)
        {
            obj.className+=oldClass.substr(startPos+className.length);
        }
    }
}

/**
 * Add remove class name to the link
 */
function SB_highlight(linkObj, highlight)
{
    var className = 'highlight';

    if (!SB_hasClass(linkObj, className) && highlight)
    {
        SB_gHighlighted[SB_gHighlighted.length] = linkObj;
    }

    SB_class(linkObj, className, highlight);
}

/**
 * Filter links with matching name or URL
 */
function SB_filter(icon)
{
    var btnFilter = document.getElementById('btnFilter');

    if (SB_gFilterActive)
    {
        SB_unfilter();
        if (icon) return;
    }

    for (i=0; i<SB_gHighlighted.length; i++)
    {
        SB_highlight(SB_gHighlighted[i], false);
    }

    SB_gHighlighted = new Array();

    var fld  = document.getElementById('fldSearch');
    var text = fld.value;
    if (text.length==0) return;

    SB_gFilterActive = true;
    SB_buttonDown(btnFilter, true);

    var type = SB_getJSData('sb_defaultSearch');
    SB_gPrevParent = null;

    // Check search pattern
    var reST = new RegExp("^(url|desc|name|all):(.*)$");
    if (text.match(reST))
    {
        type = RegExp.$1;

        // If we have pattern then use it
        if (type == 'url'
        ||  type == 'desc'
        ||  type == 'name'
        ||  type == 'all')
        {
            text = RegExp.$2;
        }
    }

    var re = new RegExp(text,"i")

    var divs = document.getElementsByTagName('div');
    for (i = 0; i<divs.length; i++)
    {
        if (divs[i].className == 'node')
        {
            nodeAnchor = document.getElementById('a'+divs[i].id);
            if (SB_getLinkName(nodeAnchor).search(re)!=-1)
            {
                SB_highlight(nodeAnchor, true);
                divs[i].style.display = 'block';
                SB_openParents(divs[i].parentNode.parentNode);
            }
            else
            {
                divs[i].style.display = 'none';
                SB_gHidden[SB_gHidden.length] = divs[i];
            }
        }
    }

    var links = document.getElementsByTagName('a');
    for (i = 0; i<links.length; i++)
    {
        var name = SB_getLinkName(links[i]);
        var url = links[i].getAttribute('href');
        var desc = links[i].getAttribute('x_title');
        if (!desc)
        {
            links[i].getAttribute('title');
        }

        var parentDIV = links[i].parentNode;

        // Ignore everything but links in tree
        if (parentDIV.className.indexOf('link')==-1) continue;

        var subject = '';

        if (type=='url'  || type=='all') subject += url;
        if (type=='name' || type=='all') subject += name;
        if (type=='desc' || type=='all') subject += desc;

        if (subject.search(re)!=-1)
        {
            SB_openParents(parentDIV.parentNode.parentNode);
            SB_highlight(links[i], true);
        }
    }

    for (i = 0; i<divs.length; i++)
    {
        if (divs[i].className == 'node')
        {
            nodeAnchor = document.getElementById('a'+divs[i].id);
            // Folder is not matching
            if (SB_getLinkName(nodeAnchor).search(re)==-1)
            {
                var children = document.getElementById('c'+divs[i].id).childNodes;

                for (var j = 0; j < children.length; j++)
                {
                    if (children[j].className == 'link')
                    {
                        if (SB_hasClass(document.getElementById('a'+children[j].id), 'highlight'))
                        {
                            continue;
                        }
                        children[j].style.display = 'none';
                        SB_gHidden[SB_gHidden.length] = children[j];
                    }
                }
            }
        }
    }

    fld.select();
    fld.focus();
}

function SB_unfilter()
{
    if (!SB_gFilterActive) return;
    SB_gFilterActive = false;

    for (var i=0; i<SB_gHidden.length; i++)
    {
        SB_gHidden[i].style.display = 'block';
    }

    SB_gHidden = new Array();

    SB_buttonOut(document.getElementById('btnFilter'));
    document.getElementById('fldSearch').focus();
}

/**
 * For search functions: opens all parent folders
 */
function SB_openParents(parentNode)
{
    if (SB_gPrevParent == parentNode)
    {
        return;
    }

    SB_gPrevParent = parentNode;

    var obj = parentNode;
    while (obj && obj.getAttribute('x_level')!=null
        && obj.getAttribute('x_level')!='') // For Opera
    {
        obj.style.display = 'block';
        SB_node(false, obj, true);
        obj = obj.parentNode.parentNode;
    }
}

/**
 * For search functions: returns name of the link (ignores leading tags)
 */
function SB_getLinkName(linkTag)
{
    if (linkTag.innerHTML.match(/.*>(.*)/))
    {
        return RegExp.$1;
    }
    else
    {
        return linkTag.innerHTML;
    }
}

function SB_defaultSearch(target, tool)
{
    if (tool == 'filter')
    {
        SB_filter();
        return;
    }
    SB_storeSearch();
    window.open(SB_getAbsBaseUrl() + 'search.php' + (tool=='web'?'?web=1':''), target);
}

/**
 * Reload sitebar keeping images in cache
 */
function SB_reloadPageWorker(cancelled, all)
{
    var url = location.href.replace(/\?.*/,'') + '?';
    var sParam = location.search;

    if (sParam && sParam.length && sParam.split)
    {
        var aParam = sParam.substr(1).split('&');

        for (var i=0; i<aParam.length; i++)
        {
            var aPair = aParam[i].split('=');
            if (aPair[0] == 'reload') continue;
            if (aPair[0] == 'command') continue;
            if (aPair[0] == 'uniq') continue;

            url += aParam[i] + '&';
        }
    }

    location.href = url + 'reload=' + (all?'all':'yes') +
              (!cancelled?'&uniq=' + (new Date()).valueOf():'');
}

function SB_reloadPage()
{
    SB_storePosition();
    SB_reloadPageWorker();
}

function SB_reloadPageWithReferer(ref)
{
  if (ref && ref.length) {
    location.href = ref;
  } else {
    SB_reloadPage();
  }
}

/**
 * Reload with hidden folders and all roots
 */
function SB_reloadAll()
{
    SB_storePosition();
    SB_reloadPageWorker(false, true);
}

/**
 * Collapse all nodes
 */
function SB_collapseAll()
{
    if (SB_gState.length==0 || SB_gState=='!')
    {
        SB_expandAll();
        return;
    }

    var divs = document.getElementsByTagName('div');
    var level;
    var div;

    for (var i=0; i<divs.length; i++)
    {
        div = divs[i];
        level = div.getAttribute('x_level');

        if (level!=null && level!='') // '' for Opera
        {
            SB_node(null, div, false, true);
        }
    }

    SB_gState = '!';
    SB_saveCookie(SB_gState);
}


/**
 * Collapse all nodes
 */
function SB_expandAll()
{
    var divs = document.getElementsByTagName('div');
    var level;
    var div;

    for (var i=0; i<divs.length; i++)
    {
        div = divs[i];
        level = div.getAttribute('x_level');

        if (level!=null && level!='') // '' for Opera
        {
            SB_node(null, div, true);
        }
    }
}

/**
 * Change CSS style
 */
function SB_changeCSS(myclass,element,value)
{
    var CSSRules;

    if (document.all)
    {
        CSSRules = 'rules'
    }
    else if (document.getElementById)
    {
        CSSRules = 'cssRules'
    }

    for (var i = 0; i < document.styleSheets[0][CSSRules].length; i++)
    {
        var rule = document.styleSheets[0][CSSRules][i];

        if (rule.selectorText && rule.selectorText.toUpperCase() == myclass.toUpperCase())
        {
            var oldValue = rule.style[element];
            if (value)
            {
                rule.style[element] = value;
            }
            return oldValue;
        }
    }

    // Class not found
    return '';
}

/*** Drag & Drop **************************************************************/

function SB_changeStyleForDragging(dragging)
{
    var style = '.siteBar div.tree a:hover';

    if (dragging)
    {
        // Get colors and change cursor for dragging
        var bg = SB_changeCSS(style + ' .selected', 'background');
        var fg = SB_changeCSS(style + ' .selected', 'color');
        var cr = SB_changeCSS(style + ' .selected', 'cursor');

        // Change color attributes and cursor
        SB_gDraggingStyleBG = SB_changeCSS(style, 'background', bg);
        SB_gDraggingStyleFG = SB_changeCSS(style, 'color', fg);
        SB_gDraggingStyleCR = SB_changeCSS(style, 'cursor', cr);
    }
    else
    {
        SB_changeCSS(style, 'background', SB_gDraggingStyleBG);
        SB_changeCSS(style, 'color', SB_gDraggingStyleFG);
        SB_changeCSS(style, 'cursor', SB_gDraggingStyleCR);
    }
}

function SB_nodeDrag(event, id)
{
    if (event.button == 2 || SB_gDraggedID != null)
    {
        return false;
    }

    SB_changeStyleForDragging(true);
    SB_gDraggedID = id;
    SB_gSourceTypeIsNode = true;
    return false;
}

function SB_go(alink,id)
{
    var newurl = SB_getAbsBaseUrl() + "go.php?id=" + id + "&url=" + escape(alink.href);
    alink.href = newurl;
    return false;
}

function SB_linkDrag(event, id)
{
    if (event.button == 2 || SB_gDraggedID != null)
    {
        return false;
    }

    SB_changeStyleForDragging(true);
    SB_gDraggedID = id;
    SB_gSourceTypeIsNode = false;
    return false;
}

function SB_cancelDragging()
{
    if (SB_gDraggedID!=null)
    {
        SB_changeStyleForDragging(false);
        SB_gDraggedID = null;
    }
}

function SB_getJSData(label)
{
    var obj = document.getElementById(label);
    if (!obj)
    {
        alert('Javascript data for ' + label + ' not found!');
        return null;
    }
    return obj.innerHTML;
}

function SB_nodeDrop(event, obj, id, linkID)
{
    if (id == SB_gDraggedID || (!SB_gSourceTypeIsNode && linkID && linkID == SB_gDraggedID))
    {
        return true;
    }

    if (event.button == 2 || SB_gDraggedID == null)
    {
        return false;
    }

    SB_stopIt(event);
    SB_gSourceID = SB_gDraggedID;
    SB_cancelDragging();
    SB_commandWindow('Paste', id);
    return false;
}

function SBCFF_dragOver(event)
{
    // Cause a drop accept only when the dragged item is a list of links (link can be link to page or image)
    // event.preventDefault() will cause a drop accept from drags that got initiated from other parts of Firefox
    var types = event.dataTransfer.types;
    var supportedTypes = ["application/x-bookmark", "application/x-moz-url", "text/uri-list", "text/plain"];
    
    for (var i = 0; i < supportedTypes.length; i++) {
    
        if ( !(types.contains(supportedTypes[i])) ) continue;
        event.preventDefault();
        break;
    }    
}


function SBCFF_nodeDrop(event, obj, id, linkID)
{
    // the obj and linkID arguments aren't used, they are there to make this event handler look similar to
    // the existing ones, it is up to Ondrej what happens to them.
    var types = event.dataTransfer.types;
    var supportedTypes = ["application/x-bookmark", "application/x-moz-url", "text/uri-list", "text/plain"];
    
    types = supportedTypes.filter(function (value) { types.contains(value); } );
    if (types.length) {
        var url = event.dataTransfer.getData(types[0]);
        SB_commandWindow('Add Link' + '&url=' + url, id);
    }
    
    event.preventDefault();
}

/*** Image preloading *********************************************************/

/**
 * Preload images - necessary for Internet Explorer otherwise
 * some image is always somehow missing.
 * Does not harm any other browser.
 */

function SB_imgPath(basename)
{
    if (SB_gSkinDir==null)
    {
        SB_gSkinDir = SB_getJSData('sb_skinDir');
    }
    return SB_gSkinDir + basename + '.png';
}

function SB_preloadImages()
{
    var images = Array
    (
        'collapse',
        'connect',
        'empty',
        'feed',
        'join',
        'join_last',
        'link',
        'link_private',
        'link_wrong_favicon',
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
        'root_plus'
    );

    /**
     * This is called when the script is loaded automatically.
     */
    for (var i=0; i<images.length; i++)
    {
        // Save references in an array, to avoid their releasing
        var path = SB_imgPath(images[i]);
        images[i] = new Image(); // We change the type
        images[i].src = path;
        SB_gImageHolder[SB_gImageHolder.length] = images[i];
    }
}

/**
 * On error handler for images: Wrong Favicon
 */
function SB_WFI(imgObj)
{
    imgObj.src=SB_imgPath('link_wrong_favicon');
}

/*** Commander functions ******************************************************/

function SB_initCommander()
{
    document.cookie = 'SB3COOKIE=1'+";SameSite=None;Secure";

    if (document.getElementById('focused'))
    {
        setTimeout('document.getElementById("focused").focus();',10);
    }

    if (window && !window.closed)
    {
        window.focus();
    }
}

/**
 * When a menu should be shown on link when using Ctrl click
 */
function SB_isOpera()
{
    return window.opera && window.print;
}

function SB_initPage(inPlaceCommands)
{
    SB_gInPlaceCommands = inPlaceCommands;
    if (!SB_isOpera())
    {
        setTimeout('SB_restorePosition();',10);
    }

    window.onscroll = SB_onScroll;
    setTimeout('SB_generalTimeout();',1000);
}

function SB_generalTimeout()
{
//    setTimeout('SB_generalTimeout();',1000);
}

function SB_onScroll()
{
    var toolbar = document.getElementById('toolbar');

    if (toolbar)
    {
        var logo = document.getElementById('logo');
        var toolbarPlace = document.getElementById('toolbarPlace');

        var top = SB_getTop();

        if (logo && logo.offsetTop+logo.offsetHeight>top)
        {
            top = logo.offsetTop+logo.offsetHeight;
        }

        if (toolbar.offsetTop != top)
        {
            toolbar.style.top = top+'px';
            toolbar.style.left = '1px';
            toolbar.style.position = 'absolute';
            toolbarPlace.style.display = 'block';
        }
    }
}

function SB_getAbsBaseUrl()
{
    if (SB_gAbsBaseUrl == null)
    {
        SB_gAbsBaseUrl = SB_getJSData('sb_absBaseUrl');
    }

    return SB_gAbsBaseUrl;
}

function SB_onLoad()
{
    if (SB_isOpera())
    {
        SB_restorePosition();
    }

    SB_preloadImages();
}

function SB_restorePosition()
{
    var iTop = parseInt(SB_getCookie('SB3TOP',-1),10);
    var iLeft = parseInt(SB_getCookie('SB3LEFT',-1),10);

    if (iTop!=-1)
    {
        window.scroll(iLeft,iTop);
    }
}

/*** Tree collapsing/expanding ************************************************/

/**
 * When a div is clicked this event becomes all its parent, however, the
 * the innermost is the first. We increase ignore semaphore and schedule
 * its zeroing after 10 milliseconds. Any subsequent call of stopIt will
 * return false before it is zeroied.
 */
function SB_stopIt(event)
{
    // If event not filled then user initiated action which should
    // not be stopped.
    if (!event) return false;

    SB_gIgnore++;
    if (SB_gIgnore>1) return true;

    setTimeout('SB_gIgnore=0;',10);
    return false;
}

/**
 * Renew the event - for Opera Ctrl+click.
 */
function SB_renewIt(event)
{
    SB_gIgnore=0;
}

/**
 * If the base is not '_content' it must be changed to '_main', what is most likely
 * Internet Explorer and works in Opera.
 */
function SB_hasTargetWindow(name)
{
    return name=='_content' && window.sidebar && window.sidebar.addPanel;
}

/**
 * Save state of certain node
 */
function SB_saveState(id, state)
{
    SB_gState = (state?'Y':'N')+id.substr(1)+':'+SB_gState;
    SB_saveCookie(SB_gState);
}

/**
 * Save global state cookie
 */
function SB_saveCookie(value)
{
    var expires = new Date(new Date().getTime()+1000*60*60*24*7).toGMTString();
    document.cookie = 'SB3NODES='+value+'; expires=' + expires+";SameSite=None;Secure";
}

/**
 * Toggle display of any div referenced as object
 */
function SB_toggleDiv( div, show )
{
    if (show!=null)
    {
        div.style.display = (show?'block':'none');
        return show;
    }

    if (div.style.display=='')
    {
        if (SB_hasClass(div,'Expanded'))
        {
            div.style.display = 'block';
        }
        if (SB_hasClass(div,'Collapsed'))
        {
            div.style.display = 'none';
        }
    }

    div.style.display = (div.style.display=='block'?'none':'block');
    return (div.style.display=='block');
}

/**
 * Activated on click on node (folder). Changes + and - sign according to
 * current state.
 */
function SB_node(event, obj, show, noSaveState)
{
    if (SB_stopIt(event)) return false;

    SB_menuOff();
    SB_cancelDragging();

    if (event)
    {
        if (event.ctrlKey)
        {
            SB_renewIt(event);
            SB_menuOn(event, obj);
            return false;
        }
    }

    var simg = document.getElementById('is' + obj.id);
    var nimg = document.getElementById('in' + obj.id);
    var children = document.getElementById('c' + obj.id);

    var root = obj.getAttribute('x_level')=='1';
    var opened = SB_toggleDiv(children, show);

    if (!noSaveState)
    {
        SB_saveState(obj.id, opened);
    }

    if (root)
    {
        var deleted = obj.getAttribute('x_acl').indexOf('*')==-1;
        var links = children.getElementsByTagName('a');
        nimg.src = SB_imgPath( (opened||!links.length?'root'+(deleted?'_deleted':''):'root_plus'));
    }
    else if (simg)
    {
        var last = (simg.src.indexOf("_last.png")>-1);
        simg.src = SB_imgPath( (opened?'minus':'plus') + (last?'_last':""));
        nimg.src = SB_imgPath( 'node' + (opened?'_open':""));
    }


    return true;
}

function SB_xmlHttpGet()
{
    var http = false;

    if (window.ActiveXObject)
    {
        try
        {
            http = new ActiveXObject('Msxml2.XMLHTTP');
        }
        catch(e)
        {
            http = new ActiveXObject('Microsoft.XMLHTTP');
        }
    }
    else
    {
        http = new XMLHttpRequest();
    }

    return http;
}

function SB_xmlHttpReady(http)
{
    return http.readyState == 4 && (http.status == 304 || http.status == 200);
}

function SB_xmlHttpSend(http, url)
{
    http.open('GET', url, true);

    if (window.XMLHttpRequest)
    {
        http.send(null?null:'');
    }
    // branch for IE/Windows ActiveX version
    else if (window.ActiveXObject)
    {
        http.send();
    }
}

function SB_nodeReload(event, obj)
{
    if (SB_node(event, obj))
    {
        var children = document.getElementById('c' + obj.id);

        // If we have opened it now, but there are no children
        if (children.style.display == 'block'
        &&  children.className == 'childrenCollapsed')
        {
            var http = SB_xmlHttpGet();

            // We have old browser
            if (!http)
            {
                SB_storePosition();
                setTimeout('SB_reloadPageWorker();',10);
                return;
            }

            var level = obj.getAttribute('x_level');
            if (!level)
            {
                level = 1;
            }

            children.className  = 'childrenExpanded';
            children.innerHTML  = '<div>';

            for (var i=0; i<level; i++)
            {
                children.innerHTML += '&nbsp;&nbsp;&nbsp;&nbsp;';
            }

            children.innerHTML += SB_getJSData('sb_label_loading') + '</div>';

            // Yes, this is an AJAX style of doing things
            http.onreadystatechange = function()
            {
                if (SB_xmlHttpReady(http))
                {
                    var hdrIdx = http.responseText.indexOf("\r");
                    nid = http.responseText.substr(0,hdrIdx);

                    var children = document.getElementById('cn' + nid);
                    children.innerHTML = http.responseText.substr(hdrIdx);

/*                  Opera 8.5 does not support responseXML at all and the others with diffs.

                    var xmlRoot = http.responseXML.getElementsByTagName('root').item(0);
                    var xmlData = http.responseXML.getElementsByTagName('data').item(0);

                    if (xmlRoot && xmlData)
                    {
                        var strRoot = window.ActiveXObject?xmlRoot.text:xmlRoot.textContent;
                        var strData = window.ActiveXObject?xmlData.firstChild.text:xmlData.textContent;

                        var children = document.getElementById('cn' + strRoot);
                        children.innerHTML = strData;
                    }
*/
                }
            }

            var acl = obj.getAttribute('x_acl');
            var url = location.pathname + '?w=sitebar_ajax'+
                           '&call=loadfolder'+
                           '&nid='+obj.id.substr(1)+
                           '&level='+level+
                           '&acl='+acl +
                           SB_appendPersistentParams();

            SB_xmlHttpSend(http, url);
        }
    }
}

/**
 * Ctrl+ Left Click in Opera substitutes right click.
 */
function SB_lnk(event,obj)
{
    SB_cancelDragging();

    if (event.ctrlKey && SB_isOpera())
    {
        SB_menuOn(event, obj);
        return false;
    }
    else
    {
        SB_stopIt(event);
        return true;
    }
}

/*** Context menu functionality ***********************************************/

function SB_getCoordTop(event)
{
    var e = event;
    var ycoord;
    SB_gCoordUnit = '';

    if (!e)
    {
        e = window.event;
    }

    if (!e || ( typeof( e.pageY ) != 'number' && typeof( e.clientY ) != 'number' ) )
    {
        return[0];
    }

    if (typeof( e.pageY ) == 'number' )
    {
        SB_gCoordUnit = 'px';
        ycoord = e.pageY;
    }
    else
    {
        ycoord = e.clientY;
        if (!( ( window.navigator.userAgent.indexOf( 'Opera' ) + 1 ) || ( window.ScriptEngine && ScriptEngine().indexOf( 'InScript' ) + 1 ) || window.navigator.vendor == 'KDE' ) )
        {
            if (document.documentElement && document.documentElement.scrollTop)
            {
                ycoord += document.documentElement.scrollTop;
            }
            else if (document.body && document.body.scrollTop)
            {
                ycoord += document.body.scrollTop;
            }
        }
    }

    return ycoord-1;
}

function SB_getCoordLeft(event)
{
    var e = event;
    var xcoord;
    SB_gCoordUnit = '';

    if (!e )
    {
        e = window.event;
    }

    if (!e || ( typeof( e.pageX ) != 'number' && typeof( e.clientX ) != 'number' ) )
    {
        return[0];
    }

    if (typeof( e.pageX ) == 'number' )
    {
        SB_gCoordUnit = 'px';
        xcoord = e.pageX;
    }
    else
    {
        xcoord = e.clientX;
        if (!( ( window.navigator.userAgent.indexOf( 'Opera' ) + 1 ) || ( window.ScriptEngine && ScriptEngine().indexOf( 'InScript' ) + 1 ) || window.navigator.vendor == 'KDE' ) )
        {
            if (document.documentElement && document.documentElement.scrollLeft)
            {
                xcoord += document.documentElement.scrollLeft;
            }
            else if (document.body && document.body.scrollLeft)
            {
                xcoord += document.body.scrollLeft;
            }
        }
    }

    return xcoord-1;
}

function SB_getTop()
{
    var topOffset = document.documentElement.scrollTop;
    if (!topOffset)
    {
        topOffset = document.body.scrollTop;
    }
    return topOffset;
}

function SB_getLeft()
{
    var leftOffset = document.documentElement.scrollLeft;
    if (!leftOffset)
    {
        leftOffset = document.body.scrollLeft;
    }
    return leftOffset;
}

/**
 * Called on right click on nodes or items
 */
function SB_menuOn(event, obj)
{
    var e = event;
    if (!e)
    {
        e = window.event;
    }

    if (SB_stopIt(e)) return false;
    SB_cancelDragging();
    SB_stopMenuHider();

    // Store reference in the global variable
    SB_gTargetID = obj;

    var menuDIV = (obj.id.charAt(0)=='n'?'node':'link');
    SB_gCtxMenu = document.getElementById(menuDIV+'CtxMenu');

    if (menuDIV=='node')
    {
        document.cookie = 'SB3CTXROOT='+obj.id.substr(1)+";SameSite=None;Secure";
    }

    // Mark folder as opened
    SB_saveState(obj.id, true);

    SB_toolTipHide();
    // Hide the other context menus
    SB_hideMenus(SB_gCtxMenu);

    SB_gCtxMenu.style.top = SB_getCoordTop(e) + SB_gCoordUnit;
    SB_gCtxMenu.style.left = SB_getCoordLeft(e) + SB_gCoordUnit;
    SB_gCtxMenu.style.display = 'block';

    // Get ACL for node
    var nodeACL = obj.getAttribute('x_acl');

    // Set initial state of all items in the context menu
    for (var i=0;;i++)
    {
        var menuItem = document.getElementById(menuDIV+'menuItem'+i);
        if (!menuItem) break;

        // If not separator then set off or disable
        if (SB_hasClass(menuItem,'separator'))
        {
            continue;
        }

        var commandACL = menuItem.getAttribute('x_acl');

        if (!commandACL)
        {
            continue;
        }

        var commandSPEC = null;

        var arr = commandACL.split('_');
        var disabled = false;

        if (arr.length>1)
        {
            commandACL = arr[0];
            commandSPEC = arr[1];
        }

        // Each command might require some rights, for each letter
        // in the command ACL there must be a letter in the node
        // otherwise the command is disabled
        for (var j=0; j<commandACL.length; j++)
        {
            if (nodeACL.indexOf(commandACL.charAt(j))==-1)
            {
                disabled = true;
                break;
            }
        }

        if (!disabled && commandSPEC)
        {
            switch (commandSPEC)
            {
                case 'c':
                    disabled = !(SB_gSourceID);
                    break;
            }
        }

        SB_class(menuItem,'disabled', disabled);
        SB_class(menuItem,'active', false);
    }

    return false;
}

function SB_showOptional(menuDIV, decorator)
{
    // Set initial state of all items in the context menu
    for (var i=0;;i++)
    {
        var menuItem = document.getElementById(menuDIV+'menuItem'+i);
        if (!menuItem) break;
        menuItem.style.display = 'block';
    }

    if (decorator)
    {
        decorator.style.display = 'none';
    }
}

function SB_stopMenuHider()
{
    if (SB_gHideTimer)
    {
        clearTimeout(SB_gHideTimer);
        SB_gHideTimer = null;
    }
}

/**
 * When the item is left this is called to show parent menu.
 */
function SB_menuOff()
{
    SB_hideMenus(null);
    SB_gCtxMenu = null;
    SB_stopMenuHider();
}

/**
 * Hide all context menus, ignore the one passed as object reference
 */
function SB_hideMenus(ignore)
{
    var menus = Array('node','link');
    var menu;

    for (var i=0; i<menus.length; i++)
    {
        menu = document.getElementById(menus[i]+'CtxMenu');
        if (menu != ignore)
        {
            menu.style.display = 'none';
        }
    }
}

/**
 * Activated on mouseover on the item in context menu
 */
function SB_itemOn(menuItem)
{
    // And its hiding was scheduled
    SB_stopMenuHider();

    // Display menu
    menuItem.parentNode.display = 'block';

    SB_toggleItem(menuItem, true);
}

/**
 * Activated on mouse off
 */
function SB_itemOff(menuItem)
{
    SB_stopMenuHider();
    SB_gHideTimer = setTimeout('SB_menuOff();', 1000);
    SB_toggleItem(menuItem, false);
}

/**
 * Toggles state of the context menu item
 */
function SB_toggleItem(menuItem, show)
{
    if (SB_hasClass(menuItem,'disabled'))
    {
        return false;
    }

    if (show)
    {
        if (SB_hasClass(menuItem,'optional'))
        {
            SB_class(menuItem,'optional', false);
            SB_class(menuItem,'actopt', true);
        }
    }
    else
    {
        if (SB_hasClass(menuItem,'actopt'))
        {
            SB_class(menuItem,'actopt', false);
            SB_class(menuItem,'optional', true);
        }
    }

    SB_class(menuItem,'active', show);
    return true;
}

/**
 * Activated on click on the context menu item
 */
function SB_itemDo(menuItem, func)
{
    if (menuItem.className.indexOf('active')==-1)
    {
        return;
    }

    SB_menuOff();
    var nid = null;
    var lid = null;
    var id  = null;

    if (SB_gTargetID)
    {
        id = SB_gTargetID.id.substr(1);
        if (SB_gTargetID.id.charAt(0)=='n')
        {
            nid = id;
        }
        else
        {
            lid = id;
        }
        SB_gTargetID = null;
    }

    if (func)
    {
        eval(func+'(id)');
    }
    else
    {
        SB_commandWindow(menuItem.getAttribute('x_cmd'), nid, lid);
    }
}

function SB_itemDoAlt(elementId, func)
{
    menuItem = document.getElementById(elementId);

    SB_menuOff();
    var nid = null;
    var lid = null;
    var id  = null;

    if (SB_gTargetID)
    {
        id = SB_gTargetID.id.substr(1);
        if (SB_gTargetID.id.charAt(0)=='n')
        {
            nid = id;
        }
        else
        {
            lid = id;
        }
        SB_gTargetID = null;
    }

    if (func)
    {
        eval(func+'(id)');
    }
    else
    {
        SB_commandWindow(menuItem.getAttribute('x_cmd'), nid, lid);
    }
}

function SB_toolTip(source, event)
{
    SB_gToolTipObj = source;
    SB_gToolTipTop = SB_getCoordTop(event);
    SB_gToolTipLeft = SB_getCoordLeft(event);
    SB_gToolTipTimer = setTimeout('SB_toolTipShow();',1000)
}

function SB_toolTipHide()
{
    if (SB_gToolTipTimer)
    {
        clearTimeout(SB_gToolTipTimer);
        SB_gToolTipTimer = null;
    }
    SB_gToolTipObj = null;
    var toolTipObj = document.getElementById('toolTip');
    if (toolTipObj)
    {
        toolTipObj.style.display = 'none';
    }
}

function SB_toolTipShow()
{
    if (SB_gCtxMenu)
    {
        SB_toolTipHide();
        return;
    }

    if (SB_gToolTipObj)
    {
        var toolTipObj = document.getElementById('toolTip');

        if (!toolTipObj || toolTipObj.style.display == 'block')
        {
            return;
        }
        var text = SB_gToolTipObj.getAttribute('x_title');

        if (!text || !text.length)
        {
            return;
        }

        var maxLen = 20;
        var curLen = 0;

        if (text.indexOf(' ')==-1)
        {
            maxLen = text.length;
        }
        else
        {
            for (var i=0; i<text.length; i++)
            {
                curLen = text.indexOf(' ',i);
                if ((curLen-i)>maxLen)
                {
                    maxLen = (curLen-i);
                }
            }
        }

        var width = maxLen*7; // Magic number

        var iTop = 0;
        var iLeft = 0;

        if (0 && SB_gToolTipObj.className=='raised')
        {
            iTop = SB_gToolTipTop+15;
            iLeft = SB_gToolTipLeft-width;

            if (iLetf<0)
            {
                iLeft = 0;
            }
        }
        else
        {
            iTop = SB_gToolTipTop+22;
            iLeft = Math.floor(SB_gToolTipLeft/10);
        }

        toolTipObj.style.top = iTop + SB_gCoordUnit;
        toolTipObj.style.left = iLeft + SB_gCoordUnit;

        var punct = new Array('.','(',')',':',';','#');
        var image = new Array('dot','brace_left','brace_right','colon','semicolon','hash');
        var save  = '';

        for (var i=0; i<text.length; i++)
        {
            var skip = false;
            for (var j=0; j<punct.length && !skip; j++)
            {
                if (text.charAt(i) == punct[j])
                {
                    save += '<img class="char" src="skins/punct_'+image[j]+'.png" alt="">';
                    skip = true;
                }
            }
            if (!skip)
            {
                save += text.charAt(i);
            }
        }
        toolTipObj.innerHTML = save;
        toolTipObj.style.display = 'block';
        toolTipObj.style.width = width+'px';
    }
}

/**
 * Called on node Mark as Default command
 */
function SB_markDefault(nid)
{
    var http = SB_xmlHttpGet();

    // We have old browser
    if (!http)
    {
        alert('Sorry, your browser does not support AJAX!');
        return;
    }

    var url = SB_getAbsBaseUrl() + 'command.php?command=Mark%20as%20Default&do=1&nid_acl=' + nid;
    SB_xmlHttpSend(http, url);
}

/**
 * Called on node Copy command
 */
function SB_nodeCopy(nid)
{
    SB_gSourceID = nid;
    SB_gSourceTypeIsNode = true;
}

/**
 * Called on node Hide command
 */
function SB_nodeHide(nid)
{
    var nodeObj = document.getElementById('n'+nid);
    nodeObj.style.display = 'none';
    SB_commandWindow('Hide Folder', nid, null);
}

/**
 * Called on node Copy command
 */
function SB_linkCopy(lid)
{
    SB_gSourceID = lid;
    SB_gSourceTypeIsNode = false;
}

function SB_appendPersistentParams()
{
    var url = '';

    var sParam = location.search;
    var aPersistentParams = new Array( 'target', 'w', 'mode', 'user' );

    if (sParam && sParam.length && sParam.split)
    {
        var aParam = sParam.substr(1).split('&');

        for (var i=0; i<aParam.length; i++)
        {
            var aPair = aParam[i].split('=');

            for (var j=0; j<aPersistentParams.length; j++)
            {
                if (aPersistentParams[j] == aPair[0])
                {
                    url += '&' + aParam[i];
                }
            }
        }
    }

    return url;
}

/**
 * Open control window
 */
function SB_commandWindow(command, nid, lid)
{
    var url = SB_getAbsBaseUrl() + 'command.php?command=' + command +
        (nid?'&nid_acl='+nid:'') +
        (lid?'&lid_acl='+lid:'') +
        (SB_gSourceID?'&sid='+SB_gSourceID+'&stype='+(SB_gSourceTypeIsNode?'1':'0'):'');

    url += SB_appendPersistentParams();

    var inPlaceCommand = false;
    for (i=0; i<SB_gInPlaceCommands.length; i++)
    {
        if (command == SB_gInPlaceCommands[i])
        {
            inPlaceCommand = true;
            break;
        }
    }

    if (SB_getJSData('sb_externCommander')=='0' && !inPlaceCommand)
    {
        if (SB_gCmdWin && !SB_gCmdWin.closed) SB_gCmdWin.focus();
        SB_gCmdWin = window.open(url, 'sitebar_gCmdWin', SB_gWinPrefs);
        SB_gCmdWin.focus();
        SB_gSourceID = null;
    }
    else
    {
        location.href=url;
    }
}

function SB_openHelp(url)
{
    var winPrefs = 'resizable=yes,dependent=no,titlebar=yes,scrollbars=yes';
    SB_gHelpWin = window.open(url, 'sitebar_gHelpWin', winPrefs);
    SB_gHelpWin.focus();
}

function SB_toggleMore(hide)
{
    document.getElementById('showMore').style.display=hide?"none":"block";
    document.getElementById('showLess').style.display=hide?"block":"none";
    document.getElementById('optionalFields').style.display=hide?"block":"none";
}

function SB_showShareGroup(gid)
{
    for (var i=0; i<2; i++)
    {
        var ch = i==0?'a':'b';
        var el = document.getElementById('group'+gid+ch);
        if (el)
        {
            el.style.visibility = 'visible';
        }
    }
}

function SB_memberSelector(id, show)
{
    document.getElementById(id+"_l").style.display=show?"none":"block";
    document.getElementById(id+"_s").style.display=!show?"none":"block";

    if (show)
    {
        document.getElementById(id+"_v").focus();
    }
}

function SB_onMemberSelectorChange(id)
{
    document.getElementById(id+"_r").className=document.getElementById(id+"_v").value;
}

function SB_onMemberSelectorBlur(id)
{
    SB_memberSelector(id, false);
}
