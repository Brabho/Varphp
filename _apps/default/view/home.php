<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}
?>
<div class="main">

    <h2 style="text-align: center">Welcome to Varphp ($P)</h2>

    <h4>URL: <?php echo $this->URL('APP'); ?></h4>

    <h4>ROOT: <?php echo ROOT; ?></h4>

    <h4>PATH: <?php echo PATH; ?></h4>

    <div>Create <code style="font-weight: bold; font-size: 16px;">`_config.php`</code> 
        file and Class in root directory and set Configuration.
    </div>

</div>