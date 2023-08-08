<?php

namespace Arris\Toolkit;

interface MimeTypesInterface
{

    /**
     * Get all available mimetypes as array keys
     *
     * @return array
     */
    public static function getAllMimeTypes():array;

    /**
     * Get all available extensios (as array keys)
     *
     * @return array
     */
    public static function getAllExtensions():array;

    /**
     * Get EXTENSION from MIMETYPE string
     *
     * @param string $mime_type
     * @return string
     */
    public static function getExtension(string $mime_type):string;

    /**
     * Get MIMETYPE from EXTENSION (extension may contain dot)
     *
     * @param string $extension
     * @return string
     */
    public static function fromExtension(string $extension):string;

    /**
     * get MIMETYPE from filename with extension
     *
     * @param string $filename
     * @return string
     */
    public static function fromFilename(string $filename):string;


}