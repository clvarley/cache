<?php

namespace Cache\Serialization;

use Cache\SerializerInterface;
use Cache\CacheItem;
use Cache\Exception\DeserializationException;

use function serialize;
use function unserialize;

/**
 * Serializes cache items using normal PHP serialization
 *
 * @package Cache
 * @author clvarley
 */
Class PhpSerializer Implements SerializerInterface
{

    /**
     * Serialize the cache item
     *
     * @param CacheItem $item Cache item
     * @return string         Serialized item
     */
    public function serialize( CacheItem $item ) : string
    {
        return serialize( $item );
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
        // Can't use "allowed-classes" option
        $item = unserialize( $serialized );

        if ( !$item instanceof CacheItem ) {
            throw new DeserializationException;
        }

        return $item;
    }
}
