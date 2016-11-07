<?php

if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Main Render Class
 */

class render extends urls {

    public $HEADER;
    public $FOOTER;
    public $ERROR;
    public $ADD_FUNC;
    public $META_DETAILS;

    function __construct() {
        parent::__construct();

        $this->HEADER = ROOT . '__vp/includes/header.php';
        $this->FOOTER = ROOT . '__vp/includes/footer.php';
        $this->ERROR = false;

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
     * Set Meta Data
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
        unset($para, $func);
    }

    /*
     * Final Render View or Error
     */

    protected function RENDER($err = null) {

        /*
         * Checking Before Render
         * 
         * If Error
         */
        if ($this->ERROR) {

            while (ob_get_contents()) {
                ob_end_clean();
            }

            if (isset($err)) {
                require_once $err;
            } else {
                $this->ERROR($this->ERROR);
            }

            $output_buffer = ob_get_contents();
            while (ob_get_contents()) {
                ob_end_clean();
            }
        } else {

            /*
             * If No Error
             */

            $output_buffer = ob_get_contents();
            while (ob_get_contents()) {
                ob_end_clean();
            }
        }

        /*
         * Final Rendering
         */

        if (file_exists($this->HEADER)) {
            require_once $this->HEADER;
        }

        echo $output_buffer;

        if (file_exists($this->FOOTER)) {
            require_once $this->FOOTER;
        }

        unset($output_buffer, $err);
    }

    function __destruct() {
        unset($this);
    }

}

?>