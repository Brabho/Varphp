<?php

namespace VP\System;

use VP\System\Configure;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Getting User Define Configure and Marge
 */

if (is_file(ROOT . '_config.php')) {
    require ROOT . '_config.php';
}

if (class_exists('_config')) {

    class Get_Conf extends \_config {
        
    }

} else {

    class Get_Conf extends Configure {
        
    }

}