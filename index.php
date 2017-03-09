<?php
/*
    __     __               _
    \ \   / __ _ _ __ _ __ | |__  _ __
     \ \ / / _` | '__| '_ \| '_ \| '_ \
      \ V | (_| | |  | |_) | | | | |_) |
       \_/ \__,_|_|  | .__/|_| |_| .__/
                     |_|         |_|
            __  ____     ______
           |  \/  \ \   / / ___|
           | |\/| |\ \ / | |
           | |  | | \ V /| |
           |_|  |_|  \_/  \____|

            Version: 3.1
*/
define('ROOT', str_ireplace('\\', '/', dirname(__FILE__)) . '/');

$SCRIPT_NAME = str_ireplace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

if (strlen($SCRIPT_NAME) > 1) {
    define('PATH', $SCRIPT_NAME . '/');
} else {
    define('PATH', $SCRIPT_NAME);
}
unset($SCRIPT_NAME);

require ROOT . '__VP/system/boot.php';
?>