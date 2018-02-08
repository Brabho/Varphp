<?php

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

function include_all($arg) {
    echo '<link rel="shortcut icon" type="image/png" href="' . $arg->APP_URL . 'ico1.png"/>' . PHP_EOL;
    echo '<link rel="stylesheet" type="text/css" href="' . $arg->APP_URL . 'css/style.css"/>' . PHP_EOL;
}

array_push($this->ADD_FUNC['IN_HEAD'], 'include_all');
