<?php

namespace Clvarley\Cache\Tests;

use PHPUnit\Framework\TestCase;
use ReflectionFunction;
use Closure;

use function dirname;
use function spl_autoload_functions;
use function spl_autoload_unregister;
use function spl_autoload_register;
use function class_exists;

/**
 * @group Caches
 */
Class AutoloadTest Extends TestCase
{

    /**
     * @var callable[] $autoloaders
     */
    private $autoloaders = [];

    /**
     * Load our custom autoloader and remove any existing ones
     */
    public function setUp() : void
    {
        $this->autoloaders = spl_autoload_functions();

        // Unload others to stop interference
        foreach ( $this->autoloaders as $autoloader ) {
            spl_autoload_unregister( $autoloader );
        }

        // Load ours!
        require_once dirname( __DIR__ ) . '/src/autoload.php';
    }

    /**
     * Restore any old autoloaders (i.e: composer)
     */
    public function tearDown() : void
    {
        // Pop our custom autoloader
        foreach ( spl_autoload_functions() as $autoloader ) {
            spl_autoload_unregister( $autoloader );
        }

        // Put the old ones back
        foreach ( $this->autoloaders as $autoloader ) {
            spl_autoload_register( $autoloader );
        }
    }

    /**
     * Make sure our autoloader is registered correctly
     */
    public function testAutoloaderIsRegistered()
    {
        $autoloaders = spl_autoload_functions();
        $autoloader = $autoloaders[0];

        // PhpUnit needs to load its classes now
        $this->tearDown();

        // Is it ours?
        $reflection = new ReflectionFunction( $autoloader );
        $this->assertEquals(
            $reflection->getFileName(),
            dirname( __DIR__ ) . "/src/autoload.php"
        );

        return $autoloader;
    }

    /**
     * Make sure our autoloader correctly loads class files
     *
     * @depends testAutoloaderIsRegistered
     */
    public function testAutoloaderLoadsClasses( Closure $autoloader )
    {
        // Try and load some files
        $autoloader( \Clvarley\Cache\CacheInterface::class );
        $autoloader( \Clvarley\Cache\FileCache::class );
        $autoloader( \Clvarley\Cache\KeyGeneratorInterface::class );
        $autoloader( \Clvarley\Cache\Key\Md5Generator::class );
        $autoloader( \Clvarley\Cache\SerializerInterface::class );
        $autoloader( \Clvarley\Cache\Serialization\PhpSerializer::class );

        // PhpUnit needs to load its classes now
        $this->tearDown();

        // Did it work?
        $this->assertTrue( class_exists( \Clvarley\Cache\FileCache::class, false) );
        $this->assertTrue( class_exists( \Clvarley\Cache\Key\Md5Generator::class, false) );
        $this->assertTrue( class_exists( \Clvarley\Cache\Serialization\PhpSerializer::class, false) );
    }
}
