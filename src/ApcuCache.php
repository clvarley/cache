<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;

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
        // TODO:

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void
    {
        // TODO:

        return;
    }
}
