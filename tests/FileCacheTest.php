<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\Tests\Filesystem\AbstractFilesystemTest;
use Clvarley\Cache\FileCache;
use Clvarley\Cache\Serialization\PhpSerializer;
use Clvarley\Cache\Key\Md5Generator;
use Clvarley\Cache\Filesystem\Directory;
use stdClass;
use Closure;

use function sleep;

/**
 * @group Caches
 */
Class FileCacheTest Extends AbstractFilesystemTest
{

    /**
     * Test object for equality check
     *
     * @param stdClass $test_obj
     */
    private $test_obj;

    /**
     * Creates a new file cache with the given lifetime
     *
     * @param int $lifetime Cache lifetime
     * @return FileCache    Cache store
     */
    private function createCache( int $lifetime ) : FileCache
    {
        $this->test_obj = new stdClass;
        $this->test_obj->id = 123;
        $this->test_obj->prop = "test";

        $cache = FileCache::create( static::$test_directory );

        $cache->set( "testObj",    $this->test_obj, $lifetime );
        $cache->set( "testString", "123",           $lifetime );
        $cache->set( "testInt",    123,             $lifetime );
        $cache->set( "testArr",    [ 1, 2, 3 ],     $lifetime );

        return $cache;
    }

    /**
     * Make sure the constructor correctly sets properties
     */
    public function testConstructorSetsProperties()
    {
        $serializer = new PhpSerializer();
        $generator = new Md5Generator();

        // Use the constructor
        $cache = new FileCache( '/test/dir', $serializer, $generator );

        // Give the tests access to the private properties
        $tests = Closure::bind(
            function ( FileCache $cache ) use ( $serializer, $generator ) {
                $this->assertInstanceOf( Directory::class, $cache->directory );
                $this->assertEquals( $cache->directory->getPath(), '/test/dir' );
                $this->assertSame( $cache->serializer, $serializer );
                $this->assertSame( $cache->generator,  $generator );
            },
            $this,
            FileCache::class
        );
        $tests( $cache );
    }

    /**
     * Make sure the `::create` utility method works
     */
    public function testCanCreateUsingUtilityMethod()
    {
        $cache = FileCache::create( '/test/dir' );

        $this->assertInstanceOf( FileCache::class, $cache );

        // Give the tests access to the private properties
        $tests = Closure::bind(
            function ( FileCache $cache ) {
                $this->assertInstanceOf( Directory::class, $cache->directory );
                $this->assertEquals( $cache->directory->getPath(), '/test/dir' );
                $this->assertInstanceOf( PhpSerializer::class, $cache->serializer );
                $this->assertInstanceOf( Md5Generator::class, $cache->generator );
            },
            $this,
            FileCache::class
        );

        $tests( $cache );
    }

    /**
     * Make sure items can be read from the cache
     */
    public function testDoesReturnValidItems()
    {
        $lifetime = 1; // 1 second

        $cache = $this->createCache( $lifetime );

        // File cache will return like-for-like but NOT the the same ref
        $test_obj = $cache->get( "testObj" );

        $this->assertEquals( $test_obj->id,   $this->test_obj->id );
        $this->assertEquals( $test_obj->prop, $this->test_obj->prop );

        $this->assertEquals( $cache->get( "testString" ), "123" );
        $this->assertEquals( $cache->get( "testInt" ),    123 );
        $this->assertEquals( $cache->get( "testArr" ),    [ 1, 2, 3 ] );
    }

    /**
     * Make sure permanent cache items persist
     */
    public function testDoesReturnPermanentItems()
    {
        $lifetime = 0; // No expiry

        $cache = $this->createCache( $lifetime );

        // File cache will return like-for-like but NOT the the same ref
        $test_obj = $cache->get( "testObj" );

        $this->assertEquals( $test_obj->id,   $this->test_obj->id );
        $this->assertEquals( $test_obj->prop, $this->test_obj->prop );

        $this->assertEquals( $cache->get( "testString" ), "123" );
        $this->assertEquals( $cache->get( "testInt" ),    123 );
        $this->assertEquals( $cache->get( "testArr" ),    [ 1, 2, 3 ] );
    }

    /**
     * Make sure items in the cache expire
     */
    public function testDoesNotReturnExpiredItems()
    {
        $lifetime = 1; // 1 second

        $cache = $this->createCache( $lifetime );

        sleep( $lifetime ); // Force expiry

        $this->assertNull( $cache->get( "testObj" ) );
        $this->assertNull( $cache->get( "testString" ) );
        $this->assertNull( $cache->get( "testInt" ) );
        $this->assertNull( $cache->get( "testArr" ) );
    }
}
