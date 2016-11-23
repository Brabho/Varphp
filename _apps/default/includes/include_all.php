<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

function include_all($arg) {
    echo '<link rel="icon" type="image/png" href="' . $arg->URL('APP') . $arg->PATH('ACTIVE_APP') . 'icon1.png"/>' . "\n";
    echo '<link rel="stylesheet" type="text/css" href="' . $arg->URL('APP') . $arg->PATH('ACTIVE_APP') . 'css/style.css"/>' . "\n";
}

array_push($this->ADD_FUNC['IN_HEAD'], 'include_all');
?>