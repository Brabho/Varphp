<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Default Footer File
 */

$this->CALL_FUNCS('IN_FOOTER');
?>

</body>
</html> <?php $this->CALL_FUNCS('AFTER_FOOTER'); ?>