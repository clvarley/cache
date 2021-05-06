<?php

namespace Cache;

/**
 * Interface for all common cache functionality
 *
 * @package Cache
 * @author clvarley
 */
Interface CacheInterface
{

    /**
     * Retrieve an item from the cache
     *
     * @param string $key Item key
     * @return mixed|null Item value (or null)
     */
    public function get( string $key ) /* : mixed */;

    /**
     * Store an item in the cache
     *
     * If not provided, the `$lifetime` parameter should default to a default
     * value sensible for the cache method being used.
     *
     * @param string $key   Item key
     * @param mixed $value  Item value
     * @param int $lifetime (Optional) Item lifetime
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void;

}
