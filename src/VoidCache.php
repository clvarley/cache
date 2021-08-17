<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;

/**
 * Cache that never stores items, simply discarding them
 *
 * Useful for refactoring or for testing.
 *
 * @package Cache
 * @author clvarley
 */
Class VoidCache Implements CacheInterface
{

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : mixed */
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void
    {
        return;
    }
}
