<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *  Copyright (C) 2004  Gunnar Wrobel <sitebar@gunnarwrobel.de>               *
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

require_once('./inc/database.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/errorhandler.inc.php');
require_once('./inc/usermanager.inc.php');

/* Information implemented
 *      HEAD    : The HTML Header of the page
 *      CHARSET : The character set of the page
 *      TITLE   : The title of the page
 *      FAVURL  : The Url of the Favicon
 *                (Presence of this url does not denote
 *                 that there really is a favicon)
 *      FAVICON : The Favicon of the page
 *      ! If you wish to retrieve the favicon !
 *      ! from a normal webpage, do not       !
 *      ! specify 'FAVICON' directly. Instead !
 *      ! only retrieve 'FAVURL'. It will be  !
 *      ! read from the header of the webpage !
 *      ! and will automatically retrieve and !
 *      ! check the favicon.                  !
 *
 * Information not yet implemented
 *      MD5     : The MD5 hash of the page (might
 *                also use MODIFIED here, which would
 *                signify that the page was modified)
 */

// HTTP style errors

define ('PP_OK',                        299); // OK
define ('PP_ERR',                       400); // Common error
define ('PP_ERR__FAVICON_NOT_COMPLETE', 401); // Error
define ('PP_ERR__FAVICON_TOO_BIG',      501); // Fatal error
define ('PP_ERR__FAVICON_WRONG_SIZE',   502); // Fatal error
define ('PP_ERR__FAVICON_WRONG_FORMAT', 503); // Fatal error

class SB_HTTPStream extends SB_ErrorHandler
{
    // Handle for the connection to the
    // page
    var $connection = null;

    // Timeout for the connection
    var $timeout;

    // Host
    var $host;

    // Port
    var $port;

    function __construct($timeout=5)
    {
        $this->timeout = $timeout;
    }

    function setAddress($scheme, $host, $port)
    {
        $this->scheme = $scheme;
        $this->host = $host;
        // if the port isn't set explicitly, use the default port for
        // the given scheme.
        if (isset($port))
        {
            $this->port = $port;
        }
        else
        {
            $this->port = $scheme == 'https' ? 443 : 80;
        }
    }

    // Connect to the server
    function connect()
    {
        if ($this->connection)
        {
            $this->close();
            $this->connection = null;
        }

        if (!isset($this->host) || !isset($this->port))
        {
            $this->warn('Host or port undefined!');
            return false;
        }

        $errno = 0;
        $errstr = '';

        $fsockHost = $this->host;

        if ($this->scheme == 'https') 
        {
            $fsockHost = 'ssl://' . $this->host;
        } 

        $this->connection = fsockopen($fsockHost, $this->port,
                                      $errno, $errstr, $this->timeout);

        if (!$this->connection)
        {
            $this->warn('Cannot connect to %s://%s:%s!', 
                        array( $this->scheme, $this->host, $this->port));
            return false;
        }

        $this->setTimeOut();

        return true;
    }

    function setTimeOut($timeout=null)
    {
        socket_set_timeout($this->connection, $timeout===null?$this->timeout:$timeout);
    }

    function getMetaData()
    {
        socket_get_status($this->connection);
    }

    function put($data)
    {
        if (SB_LOG_HTTP) $this->log('> ', $data);
        return fputs($this->connection, $data);
    }

    function get($size=4096)
    {
        $data = fgets($this->connection, $size);
        if (SB_LOG_HTTP) $this->log('< ', $data);
        return $data;
    }

    function read($size=4096)
    {
        $data = fread($this->connection, $size);
        if (SB_LOG_HTTP) $this->log('< ', $data);
        return $data;
    }

    function flush()
    {
        while ($this->connection && $this->getMetaData() && $this->get());
    }

    function close()
    {
        if ($this->connection)
        {
            fclose($this->connection);
        }
        $this->connection = null;
    }
}

class SB_HTTPStream430 extends SB_HTTPStream
{
    function __construct($timeout=5)
    {
        parent::__construct($timeout);
    }

    function setTimeOut($timeout=null)
    {
        stream_set_timeout($this->connection, $timeout===null?$this->timeout:$timeout);
    }

    function getMetaData()
    {
        stream_get_meta_data($this->connection);
    }
}


class SB_PageParser extends SB_ErrorHandler
{
    var $um = null;
    var $expertMode = false;

    // HTTP stream
    var $http = null;

    // Redirection counting
    var $redirects = 0;
    var $maxRedirects = 3;

    var $https2http = false;
    var $failedFor = array();
    var $isDead = false;

    // Max download size
    var $maxBytes;

    // The url information in different
    // formats
    var $url;
    var $parsed;
    var $base;
    var $path;

    // The page information
    var $info = array();

    // Information error messages
    var $errorCode = array();

    function __construct($url)
    {
        $this->um =& SB_UserManager::staticInstance();

        $this->expertMode = $this->um->getParam('user','expert_mode');
        $this->maxBytes = $this->um->getParam('config','max_icon_size');

        /* This is the timeout while reading or writing data
         * The function name changed in PHP 4.3
         */
        if (version_compare(phpversion(), '4.3.0', '>='))
        {
            $this->http = new SB_HTTPStream430();
        }
        else
        {
            $this->http = new SB_HTTPStream();
        }

        // Set the necessary path information
        // so that url can be accessed by various
        // functions in different formats
        // calls $this->http->setAddress()
        if (!$this->setUrlInformation($url))
        {
            return;
        }
    }

    function getInformation($info=null)
    {
        if (!$this->retrieveHTTPHeaders())
        {
            $this->isDead = true;
            return false;
        }

        // We wanted just validation
        if (!$info)
        {
            return true;
        }

        foreach ($info as $value)
        {
            $this->errorCode[$value] = PP_ERR;
            $this->info[$value] = null;
        }

        // Get the page head so that we can get more information
        $this->retrieveHEADTag();

        if (!$this->hasErrors(E_ERROR))
        {
            foreach ($info as $value)
            {
                $this->errorCode[$value] = 0;
                $execute = 'parseHEADTagFor' . $value;
                if (method_exists($this, $execute))
                {
                    $this->$execute();
                }
            }
        }

        // Verify icon on FAVURL
        if ( in_array('FAVURL', $info) )
        {
            // Not found in HEAD, try default location
            if (!isset($this->info['FAVURL']))
            {
                $defLoc = $this->base . '/favicon.ico';
                if ($this->expertMode)
                {
                    $this->warn('Favicon not found! Trying default favicon location %s.', array($defLoc));
                }
                $this->info['FAVURL'] = $defLoc;
            }

            if (!$this->setUrlInformation($this->info['FAVURL']))
            {
                return false;
            }

            if (!$this->connect())
            {
                unset($this->info['FAVURL']);
                $this->errorCode['FAVURL'] = PP_ERR;
                if ($this->expertMode)
                {
                    $this->warn('Favicon not found!');
                }
            }
            else
            {
                $ico = '';
                $this->errorCode['FAVICON'] = $this->retrieveFAVICON($ico);

                if ($this->errorCode['FAVICON']<=PP_OK)
                {
                    $this->info['FAVICON'] = $ico;
                    $this->errorCode['FAVURL'] = $this->errorCode['FAVICON'];

                    require_once('./inc/faviconcache.inc.php');
                    require_once('./inc/usermanager.inc.php');

                    $fc =& SB_FaviconCache::staticInstance();

                    if ($this->um->getParam('config', 'use_favicon_cache')
                    && !$fc->isFaviconCached($this->info['FAVURL']))
                    {
                        // We have so save it
                        $fc->saveFavicon($this->info['FAVURL'], $this->info['FAVICON']);
                    }
                }
                else
                {
                    unset($this->info['FAVURL']);
                    $this->errorCode['FAVURL'] = PP_ERR;
                }
            }
        }

        return true;
    }

    function getContent()
    {
        if (SB_LOG_HTTP) $this->log("\rH:", "getContent\r");
        if (!$this->connect())
        {
            return false;
        }

        $this->http->put('GET ' . $this->path . ' HTTP/1.0'."\r\n");
        $this->http->put('Host: ' . $this->parsed['host'] . "\r\n");
        $this->http->put('Accept: text/html'."\r\n");
        $this->putCommonHeaders();

        $lines = $this->readHTTPHeaders();
        while ($line = $this->http->get())
        {
            $lines[] = trim($line);
        }

        $this->http->close();
        return $lines;
    }

    function connect()
    {
        $addr = $this->http->host.':'.$this->http->port;
        if (isset($this->failedFor[$addr]))
        {
            return false;
        }

        if (!$this->http->connect())
        {
            $this->failedFor[$addr]=true;
            return false;
        }
        return true;
    }

    function putCommonHeaders($close = true)
    {
        static $agent = null;
        if ($agent === null)
        {
            $agent = 'SiteBar/' . str_replace(' ', '', SB_CURRENT_RELEASE) . ' (Bookmark Server; http://sitebar.org/)';
        }

        $this->http->put( 'User-Agent: '.$agent."\r\n");

        // We cannot use Keep-Alive if we do not want to complicate the communication a lot.
        // It is not guaranteed that the connection would be kept and we do usually only 3
        // hits to one site. Keep-Alive could speed it up, but probably not very dramatically.
        // If someone wants to go this way, then he must count with other problems. He must
        // ensure that he flushes the stream, reads only what he should (some sites do not
        // sent Content-length!).
        $this->http->put('Connection: Close'."\r\n");

        $this->http->put('Referer: ' . SB_Page::absBaseUrl() . "\r\n");
        if ($close)
        {
            $this->http->put( "\r\n");
        }
    }

    /* This retrieves the HTTP HEAD
     * The function is only intended to be called by the
     * constructor.
     * The function has been adapted from the PEAR HTTP module.
     */
    function retrieveHTTPHeaders($request = 'HEAD')
    {
        if (SB_LOG_HTTP) $this->log("\rH:", "retrieveHTTPHeaders\r");
        if (!$this->connect())
        {
            return false;
        }

        $this->http->put($request . ' ' . $this->path . ' HTTP/1.0'."\r\n");
        $this->http->put('Host: ' . $this->parsed['host'] . "\r\n");
        $this->putCommonHeaders();

        $this->info['HEADERS'] = $this->readHTTPHeaders();

        $status = $this->http->getMetaData();
        if ($status['timed_out'] && $request == 'HEAD')
        {
            // Timeout. Might signify unsupported HEAD. Try a GET.
            $this->warn('HEAD unsupported, trying GET!'); // !! DEBUG
            $this->retrieveHTTPHeaders('GET');
        }
        else if ($status['timed_out'])
        {
            $this->warn('Connection timed out!');
        }
        else if (!isset($this->info['HEADERS']['response_code']))
        {
            $this->warn('Incomplete HTTP response!');
        }
        else if (intval($this->info['HEADERS']['response_code']) == 405
                 && $request == 'HEAD')
        {
            $this->retrieveHTTPHeaders('GET');
        }
        else if (intval($this->info['HEADERS']['response_code']) > 399)
        {
            $this->warn('Page not found!');
        }
        else if (intval($this->info['HEADERS']['response_code']) > 299)
        {
            if ($this->redirects > $this->maxRedirects)
            {
                if ($this->expertMode)
                {
                    $this->warn('No more than %s redirections allowed!', array($this->maxRedirects));
                }
            }
            else
            {
                $redirect = @parse_url($this->info['HEADERS']['location']);

                $url = $this->mergeRedirect($this->parsed, $redirect);

                if ($this->expertMode)
                {
                    $this->warn('Page redirected to %s!', array($url));
                }

                if (!$this->setUrlInformation($url))
                {
                    return false;
                }

                $this->redirects++;
                unset($this->info['HEADERS']);

                $this->retrieveHTTPHeaders();
            }
        }

        return true;
    }

    // Retrieve the HTML HEAD portion of the page
    function retrieveHEADTag()
    {
        if (SB_LOG_HTTP) $this->log("\rH:", "retrieveHEADTag\r");
        if (!$this->connect())
        {
            return;
        }

        $this->http->put('GET ' . $this->path . ' HTTP/1.0'."\r\n");
        $this->http->put('Host: ' . $this->parsed['host'] . "\r\n");
        $this->http->put('Accept: text/html'."\r\n");
        $this->putCommonHeaders();

        $this->info['HEADERS'] = $this->readHTTPHeaders();

        $head = '';
        $found = false;

        while ($line = $this->http->get())
        {
            $head .= $line;
            $end = strpos( strtolower($head), "</head>");

            if ($end !== false)
            {
                $found = true;
                $head = substr($head, 0, $end);
                break;
            }

            $pos = strlen($head);

            // Read too far into the page without finding </head>
            if ($pos > $this->maxBytes)
            {
                $head = null;
                break;
            }
        }

        if (!$found)
        {
            $this->warn('Head of the HTML page was not found!');
            $head = null;
        }

        $this->info['HEAD'] = $head;
        $this->http->close();

        return true;
    }

    function parseHEADTagForFAVURL()
    {
        preg_match_all ("/<([^<]*)>/", $this->info['HEAD'], $tags);
        // If there are any tags
        if ( count ($tags[1]) )
        {
            foreach ($tags[1] as $tag)
            {
                /* identify favicon references
                 * The common name for rel is usually "shortcut icon"
                 * but FireFox also accepts only "icon". So I shortened
                 * the match here.
                 */
                if (   preg_match('/link/i', $tag)
                    && preg_match('/rel=([\'"])[\w\s]*icon\1/i', $tag))
                {
                    if (preg_match ('/href=([\'"])(.+?)\1/i', $tag, $found))
                    {
                        $favurl = @parse_url($found[2]);
                        $this->info['FAVURL'] = $this->mergeRedirect($this->parsed, $favurl);
                        return;
                    }
                }
            }
        }

        $this->errorCode['FAVURL'] = PP_ERR;
    }

    function parseHEADTagForCHARSET()
    {
        //parse HTTP HEAD
        if (isset($this->info['HEADERS']['content-type']))
        {
            preg_match ('/charset=([^\s";]*)/', $this->info['HEADERS']['content-type'], $found);
            if (count($found))
            {
                $this->info['CHARSET'] = $found[1];
                return;
            }
        }

        preg_match_all ("/(<meta.*?>)/i", $this->info['HEAD'], $tags);
        // If there are any tags
        if ( count ($tags[1]) )
        {
            foreach ($tags[1] as $tag)
            {
                // identify meta charset references
                if (preg_match('/charset=([^\s";]*)/i', $tag, $found))
                {
                    $this->info['CHARSET'] = $found[1];
                    return;
                }
            }
        }

        $this->errorCode['CHARSET'] = PP_ERR;
    }

    function parseHEADTagForTITLE()
    {
        // identify title
        if (preg_match('#<title[^>]*>\s*(.*)\s*</title>#is', $this->info['HEAD'], $found))
        {
            $this->info['TITLE'] = $found[1];
            return;
        }

        $this->errorCode['TITLE'] = PP_ERR;
    }

    function parseHEADTagForDESC()
    {
        if (preg_match('#<meta name=([\'"])Description\1\s*content=([\'"])(.*?)\2#i', $this->info['HEAD'], $found))
        {
            $this->info['DESC'] = $found[3];
            return;
        }

        $this->errorCode['DESC'] = PP_ERR;
    }

    function parseHEADTagForKEYWORDS()
    {
        if (preg_match('#<meta name=([\'"])Keywords\1\s*content=([\'"])(.*)\2#i', $this->info['HEAD'], $found))
        {
            $this->info['KEYWORDS'] = $found[3];
            return;
        }

        $this->errorCode['KEYWORDS'] = PP_ERR;
    }

    function retrieveFAVICON(&$ico)
    {
        if (SB_LOG_HTTP) $this->log("\rH:", "retrieveFAVICON\r");

        for ($i=0; $i<2; $i++)
        {
            if (!$this->connect())
            {
                return PP_ERR;
            }

            $this->http->put('GET ' . $this->path . ' HTTP/1.0'."\r\n");
            $this->http->put('Host: ' . $this->parsed['host'] . "\r\n");
            $this->http->put('Accept: image/*,*/*;q=0.5'."\r\n");
            $this->putCommonHeaders();

            $head = $this->readHTTPHeaders();

            if (!isset($head['response_code']) || intval($head['response_code']) > 399)
            {
                if ($this->expertMode)
                {
                    $this->warn('Favicon not found!');
                }
                $this->http->close();
                return PP_ERR;
            }

            if (!isset($head['response_code']) || intval($head['response_code']) > 299)
            {
                $this->http->close();
                if (!$this->setUrlInformation($head['location']))
                {
                    return false;
                }
                continue;
            }

            break;
        }

        $ico = '';
        $data = '';

        while ( strlen($data = $this->http->read()) )
        {
            $ico .= $data;
        }

        $this->http->close();

        if (strlen($ico) > $this->maxBytes)
        {
            $this->warn('Icon size %s exceeds maximal size %s.', array(strlen($ico), $this->maxBytes));
            return PP_ERR__FAVICON_TOO_BIG;
        }

        if (!$this->faviconCheck($ico))
        {
            $ico = '';
            $this->warn('Wrong favicon type/format "%s"!', array($head['content-type']));
            return PP_ERR__FAVICON_WRONG_FORMAT;
        }

        return PP_OK;
    }

    // Parses the HTTP HEAD on the given connection
    function readHTTPHeaders()
    {
        $head = array();

        $response = rtrim($this->http->get());

        if (preg_match("|^HTTP/[^\s]*\s(\d*)|", $response, $status))
        {
            $head['response_code'] = $status[1];
        }
        $head['response'] = $response;

        while ($line = $this->http->get())
        {
            if (!trim($line))
            {
                break;
            }
            if (($pos = strpos($line, ':')) !== false)
            {
                // HTTP Headers are case insensitive
                $header = strtolower(substr($line, 0, $pos));
                $value  = trim(substr($line, $pos + 1));
                $head[$header] = $value;
            }
        }

        return $head;
    }

    // Parses the url
    function setUrlInformation($url)
    {
        // https is supported if "ssl" is an available transport
        // in this PHP environment
        $httpsSupported = in_array('ssl', stream_get_transports());

        // This may fail but it is not important here
        // Only the connection counts
        $this->parsed = @parse_url($url);

        if (!isset($this->parsed['path']))
        {
            $this->parsed['path'] = '/';
        }

        if (!isset($this->parsed['scheme']))
        {
            $this->parsed['scheme'] = 'http';
        }

        if ($this->parsed['scheme'] == 'https' && !$httpsSupported)
        {
            if (!$this->https2http)
            {
                $this->warn('Cannot download %s using https:, trying http:...', array($url));

                $this->parsed['scheme'] = 'http';
                $url = str_replace('https://','http://', $url);
                $this->https2http = true;
            }
            else
            {
                $this->warn($url . ': We tried using http: but were redirected back to https: -- giving up. ');
                return false;
            }
            
        }

        if (!in_array($this->parsed['scheme'], array('http','https')))
        {
            $this->warn('Cannot handle %s protocol!', array($this->parsed['scheme']));
            return false;
        }

        if (array_key_exists('query', $this->parsed))
        {
            $this->path = $this->parsed['path'] . '?' . $this->parsed['query'];
        }
        else
        {
            $this->path = $this->parsed['path'];
        }

        $this->base = $this->getUrlBase($this->parsed);

        $this->http->setAddress($this->parsed['scheme'],
                                $this->parsed['host'],
                                isset($this->parsed['port'])?$this->parsed['port']:null);

        $this->url = $url;
        return true;
    }

    //
    function getUrlBase($parsed)
    {
        $uri = '';
        if (array_key_exists ('scheme', $parsed))
        {
            $uri .=   $parsed['scheme']
                    ? $parsed['scheme'] . ':' . ((strtolower($parsed['scheme']) == 'mailto')
                      ? ''
                      : '//')
                    : '';
        }
        if (array_key_exists ('user', $parsed))
        {
            $uri .=   $parsed['user']
                    ? $parsed['user'] . ($parsed['pass']
                      ? ':' . $parsed['pass']
                      : '') . '@'
                    : '';
        }
        if (array_key_exists ('host', $parsed))
        {
            $uri .=   $parsed['host']
                    ? $parsed['host']
                    : '';
        }
        if (array_key_exists ('port', $parsed))
        {
            if ($parsed['scheme']!='http' || $parsed['port']!=80)
            {
                $uri .=   $parsed['port']
                        ? ':' . $parsed['port']
                        : '';
            }
        }
        return $uri;
    }

    // merge two parsed urls to one new, redirected url string
    function mergeRedirect($base, $redirect)
    {
        $oldpath = '';

        if (isset($base['path']))
        {
            if ($base['path']{strlen($base['path'])-1} == '/')
            {
                $oldpath = $base['path'];
            }
            else
            {
                // For servers hosted on Windows
                $oldpath = str_replace('\\','/',dirname($base['path']));
            }
        }

        $new = array_merge($base, $redirect);

        if (isset($new['path']) && strlen($new['path']))
        {
            if ($new['path']{0} == '/')
            {
                return $this->getUrlBase($new) . $new['path'];
            }
            else
            {
                if( substr($oldpath, -1) == '/')
                {
                    return $this->getUrlBase($new) . $oldpath . $new['path'];
                }
                else
                {
                    return $this->getUrlBase($new) . $oldpath . '/' . $new['path'];
                }
            }
        }
        else
        {
            return $this->getUrlBase($new);
        }
    }

    // Convert 4 bytes (big endian) to a long integer
    function bigEndianBin2long($bin_string)
    {
        for ($i = 0; $i < strlen( $bin_string); $i++)
        {
            $a[$i] = ord(substr( $bin_string, $i, 1));
        }
        return ($a[3] << 24) |  ($a[2] << 16) | ($a[1] << 8) | $a[0];
    }

    // Convert 2 bytes (big endian) to an integer
    function bigEndianBin2short($bin_string)
    {
        for ($i = 0; $i < strlen( $bin_string); $i++)
        {
            $a[$i] = ord(substr( $bin_string, $i, 1));
        }
        return ($a[1] << 8) | $a[0];
    }

    // Check the binary format of a file for BMP or ICO format.
    function faviconCheck ($ico)
    {
        if( substr($ico,0,3)=='GIF'
        ||  substr($ico,6,4)=='JFIF'
        ||  substr($ico,1,3)=='PNG')
        {
            return true;
        }

        /* It could be a BMP. It would then start with 'BM',
         * followed by a magic 0 after 6 bytes and a magic 40 after
         * 14 bytes (see http://www.daubnet.com/formats/BMP.html)
         */
        if ( strlen($ico) >= 40
             && substr( $ico, 0, 2) == 'BM'
             && SB_PageParser::bigEndianBin2long( substr( $ico, 6, 4)) == 0
             && SB_PageParser::bigEndianBin2long( substr( $ico, 14, 4)) == 40)
        {
            // Highly probable that this is really a BMP
            return true;
        }

        /* It could also be ICO-format. It would then start with
         * a leading zero, followed by a magic 1.
         * (see http://www.daubnet.com/formats/ICO.html)
         */
        if ( strlen($ico) >= 4
             && SB_PageParser::bigEndianBin2short( substr( $ico, 0, 2)) == 0
             && SB_PageParser::bigEndianBin2short( substr( $ico, 2, 2)) == 1)
        {
            // Check for the magic 40 after some header bytes
            $offset = SB_PageParser::bigEndianBin2short( substr( $ico, 4, 2)) * 16;
            if (SB_PageParser::bigEndianBin2long( substr( $ico, 6 + $offset, 4)) == 40)
            {
                // Highly probable that this is really an ICO
                return true;
            }
        }

        return false;
    }

}
?>
