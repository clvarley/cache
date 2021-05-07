<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;
use Clvarley\Cache\CacheItem;

use const PHP_INT_MAX;

/**
 * Very simple in memory cache store
 *
 * @package Cache
 * @author clvarley
 */
Class MemoryCache Implements CacheInterface
{

    /**
     *  Currently stored items
     *
     * @var CacheItem[] $items Cache items
     */
    private $items = [];

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        if ( isset( $this->items[$key] ) && $this->items[$key]->isValid() ) {
            return $this->items[$key]->value;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 0 ) : void
    {
        $this->items[$key] = new CacheItem( $value, $lifetime );
    }
}
