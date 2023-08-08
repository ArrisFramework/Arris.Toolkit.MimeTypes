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
        $this->assertEquals('', MimeTypes::fromExtension('undefined'));
    }

    /**
     * @return void
     * @testdox get extension for undefined mimetype
     */
    public function testGetExtensionUndefined()
    {
        $this->assertEquals('', MimeTypes::getExtension('undefined'));
    }

    /**
     * @return void
     * @testdox get mimetype for valid extension (.json)
     */
    public function testGetMimeType()
    {
        $this->assertEquals('application/json', MimeTypes::fromExtension('.json'));
    }

    /**
     * @return void
     * @testdox get Extension for valid mimetype 'application/json'
     */
    public function getGetExtension()
    {
        $this->assertEquals('json', MimeTypes::getExtension('application/json'));
    }

    /**
     * @return void
     * @testdox get mimetype for valid extension (.jpg)
     */
    public function testGetMimeTypeJPEG()
    {
        $this->assertEquals('image/jpeg', MimeTypes::fromExtension('.jpg'));
    }

    /**
     * @return void
     * @testdox get Extension for valid mimetype 'image/jpeg'
     */
    public function getGetExtensionJPEG()
    {
        $this->assertEquals('jpg', MimeTypes::getExtension('image/jpeg'));
    }

}