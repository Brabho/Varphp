![Varphp](default/ico1.png?raw=true "Varphp")
# Varphp



> **_Description_**

Only PHP MVC (Model View Controller) nothing else. Its not a framework. You can say it is a Kernel.

Host Multiple Apps, Lightweight, Powerful, Most Secure & Super Fast



> **_Build_**
- Version: **4.0**
- Status: **Stable**



> **_Tested_**
- PHP (5.5, 5.6, 7.0, 7.1, 7.2)
- Nginx (1.9, 1.10, 1.12, 1.14)
- Apache (2.2, 2.4)
- HHVM (3.20)



> **_Note_**

- Enable Rewrite Module On.

- Example Server Configure Files are in **_`server_config_samples`_** folder.

- No Library or Class or Functions Added. 
Use <a href="https://github.com/krishnaTORQUE/HelperClass" target="_blank">**HelperClass**</a> Instead.



> **_Setup_**

```php
# Create `_config.php` file in root directory.
class _config extends VP\System\Configure {
    function __construct() {
        parent::__construct();

        $this->APP['NAME'] = 'My App';
        $this->APP['ACTIVE'] = 'myapp';

		## Using Plugins ##
		# Create `__PLUGINS` folder in root directory and paste your plugins.
		$this->APP['ACTIVE_PLUGINS'] => ['plugin_dir'];

		## Using Autoloaders ##
		# Create `__AUTOLOADS` folder in root directory and paste your class files.
		$this->APP['ACTIVE_AUTOLOADS'] => ['file_name.php'];
    }
}
```



> **_Update_**

**_Always check `CHANGELOG` before update._**
1. Delete **`__VP`** folder and **`index.php`** file completely from host.
2. Download new version of Varphp and copy & paste `__VP` folder and `index.php` file.



> **_License (C) 2013 - 2018 under GNU GPL V2._**


