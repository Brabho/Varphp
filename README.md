![Varphp](_default/ico1.png?raw=true "Varphp")
# Varphp

### Description
PHP nano MVC Pattern. (Model View Controller)

Only MVC nothing else. Its not a framework.

No Library or Class/Functions Added.
Use [HelperClass] (https://github.com/krishnaTORQUE/HelperClass) Instead.

Fast, LightWeight & Powerful

### Tested
PHP     (5.5, 5.6, 7.0)

Apache  (2.2, 2.4)

### Note
Enable Rewrite Module On

### Version
Stable Version 3.0

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

## Using Autoloaders #
# Create `__AUTOLOADS` folder in root directory and paste your class file.
```