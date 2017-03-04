<?php
if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

$this->CALL_FUNCS('BEFORE_HEAD');
/*
 * Default Header File
 */
echo $this->TAGS['DOCTYPE'] . PHP_EOL;
echo $this->TAGS['HTML'] . PHP_EOL;
echo $this->TAGS['HEAD'] . PHP_EOL;
?>
<meta charset="<?php echo $this->APP['CHARSET']; ?>"/>
<title><?php echo trim($this->META_DETAILS['TITLE']); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
<?php
echo (strlen($this->META_DETAILS['DESCRIPTION']) > 0) ? '<meta name="description" content="' . trim($this->META_DETAILS['DESCRIPTION']) . '"/>' . PHP_EOL : null;
echo (strlen($this->META_DETAILS['KEYWORDS']) > 0) ? '<meta name="keywords" content="' . trim($this->META_DETAILS['KEYWORDS']) . '"/>' . PHP_EOL : null;

$this->CALL_FUNCS('IN_HEAD');
?>
</head>
<?php
echo $this->TAGS['BODY'] . PHP_EOL;
$this->CALL_FUNCS('IN_BODY');
?>