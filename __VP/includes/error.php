<?php
/*
 * Default / Static Error Page
 */

while (ob_get_contents()) {
    ob_end_clean();
}

http_response_code(404);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Error</title>
        <meta name="description" content="Page not found or Down for Maintain"/>
        <style type="text/css">
            body{
                background: #fafafa;
                font-family: Tahoma, Helvetica, Arial, sans-serif;
            }
            .main{
                background: #fdfdfd;
                border: 5px dashed #aaa;
                width: 40%;
                border-radius: 5px;
                margin: 10% auto;
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