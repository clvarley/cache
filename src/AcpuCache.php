<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;

/**
 * Cache that acts as a wrapper around the ACPu extension
 *
 * @package Cache
 * @author clvarley
 * @since 1.1.0
 */
Class AcpuCache Implements CacheInterface
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
