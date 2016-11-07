<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Hook Class (Middle/Joint/Marge)
 * Getting Plugins 
 */

class hooks extends render {

    function __construct() {
        parent::__construct();

        $plugins_path = $this->PATH('PLUGINS');
        if (file_exists($plugins_path)) {
            $plugins_list = scandir($plugins_path);

            foreach ($plugins_list as $plugin) {
                if ($plugin === '.' || $plugin === '..') {
                    continue;
                }
                $plugin_contl = ROOT . $this->PATH('PLUGINS') . $plugin . '/controller.php';
                if ($this->PLUGIN_ACTIVE($plugin) && file_exists($plugin_contl)) {
                    require_once $plugin_contl;
                }
            }
        }
        unset($plugins_path, $plugins_list, $plugin, $plugin_contl);
    }

    function __destruct() {
        unset($this);
    }

}

?>