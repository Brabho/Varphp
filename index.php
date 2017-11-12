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

              Version: 3.7.4
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
