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

define('SB_CHARSET_IGNORE',   0);
define('SB_CHARSET_ICONV',    1);
define('SB_CHARSET_LIBICONV', 2);
define('SB_CHARSET_RECODE',   3);

class SB_Converter extends SB_ErrorHandler
{
    // List of available languages
    var $languages;

    // Default charSet
    var $charSet;

    // Use conversion engine
    var $useEngine = false;


    function __construct($useEngine=true, $charSet='utf-8')
    {
        $this->useEngine = $useEngine;

        if ($charSet==null)
        {
            $charSet = 'utf-8';
        }

        $this->languages = array(
            'af-iso-8859-1'=> array('af|afrikaans', 'afrikaans', 'iso-8859-1', 'af'),
            'ar-win1256'   => array('ar([-_][[:alpha:]]{2})?|arabic', 'arabic', 'windows-1256', 'ar'),
            'bg-win1251'   => array('bg|bulgarian', 'bulgarian', 'windows-1251', 'bg'),
            'bg-koi8-r'    => array('bg|bulgarian', 'bulgarian', 'koi8-r', 'bg'),
            'ca-iso-8859-1'=> array('ca|catalan', 'catalan', 'iso-8859-1', 'ca'),
            'cs-iso-8859-2'=> array('cs|czech', 'czech', 'iso-8859-2', 'cs'),
            'cs-win1250'   => array('cs|czech', 'czech', 'windows-1250', 'cs'),
            'da-iso-8859-1'=> array('da|danish', 'danish', 'iso-8859-1', 'da'),
            'de-iso-8859-1'=> array('de([-_][[:alpha:]]{2})?|german', 'german', 'iso-8859-1', 'de'),
            'el-iso-8859-7'=> array('el|greek',  'greek', 'iso-8859-7', 'el'),
            'en-iso-8859-1'=> array('en([-_][[:alpha:]]{2})?|english',  'english', 'iso-8859-1', 'en'),
            'es-iso-8859-1'=> array('es([-_][[:alpha:]]{2})?|spanish', 'spanish', 'iso-8859-1', 'es'),
            'et-iso-8859-1'=> array('et|estonian', 'estonian', 'iso-8859-1', 'et'),
            'fi-iso-8859-1'=> array('fi|finnish', 'finnish', 'iso-8859-1', 'fi'),
            'fr-iso-8859-1'=> array('fr([-_][[:alpha:]]{2})?|french', 'french', 'iso-8859-1', 'fr'),
            'gl-iso-8859-1'=> array('gl|galician', 'galician', 'iso-8859-1', 'gl'),
            'he-iso-8859-8-i'=> array('he|hebrew', 'hebrew', 'iso-8859-8-i', 'he'),
            'hr-win1250'   => array('hr|croatian', 'croatian', 'windows-1250', 'hr'),
            'hr-iso-8859-2'=> array('hr|croatian', 'croatian', 'iso-8859-2', 'hr'),
            'hu-iso-8859-2'=> array('hu|hungarian', 'hungarian', 'iso-8859-2', 'hu'),
            'id-iso-8859-1'=> array('id|indonesian', 'indonesian', 'iso-8859-1', 'id'),
            'it-iso-8859-1'=> array('it|italian', 'italian', 'iso-8859-1', 'it'),
            'ja-euc'       => array('ja|japanese', 'japanese', 'euc-jp', 'ja'),
            'ja-sjis'      => array('ja|japanese', 'japanese', 'shift_jis', 'ja'),
            'ko-uhc'       => array('ko|korean', 'korean', 'uhc', 'ko'),
            'lt-win1257'   => array('lt|lithuanian', 'lithuanian', 'windows-1257', 'lt'),
            'lv-win1257'   => array('lv|latvian', 'latvian', 'windows-1257', 'lv'),
            'ms-iso-8859-1'=> array('ms|malay', 'malay', 'iso-8859-1', 'ms'),
            'nl-iso-8859-1'=> array('nl([-_][[:alpha:]]{2})?|dutch', 'dutch', 'iso-8859-1', 'nl'),
            'no-iso-8859-1'=> array('no|norwegian', 'norwegian', 'iso-8859-1', 'no'),
            'pl-iso-8859-2'=> array('pl|polish', 'polish', 'iso-8859-2', 'pl'),
            'pt-br-iso-8859-1' => array('pt[-_]br|brazilian port.', 'brazilian_portuguese', 'iso-8859-1', 'pt-BR'),
            'pt-iso-8859-1'=> array('pt([-_][[:alpha:]]{2})?|portuguese', 'portuguese', 'iso-8859-1', 'pt'),
            'ro-iso-8859-1'=> array('ro|romanian', 'romanian', 'iso-8859-1', 'ro'),
            'ru-win1251'   => array('ru|russian', 'russian', 'windows-1251', 'ru'),
            'ru-dos-866'   => array('ru|russian', 'russian', 'dos-866', 'ru'),
            'ru-koi8-r'    => array('ru|russian', 'russian', 'koi8-r', 'ru'),
            'sk-iso-8859-2'=> array('sk|slovak', 'slovak', 'iso-8859-2', 'sk'),
            'sk-win1250'   => array('sk|slovak', 'slovak', 'windows-1250', 'sk'),
            'sl-iso-8859-2'=> array('sl|slovenian', 'slovenian', 'iso-8859-2', 'sl'),
            'sl-win1250'   => array('sl|slovenian', 'slovenian', 'windows-1250', 'sl'),
            'sq-iso-8859-1'=> array('sq|albanian', 'albanian', 'iso-8859-1', 'sq'),
            'sr-win1250'   => array('sr|serbian', 'serbian', 'windows-1250', 'sr'),
            'sv-iso-8859-1'=> array('sv|swedish', 'swedish', 'iso-8859-1', 'sv'),
            'th-tis-620'   => array('th|thai', 'thai', 'tis-620', 'th'),
            'tr-iso-8859-9'=> array('tr|turkish', 'turkish', 'iso-8859-9', 'tr'),
            'uk-win1251'   => array('uk|ukrainian', 'ukrainian', 'windows-1251', 'uk'),
            'zh-tw'        => array('zh[-_]tw|chinese traditional', 'chinese', 'big5', 'zh-TW'),
            'zh-gbk'       => array('zh|chinese simplified', 'chinese', 'gbk', 'zh')
        );

        $this->setCharSet($charSet);
    }

    function setCharSet($charset)
    {
        $this->charSet = strtolower($charset);
    }

    function getEngine()
    {
        static $engine = -1;

        if ($engine!=-1)
        {
            return $engine;
        }

        if (!$this->useEngine)
        {
            $engine = SB_CHARSET_IGNORE;
            return $engine;
        }

        if (!function_exists('iconv') && !extension_loaded('iconv'))
        {
            $this->useHandler(false);
            @dl('iconv');
            $this->useHandler();
        }

        if (function_exists('iconv'))
        {
            $engine = SB_CHARSET_ICONV;
        }
        elseif (function_exists('libiconv'))
        {
            $engine = SB_CHARSET_LIBICONV;
        }
        else
        {
            if (!function_exists('recode_string') && !extension_loaded('recode'))
            {
                $this->useHandler(false);
                @dl('recode');
                $this->useHandler();
            }

            if (function_exists('recode_string'))
            {
                $engine = SB_CHARSET_RECODE;
            }
            else
            {
                $engine = SB_CHARSET_IGNORE;
            }
        }

        return $engine;
    }

    function langDetect()
    {
        if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $str = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            foreach ($this->languages as $key => $value)
            {
                if (preg_match('/^(' . $value[0] . ').*?(;q=[0-9]\\.[0-9])?$/', $str))
                {
                    return $key;
                }
            }
        }

        return $this->charSet;
    }

    function toUTF8($text)
    {
        if ($this->charSet == 'utf-8')
        {
            return $text;
        }

        switch ($this->getEngine())
        {
            case SB_CHARSET_ICONV:
                return iconv($this->charSet, 'utf-8', $text);

            case SB_CHARSET_LIBICONV:
                return libiconv($this->charSet, 'utf-8', $text);

            case SB_CHARSET_RECODE:
                return recode_string($this->charSet .'..'. 'utf-8', $text);

            default:
                return utf8_encode($text);
        }
    }

    function fromUTF8($text)
    {
        if ($this->charSet == 'utf-8')
        {
            return $text;
        }

        switch ($this->getEngine())
        {
            case SB_CHARSET_ICONV:
                return iconv('utf-8', $this->charSet."//TRANSLIT", $text);

            case SB_CHARSET_LIBICONV:
                return libiconv('utf-8', $this->charSet, $text);

            case SB_CHARSET_RECODE:
                return recode_string('utf-8' .'..'. $this->charSet, $text);

            default:
                return utf8_decode($text);
        }
    }

    function utf8RawUrlDecode($source)
    {
        $decodedStr = '';
        $pos = 0;
        $len = strlen ($source);

        while ($pos < $len)
        {
            $charAt = substr ($source, $pos, 1);
            if ($charAt == '%')
            {
                $pos++;
                $charAt = substr ($source, $pos, 1);
                if ($charAt == 'u')
                {
                    // we got a unicode character
                    $pos++;
                    $unicodeHexVal = substr ($source, $pos, 4);
                    $unicode = hexdec ($unicodeHexVal);
                    $entity = "&#". $unicode . ';';
                    $decodedStr .= $this->utf8Encode($entity);
                    $pos += 4;
                }
                else
                {
                    // we have an escaped ascii character
                    $hexVal = substr ($source, $pos, 2);
                    $decodedStr .= $this->toUTF8(chr (hexdec ($hexVal)));
                    $pos += 2;
                }
            }
            else
            {
                $decodedStr .= $this->toUTF8($charAt);
                $pos++;
            }
        }
        return $decodedStr;
    }

    function utf8Encode ($source)
    {
        $utf8Str = '';
        $entityArray = explode ("&#", $source);
        $size = count ($entityArray);
        for ($i = 0; $i < $size; $i++)
        {
            $subStr = $entityArray[$i];
            $nonEntity = strstr ($subStr, ';');
            if ($nonEntity !== false)
            {
                $unicode = intval (substr ($subStr, 0, (strpos ($subStr, ';') + 1)));
                // determine how many chars are needed to reprsent this unicode char
                if ($unicode < 128)
                {
                    $utf8Substring = chr ($unicode);
                }
                else if ($unicode >= 128 && $unicode < 2048)
                {
                    $binVal = str_pad (decbin ($unicode), 11, '0', STR_PAD_LEFT);
                    $binPart1 = substr ($binVal, 0, 5);
                    $binPart2 = substr ($binVal, 5);

                    $char1 = chr (192 + bindec ($binPart1));
                    $char2 = chr (128 + bindec ($binPart2));
                    $utf8Substring = $char1 . $char2;
                }
                else if ($unicode >= 2048 && $unicode < 65536)
                {
                    $binVal = str_pad (decbin ($unicode), 16, '0', STR_PAD_LEFT);
                    $binPart1 = substr ($binVal, 0, 4);
                    $binPart2 = substr ($binVal, 4, 6);
                    $binPart3 = substr ($binVal, 10);

                    $char1 = chr (224 + bindec ($binPart1));
                    $char2 = chr (128 + bindec ($binPart2));
                    $char3 = chr (128 + bindec ($binPart3));
                    $utf8Substring = $char1 . $char2 . $char3;
                }
                else
                {
                    $binVal = str_pad (decbin ($unicode), 21, '0', STR_PAD_LEFT);
                    $binPart1 = substr ($binVal, 0, 3);
                    $binPart2 = substr ($binVal, 3, 6);
                    $binPart3 = substr ($binVal, 9, 6);
                    $binPart4 = substr ($binVal, 15);

                    $char1 = chr (240 + bindec ($binPart1));
                    $char2 = chr (128 + bindec ($binPart2));
                    $char3 = chr (128 + bindec ($binPart3));
                    $char4 = chr (128 + bindec ($binPart4));
                    $utf8Substring = $char1 . $char2 . $char3 . $char4;
                }

                if (strlen ($nonEntity) > 1)
                {
                    $nonEntity = substr ($nonEntity, 1); // chop the first char (';')
                }
                else
                {
                    $nonEntity = '';
                }
                $utf8Str .= $utf8Substring . $nonEntity;
            }
            else
            {
                $utf8Str .= $subStr;
            }
        }
        return $utf8Str;
    }
}
?>
