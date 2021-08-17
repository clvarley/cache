<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;
use Clvarley\Cache\CacheItem;

/**
 * Cache that simply holds items in memory
 *
 * @package Cache
 * @author clvarley
 */
Class SimpleCache Implements CacheInterface
{

    /**
     * Currently stored items
     *
     * @psalm-var array<string,CacheItem> $items
     *
     * @var CacheItem[] $items Cache items
     */
    private $items = [];

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : mixed */
    {
        if ( isset( $this->items[$key] ) ) {
            if ( $this->items[$key]->isValid() ) {
                return $this->items[$key]->value;
            }

            unset( $this->items[$key] );
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
