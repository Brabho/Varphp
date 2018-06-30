# Change Log & History

#### 30-06-2018
	Stable | 4.0
	Review All Files
	Minor Bugs Fixed

	Added:
		Support PHP 7.2
		MIN_PAYLOAD						"Minify Payload when app environment is `publish`"
		$APP_STRINGS 					"Static Strings. Access from PHP & JS. Allow JSON data only"
		LOAD_TAGS[]						"Quickly add FavIcon, CSS & JS Tags"
		REQUEST SCHEME					"VIEW & AJAX"
		AJAX HOST Filter				"Whitelist: Accept Outbound Hosts Request"
		VIEW & AJAX Request Separated 	"Separated Request, Method & Scheme"

	Improved:
		Stability
		Performance
		Error Handler
		Comments

	Changes:
		RENDER() 						"View or Error type & File path with response code"
		Apps::$V 						"Replace with Local Variable/App Variable"
											Explace:
												From > echo $this->APP['NAME']
												To   > echo Apps:$V->APP['NAME']

		App controller independent		"No Inherit"
		Use NameSpace					"Use NameSpace whenever using App Variable `use VP\Controller\Apps`"

		Major Changes in Core
		All config settings should be in small letter.
				Example:
				From > $this->APP['AJAX']['METHODS'] = ['GET', 'POST'];
				To   > $this->APP['AJAX']['METHODS'] = ['get', 'post'];

	Removed:
		Error Controller				"use RENDER instead"

#### 10-02-2018
    Stable | 3.8
    Bugs Fixed

    Improved:
		Stability
        Main Controller
        AJAX Controller
        Route or Routing

    Added:
        PAGE_ACCEPT_METHODS   	"In Page Request Method Filter"

#### 13-11-2017
    Stable | 3.7.4
    Bugs Fixed
    Stability Improved

#### 12-07-2017
    Stable | 3.7.2
    Stability Improved

#### 06-06-2017
    Stable | 3.7
    Nginx Supported
    HHVM Supported
    Security Improved

    Added:
        `ACCEPT_METHODS`

#### 26-05-2017
    Stable | 3.6
    Review All Files
    Stability Improved

    Added:
        APP_URL
        APP_PATH

#### 10-05-2017
    Stable | 3.5

    Improved:
        Stability
        Speed
        Performance
        hooks.php
        apps.php

#### 01-05-2017
    Stable | 3.4
    Stability Improved
    Tags Attribute Changes
    Ajax Controller Improved

#### 23-03-2017
    Stable | 3.3

    Added:
        Dynamic Method

    Improved:
        URI Routing
        App Routing
        AJAX Controller
        app.php
        render.php

#### 09-03-2017
    Stable | 3.1

    Improved:
        URI Controller

#### 04-03-2017
    Stable | 3.0

    Improved:
        Security
        Performances
        Speed
        Temp Directory

        .htaccess
        configure.php
        render.php

    Added:
        Details
        Charset

    Changed:
        `AUTOLOAD`            > `AUTOLOADS`

        [DIR]
        `_autoload`           > `__AUTOLOADS`
        `_plugins`            > `__PLUGINS`
        `_temp`               > `__TMP`

    Removed:
        URL attribute from header
        Apps Parent Directory
        Error Shortcut Controller

#### 12-02-2017
    Stable | 2.12
    Review All Files

    Improved:
        Security
        Maintain Mode
        Error Controller

    Bugs Fixed:
        conf.php

#### 08-02-2017
    Stable | 2.11
    Major Bugs Fixed

    Improved:
        Ajax Controller
        Ajax Method
        Performances
        render.php

#### 04-02-2017
    Stable | 2.10

    Improved:
        App Controller
        App Method
        Error Controller
        boot.php

#### 28-01-2017
    Stable | 2.9

    Improved:
        Autoload
        configure.php

#### 10-01-2017
    Stable | 2.8
    Review All Files

    Removed:
        Session Start
        ob_start();

#### 30-12-2016
    Stable | 2.7
    Dynamic Method Added
    Method Bug Fixed

#### 12-12-2016
    Stable | 2.6.4
    Stability Improved
    Review All Files

#### 28-11-2016
    Stable | 2.6
    Few Major Bugs Fixed

#### 23-11-2016
    Stable | 2.5
    Review All Files

    Added:
        Autoloader
        NameSpace
        Ajax Details

    Changed:
        `_vp` > `_VP`
        Ajax Key `REQ` > `METHOD`

    Bugs Fixed:
        Ajax Controller
        In Body Plug

#### 07-11-2016
    Stable | 2.3
    Few Minor Bugs Fixed

    Improved:
        `index.php` File Edited
        index Controller

#### 01-11-2016
    Stable | 2.2
    Stability Improved

#### 26-10-2016
	Stable | 2.1.1
	Stability improved

#### 08-10-2016
	Stable | 2.1
	Minor Bug Fixed
	Review All Files
	Dynamic Controller Added

#### 27-09-2016
	Beta | 2.0

#### 2013
	Founded
	First made
