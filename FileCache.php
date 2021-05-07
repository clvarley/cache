<?php

namespace Cache;

use Cache\CacheInterface;
use Cache\Filesystem\Directory;
use Cache\SerializerInterface;
use Cache\Serialization\PhpSerializer;
use Cache\KeyGeneratorInterface;
use Cache\Key\Md5Generator;
use Cache\Exception\DeserializationException;

use function array_pop;
use function file_get_contents;
use function file_put_contents;
use function implode;
use function explode;

use const LOCK_EX;

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
     * @return static           FileCache adapter
     */
    public static function create( string $directory ) : FileCache
    {
        return new static(
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
        $parts = $this->splitKey( $key );

        $filepath = implode( '/', $parts );
        $filepath = "$filepath.bin";

        // Cache file not found
        if ( !is_file( $filepath ) ) {
            return null;
        }

        $content = (string)file_get_contents( $filepath );

        // TODO: Checking $content is valid

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
            $directory = $this->createDirectories( $parts );
        } else {
            $directory = $this->directory;
        }

        // TODO: Catch cases where `createDirectories` returns null

        $root = $directory->getPath();

        // Try and write the file
        file_put_contents( "$root/$filename.bin", $content, LOCK_EX );

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
            $parts[] = $this->generator->hash( $sub_key );
        }

        return $parts;
    }

    /**
     * Attempts to create the given directory tree
     *
     * @param string[] $directories Directory names
     * @return Directory|null       Directory object
     */
    private function createDirectories( array $directories ) : ?Directory
    {
        $current = $this->directory;

        // Recurse down and create
        foreach ( $directories as $directory ) {
            $current = $current->create( $directory );

            if ( $current === null ) {
                return null;
            }
        }

        return $current;
    }
}
