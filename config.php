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
* Change the line below to config.cgi, if you have backend problems with
* importing bookmarks or other security related problems or your server
* runs PHP in a 'safe mode' :
*/
define( 'SB_FORM_ACTION_EXECUTOR', 'config.php');
/*
* Example of config.cgi (create manually, save as "config.cgi" and
* upload to the same directory as this file is :
* --- BEGIN ---
* #!/usr/bin/php
* <?php include("config.php");
* --- END ---
*/
require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/database.inc.php');

class Configuration extends SB_ErrorHandler
{
    var $file;
    var $base = 'config.inc.php';
    var $config;
    var $command = '';
    var $message;
    var $db;

    var $host = 'localhost';
    var $name = 'sitebar';
    var $user = 'root';
    var $pass;
    var $pass2;

    function __construct()
    {
        $this->file = './adm/'.$this->base;

        if (file_exists($this->file))
        {
            $this->checkStructure();
            return;
        }

        if (isset($_REQUEST['command']))
        {
            $this->command = $_REQUEST['command'];
            $this->host = SB_safeVal($_REQUEST,'host');
            $this->name = SB_safeVal($_REQUEST,'name');
            $this->user = SB_safeVal($_REQUEST,'username');
            $this->pass = SB_safeVal($_REQUEST,'password');
            $this->pass2 = SB_safeVal($_REQUEST,'repeat');

            $config = <<<__END
\$SITEBAR = array
(
    'db' => array
    (
        'host'      =>  '{$this->host}',
        'username'  =>  '{$this->user}',
        'password'  =>  '{$this->pass}',
        'name'      =>  '{$this->name}',
    ),
    'baseurl' => null,
    'login_as' => null,
);
__END;

            $this->config = '<' . "?php\n" . $config . "\n?" . ">\n";
        }

        if ($this->command)
        {
            if ($this->checkParams() && $this->command!='Check Settings')
            {
                $shortname = str_replace(' ','',$this->command);
                $execute = 'command' . $shortname;
                $this->$execute();
            }
        }

        $this->writeConfig();
    }

    function checkParams()
    {
        if ($this->pass && $this->pass !== $this->pass2)
        {
            $this->error('Password incorrectly retyped!');
            return false;
        }

        $this->db =& SB_Database::staticInstance();
        // Assign the connection with the database
        $this->db->connection = $this->db->connect($this->host, $this->user, $this->pass);

        if (!$this->db->connection)
        {
            $this->error($this->db->getErrorText());
            return false;
        }
        else if (!$this->db->hasDB($this->name))
        {
            if ($this->command!='Create Database')
            {
                $this->error($this->db->getErrorText());
                return false;
            }
        }
        else if ($this->command=='Create Database')
        {
            $this->error('Database already exists!');
            return false;
        }

        return true;
    }

    function commandCreateDatabase()
    {
        $this->db =& SB_Database::staticInstance();

        if (!$this->db->createDB($this->name))
        {
            $this->error($this->db->getErrorText());
        }
        else
        {
            $this->message = 'Database created.';
        }
    }

    function commandWriteToFile()
    {
        $this->useHandler(false);
        $fp = @fopen($this->file,'wb');
        $this->useHandler(true);

        if (!$fp)
        {
            $this->error('Cannot open file %s. Does your HTTP server have write access to adm directory?', array($this->file));
            return;
        }
        fwrite($fp, $this->config);
        fclose($fp);
        header('Location: config.php');
    }

    function commandDownloadSettings()
    {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$this->base.'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($this->config));
        echo $this->config;
        exit;
    }

    function commandPreviewSettings()
    {
        header('Content-Type: text/plain');
        header('Content-Length: ' . strlen($this->config));
        echo $this->config;
        exit;
    }

    function writePage()
    {
        SB_Page::head('DB Configuration', 'siteBarConfig');
?>
<h2>DB Configuration</h2>

<p>
&nbsp;<a href="doc/install.txt">Install &amp; Upgrade Guide</a>
<br>
&nbsp;<a href="doc/troubleshooting.txt">Troubleshooting</a>

<?php
        if (!$this->hasErrors())
        {
            if ($this->command=='Check Settings')
            {
                $this->message = 'Connection parameters are OK!';
            }
            if ($this->message)
            {
?>
<div class="message">
    <?php echo $this->message?>
</div>
<?php
            }
        }
        else
        {
?>
<div class="error">
<?php
            $this->writeErrors(false);
?>
</div>
<?php
        }
    }

    function writeConfig()
    {
        $this->writePage();

?>
<form action="<?php echo SB_FORM_ACTION_EXECUTOR ?>" method="POST">
<table>
<tr><th>DB Host Name</th></tr>
<tr><td><input name="host" value="<?php echo $this->host?>"></tr>
<tr><th>DB Username</th></tr>
<tr><td><input name="username" value="<?php echo $this->user?>"></tr>
<tr><th>DB Password</th></tr>
<tr><td><input type="password" name="password" value="<?php echo $this->pass?>"></tr>
<tr><th>DB Repeat Password</th></tr>
<tr><td><input  type="password" name="repeat" value="<?php echo $this->pass2?>"></tr>
<tr><th>Database Name</th></tr>
<tr><td><input name="name" value="<?php echo $this->name?>"></tr>
</table>

<p>
<input type="submit" name="command" value="Check Settings">
<input type="submit" name="command" value="Create Database">
Use any of the following to create file <strong>config.inc.php</strong>
and place it to your <strong>adm</strong> subdirectory of your
SiteBar installation.
<input type="submit" name="command" value="Write To File">
If "Write To File" does not work, do not
waste time setting the rights, just download the file and upload
it to the <strong>adm</strong> manually!
<input type="submit" name="command" value="Download Settings">
<input type="submit" name="command" value="Preview Settings">
</form>

<?php
        SB_Page::foot();
    }

    function getDBRelease()
    {
        $release = "";

        if ($this->db->hasTable('sitebar_config'))
        {
            $rset = $this->db->select(null, 'sitebar_config');
            $config = $this->db->fetchRecord($rset);
            $release = $config['release'];

            // Small fix for CVS releases
            if ($release == "3.0pre")  $release = "3.0pre1";
            if ($release == "3.0pre2") $release = "3.0pre1";
            if ($release == "3.0b")    $release = "3.0pre1";
        }

        return $release;
    }

    function checkStructure()
    {
        $this->db = SB_Database::staticInstance();
        if ($this->db->connection)
        {
            $release = $this->getDBRelease();

            if ($this->db->currentRelease() != $release)
            {
                if (isset($_REQUEST['command']))
                {
                    $this->command = $_REQUEST['command'];
                }

                switch ($this->command)
                {
                    case 'Upgrade':
                        $this->conversion($release, true);
                        exit;

                    case 'Downgrade':
                        $this->conversion($release, false);
                        exit;

                    case 'Install':
                        $this->install();
                        exit;
                }

                if ($release)
                {
                    $dbrel = $this->db->currentRelease();

                    $this->message = <<<MSG
Your software version $dbrel differs from the database version $release.
MSG;
                    $this->writePage();
?>
<p>
<form action="<?php echo SB_FORM_ACTION_EXECUTOR ?>" method="POST">
<?php if (file_exists($this->getScriptName($release,true))) : ?>
<input type="submit" name="command" value="Upgrade">
<?php
      endif;
      if (file_exists($this->getScriptName($release,false))) :
?>
<input type="submit" name="command" value="Downgrade">
<?php endif; ?>
<input type="submit" name="command" value="Reload">
</form>
<?php
                }
                else
                {
                    $this->message = 'Your database does not contain SiteBar tables.';
                    $this->writePage();
?>
<p>
<form action="<?php echo SB_FORM_ACTION_EXECUTOR ?>" method="POST">
<input type="submit" name="command" value="Install">
<input type="submit" name="command" value="Reload">
</form>
<?php
                }
            }
            else
            {
                header('Location: index.php');
            }
        }
        else
        {
            $this->error('Cannot connect to database!');

            $this->writePage();
?>
<p>
<form action="<?php echo SB_FORM_ACTION_EXECUTOR ?>" method="POST">
<input type="submit" name="command" value="Check Settings">
</form>
<?php
        }

    }

    function getScriptName($from, $upgrade=true)
    {
        return strtolower(sprintf('sql/%s_%s.sql',
            ($upgrade?'upgrade':'downgrade'), str_replace(' ', '', $from)));
    }

    function conversion($from, $upgrade=true)
    {
        do
        {
            $this->loadSQL($this->getScriptName($from, $upgrade));
            $from = $this->getDBRelease();
        }
        while ($upgrade
        &&     $from!=$this->db->currentRelease()
        &&     file_exists($this->getScriptName($from,$upgrade)));
    }

    function install()
    {
        $this->loadSQL('./sql/install.sql');

        if (!$this->hasErrors())
        {
            require_once('./inc/loader.inc.php');
            require_once('./inc/tree.inc.php');

            $bm = new SB_Loader(false);
            $bm->loadFile('./sql/bookmarks_sitebar.xbel', 'xbel');

            if ($bm->success)
            {
                $tree =& SB_Tree::staticInstance();
                $tree->importTree(2, $bm->root, false, 'SB_cleanUpLink');
            }

            $bm = new SB_Loader(false);
            $bm->loadFile('./sql/bookmarks_websearch.xbel', 'xbel');

            if ($bm->success)
            {
                $tree =& SB_Tree::staticInstance();
                $tree->importTree(2, $bm->root, false, 'SB_cleanUpLink');
            }
        }
    }

    function loadSQL($filename)
    {
        $res = $this->db->raw('select @@innodb_version version');
        $rec = $this->db->fetchRecord($res);
        $version = $rec['version'];
        $old = version_compare($version,'5.6.5') < 0;

        if (!($fp=fopen($filename,'r')))
        {
            $this->error('Cannot open file '.$filename.'!');
            return;
        }

        $sql = '';

        while (!feof($fp))
        {
            $line = rtrim(fgets($fp,4096));
            $size = strlen($line);

            if ($size>0 && $line[$size-1] ==';')
            {
                $line = substr($line,0,$size-1);
                $sql .= ' ' . $line;

                if ($old) {
                    $sql = str_replace("datetime NOT NULL DEFAULT CURRENT_TIMESTAMP", "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'", $sql);
                }   
        
                if (!$this->db->raw($sql))
                {
                    $this->error($this->db->getErrorText().' ['.$sql.']');
                }
                $sql = '';
            }
            else
            {
                $sql .= ' ' . $line;
            }
        }
        fclose( $fp);

        if ($this->hasErrors())
        {
            $this->writePage();
?>
<p>
<form action="<?php echo SB_FORM_ACTION_EXECUTOR ?>" method="POST">
<input type="submit" name="command" value="Reload">
</form>
<?php
        }
        else
        {
            header('Location: index.php');
        }
    }
}

$config = new Configuration();
?>
