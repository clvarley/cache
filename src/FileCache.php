<?php

namespace Clvarley\Cache;

use Clvarley\Cache\CacheInterface;
use Clvarley\Cache\Filesystem\Directory;
use Clvarley\Cache\Filesystem\File;
use Clvarley\Cache\SerializerInterface;
use Clvarley\Cache\Serialization\PhpSerializer;
use Clvarley\Cache\KeyGeneratorInterface;
use Clvarley\Cache\Key\Md5Generator;
use Clvarley\Cache\Exception\DeserializationException;
use Clvarley\Cache\Exception\CacheWriteException;

use function array_pop;
use function implode;
use function explode;

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
     * @var Directory $directory Root directory
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
        $this->directory  = new Directory( $directory );
        $this->serializer = $serializer;
        $this->generator  = $generator;
    }

    /**
     * Creates a FileCache with sensible defaults
     *
     * @static
     * @param string $directory Root directory
     * @return FileCache        FileCache adapter
     */
    public static function create( string $directory ) : FileCache
    {
        return new self(
            $directory,
            new PhpSerializer,
            new Md5Generator
        );
    }

    /**
     * {@inheritdoc}
     */
    public function get( string $key ) /* : ?mixed */
    {
        $root = $this->directory->getPath();

        $parts = $this->splitKey( $key );

        $filepath = implode( '/', $parts );
        $filepath = "$root/$filepath.bin";

        $cache_file = new File( $filepath );

        // Cache file not found
        if ( !$cache_file->exists() ) {
            return null;
        }

        $content = $cache_file->read();

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

        // Create sub-directories (if required)
        $parts = $this->splitKey( $key );
        $filename = array_pop( $parts );

        if ( !empty( $parts ) ) {
            $path = implode( '/', $parts );
            $directory = $this->directory->create( $path );
        } else {
            $directory = $this->directory;
        }

        // Failed to create directory
        if ( $directory === null ) {
            throw new CacheWriteException;
        }

        $root = $directory->getPath();

        $cache_file = new File( "$root/$filename.bin" );
        $cache_file->write( $content );

        return;
    }

    /**
     * Splits the key into an array of hashed sub parts
     *
     * @param string $key Item key
     * @return string[]   Hashed parts
     */
    private function splitKey( string $key ) : array
    {
        $parts = [];

        foreach ( explode( '.', $key ) as $sub_key ) {
            $parts[] = $this->generator->generate( $sub_key );
        }

        return $parts;
    }
}
