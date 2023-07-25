# What is it?  %%generate_datetime%%

PHP package for converting file extensions to MIME types and vice versa.

Uses the MIME content type for a file as determined by using information from the `magic.mime` file.

# Mimetypes

Creates a JSON document containing a thorough list of file extensions => mime types as provided by the
[Apache httpd project](http://httpd.apache.org).

## How to update?

### Step 1

Download the latest copy of the Apache `mime-types` file into the same directory as the `generate` script

```bash
make update
```

or 
```bash
wget --no-check-certificate https://svn.apache.org/repos/asf/httpd/httpd/branches/2.4.x/docs/conf/mime.types -O ./tools/mime.types
```

### Step 2 (optional)

Update the provided `customize.json` document with any additional mimetypes to define, or any that you would like to
override.

### Step 3

Run the `generate` script:

```bash
make build
```

In the end, a `mimetypes.json` document will be generated. This JSON document can be easily parsed into a
map/dictionary/associative array by pretty much every programming language with little effort.

It also generates a backing PHP class if you want to use the data in PHP-land.

### Step 4

```bash
make test
```

### Step 5 

Update repository (commit, push, pull request)

## Installation

### Install with Composer

If you're using [Composer](http://getcomposer.org) to manage dependencies, you can add the mimetypes with it.

```json
{
    "require": {
        "karelwintersky/arris.toolkit.mimetypes": ">=1.0"
    }
}
```
or
```
composer require karelwintersky/arris.toolkit.mimetypes
```

## Usage

And use it in your scripts:

```php

use Arris\Toolkit;
$ext = MimeTypes::getExtension('application/json');

// => .json

$type = MimeTypes::fromExtension('.json');

// 'application/json'
// or (use alias)

$type = MimeTypes::getMimeType('.json');
```

NB:

'fallback' function `mime_content_type()` return all same data. 

## License & Copyright

Original idea: 2010-2013 [Ryan Parman](http://ryanparman.com).

Refactored: 2023 [Karel Wintersky](https://github.com/KarelWintersky)

removed unnecessary Twig template engine and `dflydev/apache-mime-types` (repository load/mapper)

Licensed for use under the terms of the [MIT license](http://www.opensource.org/licenses/mit-license.php).

