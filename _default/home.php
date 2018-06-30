<?php

use VP\Controller\Apps;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class home {

    public function index() {

        /*
         * If Direct Call to Home Controller
         */
        require Apps::$V->APP_PATH . 'includes/include_all.php';

        if (Apps::$V->URL('PATHS')[0] === 'home') {
            /*
             * Error
             */
            Apps::$V->RENDER([
                'TITLE' => 'ERROR',
                'code' => 404,
                'file' => Apps::$V->APP_PATH . 'views/404.php'
            ]);
        } else {
            /*
             * View
             */
            Apps::$V->RENDER([
                'file' => Apps::$V->APP_PATH . 'views/home.php'
            ]);
        }
    }

}
