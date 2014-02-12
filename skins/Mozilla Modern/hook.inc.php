<?php

/**
* See class SB_HookInterface in ../../inc/page.inc.php for possible methods to be overridden.
*/

class SB_Hook extends SB_HookInterface
{
    function designedBy()
    {
        echo SB_T('Skin created by')?> <a href="http://www.jasonsawtelle.com/" <?php echo SB_Page::target()?>>Jason Sawtelle</a><?php
    }

    function getStyle($styleID)
    {
        switch ($styleID)
        {
            case 'google_color_border': return '7A8CA7';
        }

        return parent::getStyle($styleID);
    }
}

?>
