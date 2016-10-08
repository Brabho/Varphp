<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Get User Define Configure and Marge
 */
if (file_exists(ROOT . '_config.php')) {
    require_once ROOT . '_config.php';
}

if (class_exists('_config')) {

    class get_conf extends _config {
        
    }

} else {

    class get_conf extends configure {
        
    }

}

/*
 * Set Configuration 
 * Private Keys (Controller & Ajax)
 */

class conf extends get_conf {

    function __construct() {
        parent::__construct();
        $this->SETS();
    }

    /*
     * Error Controller
     */

    protected function ERROR($arg = null) {
        if (ob_get_contents()) {
            ob_end_clean();
        }
        $path = ROOT . $this->PATH('ACTIVE_APP');
        if (file_exists($path . 'error.php')) {
            require_once $path . 'error.php';

            if (class_exists('error')) {
                $class = new error($arg);
            } else {
                require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
            }

            if (method_exists('error', $arg)) {
                $class->$arg();
            }
        } else {
            require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
        }
    }

    /*
     * Real File
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

}

?>