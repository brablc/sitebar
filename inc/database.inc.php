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

define('SB_CURRENT_RELEASE', '3.6.2');

require_once('./inc/errorhandler.inc.php');

class SB_Database extends SB_ErrorHandler
{
    public $connection = null;
    public $name;
    public $user;
    public $lastsql;
    public $count = 0; // Count of executed statements
    public $sw;

    public function __construct()
    {
        $this->sw = new SB_StopWatch();
    }

    public function currentRelease()
    {
        return SB_CURRENT_RELEASE;
    }

    public static function & staticInstance($ignoreError = false)
    {
        static $db;

        if (!$db) {
            if (function_exists('mysql_real_escape_string')) {
                $db = new SB_DatabaseMySQLPhp43($ignoreError);
            } else {
                $db = new SB_DatabaseMySQL($ignoreError);
            }
        }

        return $db;
    }

    public function dieOnError($result, $ignore = null)
    {
        if (!$result && (!$ignore || !in_array($this->getErrorCode(), $ignore))) {
            $err = $this->getErrorCode() . ': ' . $this->getErrorText();

            echo '<b>Invalid query:</b> ' . $err;
            echo '<p>';
            echo '<pre>';
            echo  htmlspecialchars($this->lastsql);
            echo '</pre>';

            $this->log("\nDB:$err\n", $this->lastsql);
            die();
        }
    }

    public function select($columns, $table, $where = null, $order = null)
    {
        $sql  = 'SELECT ' .
            ($columns ? (is_array($columns) ? implode(',', $columns) : $columns) : '*') .
            "\nFROM " . $table;
        $sql .= $this->buildWhere($where);

        if ($order) {
            $sql .= "\nORDER BY " . $order . "\n";
        }

        $result = $this->raw($sql);
        $this->dieOnError($result);
        return $result;
    }

    public function insert($table, $pairs, $ignore = null)
    {
        $values = array();

        foreach (array_values($pairs) as $value) {
            $values[] = $this->quoteValue($value);
        }

        $sql  = 'INSERT INTO ' . $table . ' ';
        $sql .= '(' . implode(', ', array_keys($pairs)) . ")\n";
        $sql .= 'VALUES (' . implode(', ', $values) .  ')';

        $result = $this->raw($sql);
        $this->dieOnError($result, $ignore);
        return $result;
    }

    public function delete($table, $where = null)
    {
        $sql  = 'DELETE FROM ' . $table . "\n";

        if ($where !== null) {
            $sql .= $this->buildWhere($where);
        }

        $result = $this->raw($sql);
        $this->dieOnError($result);
        return $result;
    }

    public function update($table, $pairs, $where = null, $ignore = null)
    {
        $sql = 'UPDATE ' . $table . "\nSET ";
        $set = array();

        if (is_array($pairs)) {
            foreach ($pairs as $column => $value) {
                $set[] = $column . '=' . $this->quoteValue($value);
            }
        } else {
            $set[] = $pairs;
        }

        $sql .= implode(', ', $set);
        $sql .= $this->buildWhere($where);

        $result = $this->raw($sql);
        $this->dieOnError($result, $ignore);
        return $result;
    }

    public function buildWhere($where)
    {
        $sql = '';

        if ($where) {
            $sql .= "\nWHERE ";

            if (is_array($where)) {
                foreach ($where as $filter => $value) {
                    if (substr($filter, 0, 1) == '^') {
                        $sql .= ' ' . $value . ' ';
                    } else {
                        $qv = $this->quoteValue($value);
                        $sql .= ' ' . $filter . ($qv === 'NULL' ? ' is ' : '=') . $qv;
                    }
                }
            } else {
                $sql .= ' ' . $where;
            }
        }

        return $sql;
    }

    public function quoteValue($value)
    {
        if (is_numeric($value)) {
            return $value;
        } elseif (is_array($value)) {
            $val  = key($value) . '(';
            $val .= $value[key($value)]
                    ? $this->quoteValue($value[key($value)]) : '';
            $val .= ') ';
            return $val;
        } elseif ($value === null) {
            return 'NULL';
        } else {
            return "'" . $this->escapeString($value) . "'";
        }
    }

    public function fetchRecord($request, $binary = false)
    {
        $this->sw->cont();
        $record = $this->fetchArray($request);

        if (!$record) {
            $this->sw->pause();
            return false;
        } else {
            if (!$binary) {
                array_walk($record, array( $this, '_unescape'));
            }
            $this->sw->pause();
            return $record;
        }
    }

    public function fetchRecords($request)
    {
        $this->sw->cont();
        $records = array();

        while (($record = $this->fetchArray($request))) {
            array_walk($record, array( $this, '_unescape'));
            $records[] = $record;
        }

        $this->sw->pause();
        return $records;
    }

    public function _unescape(&$item, $key)
    {
        if (!is_numeric($item)) {
            $item = stripslashes($item);
        }
    }

    /* Cache functions */

    public function getCache($type, $key)
    {
        $res = $this->select(
            null,
            'sitebar_cache',
            array('type' => $type,'^1' => 'AND', 'ckey' => $key)
        );

        $rec = $this->fetchRecord($res, true);

        return $rec;
    }

    public function setCache($type, $key, $value)
    {
        $this->delete(
            'sitebar_cache',
            array('type' => $type,'^1' => 'AND', 'ckey' => $key)
        );

        $this->insert('sitebar_cache', array(
            'type' => $type,
            'ckey' => $key,
            'created' => array('now' => ''),
            'cvalue' => $value
        ));
        return true;
    }

    public function purgeCache($type, $key = null, $created = null)
    {
        static $alreadyPurged = array();

        if (isset($alreadyPurged[$type . $key . $created])) {
            return true;
        }
        $alreadyPurged[$type . $key . $created] = true;

        $where = array('type' => $type);

        if ($key) {
            $where['^1'] = 'AND';
            $where['ckey'] = $key;
        }

        if ($created) {
            $where['^2'] = 'AND created < ' . $created;
        }

        $this->delete('sitebar_cache', $where);
        return true;
    }

    /* Data functions */

    public function getData($type, $key)
    {
        $res = $this->select(
            null,
            'sitebar_data',
            array('type' => $type,'^1' => 'AND', 'dkey' => $key)
        );

        $rec = $this->fetchRecord($res, true);

        return $rec ? $rec['dvalue'] : null;
    }

    public function setData($type, $key, $value = '')
    {
        $this->delete(
            'sitebar_data',
            array('type' => $type,'^1' => 'AND', 'dkey' => $key)
        );

        if (strlen($value)) {
            $this->insert('sitebar_data', array(
                'type' => $type,
                'dkey' => $key,
                'dvalue' => $value
            ));
        }
        return true;
    }

    public function getUserData($type, $uid, $key)
    {
        $res = $this->select(
            null,
            'sitebar_user_data',
            array('type' => $type,'^1' => 'AND','uid' => $uid,'^2' => 'AND', 'dkey' => $key)
        );

        $rec = $this->fetchRecord($res, true);

        return $rec ? $rec['dvalue'] : null;
    }

    public function setUserData($type, $uid, $key, $value = '')
    {
        $this->delete(
            'sitebar_user_data',
            array('type' => $type,'^1' => 'AND', 'uid' => $uid,'^2' => 'AND', 'dkey' => $key)
        );

        if (strlen($value)) {
            $this->insert('sitebar_user_data', array(
                'type' => $type,
                'uid' => $uid,
                'dkey' => $key,
                'dvalue' => $value
            ));
        }
        return true;
    }

    public function clearUserData($uid)
    {
        $this->delete('sitebar_user_data', array('uid' => $uid));
    }

    /* Abstract functions to be redefined */

    public function createDB($db)
    {
        die('Abstract class.');
    }
    public function connect($host, $user, $pass)
    {
        die('Abstract class.');
    }
    public function close()
    {
        die('Abstract class.');
    }
    public function escapeString($str)
    {
        die('Abstract class.');
    }
    public function fetchArray($request)
    {
        die('Abstract class.');
    }
    public function getAffectedRows()
    {
        die('Abstract class.');
    }
    public function getErrorCode()
    {
        die('Abstract class.');
    }
    public function getErrorText()
    {
        die('Abstract class.');
    }
    public function getLastId()
    {
        die('Abstract class.');
    }
    public function hasDB($db)
    {
        die('Abstract class.');
    }
    public function hasTable($table)
    {
        die('Abstract class.');
    }
    public function lock($tables)
    {
        die('Abstract class.');
    }
    public function unlock()
    {
        die('Abstract class.');
    }
    public function raw($sql)
    {
        die('Abstract class.');
    }
}

class SB_DatabaseMySQL extends SB_Database
{
    public function __construct($ignoreError = false)
    {
        parent::__construct();

        if (!extension_loaded('mysqli') || !function_exists('mysqli_connect')) {
            die('SiteBar: No support for MySQL detected!');
        }

        if (!is_file('./adm/config.inc.php')) {
            return;
        }

        include('./adm/config.inc.php');

        $config = $SITEBAR['db'];
        $this->name = $config['name'];
        $this->connection = $this->connect($config['host'], $config['username'], $config['password']);

        if (!$this->connection) {
            return;
        }

        if (isset($config['charset'])) {
            mysqli_set_charset($this->connection, $config['charset']);
        }

        //
        // Compatibility with 5.7 and its strict NO_ZERO_DATE
        mysqli_query($this->connection, "SET SESSION sql_mode = 'TRADITIONAL'");

        if (!$this->hasDB($config['name'])) {
            if (!$ignoreError) {
                die('SiteBar: Database <b>' . $this->name . '</b> does not exist! ' .
                    'Delete your <b>adm/config.inc.php</b>!');
            }
            $this->connection = null;
            return;
        }
    }

    public function createDB($db)
    {
        return $this->raw('CREATE DATABASE ' . $db);
    }

    public function connect($host, $user, $pass)
    {
        $this->sw->cont();
        SB_ErrorHandler::useHandler(false);
        $ret = @mysqli_connect($host, $user, $pass);
        SB_ErrorHandler::useHandler(true);
        $this->sw->pause();
        return $ret;
    }

    public function close()
    {
        $this->sw->cont();
        mysqli_close($this->connection);
        $this->sw->pause();
        $this->connection = null;
    }

    public function escapeString($str)
    {
        return mysqli_escape_string($this->connection, str_replace('\\0', '\\\\0', $str));
    }

    public function fetchArray($request)
    {
        $this->sw->cont();
        $data = mysqli_fetch_array($request, MYSQLI_ASSOC);
        $this->sw->pause();
        return $data;
    }

    public function getAffectedRows()
    {
        return mysqli_affected_rows($this->connection);
    }

    public function getErrorCode()
    {
        return mysqli_errno($this->connection);
    }

    public function getErrorText()
    {
        if ($this->connection) {
            return mysqli_error($this->connection);
        } else {
            return mysqli_error();
        }
    }

    public function getLastId()
    {
        return mysqli_insert_id($this->connection);
    }

    public function hasDB($db)
    {
        return mysqli_select_db($this->connection, $db) ;
    }

    public function hasTable($table)
    {
        if (!$this->connection) {
            return false;
        }

        $this->useHandler(false);

        $sql = sprintf(
            "
            SELECT COUNT(*) as count FROM information_schema.tables 
            WHERE table_schema = '%s' 
            AND table_name = '%s'",
            $this->name,
            $this->escapeString($table)
        );

        $result = @mysqli_query($this->connection, $sql);
        $this->useHandler(true);

        if (!$result) {
            return false;
        }

        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return ($row['count'] > 0);
    }

    public function lock($tables)
    {
        $pairs = array();

        foreach ($tables as $table => $mode) {
            $pairs[] = $table . ' ' . $mode;
        }

        $this->raw('LOCK TABLES ' . implode(',', $pairs));
    }

    public function unlock()
    {
        $this->raw('UNLOCK TABLES');
    }

    public function raw($sql)
    {
        $this->count++;
        $this->lastsql = $sql;
        if (SB_LOG_SQL) {
            $this->log("SQL", str_replace("\n", ' ', $sql));
        }
        $this->sw->cont();
        $res = mysqli_query($this->connection, $sql);
        $this->sw->pause();
        return $res;
    }
}

class SB_DatabaseMySQLPhp43 extends SB_DatabaseMySQL
{
    public function __construct($ignoreError = false)
    {
        parent::__construct($ignoreError);
    }

    public function escapeString($str)
    {
        return mysqli_real_escape_string($this->connection, str_replace('\\0', '\\\\0', $str));
    }
}
