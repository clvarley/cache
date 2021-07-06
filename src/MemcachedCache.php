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
     * Creates a new MemcachedCache with sensible defaults
     *
     * Starts a new memcached session and connects to the provided server. The
     * method signature mirrors that of {@see \Memcached::addServer}, more
     * information about which can be found here:
     *
     * https://www.php.net/manual/en/memcached.addserver.php
     *
     * @static
     * @param string $host    Server hostname
     * @param int $port       Memcached port
     * @param int $weight     (Optional) Server weighting
     * @return MemcachedCache Memcached adapter
     */
    public static function create(
        string $host,
        int $port,
        int $weight = 0
    ) : MemcachedCache {
        $memcached = new Memcached();
        $memcached->setOption( Memcached::OPT_LIBKETAMA_COMPATIBLE, true );
        $memcached->addServer( $host, $port, $weight );

        return new self( $memcached );
    }

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        /** @var mixed|false $result */
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

    /**
     * Adds a new server to the server pool
     *
     * @param string $host    Server hostname
     * @param int $port       Memcached port
     * @param int $weight     (Optional) Server weighting
     * @return self           Fluent interface
     */
    public function addServer( string $host, int $port, int $weight = 0) : self
    {
        $this->memcached->addServer( $host, $port, $weight );

        return $this;
    }
}
