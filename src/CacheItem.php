<?php

namespace Clvarley\Cache;

use function time;

/**
 * Represents a single item in the cache
 *
 * @template T
 * @package Cache
 * @author clvarley
 */
Final Class CacheItem
{

    /**
     * The actual value being cached
     *
     * @psalm-var T $value
     *
     * @var mixed $value Item value
     */
    public $value;

    /**
     * Timestamp of when this item expires
     *
     * If the timestamp is 0, this item should never expire.
     *
     * @var int $expires Expiry time
     */
    public $expires;

    /**
     * Creates a new cache item from the value supplied
     *
     * @psalm-param T $value
     *
     * @param mixed $value  Item value
     * @param int $lifetime Item lifetime
     */
    public function __construct( /* mixed */ $value, int $lifetime )
    {
        $this->value   = $value;
        $this->expires = ( $lifetime !== 0 ? time() + $lifetime : 0 );
    }

    /**
     * Checks to see if this cache item has expired
     *
     * @return bool Item expired?
     */
    public function isValid() : bool
    {
        return ( $this->expires === 0 || $this->expires > time() );
    }
}
