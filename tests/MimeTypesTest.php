<?php

use Arris\Toolkit\MimeTypes;
use PHPUnit\Framework\TestCase;

class MimeTypesTest extends TestCase {

    /**
     * @return void
     * @testdox get mimetype for unknown (undefined extension)
     */
    public function testGetMimeTypeUndefined()
    {
        $this->assertEquals('application/octet-stream', MimeTypes::fromExtension('undefined'));
    }

    /**
     * @return void
     * @testdox get extension for undefined mimetype
     */
    public function testGetExtensionUndefined()
    {
        $this->assertEquals('', MimeTypes::fromType('undefined'));
    }

    /**
     * @return void
     * @testdox get mimetype for valid extension (.json)
     */
    public function testGetMimeType()
    {
        $this->assertEquals('application/json', MimeTypes::fromExtension('json'));
    }

    /**
     * @return void
     * @testdox get Extension for valid mimetype 'application/json'
     */
    public function getGetExtension()
    {
        $this->assertEquals('json', MimeTypes::fromType('application/json'));
    }

    /**
     * @return void
     * @testdox get mimetype for valid extension (.jpg)
     */
    public function testGetMimeTypeJPEG()
    {
        $this->assertEquals('image/jpeg', MimeTypes::fromExtension('jpg'));
    }

    /**
     * @return void
     * @testdox get Extension for valid mimetype 'image/jpeg'
     */
    public function getGetExtensionJPEG()
    {
        $this->assertEquals('jpg', MimeTypes::fromType('image/jpeg'));
    }

    public function testGetTypeFromInvalidExtension()
    {
        $this->assertEquals(MimeTypes::UNKNOWN_MIME_TYPE, MimeTypes::fromExtension('foobar'));
    }

}