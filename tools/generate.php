<?php

function var_export_short($expression, $return = false): ?string
{
    if (!is_array($expression)) {
        return var_export($expression, $return);
    }
    $export = var_export($expression, true);
    $export = preg_replace("/^([ ]*)(.*)/m", '$1$1$2', $export);
    $array = preg_split("/\r\n|\n|\r/", $export);
    $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [NULL, ']$1', ' => ['], $array);
    $export = implode(PHP_EOL, array_filter(["["] + $array));
    if ($return) {
        return $export;
    } else {
        echo $export;
        return '';
    }
}

$template_generate_date = date('j M Y, g:ia T');

$fn_source_types = __DIR__ . '/mime.types';
$fn_source_types_custom = __DIR__ . '/mime.types.custom';

if (!is_readable($fn_source_types)) {
    die('mime.types is not downloaded or not readable');
}
$mime_types_default_text = file($fn_source_types, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$mime_types_custom_text = [];
if (is_readable($fn_source_types_custom)) {
    $mime_types_custom_text = file($fn_source_types_custom, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$source_mimes = array_merge($mime_types_custom_text, $mime_types_default_text);

$defs = [];

foreach ($source_mimes as $line) {
    $line = trim(preg_replace('~\\#.*~', '', $line));

    if (!empty($line)) {
        preg_match_all('/^((\w|\/|\.|-|\+)+)(\s+)([^\n]*)$/im', $line, $match);

        $type = $match[1][0];
        $extensions = explode(' ', $match[4][0]);

        if (!array_key_exists($type, $defs)) {
            $defs[$type] = $extensions;
        }
    }
}

ksort($defs);

$mapping = [
    // ext -> mime
    'mimes'         =>  [],

    // mime -> ext
    'extensions'    =>  []
];

foreach ($defs as $mime => $exts) {
    foreach ($exts as $extension) {
        // $mapping['mimes'][$extension][] = $mime;
        // $mapping['mimes'][$extension] = array_unique($mapping['mimes'][$extension]);
        $mapping['mimes'][$extension] = $mime;

        // $mapping['extensions'][$mime][] = $extension;
        // $mapping['extensions'][$mime] = array_unique($mapping['extensions'][$mime]);
    }
    $mapping['extensions'][$mime] = $exts[0];
}

if (is_readable(__DIR__ . '/customize.json')) {
    $entries = json_decode(file_get_contents(__DIR__ . '/customize.json'), true);

    foreach ($entries as $extensions => $mime) {
        $extensions = explode(' ', $extensions);

        foreach ($extensions as $extension) {
            $mapping['mimes'][$extension] = $mime;
        }

        if (!array_key_exists($mime, $mapping['extensions'])) {
            $mapping['extensions'][$mime] = $extensions[0];
        }
    }
}
ksort($mapping['mimes']);
ksort($mapping['extensions']);

var_dump($mapping);

/**
 * Output
 */

$mimetypes_json = __DIR__ . '/mimetypes.json';
if (file_put_contents($mimetypes_json, json_encode($mapping, JSON_PRETTY_PRINT))) {
    echo print_r($mapping, true)
        . PHP_EOL
        . "\033[01;32mSuccessfully wrote {$mimetypes_json}\033[00m"
        . PHP_EOL;
} else {
    echo "Failed to write {$mimetypes_json}. Please ensure that this file system location is writable." . PHP_EOL;
}

/*
 * WRITE PHP CLASS
 */

$content = file_get_contents(__DIR__ . '/template.txt');
$content = str_replace('%%generate_datetime%%', $template_generate_date, $content);
// $content = str_replace('%%return_array_mime_types%%', "return " . var_export_short($mapping, true) . ";", $content);
$content = str_replace('%%array_mime_types%%', var_export_short($mapping, true), $content);

//$content = str_replace('%%array_mime_types%%', $text, $content); // преформатированный красивый вывод

/*file_put_contents(
    __DIR__ . '/../src/MimeTypes.php',
    $content
);*/
file_put_contents(__DIR__ . '/export.php', $content);

echo "\033[01;32mSuccessfully wrote " . __DIR__ . '/src/Mimetypes.php' . "\033[00m" . PHP_EOL;

// Done.
echo PHP_EOL;


