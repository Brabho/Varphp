<?php
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
                background: #eee;
                font-family: Helvetica;
            }
            .main{
                background: #fff;
                box-shadow: 0 0 25px #aaa;
                border: 1px solid #888;
                width: 40%;
                border-radius: 5px;
                margin: 10% auto;
                padding: 15px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h1>Page not found</h1> 
            <h1>OR</h1>
            <h1>Down for Maintain</h1>
        </div>
    </body>
</html>
<?php
die();
?>