<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\CacheItem;
use PHPUnit\Framework\TestCase;

/**
 * @group Shared
 */
Class CacheItemTest Extends TestCase
{

    /**
     * Make sure the constructor correctly sets properties
     */
    public function testConstructor()
    {
        $cache_item = new CacheItem( "Test", 10 );

        $now = time() + 10;

        $this->assertSame( $cache_item->value, "Test" );
        $this->assertEqualsWithDelta( $cache_item->expires, $now, 1 );
    }

    /**
     * Make sure isValid returns true for live items
     */
    public function testValidItem()
    {
        $cache_item = new CacheItem( "Test", 1 );

        $this->assertTrue( $cache_item->isValid() );
    }

    /**
     * Make sure isValid returns false for expired items
     */
    public function testInvalidItem()
    {
        $cache_item = new CacheItem( "Test", 1 );

        sleep( 1 ); // Force expiry

        $this->assertFalse( $cache_item->isValid() );
    }

    /**
     * Make sure items with no expiry time are considered permanent
     */
    public function testEmptyExpiry()
    {
        $cache_item = new CacheItem( "Test", 0 );

        $this->assertSame( $cache_item->expires, 0 );

        return $cache_item;
    }

    /**
     * Make sure permanent cache items are considered valid
     *
     * @depends testEmptyExpiry
     */
    public function testPermanentLifetime( CacheItem $item )
    {
        $this->assertTrue( $item->isValid() );
    }
}
