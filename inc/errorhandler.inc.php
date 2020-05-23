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

define('SB_DEVELOPMENT', false);

// Change the "false" to "true" to perform logging on basic level in production
// software.
define('SB_DEBUGGING', SB_DEVELOPMENT || false);

// Please note that the http server must have rights to write to the file
// specified bellow. You may change the log file path here.
define('SB_SHOW_PHP_ERRORS', SB_DEBUGGING);
define('SB_LOG_HTTP', SB_DEBUGGING && false);
define('SB_LOG_SQL', SB_DEBUGGING && true);

require_once './lib/vendor/tracy/tracy/src/tracy.php';
use Tracy\Debugger;


if (SB_SHOW_PHP_ERRORS)
{
    error_reporting(E_ALL | E_STRICT); // We want to see all errors, regardless of php.ini
    Debugger::enable(Debugger::DEVELOPMENT);
}
// This should be a static class variable, if PHP 4 were OO language :-)
$SB_errorHandler__errorCount = 0;
$SB_errorHandler__warnCount = 0;
$SB_errorHandler__messages = array();

$SB_errorHandler__phpHandlerUsed = 0;
$SB_errorHandler__phpHandlerSet = 0;
$SB_errorHandler__ignoreWarnings = 0;

function SB_safeVal(&$ascArr, $field, $default = null)
{
    if (isset($ascArr[$field]))
    {
        return $ascArr[$field];
    }
    return $default;
}

function SB_errorHandler_handler($errno, $errstr, $errfile, $errline)
{
    if (!SB_SHOW_PHP_ERRORS)
    {
        return;
    }

    global $SB_errorHandler__phpHandlerUsed;
    $SB_errorHandler__phpHandlerUsed++;

    $errHandler = new SB_ErrorHandler();
    $pathParts = pathinfo($errfile);
    $location = $pathParts['basename'] . ' line ' . $errline;

    switch ($errno)
    {
        case E_ERROR:
            $errHandler->error("%s [%s]", array($errstr, $location));
            break;

        // E_STRICT - PHP 5.0 wants access modifiers instead of var
        // We will wait and switch to the new way only when PHP 4.0
        // is no more used (never?).
        case 2048:
            break;

        case E_WARNING:
        default:
            $errHandler->warn("%s [%s]", array($errstr, $location));
            break;
    }
}

require_once('./inc/localizer.inc.php');

class SB_StopWatch
{
    var $started = 0;
    var $elapsed = 0;

    function __construct()
    {
        $this->start();
    }

    function start()
    {
        $this->elapsed = 0;
        $this->cont();
    }

    function cont()
    {
        $this->started = $this->getMicroTime();
    }

    function pause()
    {
        $this->elapsed += $this->getMicroTime() - $this->started;
        return $this->elapsed;
    }

    function stop()
    {
        return $this->pause();
    }

    public static function getMicroTime()
    {
        list($usec, $sec) = explode(' ',microtime());
        return ((float)$usec + (float)$sec);
    }
}

class SB_ErrorHandler
{
    function useHandler($sbHandler = true)
    {
        global $SB_errorHandler__phpHandlerSet;

        if ($sbHandler)
        {
            if (!$SB_errorHandler__phpHandlerSet)
            {
                set_error_handler('SB_errorHandler_handler');
            }
            $SB_errorHandler__phpHandlerSet++;
        }
        else
        {
            if ($SB_errorHandler__phpHandlerSet)
            {
                restore_error_handler();
            }
            $SB_errorHandler__phpHandlerSet--;
        }
    }

    function ignoreWarnings($ignore=true)
    {
        global $SB_errorHandler__ignoreWarnings;

        if ($ignore)
        {
            $SB_errorHandler__ignoreWarnings++;
        }
        else
        {
            $SB_errorHandler__ignoreWarnings--;
        }
    }

    /**
    * Issue error
    */
    function error($msg, $arr=null)
    {
        global $SB_errorHandler__errorCount;
        $SB_errorHandler__errorCount++;
        $errors =& SB_ErrorHandler::getErrors();
        $errors[] = array(E_ERROR,SB_ErrorHandler::formatError($msg ?? "Unknown error", $arr));
    }

    /**
    * Issue warning
    */
    function warn($msg, $arr=null)
    {
        global $SB_errorHandler__ignoreWarnings;

        if ($SB_errorHandler__ignoreWarnings)
        {
            return;
        }

        global $SB_errorHandler__warnCount;
        $SB_errorHandler__warnCount++;
        $errors =& SB_ErrorHandler::getErrors();
        $errors[] = array(E_WARNING,SB_ErrorHandler::formatError($msg, $arr));
    }

    /**
    * Fatal error
    */
    function fatal($msg, $arr=null)
    {
        SB_ErrorHandler::error($msg, $arr);
        SB_ErrorHandler::writeErrors();
        die();
    }

    function formatError($msg, $arr=null)
    {
        $txt = '';

        if (!$msg) // No formatting
        {
            $txt = $arr;
        }
        else
        {
            $txt = SB_T($msg,$arr);
        }

        return $this->log("\nE:", $txt);
    }

    /**
    * Returns any possible errors
    */
    function & getErrors()
    {
        global $SB_errorHandler__messages;
        return $SB_errorHandler__messages;
    }

    /**
    * Tells wheter there were php errors handled
    */
    function hasHandledErrors()
    {
        global $SB_errorHandler__phpHandlerUsed;
        return $SB_errorHandler__phpHandlerUsed;
    }

    /**
    * Tells whether there are errors to be reported
    */
    function hasErrors($type=null)
    {
        global $SB_errorHandler__errorCount, $SB_errorHandler__warnCount;

        switch ($type)
        {
            case E_ERROR:
                return $SB_errorHandler__errorCount;

            case E_WARNING:
                return $SB_errorHandler__warnCount;

            default:
                return count(SB_ErrorHandler::getErrors());
        }
    }

    /**
    * Write errors as UL
    */
    function writeErrors($fulldetails = true)
    {
        if (SB_ErrorHandler::hasHandledErrors())
        {
            $fulldetails = true;
        }

        foreach (SB_ErrorHandler::getErrors() as $err)
        {
            $el = "";
            switch($err[0])
            {
                case E_ERROR:
                    $el = SB_T('Error');
                    break;

                case E_WARNING:
                    $el = SB_T('Warning');
                    break;

                default:
                    $el = SB_T('Unknown');
            }

            echo "<p>";
            if ($fulldetails)
            {
                echo $el . ": ";
            }
            echo $err[1];
        }
    }

    function log($prefix, $data=null)
    {
        if (SB_DEBUGGING)
        {
            $this->useHandler(false);
            Debugger::fireLog($prefix.": ".$data);
            $this->useHandler();
        }
        return $data;
    }

    function dump($expr,$inscript=0)
    {
        Debugger::fireDump($expr);
    }
}

$SB_ErrorHandler_obj = new SB_ErrorHandler;
$SB_ErrorHandler_obj->useHandler();
