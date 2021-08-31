<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;
use Clvarley\Cache\Exception\CacheWriteException;

use function apcu_fetch;
use function apcu_store;

/**
 * Cache that acts as a wrapper around the APCu extension
 *
 * @package Cache
 * @author clvarley
 * @since 1.1.0
 */
Class ApcuCache Implements CacheInterface
{

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) // : mixed
    {
        /** @var mixed $value */
        $value = apcu_fetch( $key, $success );

        // Standardise our null return contract
        if ( $success === false && $value === false ) {
            $value = null;
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void
    {
        $success = apcu_store( $key, $value, $lifetime );

        // Failed to cache value
        if ( $success === false ) {
            throw new CacheWriteException;
        }

        return;
    }
}
