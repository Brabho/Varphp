![Varphp](_default/ico1.png?raw=true "Varphp")
# Varphp

### Description
PHP mini MVC Pattern. (Model View Controller)

Only MVC nothing else. Its not a framework.

No Library or Class / Functions Added. Use `HelperClass` Instead.

HelperClass >> https://github.com/krishnaTORQUE/HelperClass

Host Multiple Apps, Fast, Lightweight, Powerful & Secure

### Tested
PHP (5.5, 5.6, 7.0, 7.1)

Nginx (1.9, 1.10, 1.12)

Apache (2.2, 2.4)

HHVM (3.20.0)

### Note
Enable Rewrite Module On

### Version
Stable Version 3.7.2

### License
(C) 2013 - 2017 under GNU General Public License Version 2.

### Example
```php
## Set Configuration #
# Create `_config.php` file in root directory.

class _config extends VP\System\configure {
    function __construct() {
        parent::__construct();
        $this->APP['NAME'] = 'My App';
        $this->APP['ACTIVE'] = 'myapp';
    }
}

## Using Plugins #
# Create `__PLUGINS` folder in root directory and paste your plugin(s).
$this->APP['ACTIVE_PLUGINS'] => ['plugin_dir'];

## Using Autoloaders #
# Create `__AUTOLOADS` folder in root directory and paste your class file.
$this->APP['ACTIVE_AUTOLOADS'] => ['file_name.php'];
```