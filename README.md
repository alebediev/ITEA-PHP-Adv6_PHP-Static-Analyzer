PHP Static Analyzer
===============

TDB

Installation
------------

To install this CLI tool run following command:

```bash
$ composer require greeflas/php-static-analyzer
```

Usage
-----

`$ ./bin/console stat:class-author <src> <email>` - Shows quantity of classes/interfaces/traits created by some developer.

`$ ./bin/console stat:class-analyzer <full-class-name>` - Shows statistics information about analyzed class (class type, counts class methods and properties by visibility). Argument <full-class name> - full analyzed class name (include namespace).

License
-------

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2019, Vladimir Kuprienko
