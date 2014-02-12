<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005-2006  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software; you can redistribute it and/or modify      *
 *  it under the terms of the GNU General Public License as published by      *
 *  the Free Software Foundation; either version 2 of the License, or         *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU General Public License for more details.                              *
 *                                                                            *
 *  You should have received a copy of the GNU General Public License         *
 *  along with this program; if not, write to the Free Software               *
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA *
 ******************************************************************************/

    die;

    // Put here identifiers whose text has been changed
    // other languages will be marked as changed.
    $changes = array
    (
        'integrator::hint_install',
    );

    if ($dh = opendir('.'))
    {
        while (($dir = readdir($dh)) !== false)
        {
            $file = $dir.'/para.inc.php';

            if (is_dir($dir) && is_file($file) && $dir != 'en_US')
            {
                print 'Processing language: '.$dir.' ';

                $rows = file($file);
                $changed = 0;

                for ($i = 0; $i< count($rows); $i++)
                {
                    foreach ($changes as $change)
                    {
                        if (strstr($rows[$i], $change) && substr($rows[$i+1],0,3)!='<@>')
                        {
                            $rows[$i+1] = '<@>' . $rows[$i+1];
                            print "#";
                            $changed++;
                        }
                    }
                }

                if ($changed)
                {
                    $out = fopen($file, "w");
                    fwrite($out, implode('', $rows));
                    fclose($out);
                }

                print "\n";
            }
        }
        closedir($dh);
    }

?>