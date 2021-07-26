<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\MemoryCache;
use PHPUnit\Framework\TestCase;
use stdClass;

use function sleep;

/**
 * @group Caches
 */
Class MemoryCacheTest Extends TestCase
{

    /**
     * Test object for equality check
     *
     * @param stdClass $test_obj
     */
    private $test_obj;

    /**
     * Creates a new memory cache with the given lifetime
     *
     * @param int $lifetime Cache lifetime
     * @return MemoryCache  Cache store
     */
    private function createCache( int $lifetime ) : MemoryCache
    {
        $this->test_obj = new stdClass;
        $this->test_obj->id = 123;
        $this->test_obj->prop = "test";

        $cache = new MemoryCache();
        $cache->set( "testObj",    $this->test_obj, $lifetime );
        $cache->set( "testString", "123",           $lifetime );
        $cache->set( "testInt",    123,             $lifetime );
        $cache->set( "testArr",    [ 1, 2, 3 ],     $lifetime );

        return $cache;
    }

    /**
     * Make sure items can be read from the cache
     */
    public function testDoesReturnValidItems()
    {
        $lifetime = 1; // 1 second

        $cache = $this->createCache( $lifetime );

        $this->assertSame(   $cache->get( "testObj" ),    $this->test_obj );
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

        $this->assertSame(   $cache->get( "testObj" ),    $this->test_obj );
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
