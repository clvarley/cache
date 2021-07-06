<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;
use Memcached;

/**
 * Memcached based cache adapter
 *
 * @package Cache
 * @author clvarley
 */
Class MemcachedCache Implements CacheInterface
{

    /**
     * Handle to memcached instance
     *
     * @var Memcached $memcached Memcached instance
     */
    protected $memcached;

    /**
     * Create a wrapper around the provided MemCached instance
     *
     * @param Memcached $memcached Memcached instance
     */
    public function __construct( Memcached $memcached )
    {
        $this->memcached = $memcached;
    }

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        $result = $this->memcached->get( $key );

        // Not found in cache
        if ( $result === false
            && $this->memcached->getResultCode() === Memcached::RES_NOTFOUND
        ) {
            return null;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 60 ) : void
    {
        $this->memcached->set( $key, $value, $lifetime );
    }
}
