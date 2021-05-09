<?php

namespace Clvarley\Cache\Serialization;

use Clvarley\Cache\SerializerInterface;
use Clvarley\Cache\CacheItem;
use Clvarley\Cache\Exception\DeserializationException;

use function igbinary_serialize;
use function igbinary_unserialize;

/**
 * Serializes cache items using the igbinary extension
 *
 * @package Cache
 * @author clvarley
 */
Class IgbinarySerializer Implements SerializerInterface
{

    /**
     * Serialize the cache item
     *
     * @param CacheItem $item Cache item
     * @return string         Serialized item
     */
    public function serialize( CacheItem $item ) : string
    {
        return igbinary_serialize( $item );
    }

    /**
     * Deserialize into a cache item
     *
     * @throws DeserializationException
     * @param string $serialized Serialized item
     * @return CacheItem         Cache item
     */
    public function deserialize( string $serialized ) : CacheItem
    {
        $item = igbinary_unserialize( $serialized );

        if ( !$item instanceof CacheItem ) {
            throw new DeserializationException;
        }

        return $item;
    }
}
