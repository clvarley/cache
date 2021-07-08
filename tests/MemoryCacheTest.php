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


    public function testValidString()
    {

    }

    public function testValidArray()
    {

    }

    public function testValidObject()
    {
        $item = new stdClass;
        $item->prop = "Test";

        $cache = new MemoryCache();
        $cache->set( "test", $item, 10 );

        $this->assertSame( $cache->get( "test" ), $item );
    }

}
