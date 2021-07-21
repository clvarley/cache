<?php

namespace Clvarley\Cache\Tests\Serialization;

use PHPUnit\Framework\TestCase;
use Clvarley\Cache\CacheItem;

use function time;

/**
 * @abstract
 * @group Serialization
 */
Abstract Class AbstractSerializerTest Extends TestCase
{

    /**
     * Time tests were started
     *
     * @var int $start_time Timestamp
     */
    protected static $start_time = 0;

    /**
     * Creates a new cache item with the given value
     *
     * @param mixed $value Cache value
     * @return CacheItem   Cache item
     */
    protected function createItem( /* mixed */ $value ) : CacheItem
    {
        static::$start_time = time();

        $item = new CacheItem( $value, 1 );

        return $item;
    }
}
