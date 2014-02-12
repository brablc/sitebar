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

define ( 'TRANSLATORS', 'Translators');
define ( 'DEFAULT_LANGUAGE', 'en_US');

if (@!include_once('./inc/config.inc.php'))
{
    exit;
}

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/usermanager.inc.php');

class Translator extends SB_ErrorHandler
{
    var $parts = array
    (
        'text' => array
        (
            'label'=>'Texts',
            'file'=>'text.inc.php',
            'inline'=>true,
            'show_default'=>false,
        ),
        'para' => array
        (
            'label'=>'Paragraphs',
            'file'=>'para.inc.php',
            'inline'=>false,
            'show_default'=>true,
        ),
        'topic' => array
        (
            'label'=>'Help Topics',
            'file'=>'topic.inc.php',
            'inline'=>true,
            'show_default'=>true,
        ),
        'help' => array
        (
            'label'=>'Help Content',
            'file'=>'help.inc.php',
            'inline'=>false,
            'show_default'=>true,
        ),
    );

    var $fmt = './locale/%s/%s';
    var $infofmt = './locale/%s/%s';
    var $langs = array();
    var $gid = null;
    var $plugin = '';
    var $pluginCGI = '';

    function Translator()
    {
        if (isset($_GET['plugin']) || isset($_POST['plugin']))
        {
            $plugin = isset($_GET['plugin'])?$_GET['plugin']:$_POST['plugin'];

            if ($plugin != "" && preg_match('/^\w+$/', $plugin))
            {
                $this->dir = './plugins/'.$plugin;
                $this->fmt = $this->dir.'/locale/%s/%s';
		$this->plugin = $plugin;
                $this->pluginCGI = "plugin=".$plugin."&amp;";
            }
        }

        foreach ($this->parts as $part => $param)
        {
            include(sprintf($this->fmt,DEFAULT_LANGUAGE,$param['file']));
            eval('$this->parts[$part][DEFAULT_LANGUAGE] = $'.$part.';');
        }

        if ($dir = @opendir("./locale"))
        {
            while (($lang = readdir($dir)) !== false)
            {
                $filename = sprintf($this->infofmt,$lang,"info.inc.php");
                if (!@file_exists($filename))
                {
                    continue;
                }
                $stat = stat('./locale/'.$lang);
                if ($stat[2] != 040777)
                {
                    echo "Wrong rights for $lang: " . $stat[2] . "<br>";
                    continue;
                }
                $this->langs[] = $lang;
            }

            closedir($dir);
            sort($this->langs);
        }
    }

    function run()
    {
        if (isset($_REQUEST['edit']))
        {
            $this->check(false);
            $this->edit($_REQUEST['lang'], $_REQUEST['edit'], @$_REQUEST['cmd'], isset($_REQUEST['save']));
            exit;
        }
        else if (isset($_REQUEST['create']))
        {
            $this->check(true);
            $this->create();
            exit;
        }
        else if (isset($_REQUEST['download']))
        {
            require('./lib/zip.lib.php');
            $zipfile = new zipfile();

            foreach ($this->langs as $lang)
            {
                if ($_REQUEST['download'] && $lang!=$_REQUEST['download'])
                {
                    continue;
                }

                $this->addFile($zipfile, $lang, "info.inc.php");

                foreach ($this->parts as $part => $params)
                {
                    $this->addFile($zipfile, $lang, $params['file']);
                }
            }

            $name = sprintf( "locale%s.zip", ($_REQUEST['download']?"_".$_REQUEST['download']:''));

            //force download dialog
            header("Content-type: application/x-zip\n");
            header("Content-disposition: attachment; filename=\"$name\"\n");
            header("Content-transfer-encoding: binary\n");
            header("Content-length: " . strlen($zipfile->file()) . "\n");

            echo $zipfile->file();
            exit;
        }
        else
        {
            $this->statistics();
        }
    }

    function addFile(&$zipfile, $lang, $file)
    {
        $file = sprintf($this->fmt, $lang, $file);

        if (is_file($file))
        {
            $handle = fopen ($file, 'rb');
            $contents = fread ($handle, filesize ($file));
            fclose ($handle);
            $zipfile->addFile($contents, $file);
        }
    }

    function check($needAdmin=false)
    {
        $um = SB_UserManager::staticInstance();

        // We must be logged in pass this point
        if (!$um->isLogged())
        {
            header("Location: command.php?command=Log%20In&forward=translator.php");
            exit;
        }

        if ($needAdmin)
        {
            if (!$um->isAdmin())
            {
                SB_Page::head('Translator Error', 'siteBarLocale');
                echo 'You must be admin to create new dir!';
                SB_Page::foot();
                exit;
            }
            else
            {
                return true;
            }
        }

        $groups = $um->getGroups();
        $trGid = null;
        foreach ($groups as $gid => $rec)
        {
            if ($rec['name'] == TRANSLATORS)
            {
                $trGid = $gid;
                break;
            }
        }

        if (!$um->isAdmin() && !$trGid)
        {
            SB_Page::head('Translator Error', 'siteBarLocale');
            echo 'This installation does not have group "' . TRANSLATORS . '"!';
            SB_Page::foot();
            exit;
        }

        $myGroups = $um->getUserGroups();
        $member = false;
        foreach ($myGroups as $gid => $rec)
        {
            if ($rec['name'] == TRANSLATORS)
            {
                $member = true;
                break;
            }
        }

        if (!$um->isAdmin() && !$member)
        {
            SB_Page::head('Translator Error', 'siteBarLocale');
            echo 'You must be member of "' . TRANSLATORS . '" group to edit localizations! ';
            echo 'Ask <a href="command.php?command=Contact%20Moderator&amp;gid=' . $trGid . '">moderator</a> for membership.';
            SB_Page::foot();
            exit;
        }
    }

    function statistics()
    {
        if (!defined("EMBEDDED"))
        {
            SB_Page::head('Translator', 'siteBarLocale');
            $server = defined("DOWNLOAD_SRV")?DOWNLOAD_SRV:"";
?>
<h2>Translations</h2>

<h4>Information for users</h4>
<ul>
    <li>It is possible to download separate localizations or the whole
        <a href='<?php echo $server?>translator.php?download'>localization package</a> as ZIP files.
</ul>

<h4>Information for translators</h4>
<ul>
    <li>Although the languages can be edited on any SiteBar instance, the only authorized
        server to edit translation to be incorporated in the official release is
        <a href="http://beta.sitebar.org/translator.php">beta.sitebar.org</a>.
    <li>In order to edit translations, you must have an account in this SiteBar installation
        and be either Administrator or member of group "<?php echo TRANSLATORS?>".
    <li>You can <a href='command.php?command=Sign%20Up'>create an account</a> yourself and ask
        moderator of the group to give you membership.
    <li>If there is some language missing then you have to
        <a href='command.php?command=Contact%20Admin'>contact admin</a> of this installation
        and ask him to <a href='translator.php?create'>create a directory</a> for your language, you will then be listed as the primary
        language translator.
    <li><strong>This is real online translation.</strong> Open <a href="index.php">Sitebar</a>,
        change your language in the <a href='command.php?command=User%20Settings'>User Settings</a>
        and check the result.
    <li>Paragraphs that need update are marked with green color and &lt;@&gt; sign at the beginning.
    There are 2 different cases: <br>
    1. Source language contains a &lt;@&gt; The target language is dark green. This shows that we have changed something in the source language. Simply check if the translation needs to be updated. <br>
    2. Target language contains a &lt;@&gt; The target language is light green. Check if the translation needs to be updated AND: Remove this sign after update.
</ul>

<form method="get">
Translate
<select name='plugin' onChange="this.form.submit()">
<option value=''>SiteBar</option>
<?php

            $dir = opendir('./plugins');

            while (($plugin = readdir($dir)) !== false)
            {
                if ($plugin == '..')
                {
                    continue;
                }

                $plugdir = './plugins/'.$plugin;

                if (!is_dir($plugdir))
                {
                    continue;
                }

                if (!is_dir($plugdir.'/locale'))
                {
                    continue;
                }

                echo "<option ". ($_GET['plugin']==$plugin?"selected":"") ." value='$plugin'>Plugin $plugin</option>\n";
            }
            closedir($dir);
?>
</select>
</form>

<p>

<?php
        }
?>
<table class='stat'>
<tr>
    <th>Dir</th>
    <th>Language</th>
    <th>Author</th>
<?php
        $span = defined("EMBEDDED")?1:2;

        foreach ($this->parts as $part => $param)
        {
?>
    <th colspan="<?php echo $span?>"><?php echo $this->parts[$part]['label']?></th>
<?php
        }

?>
    <th>&nbsp;</th>
</tr>
<?php
        foreach ($this->langs as $lang)
        {
            include(sprintf($this->infofmt,$lang,"info.inc.php"));

            $authors = '';
            $langs = $lang;

            if (isset($info['aliases']))
            {
                $langs .= '<br>'. implode('<br>',$info['aliases']);
            }

            if (!isset($info['authors']))
            {
                $info['authors'][$info['author']] = $info['url'];
            }

            $count = 0;

            foreach ($info['authors'] as $author => $url)
            {
                if ($count++)
                {
                    $authors .= '<br>';
                }

                if (strstr($url,"mailto:"))
                {
                    $url =  str_replace("@", " ~at~ ", $url);
                    $url =  str_replace(".", " ~dot~ ", $url);
                }

                if (strlen($url))
                {
                    $authors .= "<a href='".$url."'>".$author."</a>";
                }
                else
                {
                    $authors .= $author;
                }
            }

            if (isset($info['co-authors']))
            {
                $authors .= '<br>' . $info["co-authors"];
            }
?>
<tr>
    <td class="fixed"><?php echo $langs?>&nbsp;</td>
    <td><?php echo $info['language']?></td>
    <td><?php echo $authors?></td>
<?php

            foreach ($this->parts as $part => $param)
            {
                eval('$'.$part.'=array();');
                include(sprintf($this->fmt,$lang,$param['file']));
                eval('$data = $'.$part.';');
                $this->parts[$part][$lang] = $data;

                $ok = 0;
                $total = 0;
                $missing = 0;
                $update = 0;

                foreach ($this->parts[$part][DEFAULT_LANGUAGE] as $label => $value)
                {
                    $total++;

                    $missingTest = false;
                    $updateTest  = false;

                    if (!isset($data[$label]) || ($data[$label]=='' && $lang!=DEFAULT_LANGUAGE))
                    {
                        $missingTest = true;
                        $missing++;
                    }

                    if (isset($data[$label]) && substr($data[$label],0,3)=='<@>')
                    {
                        $updateTest = true;
                        $update++;
                    }

                    if (!$missingTest && !$updateTest)
                    {
                        $ok++;
                    }
                }

                $fmt = defined("EMBEDDED")?"%2d":"%2.2f";
                $ratio = sprintf( $fmt, $ok/$total*100);

?>
    <td class='stat'><?php echo $ratio?>%</td>
<?php
                if (!defined("EMBEDDED"))
                {
?>

    <td class='statCmd'><?php

                    if ($lang!=DEFAULT_LANGUAGE)
                    {
                ?>[<a href='translator.php?lang=<?php echo $lang?>&amp;<?php echo $this->pluginCGI ?>edit=<?php echo $part?>'>EDIT</a>]<?php
if ($missing) : ?><br>[<a href='translator.php?lang=<?php echo $lang?>&amp;<?php echo $this->pluginCGI ?>cmd=add&amp;edit=<?php echo $part?>'>ADD</a>]<?php endif;
if ($update && !$this->parts[$part]['inline']) :  ?><br>[<a href='translator.php?lang=<?php echo $lang?>&amp;<?php echo $this->pluginCGI ?>cmd=upd&amp;edit=<?php echo $part?>'>UPD</a>]<?php endif;
                    }
                }
            }

        $server = defined("DOWNLOAD_SRV")?DOWNLOAD_SRV:"";

?>
    <td class='stat'>[<a href='<?php echo $server?>translator.php?<?php echo $this->pluginCGI ?>download=<?php echo $lang?>'>Download</a>]</td>
</tr>
<?php
        }

?>
</table>
<?php
        if (!defined("EMBEDDED"))
        {
            SB_Page::foot();
        }
    }

    function encodeValue($value, $show=false)
    {
        if ($show)
        {
            $value = htmlspecialchars($value);
        }
        else
        {
            $value = str_replace("'","&#39;",$value);
        }
        return $value;
    }

    function decodeValue(&$param, $value)
    {
        $value = str_replace("&#39;","'",$value);
        return stripslashes($value);
    }

    function edit($lang, $part, $cmd, $save)
    {
        SB_Page::head('Edit Translation', 'siteBarLocale');
?>
<h2>Edit Translation</h2>
[<a href="translator.php?<?php echo $this->pluginCGI ?>">Back to Translation List</a>]
<p>
<?php
        if (!isset($this->parts[$part]))
        {
            die("Unknown part in edit param!");
        }

        if (!preg_match('/^\w+$/',$lang))
        {
            die("Not allowed characters in lang param!");
        }
        $param = $this->parts[$part];
        $file = sprintf($this->fmt,$lang,$param['file']);

        include($file);
        eval('$data = $'.$part.';');
        eval('$'.$part.'=array();');
        include(sprintf($this->fmt,DEFAULT_LANGUAGE,$param['file']));
        eval('$default = $'.$part.';');

        if ($save)
        {
            $values = array();
            $md5 = array();

            foreach ( $_REQUEST['label'] as $i => $label)
            {
                $label = $this->decodeValue($param, $label);
                $values[$label] = $this->decodeValue($param, $_REQUEST['value'][$i]);
                $md5[$label] = $_REQUEST['md5'][$i];
            }

            $ok = 0;
            $total = 0;

            if (! ($fh = @fopen($file,'w')))
            {
                echo "Cannot write results to file: $file<br>\n";
                echo "Sorry for inconvinience, if possible keep this page open and inform admin. When the problem is fixed you could just reload this page and post the data once again.<br>\n";
                exit;
            }

            fwrite( $fh, "<?php\n\n");

            $inline = false; //$param['inline'];

            if (!strlen($this->plugin))
            {
                if ($inline)
                {
                    fwrite( $fh, "\$$part = array\n(\n");
                }
                else
                {
                    fwrite( $fh, "\$$part = array();\n\n");
                }
            }
            else
            {	    
                $inline = false;
            }

            foreach ($default as $label => $value)
            {
                $changed = isset($md5[$label]) && (md5(@$values[$label]) != @$md5[$label]);

                if (isset($data[$label]) && $cmd=='add')
                {
                    $value = $data[$label];
                }
                else if (isset($values[$label]) && ($changed || isset($data[$label])))
                {
                    $value = $changed?html_entity_decode($values[$label]):$data[$label];
                }
                else if (!$inline && $cmd=='upd' && !$changed && isset($data[$label]))
                {
                    $value = $data[$label];
                }
                else
                {
                    $value = '';
                }

                if (strlen($value))
                {
                    if ($inline)
                    {
                        fwrite( $fh, sprintf("'%s' => '%s',\n", $label, $value));
                    }
                    else
                    {
                        $value = str_replace("\r\n","\n", $value);
                        fwrite( $fh, "\$".$part."['".$label."'] = <<<_SBHD\n");

                        // Do not allow here doc to be included in the string,
                        // otherwise any php code would be executed.
                        if (strstr($value,"_SBHD"))
                        {
                            die("Value must not contain _SBHD pattern!");
                        }

                        fwrite( $fh, $value);
                        fwrite( $fh, "\n_SBHD;\n\n");
                    }
                }
            }

            if ($inline)
            {
                fwrite( $fh, ");\n\n");
            }

            fwrite( $fh, "?>\n");
            fclose( $fh);
            chmod( $file, 0666);

            echo "<h4>Data saved to $file.</h4>\n";

            // Reread to display
            eval('$'.$part.'=array();');
            include($file);
            eval('$data = $'.$part.';');
        }

?>
<form method="POST">
<table class="edit">
<input type="hidden" name="plugin" value="<?php $this->plugin ?>">
<?php
        $i  = 0;

        foreach ($default as $label => $value)
        {
            $SB_safeValue = isset($data[$label])?$data[$label]:'';

            $title  = $param['show_default']?$value:$label;
            $dCount = count(explode("\n", $title));
            $lCount = count(explode("\n", $SB_safeValue));
            //this is why we calculate the rows of the input box by the length of the string
            $rows = (strlen($SB_safeValue)/50);
            if ($rows <1)
            {
                $rows =1;
            }


            if ($cmd=='add' && strlen($SB_safeValue))
            {
                continue;
            }

            if ($cmd=='upd' && substr($SB_safeValue,0,3)!='<@>') // && $param['inline']
            {
                continue;
            }

            if (!$param['show_default'] && strlen($value))
            {
?>
<tr>
    <td class='comment'><?php echo $this->encodeValue($value,true)?></td>
</tr>
<?php
            }
            else if ($param['show_default'])
            {
?>
<tr>
    <td class='comment'><?php echo $label ?></td>
</tr>
<?php
            }
?>
<tr>
    <td class='label'><?php echo $this->encodeValue($title,true)?></td>
</tr>
<tr>
    <td class='<?php

    if (strlen($SB_safeValue))
    {
        // this checks if the translation file OR the original language file starts with <@>
        // - this way we need to update the english language only and start changed strings
        // with a <@>
        // changed by Olaf Noehring 2/2005
        if (substr($SB_safeValue,0,3)=='<@>')
        {
            echo 'update';
        }
        elseif (substr($this->encodeValue($title,false),0,3)=='<@>')
        {
            echo 'updateFromOriginal';
        }
        else
        {
            echo 'value';
        }
    }
    else
    {
        echo 'missing';
    }

    ?>'>
        <input type='hidden' name='label[<?php echo $i?>]' value='<?php echo $this->encodeValue($label)?>'>
        <input type='hidden' name='md5[<?php echo $i?>]' value='<?php echo md5($SB_safeValue)?>'>
<?php
            if ($param['inline'])
            {
?>
        <input name='value[<?php echo $i?>]' value='<?php echo $this->encodeValue($SB_safeValue)?>'>
<?php
            }
            else
            {
?>
        <textarea name='value[<?php echo $i?>]' rows='<?php echo $rows?>'><?php echo htmlspecialchars($SB_safeValue)?></textarea>
<?php
            }
?>
    </td>
</tr>
<?php
            $i++;
        }
?>
</table>
<?php if ($i): ?>
<input type='hidden' name='count' value='<?php echo $i?>'>
<input type='submit' name='save' value='Submit'>
<input type='reset'>
<?php endif;?>
</form>
<?php
        if (!defined("EMBEDDED"))
        {
            SB_Page::foot();
        }
    }

    function create()
    {
        SB_Page::head('Edit Translation', 'siteBarLocale');
?>
<h2>Create Translation</h2>
[<a href="translator.php">Back to Translation List</a>]
<p>
<?php
        if (isset($_REQUEST['save']))
        {
            $ok = true;

            foreach (array('newdir','language','author','url') as $name)
            {
                if (!isset($_REQUEST[$name]) || !strlen($_REQUEST[$name]))
                {
                    $ok = false;
                    echo "Field $name must be filled!<br>";
                }
            }

            if ($ok)
            {
                $lang = $_REQUEST['newdir'];
                if (!mkdir('./locale/' . $lang))
                {
                    $this->writeErrors(true);
                    die('Cannot create directory!');
                }
                chmod('./locale/' . $lang, 0777);
                foreach ($this->parts as $part => $param)
                {
                    $file = sprintf($this->fmt, $lang, $param['file']);
                    if (!$fh = fopen($file, 'w'))
                    {
                        $this->writeErrors(true);
                        die("Cannot create file $file!");
                    }
                    fwrite($fh, "<?php \$$part = array(); ?>");
                    fclose($fh);
                    chmod($file, 0666);
                }

                $file = sprintf($this->fmt, $lang, "info.inc.php");
                if (!$fh = fopen($file, 'w'))
                {
                    die("Cannot create file $file!");
                }
                $text = <<<_INFO
<?php

\$info = array
(
    'language' => '${_REQUEST['language']}',
    'authors' => array
    (
    '${_REQUEST['author']}' => '${_REQUEST['url']}',
    ),
);

?>
_INFO;
                fwrite($fh, $text);
                fclose($fh);
                chmod($file, 0666);

                echo 'Directory created!';
            }
        }
        else
        {
?>
<form method="POST">
<table>
<tr>
    <th>Directory</th>
    <td><input name="newdir"></td>
</tr>
<tr>
    <th>Language</th>
    <td><input name='language'></td>
</tr>
<tr>
    <th>Author</th>
    <td><input name='author'></td>
</tr>
<tr>
    <th>URL</th>
    <td><input name='url'></td>
</tr>
</table>
<input type='submit' name='save' value='Submit'>
<input type='reset'>
</form>
<?php
        }
        if (!defined("EMBEDDED"))
        {
            SB_Page::foot();
        }
    }
}

$tr = new Translator();
$tr->run();
?>
