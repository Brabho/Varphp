<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

class urls extends conf {

    function __construct() {
        parent::__construct();
    }

    /*
     * Get Safe Filtered Parse Url Array
     */

    public function URL($name = '') {

        $full = $this->OPT['PROTOCOL'] . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $full = trim($full, " \/\s\t\n\r\0\x0B");
        $full = htmlspecialchars($full, ENT_QUOTES, 'UTF-8');

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

        unset($full, $fpath, $query);
        return (array_key_exists($name, $urls)) ? $urls[$name] : $urls;
    }

    /*
     * Home Page (Return Bool)
     */

    public function HOME() {

        if ($this->URL('APP') === $this->URL('FULL')) {
            return true;
        } elseif (strlen($this->URL('FPATH')) < 1 || strlen($this->URL('PATHS')[0]) < 1) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Check Ajax Request 
     */

    public function AJAX() {
        $header = getallheaders();
        if (isset($header['HTTP_X_REQUESTED_WITH']) && $header['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            return 'header';
        } elseif (isset($header['X-Requested-With']) && $header['X-Requested-With'] === 'XMLHttpRequest') {
            return 'header';
        } elseif ($this->URL('PATHS')[0] === 'ajax') {
            return 'url';
        }
        return false;
    }

    function __destruct() {
        unset($this);
    }

}

?>