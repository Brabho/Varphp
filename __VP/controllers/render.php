<?php

namespace VP\Controller;

use VP\Controller\urls;

if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Render Class
 * Rendering Output
 */

class render extends urls {

    public $HEADER;
    public $FOOTER;
    public $ADD_FUNC;
    public $META_DETAILS;

    function __construct() {
        parent::__construct();

        $this->HEADER = ROOT . $this->PATH('VP', 'includes') . 'header.php';
        $this->FOOTER = ROOT . $this->PATH('VP', 'includes') . 'footer.php';

        $this->ADD_FUNC = [
            'BEFORE_HEAD' => [],
            'IN_HEAD' => [],
            'IN_BODY' => [],
            'IN_FOOTER' => [],
            'AFTER_FOOTER' => [],
        ];

        $this->META_DETAILS = [];
        if ($this->HOME()) {

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
     */

    public function CALL_FUNCS($para) {
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
     */

    protected function RENDER() {

        $output_buffer = '';
        while (ob_get_contents()) {
            $output_buffer .= ob_get_contents();
            ob_end_clean();
        }

        /*
         * Finally Rendering
         */

        if (count($this->URL('PATHS')) > $this->SUB_PATHS) {
            $this->ERROR('e404');
        } else {

            if (file_exists($this->HEADER)) {
                require $this->HEADER;
            }

            echo $output_buffer;

            if (file_exists($this->FOOTER)) {
                require $this->FOOTER;
            }
        }

        /*
         * Cleaning all Variables
         */

        foreach (array_keys(get_defined_vars()) as $var) {
            if ($var === 'GLOBALS' || $var === '_POST' || $var === '_GET' || $var === '_COOKIE' ||
                    $var === '_FILES' || $var === '_REQUEST' || $var === '_SERVER' || $var === '_ENV') {

                continue;
            }
            $var = null;
            unset($var, $output_buffer);
        }
        clearstatcache();
    }

}
