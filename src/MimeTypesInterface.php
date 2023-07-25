<?php

namespace Arris\Toolkit;

interface MimeTypesInterface
{
    /**
     * Get all available mime types
     *
     * @return string[]
     */
    public static function getMimeTypes():array;

    /**
     * Get EXTENSION from MIMETYPE string
     *
     * @param string $mime_type
     * @return string
     */
    public static function getExtension(string $mime_type):string;

    /**
     * Get mimetype from extension (extension may contain dot)
     *
     * @param string $extension
     * @return string
     */
    public static function fromExtension(string $extension):string;

    /**
     * Alias of fromExtension()
     *
     * @param string $extension
     * @return string
     */
    public static function getMimeType(string $extension):string;

    /**
     * Get mimetype from filename with extension
     *
     * @param string $filename
     * @return string
     */
    public static function fromFilename(string $filename):string;






}