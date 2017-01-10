<?php

namespace VP\System;

use VP\System\Configure;

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Getting User Define Configure and Marge
 */

if (file_exists(ROOT . '_config.php')) {
    require_once ROOT . '_config.php';
}

if (class_exists('_config')) {

    class get_conf extends \_config {
        
    }

} else {

    class get_conf extends Configure {
        
    }

}
?>