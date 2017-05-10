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

    function __construct() {
        parent::__construct();
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
        if ($dash) {
            if ($dash === 'dash') {
                $full = preg_replace('@_@i', '-', $full);
            } elseif ($dash === 'und') {
                $full = preg_replace('@-@i', '_', $full);
            }
        }
        $full = trim($full, " \/\t\n\r");
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
            'FULL' => $full . '/',
            'FPATH' => $fpath,
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

        $header = getallheaders();

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

            if (preg_match_all($pattern, $subject)) {
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
        } elseif (strlen($this->URL('FPATH')) < 1) {

            return true;
        } elseif (strlen($this->URL('PATHS')[0]) < 1) {

            return true;
        }
        return false;
    }

}