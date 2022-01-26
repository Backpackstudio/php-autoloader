# PHP Autoloader

PHP Autoloader provides an easy to use solution for loading classes automatically if they are not currently defined. The term "class" refers to classes, interfaces, traits, and other similar structures.

Loading classes automatically provides several benefits:

- Eliminates the need to write a list of required includes at the beginning of each script.
- Increases a performance as loads only this code which is actually needed at runtime. 

This package includes two different solutions to enable autoloading for your project.

## Autoloader specification

All class names MUST be referenced in a case-sensitive fashion.

The terminating class name corresponds to a file name ending in .php. The file name MUST match the case of the terminating class name.

A fully qualified class name has the following form:

```
 \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>
```

Autoloader follows PSR-4 standard. Mored details: [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/)

## bps-autoload.php

`bps-autoload.php` is  the best solution on case, when you need to register only one path as root of all your classes/structures. You have to put file `bps-autoload.php` into root directory of your classes and include it once somewhere in your code.

Lets imagine that your PHP web application is in folder `./my-app-root/` and your PHP classes are in subfolder `classes`. On such case you have to put script `bps-autoload.php` into directory `classes`, as shown below.

```
./my-app-root/
	index.php
	classes
		bps-autoload.php
		MyNameSpace
			MyClassA.php
			MyClassB.php
```

To enable autoloading you have to include `bps-autoload.php` and the rest is done automatically.

**Example:**

```php
<?php //index.php
require_once 'classes/bps-autoload.php';
\MyNameSpace\MyClassA::printRandomString();
```

## bps-autoloader.php

`bps-autoloader.php` comes with function `register_path_for_autoload` which provides better control at runtime, so you can define one or more folders as  root paths of your classes. 

### **Example**

```php
<?php //index.php
require_once 'bps-autoloader.php';
register_path_for_autoload(__DIR__ . '/classes');
register_path_for_autoload(__DIR__ . '/vendor');
\MyNameSpace\MyClassA::printRandomString();
\AnotherVendor\SubNameSpace\VendroClassX::printCurrentTime();
```

**Related file tree:**

```
./my-app-root/
	index.php
	bps-autoload.php
	classes
		MyNameSpace
			MyClassA.php
			MyClassB.php
	vendor
		AnotherVendor
			SubNameSpace
				VendroClassX.php
```



