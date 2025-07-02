# What is it?

PHP package for converting file extensions to MIME types and vice versa.
Uses the MIME content type for a file as determined by using information from the `magic.mime` file.

PHP-пакет для преобразования расширений файлов в MIME-типы и наоборот.
Использует MIME-тип содержимого файла, определенный с помощью информации из файла magic.mime.

## Installation

```
composer require karelwintersky/arris.toolkit.mimetypes
```

## Usage

And use it in your scripts:

```php
use Arris\Toolkit;

echo "Get EXTENSION from MIME" . PHP_EOL;

var_dump(
    MimeTypes::getExtFromMime('application/json')
);;
var_dump(
    MimeTypes::fromType('application/json')
);
// => .json

echo "Get EXTENSION from FILE" . PHP_EOL;

var_dump(
    MimeTypes::getExtFromFile(__FILE__)
);
var_dump(
    Toolkit\MimeTypes::fromFile(__FILE__);
);
// => .php

echo "Get MIMETYPE from FILE" . PHP_EOL;

var_dump(
    MimeTypes::getMimeFromFile(__FILE__);
);
var_dump(
    MimeTypes::getType(__FILE__);
);


echo "GET MIMETYPE from EXTENSION" . PHP_EOL;

var_dump(
    MimeTypes::getMimeFromExt('json');
);
var_dump(
    MimeTypes::fromExtension('json')
);

```

## License & Copyright

Original idea: 2010-2013 [Ryan Parman](http://ryanparman.com).

Refactored: 2023-2025 [Karel Wintersky](https://github.com/KarelWintersky) - removed unnecessary Twig template engine 
and `dflydev/apache-mime-types` (repository load/mapper)

Licensed for use under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).

