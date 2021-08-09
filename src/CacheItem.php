<?php

namespace Clvarley\Cache;

use function time;

/**
 * Represents a single cache item
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
     * @param mixed $value Item value
     * @param int $expires Item lifetime
     */
    public function __construct( /* mixed */ $value, int $expires )
    {
        $this->value   = $value;
        $this->expires = ( $expires !== 0 ? time() + $expires : 0 );
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
