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
require_once('./inc/page.inc.php');

SB_handleRootCookie();

if (@!include_once('./adm/config.inc.php'))
{
    header('Location: config.php');
    exit;
}

require_once('./inc/writer.inc.php');

$writer = 'sitebar';

if (SB_reqChk('w'))
{
    $writer = SB_reqVal('w');
}
else if (!SB_reqChk('uniq')) // We do not have reload from screen
{
    require_once('./inc/usermanager.inc.php');
    $um =& SB_UserManager::staticInstance();
    $ua = $um->getParamB64('config', 'web_search_user_agents');

    if (strlen($ua))
    {
        if ($ua{0}!='/')
        {
            $ua = '/' . $ua . '/i';
        }
        if (preg_match($ua, SB_safeVal($_SERVER,'HTTP_USER_AGENT')))
        {
            $writer = 'sitebar_plain';
        }
    }
}

if (strstr($writer,'xbel2'))
{
    $writer = 'dir';
}

// Live bookmarks
if ($writer == 'rss' &&  SB_reqVal('sd') == '0' && !isset($_SERVER['HTTPS']))
{
    header("Content-Type=application/xml; charset=utf-8");
    readfile('premium.rss');
    exit;
}

if ($writer && !strstr($writer,'.'))
{
    $writerFile = './inc/writers/'.$writer.'.inc.php';
    if (is_file($writerFile))
    {
        require_once($writerFile);
        eval('$writerObj = new SB_Writer_'. $writer .'();');

        if (SB_reqChk('sort'))
        {
            $sortMode = SB_reqVal('sort');

            if ( !($sortMode == 'custom' || $sortMode==''))
            {
                if ($sortMode == 'user')
                {
                    $sortMode = $writerObj->um->getParam('user', 'link_sort_mode');
                }

                $writerObj->tree->sortMode = $sortMode;
            }
        }

        if (SB_reqChk('mix'))
        {
            $writerObj->um->setParam('user','mix_mode',SB_reqVal('mix'));
        }

        if (SB_reqChk('sd') && SB_reqVal('sd')==0)
        {
            $writerObj->tree->maxLevel = 0;
        }

        foreach ($writerObj->switches as $key => $value)
        {
            if (SB_reqChk($key) && strlen(SB_reqVal($key)))
            {
                $writerObj->switches[$key] = SB_reqVal($key);
            }
        }

        if (SB_reqChk('user'))
        {
            $user = $writerObj->switches['user'];

            if (strlen($user))
            {
                $writerObj->um->setCookie('SB3USER', $user, 0 /*browser session*/);
            }
            else // Forget user
            {
                $writerObj->um->setCookie('SB3USER');
            }
        }
        else
        {
            if (isset($_COOKIE['SB3USER']))
            {
                $writerObj->switches['user'] = $_COOKIE['SB3USER'];
            }
        }

        if (SB_reqChk('cp'))
        {
            $writerObj->setCharset(SB_reqVal('cp'));
        }

        $writerObj->run();
        exit;
    }
}

header('Content-Type: text/html');
echo "Unknown SiteBar writer was selected!";

if (SB_ErrorHandler::hasErrors())
{
    SB_ErrorHandler::writeErrors();
}

?>
