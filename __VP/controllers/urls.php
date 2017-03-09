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

    public function URL($name = '', $ignore = true) {

        $full = $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($ignore === true) {
            $full = strtolower($full);
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
        $header = getallheaders();
        if (isset($header['HTTP_X_REQUESTED_WITH']) && $header['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $status = true;

            $this->AJAX_DETAILS = [];
            $this->AJAX_DETAILS['REQUESTED'] = 'HEADER';
        } elseif (isset($header['X-Requested-With']) && $header['X-Requested-With'] === 'XMLHttpRequest') {
            $status = true;

            $this->AJAX_DETAILS = [];
            $this->AJAX_DETAILS['REQUESTED'] = 'HEADER';
        } elseif ($this->URL('PATHS')[0] === 'ajax') {
            $status = true;

            $this->AJAX_DETAILS = [];
            $this->AJAX_DETAILS['REQUESTED'] = 'URL';
        }

        /*
         * Request From
         */

        if ($status === true && isset($this->AJAX_DETAILS, $_SERVER['HTTP_REFERER'])) {

            $this->AJAX_DETAILS['METHOD'] = $_SERVER['REQUEST_METHOD'];
            $this->AJAX_DETAILS['REFERER'] = $header['Referer'];

            $pattern = '@' . $_SERVER['HTTP_REFERER'] . '@';
            $subject = $this->URL('FULL');

            if (preg_match($pattern, $subject)) {
                $this->AJAX_DETAILS['FROM'] = 'IN';
            } elseif (!preg_match($pattern, $subject)) {
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

    function __destruct() {
        unset($this);
    }

}

?>