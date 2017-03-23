<?php

/*
 * Main
 * BootLoader
 * BootStrap
 */
if (!defined('ROOT')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

if (preg_match_all('/index\.php/', $_SERVER['PHP_SELF']) &&
        preg_match_all('/index\.php/', $_SERVER['SCRIPT_FILENAME'])) {


    define('MAIN', true);

    ob_start();

    /*
     * Getting Configuration
     */

    require ROOT . '__VP/system/configure.php';
    require ROOT . '__VP/system/get_conf.php';
    require ROOT . '__VP/system/conf.php';

    /*
     * Getting Controllers
     */

    require ROOT . '__VP/controllers/urls.php';
    require ROOT . '__VP/controllers/render.php';
    require ROOT . '__VP/controllers/hooks.php';
    require ROOT . '__VP/controllers/apps.php';

    new VP\Controller\apps();
} else {

    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}
?>