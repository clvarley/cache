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
    private $start_time = 0;

    /**
     * Creates a new cache item with the given value
     *
     * @param mixed $value Cache value
     * @return CacheItem   Cache item
     */
    private function createItem( /* mixed */ $value ) : CacheItem
    {
        $this->start_time = time();

        $item = new CacheItem( $value, 1 );
        return $item;
    }
}
