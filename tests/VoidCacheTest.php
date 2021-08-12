<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\VoidCache;
use PHPUnit\Framework\TestCase;

use function sleep;

/**
 * @group Caches
 */
Class VoidCacheTest Extends TestCase
{

    /**
     * Make sure valid cache items DON'T return
     */
    public function testDoesNotReturnValidItems()
    {
        $cache = new VoidCache();
        $cache->set( "valid", 123, 10 );

        $this->assertNull( $cache->get( "valid" ) );

        return $cache;
    }

    /**
     * Make sure permanent cache items DON'T return
     */
    public function testDoesNotReturnPermanentItems()
    {
        $cache = new VoidCache();
        $cache->set( "infinite", 123, 0 );

        $this->assertNull( $cache->get( "infinite" ) );
    }

    /**
     * Make sure expired cache items DON'T return
     */
    public function testDoesNotReturnExpiredItems()
    {
        $cache = new VoidCache();
        $cache->set( "expired", 123, 1 );

        sleep( 1 ); // Force expiry

        $this->assertNull( $cache->get( "expired" ) );
    }
}
