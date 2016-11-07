<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Getting App
 */

class app extends urls {

    function __construct() {
        parent::__construct();

        if ($this->AJAX()) {
            $this->ajax_ctrl();
        } else {
            $this->view_ctrl();
        }
    }

    /*
     * View or Render
     */

    public function view_ctrl() {
        $path = ROOT . $this->PATH('ACTIVE_APP');

        /*
         * MainController (Check & Call)
         */
        $mainController = $this->get_file($path . 'maincontroller') . '.php';
        if (file_exists($mainController)) {
            require_once $mainController;
            if (class_exists('mainController')) {
                new mainController();
            }
        } else {

            /*
             * If no Main Controller
             */
            $error = false;
            if ($this->HOME()) {
                $class = 'home';
            } elseif (array_key_exists(0, $this->URL('PATHS'))) {
                $class = $this->URL('PATHS')[0];
            }

            /*
             * Getting Controller (File and Class)
             */
            $ctrl_file = $this->get_file($path . $class) . '.php';
            if (file_exists($ctrl_file)) {
                require_once $ctrl_file;
                if (class_exists($class)) {
                    $param = $this->URL('PATHS');
                    array_shift($param);
                    $call = new $class($param);
                } else {
                    $error = true;
                }

                /*
                 * Dynamic Controller 
                 */
            } elseif (file_exists($this->get_file($path . 'dynamic') . '.php')) {
                $ctrl_file = $this->get_file($path . 'dynamic') . '.php';
                require_once $ctrl_file;
                if (class_exists('dynamic')) {
                    new dynamic($this->URL('PATHS'));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }

            /*
             * Calling Method
             */
            if (array_key_exists(1, $this->URL('PATHS')) && method_exists($class, $this->URL('PATHS')[1])) {
                array_shift($param);
                $method = $this->URL('PATHS')[1];
                $call->$method($param);
            } elseif (method_exists($class, 'index')) {
                $call->index($param);
            }

            if ($error) {
                $this->ERROR('e404');
            }
        }
        unset($path, $error, $call, $class, $method, $param, $direct);
    }

    /*
     * Ajax Controller
     */

    public function ajax_ctrl() {

        /*
         * Request Type Auth
         */
        $req = null;
        switch ($this->APP['AJAX']['REQ']) {

            case 'GET':
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $req = true;
                }
                break;

            case 'POST':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $req = true;
                }
                break;

            case 'BOTH':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
                    $req = true;
                }
                break;
        }

        /*
         * Request From Auth
         */
        $from = null;
        if (isset($_SERVER['HTTP_REFERER'])) {

            $pattern = '@' . $_SERVER['HTTP_REFERER'] . '@';
            $subject = $this->URL('FULL');

            switch ($this->APP['AJAX']['FROM']) {

                case 'IN':
                    if (preg_match($pattern, $subject)) {
                        $from = true;
                    }
                    break;

                case 'OUT':
                    if (!preg_match($pattern, $subject)) {
                        $from = true;
                    }
                    break;

                case 'BOTH':
                    $from = true;
            }
        }

        /*
         * Valid Auth
         */
        if (isset($req, $from)) {
            if ($this->AJAX() === 'header') {
                $path = $this->get_file($this->URL('FPATH'), 'ajax');
            } elseif ($this->AJAX() === 'url') {
                $path = $this->get_file(substr($this->URL('FPATH'), 5), 'ajax');
            }
        }

        /*
         * Calling File
         * Class, Method (if exists)
         */
        if (isset($path) && file_exists($path . '.php')) {

            require_once $path . '.php';
            $path = explode('/', $path);
            $class = $this->get_name($path[count($path) - 1], 'ajax');

            if (class_exists($class)) {
                $call = new $class();
            }

            if (isset($call, $_SERVER['QUERY_STRING'], $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']])) {
                $method = $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']];
                if (method_exists($class, $method)) {
                    $call->$method();
                }
            }
        } else {
            $this->ERROR('e404');
        }
    }

    function __destruct() {
        unset($this);
    }

}

?>