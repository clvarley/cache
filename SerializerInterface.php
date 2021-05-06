<?php

namespace Cache;

use Cache\CacheItem;
use Cache\Exception\SerializationException;
use Cache\Exception\DeserializationException;

/**
 * Interface for all classes capable of serializing values
 *
 * @package Cache
 * @author clvarley
 */
Interface SerializerInterface
{

    /**
     * Serialize the cache item using the appropriate method
     *
     * @throws SerializationException
     * @param CacheItem $item Cache item
     * @return string         Serialized item
     */
    public function serialize( CacheItem $item ) : string;

    /**
     * Deserialize the string into a cache item using the appropriate method
     *
     * @throws DeserializationException
     * @param string $serialized Serialized item
     * @return CacheItem         Cache item
     */
    public function deserialize( string $serialized ) : CacheItem;

}
