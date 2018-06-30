<?php

namespace VP\Controller;

use VP\Controller\Hooks;

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

class Apps extends Hooks {

    public static $V;

    function __construct() {
        parent::__construct();

        /*
         * Maintain Mode
         */

        if ($this->MAINTAIN()) {
            $this->RENDER([
                'code' => 503,
                'type' => 'error'
            ]);
        } else {

            $this->V();

            /*
             * App Controller
             */
            if ($this->AJAX()) {
                $this->Ajax_Ctrl();
            } else {
                $this->View_Ctrl();
            }
        }
    }

    private function V() {
        self::$V = $this;
    }

    /*
     * App View Controller
     */

    private function View_Ctrl() {

        $req = null;
        $schema = null;

        /*
         * Auth
         * Request Method
         */
        if ($this->APP['VIEW']['METHODS'] === 'any') {
            $req = true;
        } elseif (in_array($this->HEADER_SERVER['METHOD'], $this->APP['VIEW']['METHODS'])) {
            $req = true;
        }

        /*
         * Auth
         * Request Schema
         */
        if ($this->APP['VIEW']['SCHEME'] === 'any') {
            $schema = true;
        } elseif (in_array($this->HEADER_SERVER['SCHEME'], $this->APP['VIEW']['SCHEME'])) {
            $schema = true;
        }

        if (!$req || !$schema) {
            $this->RENDER([
                'code' => 404,
                'type' => 'error'
            ]);
        }

        /*
         * MainController (Check & Call)
         */

        $main_ctrl = false;
        $maincontroller = $this->GET_FILE($this->APP_PATH . 'maincontroller') . '.php';

        if (is_file($maincontroller)) {

            require $maincontroller;

            if (class_exists('MainController')) {

                $main_ctrl = true;
                $main_init = new \MainController();
                $main_init->init();
            }
        }

        if (!$main_ctrl) {

            /*
             * If no Main Controller 
             */

            $call = null;
            $class = null;
            $method = null;

            if ($this->IS_HOME()) {
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

            $ctrl_file = $this->GET_FILE($this->APP_PATH . $class) . '.php';
            if (is_file($ctrl_file)) {
                require $ctrl_file;
                $class = str_replace('-', '_', $class);
                if (class_exists($class)) {
                    $call = new $class($param);
                } else {
                    $this->RENDER([
                        'code' => 404,
                        'type' => 'error'
                    ]);
                }

                /*
                 * Dynamic Controller 
                 */
            } elseif (is_file($this->GET_FILE($this->APP_PATH . 'dynamic') . '.php')) {
                $ctrl_file = $this->GET_FILE($this->APP_PATH . 'dynamic') . '.php';
                require $ctrl_file;
                if (class_exists('dynamic')) {
                    $call = new \dynamic($param);
                    $class = 'dynamic';
                } else {
                    $this->RENDER([
                        'code' => 404,
                        'type' => 'error'
                    ]);
                }
            } else {
                $this->RENDER([
                    'code' => 404,
                    'type' => 'error'
                ]);
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
                        $this->RENDER([
                            'code' => 404,
                            'type' => 'error'
                        ]);
                    }
                } elseif (method_exists($class, 'index')) {
                    $call->index($param);
                } else {
                    $this->RENDER([
                        'code' => 404,
                        'type' => 'error'
                    ]);
                }
            }
        }
        unset($main_ctrl, $call, $class, $method, $param, $direct);
    }

    /*
     * App Ajax Controller
     */

    private function Ajax_Ctrl() {

        $req = null;
        $schema = null;
        $from = null;
        $path = null;

        /*
         * Auth
         * Request Method
         */
        if ($this->APP['AJAX']['METHODS'] === 'any') {
            $req = true;
        } elseif (in_array($this->HEADER_SERVER['METHOD'], $this->APP['AJAX']['METHODS'])) {
            $req = true;
        }

        /*
         * Auth
         * Request Schema
         */
        if ($this->APP['AJAX']['SCHEME'] === 'any') {
            $schema = true;
        } elseif (in_array($this->HEADER_SERVER['SCHEME'], $this->APP['AJAX']['SCHEME'])) {
            $schema = true;
        }

        /*
         * Auth
         * Request From
         */
        if ($this->APP['AJAX']['FROM'] === 'any') {
            $from = true;
        } elseif ($this->APP['AJAX']['FROM'] === 'host' &&
                in_array($this->HEADER_SERVER['REFERER_HOST'], $this->APP['AJAX']['FROM_HOSTS'])) {

            $from = true;
        } elseif (in_array($this->AJAX_DETAILS['FROM'], $this->APP['AJAX']['FROM'])) {
            $from = true;
        }

        /*
         * Auth
         * Requested By
         */
        if (isset($req, $schema, $from)) {

            if ($this->AJAX_DETAILS['REQUESTED_BY'] === 'url') {
                $path = $this->GET_FILE(substr($this->URL('FPATH'), 5), 'AJAX');
            } elseif ($this->AJAX_DETAILS['REQUESTED_BY'] === 'header') {
                $path = $this->GET_FILE($this->URL('FPATH'), 'AJAX');
            }
        }

        /*
         * Calling File & Class
         * Method [if exists]
         */
        if (isset($path) && is_file(ROOT . $path . '.php')) {

            require ROOT . $path . '.php';
            $path = explode('/', $path);
            $class = $this->GET_NAME(end($path), 'AJAX');
            $class = str_replace('-', '_', $class);

            if (class_exists($class)) {
                $call = new $class();
            } else {
                $this->RENDER([
                    'code' => 404,
                    'type' => 'error'
                ]);
            }

            if (isset($call, $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']])) {
                $method = $this->URL('QUERIES')[$this->KEYS['AJAX']['QUERY']];
                $method = str_replace('-', '_', $method);
                if (method_exists($class, $method)) {
                    $call->$method();
                }
            }
        } else {
            $this->RENDER([
                'code' => 404,
                'type' => 'error'
            ]);
        }
    }

}
