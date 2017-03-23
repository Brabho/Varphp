<?php

namespace VP\System;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Main Configure Class File
 */

class configure {

    public $APP;
    public $KEYS;
    public $TAGS;
    public $META;
    public $OPT;
    public $EXTRA;

    function __construct() {

        /*
         * App Details
         */
        $this->APP = [
            /*
             * App Name
             */
            'NAME' => 'Varphp',
            /*
             * Charset
             */
            'CHARSET' => 'utf-8',
            /*
             * App Time Zone
             */
            'TIMEZONE' => 'Asia/Kolkata',
            /*
             * Active Template Directory Name
             */
            'ACTIVE' => 'default',
            /*
             * Active Plugins Directory Name
             */
            'ACTIVE_PLUGINS' => [],
            /*
             * Active Autoload Files
             */
            'ACTIVE_AUTOLOADS' => [],
            /*
             * App Mode
             * [run, maintain]
             */
            'MODE' => 'run',
            /*
             * App Environment
             * [develop, publish]
             */
            'ENVT' => 'develop',
            /*
             * Ajax Request From
             * Ajax Request Type
             */
            'AJAX' => [
                /*
                 * Request Method 
                 * [GET, POST, BOTH]
                 */
                'METHOD' => 'BOTH',
                /*
                 * Request From 
                 * [IN, OUT, BOTH]
                 */
                'FROM' => 'BOTH'
            ],
        ];

        /*
         * Private Keys of 
         * View & Ajax Controllers
         * [P = Primary, S = Secondary]
         */
        $this->KEYS = [
            'CONTROLLER' => [
                'P' => '',
                'S' => ''
            ],
            'AJAX' => [
                'P' => '',
                'S' => '',
                /*
                 * Method Name in Query String
                 */
                'QUERY' => 'm',
            ],
        ];

        /*
         * Default HTML Tags & Attributes
         */
        $this->TAGS = [
            'DOCTYPE' => '<!DOCTYPE html>',
            'HTML' => '<html>',
            'HEAD' => '<head>',
            'BODY' => '<body>',
        ];

        /*
         * Meta Tags and Details
         */
        $this->META = [
            'SEPARATE' => ' | ',
            'DESCRIPTION' => '',
            'KEYWORDS' => '',
            /*
             * This section Will be add in all pages
             */
            'STICK' => [
                'DESCRIPTION' => '',
                'KEYWORDS' => '',
            ],
        ];

        /*
         * Other Options
         */
        $this->OPT = [
            /*
             * App Protocol
             * [http:// or https://]
             * Auto Configure, If Empty
             */
            'PROTOCOL' => '',
            /*
             * Set Memory Limit
             */
            'MEMORY_LIMIT' => '16M',
            /*
             * Cookie HTTP Only
             */
            'COOKIE_HTTP' => true,
        ];

        /*
         * Extra Global Array or Value
         */
        $this->EXTRA = [];
    }

    /*
     * Default Paths
     */

    public function PATH($name = null, $sub = null) {
        $allDirs = [
            'VP' => '__VP/',
            'SYS' => '__VP/system/',
            'PLUGINS' => '__PLUGINS/',
            'AUTOLOADS' => '__AUTOLOADS/',
            'TMP' => '__TMP/',
            'ACTIVE_APP' => '_' . $this->APP['ACTIVE'] . '/',
        ];

        $path = false;
        if (array_key_exists($name, $allDirs)) {

            if ($name === 'TMP' && !is_dir($allDirs['TMP'])) {
                mkdir(ROOT . $allDirs['TMP'], 0777, TRUE);
            }

            if (strlen($sub) > 0) {
                $path = $allDirs[$name] . $sub . '/';

                if ($name === 'TMP' && !is_dir($path)) {
                    mkdir(ROOT . $allDirs['TMP'] . $sub, 0777, TRUE);
                } elseif (!is_dir($path)) {
                    $path = false;
                }
            } else {
                $path = $allDirs[$name];
            }
        }
        return $path;
        unset($name, $sub, $allDirs, $path);
    }

    /*
     * Get Maintain Mode
     * [Return Bool]
     */

    public function MAINTAIN() {
        return ($this->APP['MODE'] === 'maintain' || file_exists(ROOT . '.maintain')) ? true : false;
    }

    /*
     * Checking Autoload Exists & Active
     */

    public function AUTOLOAD_ACTIVE($name) {
        if (in_array($name, $this->APP['ACTIVE_AUTOLOADS']) && file_exists(ROOT . $this->PATH('AUTOLOADS') . $name)) {
            return $this->PATH('AUTOLOADS') . $name;
        }
        return false;
        unset($name);
    }

    /*
     * Checking Plugin Exists & Active
     */

    public function PLUGIN_ACTIVE($name) {
        if (in_array($name, $this->APP['ACTIVE_PLUGINS']) && is_dir(ROOT . $this->PATH('PLUGINS'))) {
            return $this->PATH('PLUGINS') . $name . '/';
        }
        return false;
        unset($name);
    }

    /*
     * System Details
     */

    public function VARPHP($n) {
        $details = [
            'VERSION' => '3.3',
            'STATUS' => 'Stable'
        ];
        return (array_key_exists($n, $details)) ? $details[$n] : false;
    }

    /*
     * Setting up Configuration
     * Do not call this Method *
     */

    protected function SETS() {

        switch ($this->APP['ENVT']) {

            case 'develop':
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                break;

            case 'publish':
                error_reporting(0);
                ini_set('display_errors', 0);
                break;
        }

        if (function_exists('date_default_timezone_set')) {
            date_default_timezone_set($this->APP['TIMEZONE']);
        }

        if (strlen($this->OPT['PROTOCOL']) < 1) {

            if ((array_key_exists('HTTPS', $_SERVER) && ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1)) ||
                    (array_key_exists('HTTP_X_FORWARDED_PROTO', $_SERVER) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {

                $this->OPT['PROTOCOL'] = 'https://';
            } else {
                $this->OPT['PROTOCOL'] = 'http://';
            }
        }

        if ($this->OPT['PROTOCOL'] === 'https://') {
            ini_set('session.cookie_secure', 1);
        }

        ini_set('memory_limit', $this->OPT['MEMORY_LIMIT']);

        if ($this->OPT['COOKIE_HTTP'] === true) {
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
        }
    }

}

?>