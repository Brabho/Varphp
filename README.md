![Alt text](_apps/default/icon1.png?raw=true "Varphp")
# Varphp

### Description
PHP MVC Pattern. 

It is a micro framework. 

No Library or Class/Functions Added. 
Use [HelperClass] (https://github.com/krishnaTORQUE/HelperClass)

Fast & LightWeight

### Tested
PHP    (5.5, 5.6)

Apache (2.2, 2.4)

### Version 
Stable Version 2.3

### License
(C) 2013 - 2016 
under GNU General Public License Version 2.

### Example
```php
# Set Configure #
# Create _config.php file in root directory

class _config extends configure {
    function __construct() {
        parent::__construct();
        $this->APP['NAME'] = 'My App';
    }
}
```