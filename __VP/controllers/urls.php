<?php

namespace VP\Controller;

use VP\System\Conf;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * URLs/URIs Class
 */

class Urls extends Conf {

    function __construct() {
        parent::__construct();

        $this->SUB_PATHS = 2;
        $this->PAGE_ACCEPT_METHODS = ['get', 'post'];

        $this->APP_URL = $this->URL('APP') . $this->PATH('ACTIVE_APP');
        $this->APP_PATH = ROOT . $this->PATH('ACTIVE_APP');
    }

    /*
     * Filtered Parse URL/URI Array
     * (str) $name of array key 
     * (bool) $ignore case
     * $dash to convert _ > - or - > _
     * (bool) $reload to remove cache & call function again
     */

    public function URL($name = '', $ignore = true, $dash = false, $reload = false) {

        if (!isset($this->URI_ARR) || $reload) {

            $full = $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            if ($ignore) {
                $full = strtolower($full);
            }

            if ($dash === 'dash') {
                $full = preg_replace('@_@i', '-', $full);
            } elseif ($dash === 'und') {
                $full = preg_replace('@\-@i', '_', $full);
            }

            $full = $this->TRIMS($full, " \/\t\n\r\\", '');
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

            $this->URI_ARR = [
                'APP' => $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . PATH,
                'FULL' => $full,
                'FPATH' => '/' . $fpath,
                'FPATHQ' => '/' . $fpath . '?' . $query,
                'PATHS' => explode('/', $fpath),
                'QUERY' => $query,
                'QUERIES' => $QUERIES,
            ];
        }

        $this->HEADER_SERVER();

        return (array_key_exists($name, $this->URI_ARR)) ? $this->URI_ARR[$name] : false;
    }

    /*
     * Header & Server Array
     * (bool) $ignore case
     * (bool) $reload to remove cache & call function again
     */

    protected function HEADER_SERVER($ignore = true, $reload = false) {

        if (!isset($this->HEADER_SERVER) || $reload) {

            $this->HEADER_SERVER = [];
            $this->HEADER_SERVER['HEADER'] = $this->GET_HEADERS();
            $this->HEADER_SERVER['SERVER'] = $_SERVER;

            $this->HEADER_SERVER['METHOD'] = $_SERVER['REQUEST_METHOD'];
            if ($ignore) {
                $this->HEADER_SERVER['METHOD'] = strtolower($this->HEADER_SERVER['METHOD']);
            }

            $this->HEADER_SERVER['SCHEME'] = $_SERVER['REQUEST_SCHEME'];
            if ($ignore) {
                $this->HEADER_SERVER['SCHEME'] = strtolower($this->HEADER_SERVER['SCHEME']);
            }

            if (array_key_exists('Referer', $this->HEADER_SERVER['HEADER']) &&
                    strlen($this->HEADER_SERVER['HEADER']['Referer']) > 1) {

                $this->HEADER_SERVER['REFERER_LINK'] = $this->HEADER_SERVER['HEADER']['Referer'];
                if ($ignore) {
                    $this->HEADER_SERVER['REFERER_LINK'] = strtolower($this->HEADER_SERVER['REFERER_LINK']);
                }

                $this->HEADER_SERVER['PARSE_URL'] = parse_url($this->HEADER_SERVER['REFERER_LINK']);
                $this->HEADER_SERVER['REFERER_HOST'] = $this->HEADER_SERVER['PARSE_URL']['host'];
            }
        }
    }

    /*
     * Checking is Ajax Request
     */

    public function AJAX() {

        $status = false;
        $this->AJAX_DETAILS = [];

        /*
         * Requested By
         */

        if ($this->URL('PATHS')[0] === 'ajax') {

            $status = true;
            $this->AJAX_DETAILS['REQUESTED_BY'] = 'url';
        } elseif (in_array('HTTP_X_REQUESTED_WITH', $_SERVER) || in_array('X-Requested-With', $_SERVER)) {

            $status = true;
            $this->AJAX_DETAILS['REQUESTED_BY'] = 'header';
        }

        /*
         * Request From
         */

        if ($status && array_key_exists('REFERER_LINK', $this->HEADER_SERVER)) {

            $pattern = '@' . $this->HEADER_SERVER['REFERER_HOST'] . '@i';
            $subject = $this->URL('APP');

            if (preg_match($pattern, $subject)) {
                $this->AJAX_DETAILS['FROM'] = 'in';
            } else {
                $this->AJAX_DETAILS['FROM'] = 'out';
            }
        } else {
            $status = false;
        }

        $this->AJAX_DETAILS[0] = $status;
        return $status;
    }

    /*
     * Home Page
     * (Return Bool)
     */

    public function IS_HOME() {
        if ($this->URL('APP') === $this->URL('FULL')) {

            return true;
        } elseif ($this->URL('FPATH') === '/' || strlen($this->URL('FPATH')) < 2) {

            return true;
        } elseif (strlen($this->URL('PATHS')[0]) < 1) {

            return true;
        }
        return false;
    }

    protected function TRIMS($content, $delmi = null, $white = null) {
        $content = trim($content, $delmi);
        $content = ltrim($content, $delmi);
        $content = rtrim($content, $delmi);

        if (isset($white)) {
            $content = preg_replace('/\s+/', $white, $content);
        }
        return $content;
    }

    private function GET_HEADERS() {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) === 'HTTP_') {
                $headers[str_ireplace(' ', '-', ucwords(strtolower(str_ireplace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

}
