<?php

namespace VP\Controller;

use VP\Controller\render;

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Hook Class (Middle/Joint/Marge)
 */

class hooks extends render {

    function __construct() {
        parent::__construct();
        $this->gettingAutoload();
        $this->gettingPlugins();
    }

    /*
     * Getting Autoloader
     */

    private function gettingAutoload() {
        $autoload_path = $this->PATH('AUTOLOAD');
        if (file_exists($autoload_path)) {
            $autoload_list = scandir($autoload_path);
            foreach ($autoload_list as $autoload) {
                if ($autoload === '.' || $autoload === '..') {
                    continue;
                }
                require_once ROOT . $autoload_path . $autoload;
            }
        }
    }

    /*
     * Getting Plugins
     */

    private function gettingPlugins() {
        $plugins_path = $this->PATH('PLUGINS');
        if (file_exists($plugins_path)) {
            $plugins_list = scandir($plugins_path);

            foreach ($plugins_list as $plugin) {
                if ($plugin === '.' || $plugin === '..') {
                    continue;
                }
                $plugin_contl = ROOT . $plugins_path . $plugin . '/controller.php';
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