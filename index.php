<?php

define('ROOT', str_replace('\\', '/', dirname(__FILE__)) . '/');

define('PATH', dirname($_SERVER['SCRIPT_NAME']) . '/');

require_once '__vp/system/boot.php';
?>