<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\MemoryCache;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @group Caches
 */
Class MemoryCacheTest Extends TestCase
{

    /**
     * Make sure items can be read from the cache
     */
    public function testValidItems()
    {
        $cache = new MemoryCache();

        $test_obj = new stdClass;
        $test_obj->prop = "test";

        $cache->set( "testObj", $test_obj, 1 );
        $cache->set( "testString", "123", 1 );
        $cache->set( "testInt", 123, 1 );
        $cache->set( "testArr", [ 1, 2, 3 ], 1 );

        $this->assertSame(   $cache->get( "testObj" ),    $test_obj );
        $this->assertEquals( $cache->get( "testString" ), "123" );
        $this->assertEquals( $cache->get( "testInt" ),    123 );
        $this->assertEquals( $cache->get( "testArr" ),    [ 1, 2, 3 ] );
    }

    /**
     * Make sure items in the cache expire
     */
    public function testExpiredItems()
    {
        $cache = new MemoryCache();

        $test_obj = new stdClass;
        $test_obj->prop = "test";

        $cache->set( "testObj", $test_obj, 1 );
        $cache->set( "testString", "123", 1 );
        $cache->set( "testInt", 123, 1 );
        $cache->set( "testArr", [ 1, 2, 3 ], 1 );

        sleep( 1 ); // Force expiry

        $this->assertNull( $cache->get( "testObj" ) );
        $this->assertNull( $cache->get( "testString" ) );
        $this->assertNull( $cache->get( "testInt" ) );
        $this->assertNull( $cache->get( "testArr" ) );
    }

    /**
     * Make sure permanent cache items persist
     */
    public function testPermanentItems()
    {
        $cache = new MemoryCache();

        $test_obj = new stdClass;
        $test_obj->prop = "test";

        $cache->set( "testObj", $test_obj, 0 );
        $cache->set( "testString", "123", 0 );
        $cache->set( "testInt", 123, 0 );
        $cache->set( "testArr", [ 1, 2, 3 ], 0 );

        $this->assertSame(   $cache->get( "testObj" ),    $test_obj );
        $this->assertEquals( $cache->get( "testString" ), "123" );
        $this->assertEquals( $cache->get( "testInt" ),    123 );
        $this->assertEquals( $cache->get( "testArr" ),    [ 1, 2, 3 ] );
    }
}
