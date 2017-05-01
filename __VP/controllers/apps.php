<?php

namespace VP\Controller;

use VP\Controller\urls;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Getting Apps
 * Maintain Mode
 * Apps Methods
 * Sub Controllers
 * Ajax Controller
 */

class apps extends urls {

    function __construct() {
        parent::__construct();

        if ($this->MAINTAIN()) {

            $this->ERROR('maintain');
        } else {

            if ($this->AJAX()) {
                $this->ajax_ctrl();
            } else {
                $this->view_ctrl();
            }
        }
    }

    /*
     * App View Controller
     */

    private function view_ctrl() {
        $path = ROOT . $this->PATH('ACTIVE_APP');

        /*
         * MainController (Check & Call)
         */

        $mainController = $this->get_file($path . 'maincontroller') . '.php';

        if (file_exists($mainController)) {

            require $mainController;
            if (class_exists('mainController')) {
                new \mainController();
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
             * Getting Controller
             * File and Class / Controller
             */

            $param = $this->URL('PATHS');
            array_shift($param);

            $ctrl_file = $this->get_file($path . $class) . '.php';
            if (file_exists($ctrl_file)) {
                require $ctrl_file;
                $class = str_replace('-', '_', $class);
                if (class_exists($class)) {
                    $call = new $class($param);
                } else {
                    $error = true;
                }

                /*
                 * Dynamic Controller 
                 */
            } elseif (file_exists($this->get_file($path . 'dynamic') . '.php')) {
                $ctrl_file = $this->get_file($path . 'dynamic') . '.php';
                require $ctrl_file;
                if (class_exists('dynamic')) {
                    $call = new \dynamic($param);
                    $class = 'dynamic';
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }

            /*
             * Calling Method
             */
            if (isset($call)) {
                if (array_key_exists(1, $this->URL('PATHS'))) {
                    $method = str_replace('-', '_', $this->URL('PATHS')[1]);
                    if (method_exists($class, $method)) {
                        array_shift($param);
                        $call->$method($param);

                        /*
                         * Dynamic Method 
                         */
                    } elseif (method_exists($class, 'dynamic')) {
                        $call->dynamic($param);
                        array_shift($param);
                    } else {
                        $error = true;
                    }
                } elseif (method_exists($class, 'index')) {
                    $call->index($param);
                } else {
                    $error = true;
                }
            }

            /*
             * Render error if path longer than giving in Sub Paths
             */
            if (count($param) > $call->SUB_PATHS) {
                $error = true;
            }

            if ($error) {
                $this->ERROR('e404');
            }
        }
        unset($path, $error, $call, $class, $method, $param, $direct);
    }

    /*
     * App Ajax Controller
     */

    private function ajax_ctrl() {

        /*
         * Auth
         * Request Method
         */

        if ($this->APP['AJAX']['METHOD'] === 'ANY') {
            $req = true;
        } elseif ($this->APP['AJAX']['METHOD'] === $this->AJAX_DETAILS['METHOD']) {
            $req = true;
        }

        /*
         * Auth
         * Request From
         */

        switch ($this->APP['AJAX']['FROM']) {

            case 'IN':
                if ($this->AJAX_DETAILS['FROM'] === 'IN') {
                    $from = true;
                }
                break;

            case 'OUT':
                if ($this->AJAX_DETAILS['FROM'] === 'OUT') {
                    $from = true;
                }
                break;

            case 'BOTH':
                $from = true;
        }

        /*
         * Auth
         * Requested Type
         */

        if (isset($req, $from)) {

            if ($this->AJAX_DETAILS['REQUESTED'] === 'URL') {

                $path = $this->get_file(substr($this->URL('FPATH'), 5), 'AJAX');
            } elseif ($this->AJAX_DETAILS['REQUESTED'] === 'HEADER') {

                $path = $this->get_file($this->URL('FPATH'), 'AJAX');
            }
        }

        /*
         * Calling File & Class
         * Method [if exists]
         */

        if (isset($path) && file_exists($path . '.php')) {

            require ROOT . $path . '.php';
            $path = explode('/', $path);
            $class = $this->get_name($path[count($path) - 1], 'AJAX');
            $class = str_replace('-', '_', $class);

            if (class_exists($class)) {
                $call = new $class();
            }

            if (isset($call, $_SERVER['QUERY_STRING'], $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']])) {
                $method = $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']];
                $method = str_replace('-', '_', $method);
                if (method_exists($class, $method)) {
                    $call->$method();
                }
            }

            unset($req, $from, $path, $class, $method);
        } else {
            $this->ERROR('e404');
        }
    }

}

?>