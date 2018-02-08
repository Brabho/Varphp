<?php

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class err extends VP\Controller\hooks {

    function __construct() {
        parent::__construct();
    }

    /*
     * Page not Found
     * Error 404
     */

    public function e404() {
        http_response_code(404);

        $this->META_SET([
            'TITLE' => '404 Error',
            'DESCRIPTION' => 'Page not found'
        ]);

        require $this->APP_PATH . 'includes/include_all.php';
        require $this->APP_PATH . 'view/404.php';
        $this->RENDER();
    }

    /*
     * Method not allow
     * Error 403
     */

    public function e405() {
        http_response_code(405);

        $this->META_SET([
            'TITLE' => '405 Error',
            'DESCRIPTION' => 'Request Method not allow'
        ]);

        require $this->APP_PATH . 'includes/include_all.php';
        require $this->APP_PATH . 'view/405.php';
        $this->RENDER();
    }

    /*
     * Maintan Mode
     * Error 503
     */

    public function e503() {
        http_response_code(503);

        $this->META_SET([
            'TITLE' => '503 Error',
            'DESCRIPTION' => 'Under Construction Or Down For Maintenance'
        ]);

        require $this->APP_PATH . 'includes/include_all.php';
        require $this->APP_PATH . 'view/503.php';
        $this->RENDER();
    }

}
