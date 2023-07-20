<?php

use Arris\Toolkit\MimeTypes;
use PHPUnit\Framework\TestCase;

class MimeTypesTest extends TestCase {

    public function testGetMimeTypeUndefined()
    {
        $this->assertEquals('', MimeTypes::getMimeType('undefined'));
    }

    public function testGetExtensionUndefined()
    {
        $this->assertEquals('', MimeTypes::getExtension('undefined'));
    }

    public function testVaidExtensions()
    {
        $this->assertEquals('json', MimeTypes::getExtension('application/json'));
        $this->assertEquals('application/json', MimeTypes::getMimeType('json'));
    }

}