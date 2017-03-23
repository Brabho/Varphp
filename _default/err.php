<?php

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
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
            'DESCRIPTION' => 'Page not found'
        ]);

        require ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require ROOT . $this->PATH('ACTIVE_APP') . 'view/404.php';
        $this->RENDER();
    }

    /*
     * Maintan Mode
     * Error 503
     */

    public function maintain() {
        header($_SERVER['SERVER_PROTOCOL'] . ' 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');

        $this->META_SET([
            'TITLE' => '503 Error',
            'DESCRIPTION' => 'Under Construction Or Down For Maintenance'
        ]);

        require ROOT . $this->PATH('ACTIVE_APP') . 'includes/include_all.php';
        require ROOT . $this->PATH('ACTIVE_APP') . 'view/503.php';
        $this->RENDER();
    }

}

?>