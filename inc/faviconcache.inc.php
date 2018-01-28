<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004  Gunnar Wrobel <sitebar@gunnarwrobel.de>               *
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

require_once('./inc/database.inc.php');
require_once('./inc/pageparser.inc.php');
require_once('./inc/usermanager.inc.php');
require_once('./inc/errorhandler.inc.php');

class SB_FaviconCache extends SB_ErrorHandler
{
    // The class needs the db as storage place
    var $db;
    // And the usermanager for user related functions
    var $um;

    function __construct()
    {
        $this->db =& SB_Database::staticInstance();
        $this->um =& SB_UserManager::staticInstance();
    }

    public static function & staticInstance()
    {
        static $cache;

        if (!$cache)
        {
            $cache = new SB_FaviconCache();
        }

        return $cache;
    }

    function purgeUsingCursor(&$res)
    {
        $count = 0;

        $records = $this->db->fetchRecords($res);

        foreach ($records as $rec)
        {
            // Delete it from cache anyway
            $this->db->delete('sitebar_cache', array
            (
                'type'=>'favicon',
                '^1'=>'AND',
                'ckey'=> $rec['ckey']
            ));

            if ($this->db->getAffectedRows())
            {
                $count++;
            }
        }

        return $count;
    }

    function hasSpace()
    {
        // Check only once for one execution
        static $hasSpaceCached;

        if ($hasSpaceCached !== null)
            return $hasSpaceCached;

        // Check how many icons we have
        $res = $this->db->select('count(*) count', 'sitebar_cache', "type = 'favicon'");
        $rec = $this->db->fetchRecord($res);

        // We have free place then return
        if ($rec['count']<$this->um->getParam('config','max_icon_cache'))
        {
            return ($hasSpaceCached = true);
        }

        /* This is too slow query - and orphans will go away with cache as well

        // NON BINARY: Delete orphans
        $res = $this->db->select
        (
            "ckey",
            "sitebar_cache LEFT OUTER JOIN sitebar_link ON ( md5(favicon) = ckey )",
            "sitebar_cache.type='favicon' AND lid IS NULL AND ckey NOT LIKE 'binary:%'"
        );

        $purged = $this->purgeUsingCursor($res);

        // BINARY: Delete orphans
        $res = $this->db->select
        (
            "ckey",
            "sitebar_cache LEFT OUTER JOIN sitebar_link ON ( favicon = ckey )",
            "sitebar_cache.type='favicon' AND lid IS NULL AND ckey LIKE 'binary:%'"
        );
        $purged += $this->purgeUsingCursor($res);

        if ($purged)
        {
            return ($hasSpaceCached = true);
        }

        */

        $maxAge = $this->um->getParam('config','max_icon_age');

        // NON BINARY: We have too many icons in total, purge old non binary icons - we can get them from web
        for ($i=$maxAge; $i>0; $i--)
        {
            $result = $this->db->delete('sitebar_cache',
                "type = 'favicon' AND to_days(now()) - to_days(created) > $i AND ckey NOT LIKE 'binary:%'");

            // If we delete something, then hooray and return
            if ($this->db->getAffectedRows())
            {
                return ($hasSpaceCached = true);
            }
        }

        // BINARY: We have too many icons in total, purge the old icons
        for ($i=$maxAge; $i>0; $i--)
        {
            $result = $this->db->delete('sitebar_cache',
                "type = 'favicon' AND to_days(now()) - to_days(created) > $i AND ckey LIKE 'binary:%'");

            // If we delete something, then hooray and return
            if ($this->db->getAffectedRows())
            {
                return ($hasSpaceCached = true);
            }
        }

        return ($hasSpaceCached = false);
    }

    function purge($lid = null)
    {
        if ($lid === null)
        {
            $this->db->delete('sitebar_cache', array
            (
                'type'=>'favicon',
            ));
        }
        else
        {
            // Get the url corresponding to the link id
            $select = $this->db->select( 'favicon', 'sitebar_link', array('lid' => $lid));
            $found = $this->db->fetchRecord($select);

            if (is_array($found) && isset($found['favicon']) && $found['favicon'])
            {
                // Delete it from cache anyway
                $this->db->delete('sitebar_cache', array
                (
                    'type'=>'favicon',
                    '^1'=>'AND',
                    'ckey'=> md5($found['favicon'])
                ));
            }
        }
    }

    function faviconGetAll()
    {
        $select = $this->db->select('ckey', 'sitebar_cache',
            array('type'=>'favicon'), 'length(cvalue) asc, cvalue asc');
        $found  = $this->db->fetchRecords($select);
        return $found;
    }

    function isFaviconCached($favicon)
    {
        $select = $this->db->select('count(*) count', 'sitebar_cache',
            array('^1'=>"type='favicon' AND", 'ckey' => md5($favicon)));
        $found  = $this->db->fetchRecord($select);
        return $found['count'];
    }

    function saveFavicon($favicon, $ico)
    {
        $this->db->insert('sitebar_cache', array
        (
            'type'=>'favicon',
            'ckey' => md5($favicon),
            'cvalue' => $ico,
            'created' => array('now' => ''),
        ), array(1062));
    }

    function saveFaviconBase64($base64)
    {
        if (!$this->hasSpace())
        {
            return '';
        }

        // Create shorter key, will be stored in the link
        $key = 'binary:'.md5($base64);

        $this->db->insert('sitebar_cache', array
        (
            'type'=>'favicon',
            'ckey' => $key,
            'cvalue' => base64_decode($base64),
            'created' => array('now' => ''),
        ),array(1062));

        return $key;
    }

    function faviconGet($favicon_md5, $lid, $refresh=false)
    {
        $maxAge = $this->um->getParam('config','max_icon_age');

        $select = $this->db->select(
            'cvalue, to_days(now()) - to_days(created) as age',
            'sitebar_cache',
            array('^1'=>"type='favicon' AND", 'ckey' => $favicon_md5));

        $found  = $this->db->fetchRecord($select, true);
        $oldIcon = null;

        if (is_array($found))
        {
            $oldIcon = $found['cvalue'];
            if (!$refresh && ($found['age']<=$maxAge || !$lid))
            {
                return $oldIcon;
            }
        }

        // if lid is not specified, the favicon wont be fetched into the cache
        if ($lid)
        {
            $favurl = '';

            // If we are numeric
            if ($lid == "".intval($lid))
            {
                // Get the url corresponding to the link id
                $rset = $this->db->select( null, 'sitebar_link', array('lid' => $lid));

                // Fetch the link properties
                $rlink = $this->db->fetchRecord($rset);

                // No such link? Return empty?
                if (!$rlink || !$rlink['favicon'])
                {
                    return null;
                }

                $favurl = $rlink['favicon'];
            }
            else
            {
                $favurl = $lid;
            }

            $newIcon = '';

            // Retrieve and test icon as binary string
            $page = new SB_PageParser($favurl);
            $errorCode = $page->retrieveFAVICON($newIcon);

            // We have unrecoverable error
            if ($errorCode >= 500)
            {
                return null;
            }

            // We have probably connection problem
            if ($errorCode >= 400)
            {
                if ($oldIcon)
                {
                    $this->db->update('sitebar_cache',
                        array('created' => array('now' => '')),
                        array('^1'=>"type='favicon' AND", 'ckey' => $favicon_md5));
                }
                return $oldIcon;
            }

            if ($oldIcon) // We had a records
            {
                $this->db->update('sitebar_cache',
                    array('cvalue' => $newIcon),
                    array('^1'=>"type='favicon' AND", 'ckey' => $favicon_md5));
            }
            else if ($this->hasSpace()) // New record
            {
                $this->saveFavicon($favurl, $newIcon);
            }

            return $newIcon;
        }
    }

    // For backward compatibility PHP < 4.3.0
    function file_get_contents($filename)
    {
       $fd = fopen($filename, "rb");
       $content = fread($fd, filesize($filename));
       fclose($fd);
       return $content;
    }

    // If lid is not specified, the cache wont be updated
    function faviconReturn($favicon_md5, $lid = null, $refresh=false)
    {
        $ico = $this->faviconGet($favicon_md5, $lid, $refresh);

        // 30 days keep cached in browser
        $age = 60*60*24*30;

        if (!$ico)
        {
            // Sent wrong icon image
            SB_Skin::set($this->um->getParam('user','skin'));
            $ico = $this->file_get_contents(SB_Skin::imgsrc('link_wrong_favicon'));
            $age = 60*60*24; // Try tomorrow
        }

        if ($refresh)
        {
            $age = -1;
        }

        header('Accept-Ranges: bytes');
        header('Cache-Control: public, max-age='.$age);
        header('Content-Length: '. strlen($ico));

        $type = 'image/x-icon';

        if (substr($ico,0,3)=='GIF')
        {
            $type = 'image/gif';
        }
        else if (substr($ico,6,4)=='JFIF')
        {
            $type = 'image/jpeg';
        }
        else if (substr($ico,1,3)=='PNG')
        {
            $type = 'image/png';
        }

        header('Content-Type: '.$type);

        print $ico;
    }
}
?>
