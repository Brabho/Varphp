<?php

/*
 * 
    __     __               _           
    \ \   / __ _ _ __ _ __ | |__  _ __  
     \ \ / / _` | '__| '_ \| '_ \| '_ \ 
      \ V | (_| | |  | |_) | | | | |_) |
       \_/ \__,_|_|  | .__/|_| |_| .__/ 
                     |_|         |_|    
 *
 *
 * Main BootLoader/BootStrap
 */

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

session_start();
session_regenerate_id(true);
ob_start();

require_once ROOT . '__vp/system/configure.php';

require_once ROOT . '__vp/system/conf.php';

require_once ROOT . '__vp/controllers/urls.php';

require_once ROOT . '__vp/controllers/render.php';

require_once ROOT . '__vp/controllers/hooks.php';

require_once ROOT . '__vp/controllers/app.php';

new app();
?>