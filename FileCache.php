<?php

namespace Cache;

use Cache\CacheInterface;
use Cache\SerializerInterface;
use Cache\HashInterface;
use Cache\Hashing\Md5Adapter;
use Cache\Serialization\PhpSerializer;

/**
 * File backed caching system
 *
 * @package Cache
 * @author clvarley
 */
Class FileCache Implements CacheInterface
{

    /**
    *
    *
    * @var string $directory Root directory
    */
    protected $directory;

    /**
     *
     *
     * @var SerializerInterface $serializer Value serializer
     */
    protected $serializer;

    /**
     *
     *
     * @var HashInterface $hasher Hash adapter
     */
    protected $hasher;

    /**
     * Create a file cache using the serialization and hashing method provided
     *
     * @param string $directory               Root directory
     * @param SerializerInterface $serializer Serialization method
     * @param HashInterface $hasher           Hashing method
     */
    public function __construct( string $directory, SerializerInterface $serializer, HashInterface $hasher )
    {
        $this->directory = $directory;
        $this->serializer = $serializer;
        $this->hasher = $hasher;
    }

    /**
     * Creates a FileCache with sensible defaults
     *
     * @param string $directory Root directory
     * @return static           FileCache adapter
     */
    public static function create( string $directory ) : FileCache
    {
        return new static(
            $directory,
            new Md5Adapter,
            new PhpSerializer
        );
    }
}
