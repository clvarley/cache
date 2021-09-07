<?php

namespace Clvarley\Cache\Tests\Filesystem;

use Clvarley\Cache\Tests\Filesystem\AbstractFilesystemTest;
use Clvarley\Cache\Filesystem\Directory;

use function is_dir;
use function dirname;

/**
 * @group Filesystem
 */
Class DirectoryTest Extends AbstractFilesystemTest
{

    /**
     * Make sure the `getPath` function returns expected value
     */
    public function testReturnsDirectoryPath()
    {
        $path = static::$test_directory . '/test/';

        $directory = new Directory( $path );

        // NOTE: `getPath` strips trailing slashes
        $this->assertEquals(
            $directory->getPath(),
            static::$test_directory . '/test'
        );

        return $directory;
    }

    /**
     * Make sure calls to `exists` return true if directory exists
     *
     * @depends testCanCreateChildDirectory
     */
    public function testCheckIfDirectoryExists( Directory $directory )
    {
        $path = $directory->getPath();

        $this->assertTrue( $directory->exists() );
        $this->assertTrue( is_dir( $path ) );

        return $directory;
    }

    /**
     * Make sure calls to `exists` return false if directory is non-existant
     *
     * @depends testReturnsDirectoryPath
     */
    public function testCheckIfDirectoryDoesNotExist( Directory $directory )
    {
        $path = $directory->getPath();

        $this->assertFalse( $directory->exists() );
        $this->assertFalse( is_dir( $path ) );

        return $directory;
    }

    /**
     * Make sure the current directory is created properly
     *
     * @depends testCheckIfDirectoryDoesNotExist
     */
    public function testCanCreateCurrentDirectory( Directory $directory )
    {
        $directory->create();

        $path = $directory->getPath();

        $this->assertDirectoryExists( $path );
        $this->assertDirectoryIsReadable( $path );
        $this->assertDirectoryIsWritable( $path );

        return $directory;
    }

    /**
     * Make sure named directories are created properly
     *
     * @depends testCanCreateCurrentDirectory
     */
    public function testCanCreateChildDirectory( Directory $directory )
    {
        // Move into sub folder
        $directory = $directory->create( 'example' );

        $path = $directory->getPath();

        $this->assertDirectoryExists( $path );
        $this->assertDirectoryIsReadable( $path );
        $this->assertDirectoryIsWritable( $path );

        return $directory;
    }

    /**
     * Make sure the current directory is deleted properly
     *
     * @depends testCanDeleteChildDirectory
     */
    public function testCanDeleteCurrentDirectory( Directory $directory )
    {
        $path = $directory->getPath();

        $directory->delete();

        $this->assertDirectoryDoesNotExist( $path );

        return $directory;
    }

    /**
     * Make sure the named directory is deleted properly
     *
     * @depends testCheckIfDirectoryExists
     */
    public function testCanDeleteChildDirectory( Directory $directory )
    {
        $path   = $directory->getPath();
        $parent = dirname( $path );

        // Move into parent folder
        $directory = new Directory( $parent );
        $directory->delete( 'example' );

        $this->assertDirectoryDoesNotExist( $path );

        return $directory;
    }

    /**
     * Make sure create returns null if the directory is invalid
     *
     * @depends testCanDeleteChildDirectory
     */
    public function testReturnsNullOnFailure( Directory $directory )
    {
        // Try and create directory with invalid name
        $this->assertNull( @$directory->create( "#" ) );

        return $directory;
    }
}
