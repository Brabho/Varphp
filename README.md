![Alt text](_apps/default/icon1.png?raw=true "Varphp")
# Varphp

### Description
PHP MVC Pattern. (Model View Controller)

It is a micro MVC framework.

No Library or Class/Functions Added. 
Use [HelperClass] (https://github.com/krishnaTORQUE/HelperClass) Instead.

Fast & LightWeight

### Tested
PHP    (5.5, 5.6)

Apache (2.2, 2.4)

### Version 
Stable Version 2.5

### License
(C) 2013 - 2016 
under GNU General Public License Version 2.

### Develop By [Club Coding] (http://clubcoding.com/)

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

# To use autoloader #
# Create `_autoload` folder in root directory and paste your class file.
```