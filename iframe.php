<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2006-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SiteBar</title>
    <script id="_PAGEFLAKES_Instance" type="text/javascript"></script>
</head>
<body>

<?php
    $height = "400px";
    if (isset($_GET['height']))
    {
        if (preg_match('/^(\d+)(.*)?$/',$_GET['height'],$reg))
        {
            $height = $reg[1];
            if ($reg[2] == '%')
            {
                $height .= '%';
            }
            else
            {
                $height .= 'px';
            }
        }
    }

    require_once('./inc/errorhandler.inc.php');
    require_once('./inc/page.inc.php');
    require_once('./inc/usermanager.inc.php');

    $um = SB_UserManager::staticInstance();
    $url = SB_Page::absBaseUrl();


?>

<iframe style="border: none; width:100%;height:<?php echo $height;?>"
        src="<?php echo $url;?>?target=_top" />
</body>
</html>
