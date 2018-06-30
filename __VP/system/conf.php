<?php

namespace VP\System;

use VP\System\Get_Conf;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class Conf extends Get_Conf {
    /*
     * Setup Configuration
     */

    function __construct() {
        parent::__construct();
        $this->SETS();
    }

    /*
     * Get Real / Actual File Name
     */

    protected function GET_FILE($path, $type = 'VIEW') {
        $call_file = basename($path);

        if ($type === 'VIEW') {
            $the_file = $this->KEYS['VIEW']['P'] . $call_file . $this->KEYS['VIEW']['S'];
        } elseif ($type === 'AJAX') {
            $the_file = $this->KEYS['AJAX']['P'] . $call_file . $this->KEYS['AJAX']['S'];
        }

        return ($path === $call_file) ? $the_file : dirname($path) . '/' . $the_file;
    }

    /*
     * Get File / Alice Name
     */

    protected function GET_NAME($path, $type = 'VIEW') {
        $call_file = basename($path);

        $the_keys = '';
        if ($type === 'VIEW') {
            $the_keys = [$this->KEYS['VIEW']['P'], $this->KEYS['VIEW']['S']];
        } elseif ($type === 'AJAX') {
            $the_keys = [$this->KEYS['AJAX']['P'], $this->KEYS['AJAX']['S']];
        }

        $the_file = str_replace($the_keys, '', $call_file);
        return ($path === $call_file) ? $the_file : dirname($path) . '/' . $the_file;
    }

    protected function IS_APP_STRINGS() {
        return (strlen($this->APP['STRINGS']) > 2 && is_file(ROOT . $this->PATH('ACTIVE_APP') . $this->APP['STRINGS']));
    }

}
