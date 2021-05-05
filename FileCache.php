<?php

namespace Cache;

use Cache\CacheInterface;
use Cache\SerializerInterface;
use Cache\HashInterface;

/**
 * File backed caching system
 *
 * @package Cache
 * @author clvarley
 */
Class FileCache Implements CacheInterface
{

    /**
     * @var SerializerInterface $serializer Value serializer
     */
    protected $serializer;

    /**
     * @var HashInterface $hasher Hash adapter
     */
    protected $hasher;

    /**
     * @var string $directory Root directory
     */
    protected $directory;

    /**
     *
     */
    public function __construct()
    {

    }
}
