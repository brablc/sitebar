<?php

/**
* See class SB_HookInterface in ../../inc/page.inc.php for possible methods to be overridden.
*/

class SB_Hook extends SB_HookInterface
{
    function designedBy()
    {
        echo SB_T("Skin designed by")?> <a href='http://www.alexisisaac.net/' <?php echo SB_Page::target()?>>Alexis Isaac</a><?php
    }
}

?>
