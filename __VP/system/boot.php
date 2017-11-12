<?php

/*
 * Main / BootLoader / BootStrap
 */

/*
 * Cleaning all Variables
 */

foreach (array_keys(get_defined_vars()) as $var) {
    if ($var === 'GLOBALS' || $var === '_POST' || $var === '_GET' || $var === '_COOKIE' ||
            $var === '_FILES' || $var === '_REQUEST' || $var === '_SERVER' || $var === '_ENV') {

        continue;
    }
    $var = null;
    unset($var);
}
clearstatcache();

if (!defined('ROOT') || !defined('PATH')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

if (preg_match('@index\.php@i', $_SERVER['PHP_SELF']) ||
        preg_match('@index\.php@i', $_SERVER['SCRIPT_FILENAME'])) {

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