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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['sitebar_emb'] = 'SiteBar Tree Embedded';

require_once('./inc/writers/sitebar.inc.php');

class SB_Writer_sitebar_emb extends SB_Writer_sitebar
{
    function __construct()
    {
        parent::__construct();
    }

    // Make following function to do nothing with option to call
    // them with true parameter to call parent's function.

    function setOutputHandler($doit=false)
    {
        if ($doit) parent::setOutputHandler();
    }

    function drawCacheControl($doit=false)
    {
        if ($doit) parent::drawCacheControl();
    }

    function drawContentType($doit=false)
    {
        if ($doit) parent::drawContentType();
    }

    function drawHeadPage($doit=false)
    {
        if ($doit) parent::drawHeadPage();
    }

    function drawHeadLogo($doit=false)
    {
        if ($doit) parent::drawHeadLogo();
    }

    function drawToolBar($doit=false)
    {
        if ($doit) parent::drawToolBar();
    }

    function drawFoot($doit=false)
    {
        if ($doit) parent::drawFoot();
    }

    function run()
    {
        $this->um->setParam('user','use_tooltips', false);
        $this->um->setParam('user','extern_commander', false);
        $this->um->setParam('user','auto_close', false);
        $this->loadOpenNodesOnly = false;
        parent::run();
    }
}
?>
