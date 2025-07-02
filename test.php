<?php

require __DIR__ . '/vendor/autoload.php';

use Arris\Toolkit\MimeTypes;

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
    MimeTypes::fromFile(__FILE__)
);
// => .php

echo "Get MIMETYPE from FILE" . PHP_EOL;

var_dump(
    MimeTypes::getMimeFromFile(__FILE__)
);
var_dump(
    MimeTypes::getType(__FILE__)
);


echo "GET MIMETYPE from EXTENSION" . PHP_EOL;

var_dump(
    MimeTypes::getMimeFromExt('json')
);
var_dump(
    MimeTypes::fromExtension('json')
);