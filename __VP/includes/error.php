<?php
/*
 * Default Static Error Page
 * Change or Set Default Static Error Page From Server Config File
 */

while (ob_get_contents()) {
    ob_end_clean();
}

http_response_code(404);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Error - Not found or Down</title>
        <meta name="description" content="Page not found or Down for Maintain"/>
        <style type="text/css">
            body{
                background: #fbfbfb;
                font-family: Tahoma, Helvetica, Arial, sans-serif;
            }
            .main{
                border: 5px dashed #aaa;
                width: 40%;
                border-radius: 5px;
                margin: 5% auto;
                padding: 15px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>
                Page Not Found <br/>
                or <br/>
                Down For Maintain
            </h1>
        </div>
    </body>
</html> <?php die(); ?>