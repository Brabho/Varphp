<?php

namespace VP\Controller;

use VP\Controller\Render;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Hooks Class
 * Middle / Joint / Marge
 */

class Hooks extends Render {

    function __construct() {
        parent::__construct();

        $this->gettingAutoloads();
        $this->gettingPlugins();
    }

    /*
     * Getting Autoloads
     */

    private function gettingAutoloads() {
        $autoload_path = ROOT . $this->PATH('AUTOLOADS');
        if (file_exists($autoload_path)) {
            $autoload_list = scandir($autoload_path);
            foreach ($autoload_list as $autoload) {
                if ($autoload === '.' || $autoload === '..') {
                    continue;
                }
                $autoload_file = $autoload_path . $autoload;
                if ($this->AUTOLOAD_ACTIVE($autoload)) {
                    require $autoload_file;
                }
            }
        }
        unset($autoload_path, $autoload_list, $autoload);
    }

    /*
     * Getting Plugins
     */

    private function gettingPlugins() {
        $plugins_path = ROOT . $this->PATH('PLUGINS');
        if (file_exists($plugins_path)) {
            $plugins_list = scandir($plugins_path);
            foreach ($plugins_list as $plugin) {
                if ($plugin === '.' || $plugin === '..') {
                    continue;
                }
                $plugin_contl = $plugins_path . $plugin . '/controller.php';
                if ($this->PLUGIN_ACTIVE($plugin) && is_file($plugin_contl)) {
                    require $plugin_contl;
                }
            }
        }
        unset($plugins_path, $plugins_list, $plugin, $plugin_contl);
    }

}
