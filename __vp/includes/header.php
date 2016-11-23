<?php
if (!defined('ROOT')) {
    require_once $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

$this->CALL_FUNCS('BEFORE_HEAD');

/*
 * Default Header
 */

echo $this->TAGS['DOCTYPE'] . PHP_EOL;
echo $this->TAGS['HTML'] . PHP_EOL;
echo $this->TAGS['HEAD'] . PHP_EOL;
?>
<meta charset="utf-8"/>
<meta http-equiv="Content-Type" content="text/html"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>

<title><?php echo $this->META_DETAILS['TITLE']; ?></title>

<?php
echo (strlen($this->META_DETAILS['DESCRIPTION']) > 0) ? '<meta name="description" content="' . $this->META_DETAILS['DESCRIPTION'] . '"/>' . PHP_EOL : null;
echo (strlen($this->META_DETAILS['KEYWORDS']) > 0) ? '<meta name="keywords" content="' . $this->META_DETAILS['KEYWORDS'] . '"/>' . PHP_EOL : null;
echo (strlen($this->URL('FULL')) > 0) ? '<meta name="url" content="' . $this->URL('FULL') . '"/>' . PHP_EOL : null;
echo PHP_EOL;

$this->CALL_FUNCS('IN_HEAD');
?>

</head>
<?php
echo $this->TAGS['BODY'] . PHP_EOL;
$this->CALL_FUNCS('IN_BODY');
?>