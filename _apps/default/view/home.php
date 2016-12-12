<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}
?>
<div class="main">

    <img src="<?php echo $this->URL('APP') . $this->PATH('ACTIVE_APP'); ?>icon1.png"/>

    <h2 style="text-align: center">Welcome to Varphp</h2>

    <h4>URL: <?php echo $this->URL('APP'); ?></h4>

    <h4>ROOT: <?php echo ROOT; ?></h4>

    <h4>PATH: <?php echo PATH; ?></h4>

    <div>Create <code style="font-weight: bold; font-size: 16px;">`_config.php`</code> 
        file and Class in root directory and set Configuration.
    </div>

    <br/>

    <div>Create <code style="font-weight: bold; font-size: 16px;">`_plugins`</code> 
        folder in root directory and paste your plugins.
    </div>

    <br/>

    <div>Create <code style="font-weight: bold; font-size: 16px;">`_autoload`</code> 
        folder in root directory and paste your autoload files.
    </div>

</div>