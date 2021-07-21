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
     * @internal
     * @var int $start_time Timestamp
     */
    protected $start_time = 0;

    /**
     * Creates a new cache item with the given value
     *
     * @internal
     * @param mixed $value Cache value
     * @return CacheItem   Cache item
     */
    protected function createItem( /* mixed */ $value ) : CacheItem
    {
        $this->start_time = time();

        $item = new CacheItem( $value, 1 );
        return $item;
    }
}
