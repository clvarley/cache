<?php

namespace Clvarley\Cache\Tests\Filesystem;

use PHPUnit\Framework\TestCase;

use function dirname;
use function mkdir;
use function rmdir;

use const __DIR__;

/**
 * @abstract
 * @group Filesystem
 */
Abstract Class AbstractFilesystemTest Extends TestCase
{

    /**
     * @var string $test_directory
     */
    protected $test_directory;

    /**
     * Populate the path to the test directory
     */
    public function setUpBeforeClass()
    {
        $this->test_directory = dirname( __DIR__ ) . '/cache';
    }

    /**
     * Performs setup required by both the Directory and File classes
     */
    public function setUp()
    {
        mkdir( $this->test_directory, 0755 );
    }

    /**
     * Performs teardown
     */
    public function tearDown()
    {
        rmdir( $this->test_directory );
    }
}
