#! /usr/bin/env php
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

$downloaded_mimes = file(__DIR__ . '/mime.types', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (empty($downloaded_mimes)) {
    die('mime.types is empty or not downloded');
}

$lines = [];

foreach ($downloaded_mimes as $line) {
    if (strpos($line, '#') !== 0) {
        preg_match_all('/^((\w|\/|\.|-|\+)+)(\s+)([^\n]*)$/im', $line, $match);
        $type = $match[1][0];
        $extensions = explode(' ', $match[4][0]);

        $lines[$type] = $extensions;
    }
}

$mimes = [];

foreach ($lines as $type => $extensions) {
    foreach ($extensions as $extension) {
        if (!isset($lines[$extension])) {
            $mimes[$extension] = $type;
        }
    }
}
$customize_json = __DIR__ . '/customize.json';

if (file_exists($customize_json)) {
    $entries = json_decode(file_get_contents($customize_json), true);

    foreach ($entries as $extensions => $type) {
        $extensions = explode(' ', $extensions);

        foreach ($extensions as $extension) {
            $mimes[$extension] = $type;
        }
    }
}

// WRITE JSON DOCUMENT
ksort($mimes);

$mimetypes_json = __DIR__ . '/mimetypes.json';

if (file_put_contents($mimetypes_json, json_encode($mimes, JSON_PRETTY_PRINT))) {
    echo print_r($mimes, true)
        . PHP_EOL
        . "\033[01;32mSuccessfully wrote {$mimetypes_json}\033[00m"
        . PHP_EOL;
} else {
    echo "Failed to write {$mimetypes_json}. Please ensure that this file system location is writable." . PHP_EOL;
}

/*$max_ext_length = 0;
foreach ($mimes as $ext => $type) {
    $max_ext_length = max($max_ext_length, strlen($ext));
}

$text = '';
$text .= "return [" . PHP_EOL;
foreach ($mimes as $ext => $type) {
    $text .= "            '{$ext}' ";
    // $text .= str_repeat(' ', $max_ext_length + 2 - strlen($ext));
    $text .= "=> '{$type}'," . PHP_EOL;
}
$text .= "        ];";*/

# WRITE PHP CLASS
$content = file_get_contents(__DIR__ . '/template.txt');
$content = str_replace('%%generate_datetime%%', $template_generate_date, $content);
$content = str_replace('%%return_array_mime_types%%', "return " . var_export_short($mimes, true) . ";", $content);
$content = str_replace('%%array_mime_types%%', var_export_short($mimes, true), $content);

//$content = str_replace('%%array_mime_types%%', $text, $content); // преформатированный красивый вывод

file_put_contents(
    __DIR__ . '/../src/MimeTypes.php',
    $content
);

echo "\033[01;32mSuccessfully wrote " . __DIR__ . '/src/Mimetypes.php' . "\033[00m" . PHP_EOL;

// Done.
echo PHP_EOL;

