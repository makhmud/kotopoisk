<?php


class ImageFormatTest extends TestCase {

    public function testGlobalConfig() {

        $this->assertInternalType( 'array',  Config::get('image') );

        $this->assertGreaterThan( 0, count(Config::get('image')) );



    }

    public function testFormatsConfig() {

        $this->assertInternalType( 'array',  Config::get('image.formats') );
        $this->assertNotEmpty( Config::get('image.formats') );

        $this->assertNotEmpty( Config::get('image.formats.big') );
        $this->assertEquals( 'big', Config::get('image.formats.big.name') );
        $this->assertNotEmpty( Config::get('image.formats.medium') );
        $this->assertEquals( 'medium', Config::get('image.formats.medium.name') );
        $this->assertNotEmpty( Config::get('image.formats.small') );
        $this->assertEquals( 'small', Config::get('image.formats.small.name') );

    }

    public function testDirectoriesConfig() {

        $this->assertInternalType( 'array',  Config::get('image.directories') );
        $this->assertNotEmpty( Config::get('image.directories') );

        $this->assertEquals( '/tmp/', Config::get('image.directories.temporary.path') );

    }

    public function testImageExtension() {

        $this->assertEquals( '/tmp/1.png', Image::path( '1.png', 'big', 'temporary') );
        $this->assertEquals( '/tmp/1.png', Image::temp( '1.png') );
        $this->assertEquals( '/home/geronimo/Work/kotopoisk/kotopoisk/public/user/blured-1.png', Image::path( '1.png', 'blured') );
        $this->assertEquals( '/home/geronimo/Work/kotopoisk/kotopoisk/public/user/1.png', Image::path( '1.png') );

    }

}
 