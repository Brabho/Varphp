<?php
if (!defined('MAIN')) {
    require $_SERVER['ROOT_PATH'] . $_SERVER['ERROR_PATH'];
}

/*
 * Minify Payload
 */

if ($this->APP['MIN_PAYLOAD'] === true && $this->APP['ENVT'] === 'publish') {

    function VARPHP_PAYLOAD_MINIFY($content) {
        $search = [
            '/\r\n|\r|\n|\t|<!--(.*?)-->/si',
            '/\>[^\S ]+|> |>  |>   |\s+>/si',
            '/[^\S ]+\<| <|  <|   <|<\s+/si',
            '/(\s)+/si',
        ];
        $replace = ['', '> ', ' <', '\\1'];
        $content = preg_replace($search, $replace, $content);
        return trim($content);
    }

    ob_start('VARPHP_PAYLOAD_MINIFY');
}

/*
 * Default Header File
 */
$this->CALL_FUNCS('BEFORE_HEAD');
?>
<!DOCTYPE html<?php echo $this->TAGS_ATTR['DOCTYPE']; ?>>
<html<?php echo $this->TAGS_ATTR['HTML']; ?>>
    <head<?php echo $this->TAGS_ATTR['HEAD']; ?>>
        <meta charset="<?php echo $this->APP['CHARSET']; ?>"/>
        <title><?php echo $this->TRIMS($this->META_DETAILS['TITLE']); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>

        <?php
        echo (strlen($this->META_DETAILS['DESCRIPTION']) > 0) ? '<meta name="description" content="' . $this->TRIMS($this->META_DETAILS['DESCRIPTION']) . '"/>' . PHP_EOL : null;
        echo (strlen($this->META_DETAILS['KEYWORDS']) > 0) ? '<meta name="keywords" content="' . $this->TRIMS($this->META_DETAILS['KEYWORDS']) . '"/>' . PHP_EOL . PHP_EOL : null;

        if (strlen($this->LOAD_TAGS['ICON']['URL']) > 1) {
            if (strlen($this->LOAD_TAGS['ICON']['TYPE']) > 1) {
                echo '<link rel="shortcut icon" type="' . $this->LOAD_TAGS['ICON']['TYPE'] . '" href="' . $this->LOAD_TAGS['ICON']['URL'] . '"/>' . PHP_EOL;
            } else {
                echo '<link rel="shortcut icon" href="' . $this->LOAD_TAGS['ICON']['URL'] . '"/>' . PHP_EOL;
            }
        }

        /*
         * Adding Stylesheet Tags/Href
         */
        foreach ($this->LOAD_TAGS['CSS'] as $css_tags) {
            echo '<link rel="stylesheet" type="text/css" href="' . $css_tags . '"/>' . PHP_EOL;
        }
        unset($css_tags);

        $this->CALL_FUNCS('IN_HEAD');
        ?>

    </head>
    <body<?php echo $this->TAGS_ATTR['BODY']; ?>>

        <?php $this->CALL_FUNCS('IN_BODY'); ?>