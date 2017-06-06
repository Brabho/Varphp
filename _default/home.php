<?php

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class home extends VP\Controller\hooks {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        /*
         * If Direct Call to Home Controller
         */

        if ($this->URL('PATHS')[0] === 'home') {
            /*
             * Error
             */
            $this->ERROR('e404');
        } else {
            /*
             * View
             */
            $this->META_DETAILS['TITLE'] = 'Varphp v' . $this->VARPHP('VERSION');
            require $this->APP_PATH . 'includes/include_all.php';
            require $this->APP_PATH . 'view/home.php';
            $this->RENDER();
        }
    }

}
