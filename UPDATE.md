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

Update the provided `mime.types.custom`. This file is in the same format as `mime.types` but the mappings in this file take precedence.

Update the provided `customize.json` document with any additional mimetypes to define, or any that you would like to override.

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
