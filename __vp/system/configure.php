<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Main Configure Class File
 */

class configure {

    public $DB;
    public $APP;
    public $KEYS;
    public $TAGS;
    public $META;
    public $OPT;
    public $EXTRA;

    function __construct() {

        /*
         * Default or Main Database Login Details
         */
        $this->DB = [

            /*
             * Multi DataBase Login Details With Different Array Key
             */
            'MAIN' => [
                'HOST' => '127.0.0.1',
                'DB_NAME' => 'varphp_database',
                'USER' => 'root',
                'PASS' => ''
            ]
        ];

        /*
         * App Details
         */
        $this->APP = [

            /*
             * App Name
             */
            'NAME' => 'Varphp',
            /*
             * Local Time Zone
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
             * App Mode (run, maintain)
             */
            'MODE' => 'run',
            /*
             * App Environment (develop, publish)
             */
            'ENVT' => 'develop',
            /*
             * Ajax Request From & Request Type
             */
            'AJAX' => [

                /*
                 * Request Type (GET, POST, BOTH)
                 */
                'REQ' => 'BOTH',
                /*
                 * Request From (IN, OUT, BOTH)
                 */
                'FROM' => 'BOTH'
            ],
        ];

        /*
         * Keys of Ajax, View/Controller
         * Private Keys (P = Primary, S = Secondary)
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
                 * Query String Method Name 
                 */
                'QUERY' => 'm',
            ],
        ];

        /*
         * Default HTML Tags & Attributes
         */
        $this->TAGS = [
            'DOCTYPE' => '<!DOCTYPE html>',
            'HTML' => '<html xmlns="http://www.w3.org/1999/xhtml" itemscope itemtype="http://schema.org/QAPage">',
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
             * App Protocol (http:// or https://)
             * Auto Configure **
             */
            'PROTOCOL' => '',
            /*
             * Set Memory Limit
             */
            'MEMORY_LIMIT' => '16M',
        ];

        $this->EXTRA = [];
    }

    /*
     * Default Paths
     */

    public function PATH($name = null, $sub = null) {
        $allDirs = [
            'VP' => '__vp/',
            'SYS' => '__vp/system/',
            'APPS' => '_apps/',
            'ACTIVE_APP' => '_apps/' . $this->APP['ACTIVE'] . '/',
            'PLUGINS' => '_plugins/',
            'TMP' => '_temp/',
        ];

        $path = false;
        if (array_key_exists($name, $allDirs)) {

            if ($name === 'TMP' && !is_dir($allDirs['TMP'])) {
                mkdir($allDirs['TMP'], 0777, TRUE);
            }

            if (strlen($sub) > 0) {
                $path = $allDirs[$name] . $sub . '/';

                if ($name === 'TMP' && !is_dir($path)) {
                    mkdir($allDirs['TMP'] . $sub, 0777, TRUE);
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
     * Get Maintain Mode (Return Bool)
     */

    public function MAINTAIN() {
        return ($this->APP['MODE'] === 'maintain' || file_exists('.maintain')) ? true : false;
    }

    /*
     * Check Plugin Exists
     */

    public function PLUGIN_ACTIVE($name) {
        if (in_array($name, $this->APP['ACTIVE_PLUGINS']) && is_dir(ROOT . $this->PATH('PLUGINS'))) {
            return $this->PATH('PLUGINS') . $name . '/';
        } else {
            return false;
        }
        unset($name);
    }

    /*
     * Set Configuration 
     * Do not call this Method **
     */

    public function SETS() {

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
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
    }

    function __destruct() {
        unset($this);
    }

}

?>