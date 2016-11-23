<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

while (ob_get_contents()) {
    ob_end_clean();
}

header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
header('Status: 404 Not Found');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Error</title>
        <style type="text/css">
            body{
                background: #fafafa;
                font-family: Tahoma, Helvetica, Arial, sans-serif;
            }
            .main{
                background: #fdfdfd;
                border: 2px dashed #aaa;
                width: 40%;
                border-radius: 5px;
                margin: 5% auto;
                padding: 15px;
                text-align: center;
                text-shadow: 1px 1px #fff;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>Page Not Found</h1> 
            <h1>or</h1>
            <h1>Down For Maintain</h1>
        </div>
    </body>
</html> <?php die(); ?>