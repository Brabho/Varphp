<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
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
            $this->ERROR = 'e404';
        }

        require_once ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require_once ROOT . $this->PATH('ACTIVE_APP') . 'view/home.php';
        $this->RENDER();
    }

}

?>