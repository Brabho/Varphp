<?php
/*
    __     ___    ____  ____  _   _ ____  
    \ \   / / \  |  _ \|  _ \| | | |  _ \ 
     \ \ / / _ \ | |_) | |_) | |_| | |_) |
      \ V / ___ \|  _ <|  __/|  _  |  __/ 
       \_/_/   \_|_| \_|_|   |_| |_|_|    

            __  ____     ______ 
           |  \/  \ \   / / ___|
           | |\/| |\ \ / | |    
           | |  | | \ V /| |___ 
           |_|  |_|  \_/  \____|

              Version: 4.0
 */
define('ROOT', str_ireplace('\\', '/', dirname(__FILE__)) . '/');

$SERVER_SCRIPT_NAME = str_ireplace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

if (strlen($SERVER_SCRIPT_NAME) > 1) {
    define('PATH', $SERVER_SCRIPT_NAME . '/');
} else {
    define('PATH', $SERVER_SCRIPT_NAME);
}

$SERVER_SCRIPT_NAME = null;
unset($SERVER_SCRIPT_NAME);

require ROOT . '__VP/system/boot.php';
