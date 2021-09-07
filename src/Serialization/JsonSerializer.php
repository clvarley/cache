<?php

namespace Clvarley\Cache\Serialization;

use Clvarley\Cache\SerializerInterface;
use Clvarley\Cache\CacheItem;
use Clvarley\Cache\Exception\DeserializationException;

use function json_encode;
use function json_decode;
use function is_int;

use const JSON_PRESERVE_ZERO_FRACTION;

/**
 * Serializes cache items into JSON strings
 *
 * @package Cache
 * @author clvarley
 */
Class JsonSerializer Implements SerializerInterface
{

    /**
     * Flags to use when calling json_encode
     *
     * @var int $encoding Encoding options
     */
    private $encoding = JSON_PRESERVE_ZERO_FRACTION;

    /**
     * Set the JSON encoding option flags
     *
     * @param int $encoding Encoding options
     * @return void         N/a
     */
    public function setEncoding( int $encoding ) : void
    {
        $this->encoding = $encoding;
    }

    /**
     * Serialize the cache item into JSON
     *
     * @param CacheItem $item Cache item
     * @return string         Serialized item
     */
    public function serialize( CacheItem $item ) : string
    {
        // TODO: Object serialization

        $serialized = json_encode( $item, $this->encoding );

        return $serialized;
    }

    /**
     * Deserialize JSON into a cache item
     *
     * @throws DeserializationException
     * @param string $serialized Serialized item
     * @return CacheItem         Cache item
     */
    public function deserialize( string $serialized ) : CacheItem
    {
        $deserialized = (object)json_decode( $serialized );

        // Missing required data
        if (
            !isset( $deserialized->value )
            || !isset( $deserialized->expires )
            || !is_int( $deserialized->expires )
        ) {
            throw new DeserializationException;
        }

        // TODO: Object deserialization
        $item = new CacheItem( $deserialized->value, 0 );
        $item->expires = $deserialized->expires;

        return $item;
    }
}
