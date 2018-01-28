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

// This module must run without SB_ErrorHandler!

class SB_Localizer
{
    var $dir = './locale';
    var $text;
    var $para;
    var $paraDefault;
    var $lang;
    var $langDefault = 'en_US';
    var $pluginPaths = array();

    function __construct()
    {
        $this->lang = $this->langDefault;

        if (!is_dir($this->dir))
        {
            $this->dir = '../locale';
        }

        $this->loadDefault();
    }

    // Obsolete, use staticInstance
    function & getInstance()
    {
        return SB_Localizer::staticInstance();
    }

    static function & staticInstance()
    {
        static $instance;

        if (!$instance)
        {
            $instance = new SB_Localizer();
        }

        return $instance;
    }

    function getLanguages()
    {
        static $langs = null;

        if ($langs)
        {
            return $langs;
        }

        $langs = array();

        if ($dir = opendir($this->dir))
        {
            while (($dirName = readdir($dir)) !== false)
            {
                $infofile = $this->dir.'/'.$dirName.'/info.inc.php';
                if (!is_dir($this->dir.'/'.$dirName) || !is_file($infofile)) continue;

                include($infofile);

                $info['dir']=$dirName;
                $langs[] = $info;
            }
            closedir($dir);

            function _lclangCmp(&$a, $b)
            {
                return (strcmp($a['dir'], $b['dir']));
            }

            uasort($langs, '_lclangCmp');
            reset($langs);
        }

        return $langs;
    }

    function getBrowserLang()
    {
        static $fmt = '/^(%s).*?(;q=[0-9]\\.[0-9])?$/i';

        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $str = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

            foreach ($this->getLanguages() as $lang)
            {
                $dir = str_replace('_','-',$lang['dir']);

                if (preg_match(sprintf($fmt, $dir), $str))
                {
                    return $lang['dir'];
                }

                if (isset($lang['aliases']))
                {
                    foreach ($lang['aliases'] as $dirName)
                    {
                        $dir = str_replace('_','-',$dirName);

                        if (preg_match(sprintf($fmt, $dir), $str))
                        {
                            return $lang['dir'];
                        }
                    }
                }
            }

            foreach ($this->getLanguages() as $lang)
            {
                list($ln,$country) = explode('_',$lang['dir']);

                if (preg_match(sprintf($fmt, $ln), $str))
                {
                    return $lang['dir'];
                }

                if (isset($lang['aliases']))
                {
                    foreach ($lang['aliases'] as $dirName)
                    {
                        list($ln,$country) = explode('_',$dirName);

                        if (preg_match(sprintf($fmt, $ln), $str))
                        {
                            return $lang['dir'];
                        }
                    }
                }
            }
        }

        return null;
    }

    function setPlugins(&$pluginPaths)
    {
        $this->pluginPaths =& $pluginPaths;
        $this->loadDefault();
    }

    function loadDefault()
    {
        if (require($this->dir.'/'.$this->langDefault.'/para.inc.php'))
        {
            $this->text = array();

            foreach ($this->pluginPaths as $pluginPath)
            {
                $langfile = $pluginPath . '/locale/' . $this->langDefault . '/para.inc.php';

                if (is_file($langfile))
                {
                    include($langfile);
                }
            }

            $this->para = $para;
            $this->paraDefault = $para;
        }
    }

    function getText($msg, $params=null)
    {
        $lmsg = '';
        if ($this->isDefault())
        {
            $lmsg = $msg;
        }
        else
        {
            if (isset($this->text[strtolower($msg)]))
            {
                $lmsg = $this->text[strtolower($msg)];
                if (substr($lmsg,0,3) == '<@>')
                {
                    $lmsg = $msg;
                }
            }
            else
            {
                $lmsg = $msg;
            }
        }

        if ($params)
        {
            $lmsg = vsprintf($lmsg, $params);
        }

        return $lmsg;
    }

    function getPara($id, $params=null)
    {
        $lmsg = '';

        if (isset($this->para[$id]))
        {
            $lmsg = $this->para[$id];
            if (substr($lmsg,0,3) == '<@>')
            {
                $lmsg = $this->paraDefault[$id];
            }
        }
        elseif (isset($this->paraDefault[$id]))
        {
            $lmsg = $this->paraDefault[$id];
        }
        else
        {
            $lmsg = $id;
            $params = null;
        }

        if ($params)
        {
            $lmsg = vsprintf($lmsg, $params);
        }

        return $lmsg;
    }

    function isDefault()
    {
        return $this->lang==$this->langDefault;
    }

    function getLang()
    {
        return $this->lang?$this->lang:$this->langDefault;
    }

    function setLang($lang)
    {
        if (!$lang)
        {
            $lang = $this->langDefault;
        }

        $this->lang=$lang;

        $file = $this->dir.'/'.$this->lang.'/text.inc.php';

        if (is_file($file))
        {
            include($file);

            if (!$this->isDefault())
            {
                foreach ($this->pluginPaths as $pluginPath)
                {
                    $langfile = $pluginPath . '/locale/'.$lang.'/text.inc.php';

                    if (is_file($langfile))
                    {
                        include($langfile);
                    }
                }

                // transform the text keys into lower case so as to make the lookup case insensitive
                foreach ($text as $key => $value)
                {
                    $this->text[strtolower($key)] = $value;
                }
            }
        }

        $file = $this->dir.'/'.$this->lang.'/para.inc.php';

        if (is_file($file))
        {
            include($file);

            foreach ($this->pluginPaths as $pluginPath)
            {
                $langfile = $pluginPath . '/locale/'.$lang.'/para.inc.php';

                if (is_file($langfile))
                {
                    include($langfile);
                }
            }

            $this->para = $para;
        }
    }

    function getHelpTopics()
    {
        include($this->dir.'/'.$this->langDefault.'/topic.inc.php');
        $defaultTopic = $topic;
        include($this->dir.'/'.$this->lang.'/topic.inc.php');

        foreach ($defaultTopic as $id => $label)
        {
            if (!isset($topic[$id]))
            {
                $topic[$id] = $defaultTopic[$id];
            }
        }

        return $topic;
    }

    function getHelp($id)
    {
        include($this->dir.'/'.$this->langDefault.'/help.inc.php');
        $defaultHelp = $help;
        include($this->dir.'/'.$this->lang.'/help.inc.php');

        echo $help[$id]?$help[$id]:$defaultHelp[$id];
    }
}

function SB_T($msg, $params=null)
{
    if (trim($msg)=='')
    {
        return $msg;
    }
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->getText($msg, $params);
}

function SB_P($id, $params=null)
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->getPara($id, $params);
}

function SB_C($context, $msg, $params=null)
{
    return SB_P($context.'::'.$msg, $params);
}

function SB_A($id, $pairs, $open='{', $close='}')
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    $para = $SB_Localizer->getPara($id);

    foreach ($pairs as $key => $value)
    {
        $para = str_replace($open.$key.$close, $value, $para);
    }

    return $para;
}

function SB_SetLanguage($lang)
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->setLang($lang);
}

function SB_GetLanguage()
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->getLang();
}

function SB_GetHelpTopics()
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->getHelpTopics();
}

function SB_GetHelp($params)
{
    $SB_Localizer =& SB_Localizer::staticInstance();
    return $SB_Localizer->getHelp($params['topic']);
}

?>
