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
    public function testDirectoryGetPath()
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
     * Make sure calls to `exists` return false if directory is non-existant
     *
     * @depends testDirectoryGetPath
     */
    public function testDirectoryDoesntExist( Directory $directory )
    {
        $path = $directory->getPath();

        $this->assertFalse( $directory->exists() );
        $this->assertFalse( is_dir( $path ) );

        return $directory;
    }

    /**
     * Make sure the current directory is created properly
     *
     * @depends testDirectoryDoesntExist
     */
    public function testCurrentDirectoryCreation( Directory $directory )
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
     * @depends testCurrentDirectoryCreation
     */
    public function testNamedDirectoryCreation( Directory $directory )
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
     * Make sure calls to `exists` return true if directory exists
     *
     * @depends testNamedDirectoryCreation
     */
    public function testDirectoryExists( Directory $directory )
    {
        $path = $directory->getPath();

        $this->assertTrue( $directory->exists() );
        $this->assertTrue( is_dir( $path ) );

        return $directory;
    }

    /**
     * Make sure the named directory is deleted properly
     *
     * @depends testDirectoryExists
     */
    public function testNamedDirectoryDeletion( Directory $directory )
    {
        $path   = $directory->getPath();
        $parent = dirname( $path );

        // Move into parent folder
        $directory = new Directory( $parent );
        $directory->delete( 'example' );

        $this->assertDirectoryNotExists( $path );

        // NOTE: Requires PHPUnit 9
        // $this->assertDirectoryDoesNotExist( $path );
        // $this->assertDirectoryIsNotReadable( $path );
        // $this->assertDirectoryIsNotWritable( $path );

        return $directory;
    }

    /**
     * Make sure the current directory is deleted properly
     *
     * @depends testNamedDirectoryDeletion
     */
    public function testCurrentDirectoryDeletion( Directory $directory )
    {
        $path = $directory->getPath();

        $directory->delete();

        $this->assertDirectoryNotExists( $path );

        // NOTE: Requires PHPUnit 9
        // $this->assertDirectoryDoesNotExist( $path );
        // $this->assertDirectoryIsNotReadable( $path );
        // $this->assertDirectoryIsNotWritable( $path );

        return $directory;
    }
}
