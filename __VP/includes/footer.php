<?php
if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}
/*
 * Default Footer File
 */

/*
 * Adding Static Strings to JS
 */
if ($this->IS_APP_STRINGS()) {
    echo '<script type="text/javascript" src="' . $this->URL('APP') . $this->PATH('INCLUDES') . 'app_strings.js?v=' . $this->VARPHP('VERSION') . '"></script>';
}

/*
 * Adding JavaScript Tags/Src
 */
foreach ($this->LOAD_TAGS['JS'] as $js_tags) {
    echo '<script type="text/javascript" src="' . $js_tags . '"></script>' . PHP_EOL;
}
unset($js_tags);

$this->CALL_FUNCS('IN_FOOTER');
?>

</body>
</html> <?php $this->CALL_FUNCS('AFTER_FOOTER'); ?>