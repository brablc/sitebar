<?php

/**
* See class SB_HookInterface in ../../inc/page.inc.php for possible methods to be overridden.
*/

class SB_Hook extends SB_HookInterface
{
    function designedBy()
    {
        echo SB_T("Skin designed by")?> <a href='http://www.mindslip.com/' <?php echo SB_Page::target()?>>David Szego</a><?php
    }

    function getStyle($styleID)
    {
        switch ($styleID)
        {
            case 'google_color_border': return '8899AA';
        }

        return parent::getStyle($styleID);
    }
}

?>
