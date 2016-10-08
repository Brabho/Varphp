<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
header('Status: 404 Not Found');

$this->META_DETAILS['TITLE'] = 'Error';
$this->META_DETAILS['DESCRIPTION'] = '';
$this->META_DETAILS['KEYWORDS'] = '';

?>

<div class="main">
    <h1>404 Error</h1>
    <h1>Page not found</h1>
</div>