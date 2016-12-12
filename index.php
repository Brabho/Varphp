<?php

/*
    __     __               _           
    \ \   / __ _ _ __ _ __ | |__  _ __  
     \ \ / / _` | '__| '_ \| '_ \| '_ \ 
      \ V | (_| | |  | |_) | | | | |_) |
       \_/ \__,_|_|  | .__/|_| |_| .__/ 
                     |_|         |_|    

            Version: 2.6.4
         Develop By Club Coding
*/

define('ROOT', str_ireplace('\\', '/', dirname(__FILE__)) . '/');

$SCRIPT_NAME = str_ireplace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

if (strlen($SCRIPT_NAME) > 1) {
    define('PATH', $SCRIPT_NAME . '/');
} else {
    define('PATH', $SCRIPT_NAME);
}
unset($SCRIPT_NAME);

require_once '__VP/system/boot.php';
?>