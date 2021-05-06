<?php

namespace Cache;

use Cache\SerializerInterface;
use Cache\CacheItem;

use function json_encode;
use function json_decode;

/**
 * Serializes cache items into JSON
 *
 * @package Cache
 * @author clvarley
 */
Class JsonSerializer Implements SerializerInterface
{

    /**
     * Serialize the cache item into JSON
     *
     * @param CacheItem $item Cache item
     * @return string         Serialized item
     */
    public function serialize( CacheItem $item ) : string
    {
        // TODO:

        return '';
    }

    /**
     * Deserialize JSON into a cache item
     *
     * @param string $serialized Serialized item
     * @return CacheItem         Cache item
     */
    public function deserialize( string $serialized ) : CacheItem
    {
        // TODO:

        return new CacheItem;
    }
}
