<?php

use VP\Controller\Apps;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

Apps::$V->LOAD_TAGS['ICON']['URL'] = Apps::$V->APP_URL . 'favicon.png';
Apps::$V->LOAD_TAGS['ICON']['TYPE'] = 'image/png';

array_push(Apps::$V->LOAD_TAGS['CSS'], Apps::$V->APP_URL . 'css/style.css');
