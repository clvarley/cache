<?php

namespace Clvarley\Cache\Tests\Filesystem;

use PHPUnit\Framework\TestCase;

use function dirname;
use function mkdir;
use function rmdir;

/**
 * @abstract
 * @group Filesystem
 */
Abstract Class AbstractFilesystemTest Extends TestCase
{

    /**
     * Absolute path to the temp test directory
     *
     * @var string $test_directory
     */
    protected static $test_directory;

    /**
     * Performs setup required by both the Directory and File classes
     */
    public static function setUpBeforeClass()
    {
        static::$test_directory = dirname( __DIR__ ) . '/cache';
        mkdir( static::$test_directory, 0755 );
    }

    /**
     * Performs teardown after all tests have run
     */
    public static function tearDownAfterClass()
    {
        rmdir( static::$test_directory );
    }
}
