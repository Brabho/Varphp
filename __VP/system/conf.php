<?php

namespace VP\System;

use VP\System\get_conf;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class conf extends get_conf {
    /*
     * Setup Configuration
     */

    function __construct() {
        parent::__construct();
        $this->SETS();
    }

    /*
     * Error Controller
     */

    protected function ERROR($arg = null) {
        while (ob_get_contents()) {
            ob_end_clean();
        }

        $path = ROOT . $this->PATH('ACTIVE_APP');
        if (file_exists($path . 'err.php')) {
            require $path . 'err.php';

            if (class_exists('err')) {
                $class = new \err($arg);
            } else {
                require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
            }

            if (isset($class) && method_exists('err', $arg)) {
                $class->$arg();
            } else {
                require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
            }
        } else {
            require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
        }
    }

    /*
     * Real File
     * [Actual File Name]
     */

    public function get_file($path, $type = 'CONTROLLER') {
        $call_file = basename($path);

        if ($type === 'CONTROLLER') {
            $the_file = $this->KEYS['CONTROLLER']['P'] . $call_file . $this->KEYS['CONTROLLER']['S'];
        } elseif ($type === 'ajax') {
            $the_file = $this->KEYS['AJAX']['P'] . $call_file . $this->KEYS['AJAX']['S'];
        }

        return ($path === $call_file) ? $the_file : dirname($path) . '/' . $the_file;
        unset($path, $type, $call_file, $the_file);
    }

    /*
     * File Name
     * [Alice Name]
     */

    public function get_name($path, $type = 'CONTROLLER') {
        $call_file = basename($path);

        if ($type === 'CONTROLLER') {
            $the_keys = [$this->KEYS['CONTROLLER']['P'], $this->KEYS['CONTROLLER']['S']];
        } elseif ($type === 'ajax') {
            $the_keys = array($this->KEYS['AJAX']['P'], $this->KEYS['AJAX']['S']);
        }

        $the_file = str_replace($the_keys, '', $call_file);
        return ($path === $call_file) ? $the_file : dirname($path) . '/' . $the_file;
        unset($path, $type, $call_file, $the_keys);
    }

    function __destruct() {
        unset($this);
    }

}

?>