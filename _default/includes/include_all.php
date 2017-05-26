<?php

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

if (!function_exists('include_all')) {

    function include_all($arg) {
        echo '<link rel="shortcut icon" type="image/png" href="' . $arg->URL('APP') . $arg->PATH('ACTIVE_APP') . 'ico1.png"/>' . PHP_EOL;
        echo '<link rel="stylesheet" type="text/css" href="' . $arg->URL('APP') . $arg->PATH('ACTIVE_APP') . 'css/style.css"/>' . PHP_EOL;
    }

}

array_push($this->ADD_FUNC['IN_HEAD'], 'include_all');
