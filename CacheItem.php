<?php

namespace Cache;

use function time;

/**
 * Represents a single item in the cache
 *
 * @package Cache
 * @author clvarley
 */
Final Class CacheItem
{

    /**
     * The actual value being cached
     *
     * @var mixed $value Item value
     */
    public $value;

    /**
     * Timestamp of when this item expires
     *
     * @var int $expires Expiry time
     */
    public $expires;

    /**
     * Creates a new cache item from the value supplied
     *
     * @param mixed $value  Item value
     * @param int $lifetime Item lifetime
     */
    public function __construct( /* mixed */ $value, int $lifetime )
    {
        $this->value   = $value;
        $this->expires = time() + $lifetime;
    }

    /**
     * Checks to see if this cache item has expired
     *
     * @return bool Item expired?
     */
    public function isValid() : bool
    {
        return ( $this->expires > time() );
    }
}
