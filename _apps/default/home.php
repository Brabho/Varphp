<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class home extends VP\Controller\hooks {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        require_once ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';

        require_once ROOT . $this->PATH('ACTIVE_APP') . 'view/home.php';

        /*
         * If Direct Call to Home Controller
         */

        if ($this->URL('PATHS')[0] === 'home') {
            $this->ERROR = true;
            $this->RENDER(ROOT . $this->PATH('ACTIVE_APP') . 'view/error.php');
        } else {
            $this->RENDER();
        }
    }

}

?>