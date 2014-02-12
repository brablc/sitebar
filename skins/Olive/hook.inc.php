<?php

/**
* See class SB_HookInterface in ../../inc/page.inc.php for possible methods to be overridden.
*/

class SB_Hook extends SB_HookInterface
{
    function designedBy()
    {
        echo SB_T("Skin designed by")?> <a href='http://www.gunnarwrobel.de/' <?php echo SB_Page::target()?>>Gunnar Wrobel</a><?php
    }

    function getStyle($styleID)
    {
        switch ($styleID)
        {
            case 'google_color_border': return '84AA00';
        }

        return parent::getStyle($styleID);
    }
}

?>
