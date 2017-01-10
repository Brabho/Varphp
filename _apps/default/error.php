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
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        header('Status: 404 Not Found');

        $this->META_DETAILS['TITLE'] = 'Error';
        $this->META_DETAILS['DESCRIPTION'] = '';
        $this->META_DETAILS['KEYWORDS'] = '';

        require_once ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require_once ROOT . $this->PATH('ACTIVE_APP') . 'view/error.php';
        $this->RENDER();
    }

}

?>