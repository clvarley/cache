<?php

namespace Clvarley\Cache;

use Clvarley\Cache\Exception\CacheReadException;
use Clvarley\Cache\Exception\CacheWriteException;

/**
 * Contract for all classes that can cache values
 *
 * @package Cache
 * @author clvarley
 */
Interface CacheInterface
{

    /**
     * Retrieve an item from the cache
     *
     * @throws CacheReadException
     * @param string $key Item key
     * @return mixed|null Item value (or null)
     */
    public function get( string $key ) /* : mixed */;

    /**
     * Store an item in the cache
     *
     * Cache lifetime in seconds. If not provided, the `$lifetime` parameter
     * should default to a value sensible for the implementation/cache method
     * being used.
     *
     * @throws CacheWriteException
     * @param string $key   Item key
     * @param mixed $value  Item value
     * @param int $lifetime (Optional) Item lifetime
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void;

}
