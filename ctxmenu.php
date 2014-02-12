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

/******************************************************************************
 This file is called when selecting "Add Link to SiteBar" or
 "Add Page to SiteBar" menu item in context menu of Internet Explorer.

 SB_Page code by Alexis ISAAC <moi@alexisisaac.net>, link code by Ondrej Brablc
 ******************************************************************************/

?>
<script type="text/javascript" defer>
<?php

require_once('./inc/usermanager.inc.php');
$um =& SB_UserManager::staticInstance();
$popupParams = $um->getParamB64('user', 'popup_params');

echo "    var params='$popupParams';\n";

if ($_GET['add'] == 'page') :
?>
    var tit='';

    if (external.menuArguments.document)
    {
        tit = external.menuArguments.document.title;
    }

    var url = external.menuArguments.location.href;
<?php
else :
?>
    var obj = external.menuArguments.event.srcElement;
    var tit = obj.innerHTML;
    var url = obj.getAttribute('href');

<?php

endif;
?>
    var cp  = external.menuArguments.document.charset;

    window.open('command.php?command=Add%20Bookmark'+
        '&amp;url='+escape(url)+
        '&amp;name='+escape(tit)+
        '&amp;cp='+cp,
        'sitebar_gCmdWin',
        params);

    close();
</script>
