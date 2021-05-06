<?php

namespace Cache;

use Cache\CacheInterface;
use Cache\SerializerInterface;
use Cache\HashInterface;
use Cache\Hashing\Md5Adapter;
use Cache\Serialization\PhpSerializer;
use Cache\Exception\DeserializationException;

/**
 * File backed caching system
 *
 * @package Cache
 * @author clvarley
 */
Class FileCache Implements CacheInterface
{

    /**
     * Root directory for this cache system
     *
     * @var string $directory Root directory
     */
    protected $directory;

    /**
     * Adapter responsible for serializing values
     *
     * @var SerializerInterface $serializer Value serializer
     */
    protected $serializer;

    /**
     * Adapter responsible for generating key hashes
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
     * @static
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

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        $key = $this->hasher->hash( $key );

        // TODO: Read from FS

        // Failed to deserialize - quit out
        try {
            $item = $this->serializer->deserialize( $content );
        } catch ( DeserializationException $e ) {
            return null;
        }

        // Item expired?
        if ( $item->isValid() ) {
            $value = $item->value;
        } else {
            $value = null;
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 60 ) : void
    {
        $item = new CacheItem( $value, $lifetime );

        $content = $this->serializer->serialize( $item );

        $key = $this->hasher->hash( $key );

        // TODO: Write to FS

        return;
    }
}
