<?php

namespace VP\System;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Main Configure Class File
 */

class Configure {

    public $APP;
    public $KEYS;
    public $TAGS;
    public $META;
    public $OPT;
    public $EXTRA;
    public $URI_ARR;
    public $HEADER_SERVER;
    public $AJAX_DETAILS;
    public $SUB_PATHS;
    public $PAGE_ACCEPT_METHODS;
    public $APP_URL;
    public $APP_PATH;
    public $APP_STRINGS;
    public $HEADER;
    public $FOOTER;
    public $ADD_FUNC;
    public $LOAD_TAGS;
    public $META_DETAILS;

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
            'CHARSET' => 'UTF-8',
            /*
             * App Time Zone
             */
            'TIMEZONE' => 'Asia/Kolkata',
            /*
             * Active Template Directory Name
             */
            'ACTIVE' => 'default',
            /*
             * Active Autoload Files
             */
            'ACTIVE_AUTOLOADS' => [],
            /*
             * Active Plugins Directory Name
             */
            'ACTIVE_PLUGINS' => [],
            /*
             * App Mode
             * [run, maintain]
             */
            'MODE' => 'run',
            /*
             * App Environment
             * [develop, publish]
             * Server Default If not set
             */
            'ENVT' => 'develop',
            /*
             * Static Strings JSON File Path
             */
            'STRINGS' => '',
            /*
             * Minify Payload
             * Minify only when app environment is 'publish'
             */
            'MIN_PAYLOAD' => true,
            /*
             * View Request Method Type
             * View Request Schema
             */
            'VIEW' => [
                /*
                 * Accept Request Methods
                 * Set to `any` for All kind of Request Methods
                 */
                'METHODS' => ['get', 'post'],
                /*
                 * Accept Request Schema
                 * Set to `any` for All Schemas
                 */
                'SCHEME' => ['http', 'https'],
            ],
            /*
             * Ajax Request Method Type
             * Ajax Request From (Inbound, Outbound)
             * Ajax Request Schema
             */
            'AJAX' => [
                /*
                 * Request Method 
                 */
                'METHODS' => ['get', 'post'],
                /*
                 * Accept Request Schema
                 * Set to `any` for All Schemas
                 */
                'SCHEME' => ['http', 'https'],
                /*
                 * Request From
                 * Set to `any` to get request from any server
                 * [in, out], host
                 */
                'FROM' => 'any',
                /*
                 * List of Request From Hosts
                 * Add app host as well
                 */
                'FROM_HOSTS' => []
            ],
            /*
             * Dynamic Error Page
             * Files Path
             */
            'ERROR' => [
                403 => '',
                404 => '',
                405 => '',
                503 => ''
            ]
        ];

        /*
         * Private Keys of 
         * View & Ajax Controllers
         * [P = Primary, S = Secondary]
         */
        $this->KEYS = [
            'VIEW' => [
                'P' => '',
                'S' => ''
            ],
            'AJAX' => [
                'P' => '',
                'S' => '',
                /*
                 * Ajax Method Name in Query String
                 */
                'QUERY' => 'm',
            ],
        ];

        /*
         * Default HTML Tags & Attributes
         */
        $this->TAGS_ATTR = [
            'DOCTYPE' => '',
            'HTML' => ' lang="en"',
            'HEAD' => '',
            'BODY' => '',
        ];

        /*
         * Meta Tags and Details
         */
        $this->META = [
            'SEPARATE' => ' - ',
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
            'MEMORY_LIMIT' => '128M',
            /*
             * Cookie HTTP Only
             */
            'COOKIE_HTTP' => true,
        ];

        /*
         * Extra Global Array
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
            'INCLUDES' => '__VP/includes/',
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
    }

    /*
     * Get Maintain Mode
     * [Return Bool]
     */

    public function MAINTAIN() {
        return ($this->APP['MODE'] === 'maintain' || is_file(ROOT . '.maintain'));
    }

    /*
     * Checking Autoload Exists & Active
     */

    public function AUTOLOAD_ACTIVE($name) {
        if (in_array($name, $this->APP['ACTIVE_AUTOLOADS']) && is_file(ROOT . $this->PATH('AUTOLOADS') . $name)) {
            return $this->PATH('AUTOLOADS') . $name;
        }
        return false;
    }

    /*
     * Checking Plugin Exists & Active
     */

    public function PLUGIN_ACTIVE($name) {
        if (in_array($name, $this->APP['ACTIVE_PLUGINS']) && is_dir(ROOT . $this->PATH('PLUGINS'))) {
            return $this->PATH('PLUGINS') . $name . '/';
        }
        return false;
    }

    /*
     * Varphp Details
     */

    public function VARPHP($n) {
        $details = [
            'VERSION' => '4.0',
            'STATUS' => 'Stable'
        ];
        return (array_key_exists($n, $details)) ? $details[$n] : false;
    }

    /*
     * Setting up the Configuration
     * # DO NOT CALL THIS FUNCTION #
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

        ini_set('memory_limit', $this->OPT['MEMORY_LIMIT']);

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

        if ($this->OPT['COOKIE_HTTP'] === true) {
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
        }

        date_default_timezone_set($this->APP['TIMEZONE']);
    }

}
