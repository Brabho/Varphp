<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class error extends VP\Controller\hooks {

    function __construct($error = null) {
        parent::__construct();
    }

    /*
     * Error 404
     */

    public function e404() {
        require_once ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require_once ROOT . $this->PATH('ACTIVE_APP') . 'view/error.php';
        $this->RENDER();
    }

}

?>