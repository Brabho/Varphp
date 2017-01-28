![Alt text](_apps/default/icon1.png?raw=true "Varphp")
# Varphp

### Develop By [Club Coding] (http://clubcoding.com/)

### Description
PHP nano MVC Pattern. (Model View Controller)

No Library or Class/Functions Added.
Use [HelperClass] (https://github.com/krishnaTORQUE/HelperClass) Instead.

Fast, LightWeight & Powerful

### Tested
PHP     (5.5, 5.6, 7.0)

Apache  (2.2, 2.4)

### Note
    UTF-8 Charset Only

    Enable Rewrite Module On

### Version
Stable Version 2.9

### License
(C) 2013 - 2017
under GNU General Public License Version 2.

### Example
```php
# Set Configure #
# Create `_config.php` file in root directory.

class _config extends VP\System\configure {
    function __construct() {
        parent::__construct();
        $this->APP['NAME'] = 'My App';
    }
}

# Using Plugins #
# Create `_plugins` folder in root directory and paste your plugin(s).

# Using Autoloader #
# Create `_autoload` folder in root directory and paste your class file.
```