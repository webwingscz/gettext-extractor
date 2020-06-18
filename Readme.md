GettextExtractor
================
Cool tool for extracting gettext phrases from PHP files and templates.

Dependencies
------------
* [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser/)
* [contributte/console](https://github.com/contributte/console)
* [latte/latte](https://github.com/nette/latte)


Dependencies are installed with [composer](http://getcomposer.org/). You can use these commands:

`$ curl -s http://getcomposer.org/installer | php`  
`$ php composer.phar install`

To add GettextExtractor into your project, add to `composer.json`

```
"repositories": [
	{
	  "type": "vcs",
	  "url": "https://github.com/webwingscz/gettext-extractor"
	}
  ]
```

and run  `composer require --dev webwings/gettext/extractor`
	

Usage
-----
`php console.php [options]`

	Options:
	  -h            display this help and exit
	  

e.g.: `php console.php extract:pot -l outup/log.txt output.pot path/to/extract`

Supported file types
--------------------
* .php
* .latte (Nette Latte templates)

License
-------
GettextExtractor is licensed under the New BSD License.

Copyright
---------
* 2009 Karel Klima
* 2010 Ondřej Vodáček
* 2018 Jiří Dorazil
