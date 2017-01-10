<?php

/*
 * Main BootLoader/BootStrap
 */

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Getting Configuration
 */

require_once ROOT . '__VP/system/configure.php';
require_once ROOT . '__VP/system/get_conf.php';
require_once ROOT . '__VP/system/conf.php';

/*
 * Getting Controllers
 */

require_once ROOT . '__VP/controllers/urls.php';
require_once ROOT . '__VP/controllers/render.php';
require_once ROOT . '__VP/controllers/hooks.php';
require_once ROOT . '__VP/controllers/apps.php';

new VP\Controller\apps();
?>