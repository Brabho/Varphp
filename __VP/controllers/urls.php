<?php

namespace VP\Controller;

use VP\System\conf;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * URLs/URIs Class
 */

class urls extends conf {

    public $AJAX_DETAILS;
    public $SUB_PATHS;
    public $PAGE_ACCEPT_METHODS;
    public $APP_URL;
    public $APP_PATH;

    function __construct() {
        parent::__construct();

        $this->SUB_PATHS = 2;
        $this->PAGE_ACCEPT_METHODS = ['GET', 'POST'];

        $this->APP_URL = $this->URL('APP') . $this->PATH('ACTIVE_APP');
        $this->APP_PATH = ROOT . $this->PATH('ACTIVE_APP');
    }

    /*
     * Filtered Parse URL/URI Array
     * Ignore Case 
     */

    public function URL($name = '', $ignore = true, $dash = false) {

        $full = $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($ignore === true) {
            $full = strtolower($full);
        }

        if ($dash === 'dash') {
            $full = preg_replace('@_@i', '-', $full);
        } elseif ($dash === 'und') {
            $full = preg_replace('@\-@i', '_', $full);
        }

        $full = $this->trims($full, " \/\t\n\r\\", true);
        $full = htmlspecialchars($full, ENT_QUOTES, $this->APP['CHARSET']);

        $fpath = parse_url($full, PHP_URL_PATH);
        $fpath = substr($fpath, strlen(PATH));

        $query = parse_url($full, PHP_URL_QUERY);
        $qstre = explode('&amp;', $query);
        $QUERIES = [];

        for ($i = 0; $i < count($qstre); $i++) {
            $qstre_e = explode('=', $qstre[$i]);
            if (isset($qstre_e[0], $qstre_e[1])) {
                $QUERIES[$qstre_e[0]] = $qstre_e[1];
            }
        }

        $urls = [
            'APP' => $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . PATH,
            'FULL' => $full,
            'FPATH' => '/' . $fpath,
            'PATHS' => explode('/', $fpath),
            'QUERY' => $query,
            'QUERIES' => $QUERIES,
        ];

        unset($ignore, $full, $fpath, $query, $qstre, $QUERIES, $i);
        return (array_key_exists($name, $urls)) ? $urls[$name] : false;
    }

    /*
     * Checking Ajax Request
     */

    public function AJAX() {

        $status = false;

        $this->AJAX_DETAILS = [];
        $this->AJAX_DETAILS['REQUEST_TO'] = $this->URL('FULL');

        $header = $this->get_headers();

        /*
         * Requested By
         */

        if ($this->URL('PATHS')[0] === 'ajax') {

            $status = true;
            $this->AJAX_DETAILS['REQUESTED'] = 'URL';
        } elseif (isset($header['HTTP_X_REQUESTED_WITH']) || isset($header['X-Requested-With'])) {

            $status = true;
            $this->AJAX_DETAILS['REQUESTED'] = 'HEADER';
        }

        /*
         * Request From
         */

        if ($status === true && isset($header['Referer'])) {

            $this->AJAX_DETAILS['METHOD'] = $_SERVER['REQUEST_METHOD'];
            $this->AJAX_DETAILS['REFERER'] = $header['Referer'];

            $pattern = '@' . $this->URL('APP') . '@i';
            $subject = $_SERVER['HTTP_REFERER'];

            if (preg_match($pattern, $subject)) {
                $this->AJAX_DETAILS['FROM'] = 'IN';
            } else {
                $this->AJAX_DETAILS['FROM'] = 'OUT';
            }
        }

        unset($header);
        return $status;
    }

    /*
     * Home Page
     * [Return Bool]
     */

    public function HOME() {
        if ($this->URL('APP') === $this->URL('FULL')) {

            return true;
        } elseif ($this->URL('FPATH') === '/' || strlen($this->URL('FPATH')) < 2) {

            return true;
        } elseif (strlen($this->URL('PATHS')[0]) < 1) {

            return true;
        }
        return false;
    }

    private function get_headers() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) === 'HTTP_') {
                $headers[str_ireplace(' ', '-', ucwords(strtolower(str_ireplace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    private function trims($content, $delmi = null, $white = null) {
        $content = trim($content, $delmi);
        $content = ltrim($content, $delmi);
        $content = rtrim($content, $delmi);

        if (isset($white)) {
            $content = preg_replace('/\s+/', $white, $content);
        }
        return $content;
    }

}
