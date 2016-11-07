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
                background: #f5f5f5;
                font-family: Tahoma, Helvetica, Arial, sans-serif;
            }
            .main{
                background: #fff;
                box-shadow: 0 0 25px #bbb;
                border: 1px solid #aaa;
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
            <h1>Page Not Found</h1> 
            <h1>or</h1>
            <h1>Down For Maintain</h1>
        </div>
    </body>
</html>
<?php
die();
?>