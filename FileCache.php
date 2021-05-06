<?php

namespace Cache;

use Cache\CacheInterface;
use Cache\SerializerInterface;
use Cache\Serialization\PhpSerializer;
use Cache\KeyGeneratorInterface;
use Cache\Key\Md5Generator;
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
     * Adapter responsible for generating cache keys
     *
     * @var KeyGeneratorInterface $generator Key generator
     */
    protected $generator;

    /**
     * Create a file cache using the serialization and hashing methods provided
     *
     * @param string $directory                Root directory
     * @param SerializerInterface $serializer  Serialization method
     * @param KeyGeneratorInterface $generator Key generator
     */
    public function __construct(
        string $directory,
        SerializerInterface $serializer,
        KeyGeneratorInterface $generator
    ) {
        $this->directory  = $directory;
        $this->serializer = $serializer;
        $this->generator  = $generator;
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
            new Md5Generator,
            new PhpSerializer
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        $key = $this->generator->hash( $key );

        // TODO: Read from FS

        // Failed to deserialize - quit out
        try {
            $item = $this->serializer->deserialize( $content );
        } catch ( DeserializationException $e ) {
            return null;
        }

        // Item expired?
        if ( !$item->isValid() ) {
            return null;
        }

        return $item->value;
    }

    /**
     * {@inheritdoc}
     */
    public function set( string $key, /* mixed */ $value, int $lifetime = 60 ) : void
    {
        $item = new CacheItem( $value, $lifetime );

        $content = $this->serializer->serialize( $item );

        $key = $this->generator->hash( $key );

        // TODO: Write to FS

        return;
    }
}
