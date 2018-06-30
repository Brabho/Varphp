<?php

namespace VP\Controller;

use VP\Controller\Urls;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Render Class Controller
 * Rendering Payload or Error
 */

class Render extends Urls {

    function __construct() {
        parent::__construct();

        /*
         * Adding Static Strings to PHP
         */
        if ($this->IS_APP_STRINGS()) {
            $json_strings = file_get_contents($this->APP_PATH . $this->APP['STRINGS']);
            $this->APP_STRINGS = json_decode($this->TRIMS($json_strings), true);
            unset($json_strings);
        }

        $this->HEADER = ROOT . $this->PATH('INCLUDES') . 'header.php';
        $this->FOOTER = ROOT . $this->PATH('INCLUDES') . 'footer.php';

        $this->LOAD_TAGS = [
            'ICON' => [
                'URL' => '',
                'TYPE' => ''
            ],
            'CSS' => [],
            'JS' => []
        ];

        $this->ADD_FUNC = [
            'BEFORE_HEAD' => [],
            'IN_HEAD' => [],
            'IN_BODY' => [],
            'IN_FOOTER' => [],
            'AFTER_FOOTER' => [],
        ];

        $this->META_DETAILS = [];
        if ($this->IS_HOME()) {

            $this->META_DETAILS['TITLE'] = $this->APP['NAME'];
            $this->META_DETAILS['DESCRIPTION'] = $this->META['DESCRIPTION'];
            $this->META_DETAILS['KEYWORDS'] = $this->META['KEYWORDS'];
        } else {

            $this->META_DETAILS['TITLE'] = ucwords($this->URL('PATHS')[0]) . $this->META['SEPARATE'] . $this->APP['NAME'];
            $this->META_DETAILS['DESCRIPTION'] = $this->META['DESCRIPTION'] . $this->META['STICK']['DESCRIPTION'];
            $this->META_DETAILS['KEYWORDS'] = $this->META['KEYWORDS'] . $this->META['STICK']['KEYWORDS'];
        }
    }

    /*
     * Set Meta Datas
     */

    public function META_SET($arr = []) {
        if (array_key_exists('TITLE', $arr)) {
            $this->META_DETAILS['TITLE'] = $arr['TITLE'] . $this->META['SEPARATE'] . $this->APP['NAME'];
        }
        if (array_key_exists('DESCRIPTION', $arr)) {
            $this->META_DETAILS['DESCRIPTION'] = $arr['DESCRIPTION'] . $this->META['STICK']['DESCRIPTION'];
        }
        if (array_key_exists('KEYWORDS', $arr)) {
            $this->META_DETAILS['KEYWORDS'] = $arr['KEYWORDS'] . $this->META['STICK']['KEYWORDS'];
        }
    }

    /*
     * Calling Added Function
     * # DO NOT CALL THIS FUNCTION #
     */

    protected function CALL_FUNCS($para) {
        if (array_key_exists($para, $this->ADD_FUNC)) {
            foreach ($this->ADD_FUNC[$para] as $func) {
                if (function_exists($func)) {
                    $func($this);
                } else {
                    echo $func;
                }
            }
        }
    }

    /*
     * Final Rendering
     * (int) $arr['code'] = Response Code
     * (str) $arr['file'] = path/to/file
     * (str) $arr['type'] = error / view
     * (str) $arr['TITLE']
     * (str) $arr['DESCRIPTION']
     * (str) $arr['KEYWORDS']
     */

    public function RENDER($arr = []) {

        if (!isset($arr['code'])) {
            $arr['code'] = 200;
        }
        if (!isset($arr['file']) && $arr['type'] === 'error') {
            $arr['code'] = 404;
            $arr['file'] = ROOT . $this->APP['ERROR'][$arr['code']];
        }

        if (isset($arr['TITLE'])) {
            $this->META_SET([
                'TITLE' => $arr['TITLE']
            ]);
        }

        if (isset($arr['DESCRIPTION'])) {
            $this->META_SET([
                'DESCRIPTION' => $arr['DESCRIPTION']
            ]);
        }

        if (isset($arr['KEYWORDS'])) {
            $this->META_SET([
                'KEYWORDS' => $arr['KEYWORDS']
            ]);
        }

        if (count($this->URL('PATHS')) > $this->SUB_PATHS ||
                preg_match('@\.php@i', $this->URL('FPATH'))) {

            $arr['code'] = 404;
            $arr['file'] = ROOT . $this->APP['ERROR'][$arr['code']];
        } elseif (!in_array(strtolower($_SERVER['REQUEST_METHOD']), $this->PAGE_ACCEPT_METHODS)) {

            $arr['code'] = 405;
            $arr['file'] = ROOT . $this->APP['ERROR'][$arr['code']];
        }

        http_response_code($arr['code']);

        /*
         * Finally Rendering Payload
         */
        if (is_array($arr['file'])) {

            if (is_file($this->HEADER)) {
                require $this->HEADER;
            }

            foreach ($arr['file'] as $file) {
                if (is_file($file)) {
                    require $file;
                }
            }

            if (is_file($this->FOOTER)) {
                require $this->FOOTER;
            }
        } elseif (is_file($arr['file'])) {

            if (is_file($this->HEADER)) {
                require $this->HEADER;
            }

            require $arr['file'];

            if (is_file($this->FOOTER)) {
                require $this->FOOTER;
            }
        } else {
            require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
        }

        die();
    }

}
