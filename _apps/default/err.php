<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class err extends VP\Controller\hooks {

    function __construct() {
        parent::__construct();
    }

    /*
     * Error 404
     */

    public function e404() {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        header('Status: 404 Not Found');

        $this->META_SET([
            'TITLE' => '404 Error',
            'DESCRIPTION' => 'Page not found or Down for Maintain',
        ]);

        require ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require ROOT . $this->PATH('ACTIVE_APP') . 'view/error.php';
        $this->RENDER();
    }

    function __destruct() {
        unset($this);
    }

}

?>