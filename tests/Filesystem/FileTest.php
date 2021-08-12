<?php

namespace Clvarley\Cache\Tests\Filesystem;

use Clvarley\Cache\Tests\Filesystem\AbstractFilesystemTest;
use Clvarley\Cache\Filesystem\File;

use function unlink;

/**
 * @group Filesystem
 */
Class FileTest Extends AbstractFilesystemTest
{

    static $content = 'Here is some example file content!';

    public static function tearDownAfterClass() : void
    {
        unlink( static::$test_directory . '/example.txt' );

        parent::tearDownAfterClass();
    }

    /**
     * Make sure calls to `exists` return true if the file exists
     *
     * @depends testCanWriteToFiles
     */
    public function testCheckIfFileExists( File $file )
    {
        $path = static::$test_directory . '/example.txt';

        $this->assertTrue( $file->exists() );
        $this->assertFileExists( $path );

        return $file;
    }

    /**
     * Make sure calls to `exists` return false if the file is non-existant
     */
    public function testCheckIfFileDoesNotExist()
    {
        $path = static::$test_directory . '/example.txt';

        $file = new File( $path );

        $this->assertFalse( $file->exists() );
        $this->assertFileDoesNotExist( $path );

        return $file;
    }

    /**
     * Make sure values can be written to files
     *
     * @depends testCheckIfFileDoesNotExist
     */
    public function testCanWriteToFiles( File $file )
    {
        $path = static::$test_directory . '/example.txt';

        $file->write( self::$content );

        $this->assertFileExists( $path );
        $this->assertFileIsReadable( $path );
        $this->assertFileIsWritable( $path );
        $this->assertStringEqualsFile( $path, self::$content );

        return $file;
    }

    /**
     * Make sure values can be read to files
     *
     * @depends testCheckIfFileExists
     */
    public function testCanReadFromFiles( File $file )
    {
        $content = $file->read();

        $this->assertEquals( $content, self::$content );
    }

    /**
     * Make sure trying to read non-existant files returns an empty string
     */
    public function testFailsGracefullyIfFileDoesNotExist()
    {
        $path = static::$test_directory . '/not-here.txt';

        $file = new File( $path );

        $this->assertEquals( $file->read(), '' );
    }
}
