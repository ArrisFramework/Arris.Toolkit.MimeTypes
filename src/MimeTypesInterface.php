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
     * Get all available extensions (as array keys)
     *
     * @return array
     */
    public static function getAllExtensions():array;

    /**
     * Возвращает расширение по mime-типу (строка):
     * MIME -> EXT
     *
     * @param string $mimetype
     * @return string
     */
    public static function fromType(string $mimetype):string;

    /**
     * Возвращает расширение файла из mime-типа (файл)
     * FILE -> MIME -> EXT
     *
     * @param string $path
     * @return string
     */
    public static function fromFile(string $path):string;

    /**
     * Получить mime-тип из расширения (строка)
     * EXT -> MIME
     *
     * @param string $extension
     * @return string
     */
    public static function fromExtension(string $extension):string;

    /**
     * Получить mime-тип из файла по пути
     * FILE -> MIME
     *
     * @param string $path
     * @return string
     */
    public static function getType(string $path):string;

    // Aliases

    /**
     * MIME -> EXT
     *
     * @param string $mimetype
     * @return string
     */
    public static function getExtFromMime(string $mimetype):string;

    /**
     * FILE -> MIME -> EXT
     * @param string $path
     * @return string
     */
    public static function getExtFromFile(string $path):string;

    /**
     * EXT -> MIME
     * @param string $extension
     * @return string
     */
    public static function getMimeFromExt(string $extension):string;

    /**
     * FILE -> MIME
     * @param string $path
     * @return string
     */
    public static function getMimeFromFile(string $path):string;


}