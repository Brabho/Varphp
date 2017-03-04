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

        if (strtolower($this->URL('PATHS')[0]) === 'home') {
            /*
             * Error
             */
            require ROOT . $this->PATH('ACTIVE_APP') . 'err.php';
            $err = new err();
            $err->e404();
        } else {
            /*
             * View
             */
            $this->META_DETAILS['TITLE'] = 'Varphp v' . $this->VARPHP('VERSION');
            require ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
            require ROOT . $this->PATH('ACTIVE_APP') . 'view/home.php';
            $this->RENDER();
        }
    }

    function __destruct() {
        unset($this);
    }

}

?>