<?php

namespace Clvarley\Cache\Tests\Serialization;

use Clvarley\Cache\Tests\Serialization\AbstractSerializerTest;
use Clvarley\Cache\Serialization\JsonSerializer;
use Clvarley\Cache\Exception\DeserializationException;
use stdClass;
use Closure;

use function json_encode;

use const JSON_PRETTY_PRINT;

/**
 * @group Serialization
 * @requires extension json
 */
Class JsonSerializerTest Extends AbstractSerializerTest
{

    /**
     * Make sure the JsonSerializer can serialize a string
     */
    public function testCanSerializeString()
    {
        $item = $this->createItem( "testString" );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            "{\"value\":\"testString\",\"expires\":{$item->expires}}"
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize a string
     *
     * @depends testCanSerializeString
     */
    public function testCanDeserializeString( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  "testString"  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the JsonSerializer can serialize an array
     */
    public function testCanSerializeArray()
    {
        $item = $this->createItem( [ 1, 2, 3 ] );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            "{\"value\":[1,2,3],\"expires\":{$item->expires}}"
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize an array
     *
     * @depends testCanSerializeArray
     */
    public function testCanDeserializeArray( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  [ 1, 2, 3 ]  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the JsonSerializer can serialize an object
     */
    public function testCanSerializeAnonymousClass()
    {
        $object = new stdClass;
        $object->id = 123;
        $object->prop = "test";

        $item = $this->createItem( $object );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            "{\"value\":{\"id\":123,\"prop\":\"test\"},\"expires\":{$item->expires}}"
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize an object
     *
     * @depends testCanSerializeAnonymousClass
     */
    public function testCanDeserializeAnonymousClass( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertInstanceOf( stdClass::class, $item->value );
        $this->assertEquals( $item->value->id,   123 );
        $this->assertEquals( $item->value->prop, "test" );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the JsonSerializer can have custom encoding flags
     */
    public function testCanSetEncodingFlags()
    {
        $serializer = new JsonSerializer();
        $serializer->setEncoding( 0 | JSON_PRETTY_PRINT );

        // Give the tests access to the private properties
        $tests = Closure::bind(
            function ( JsonSerializer $serializer ) {
                $this->assertEquals( $serializer->encoding, JSON_PRETTY_PRINT );
            },
            $this,
            JsonSerializer::class
        );
        $tests( $serializer );

        return $serializer;
    }

    /**
     * Make sure the JsonSerializer respects custom encoding flags
     *
     * @depends testCanSetEncodingFlags
     */
    public function testUsesEncodingFlags( JsonSerializer $serializer )
    {
        $object = new stdClass;
        $object->id = 123;
        $object->prop = "test";

        $item = $this->createItem( $object );

        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            <<<JSON
            {
                "value": {
                    "id": 123,
                    "prop": "test"
                },
                "expires": {$item->expires}
            }
            JSON
        );
    }

    /**
     * Make sure the JsonSerializer throws on invalid strings
     */
    public function testThrowsOnInvalidStrings()
    {
        $serializer = new JsonSerializer();

        // Try to deserialize a invalid value
        try {
            $serializer->deserialize( '@@some_invalid_value' );
        } catch ( DeserializationException $e ) {}

        $this->assertInstanceOf( DeserializationException::class, $e );
    }

    /**
     * Make sure the JsonSerializer throws on invalid classes
     */
    public function testThrowsOnInvalidClasses()
    {
        $serializer = new JsonSerializer();

        // Try to deserialize a non-CacheItem class
        try {
            $serializer->deserialize( '{"id":123}' );
        } catch ( DeserializationException $e ) {}

        $this->assertInstanceOf( DeserializationException::class, $e );
    }
}
