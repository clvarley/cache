<?php

namespace Clvarley\Cache\Tests\Serialization;

use Clvarley\Cache\Tests\Serialization\AbstractSerializerTest;
use Clvarley\Cache\Serialization\JsonSerializer;
use stdClass;

use function json_encode;

use const JSON_PRESERVE_ZERO_FRACTION;

/**
 * @group Serialization
 * @requires extension json
 */
Class JsonSerializerTest Extends AbstractSerializerTest
{

    /**
     * Make sure the JsonSerializer can serialize a string
     */
    public function testSerializeString()
    {
        $item = $this->createItem( "testString" );

        var_dump( $item );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            json_encode( $item, JSON_PRESERVE_ZERO_FRACTION )
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize a string
     *
     * @depends testSerializeString
     */
    public function testDeserializeString( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  "testString"  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the JsonSerializer can serialize an array
     */
    public function testSerializeArray()
    {
        $item = $this->createItem( [ 1, 2, 3 ] );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            json_encode( $item, JSON_PRESERVE_ZERO_FRACTION )
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize an array
     *
     * @depends testSerializeArray
     */
    public function testDeserializeArray( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  [ 1, 2, 3 ]  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the JsonSerializer can serialize an object
     */
    public function testSerializeObject()
    {
        $object = new stdClass;
        $object->id = 123;
        $object->prop = "test";

        $item = $this->createItem( $object );

        $serializer = new JsonSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            json_encode( $item, JSON_PRESERVE_ZERO_FRACTION )
        );

        return $serialized;
    }

    /**
     * Make sure the JsonSerializer can deserialize an object
     *
     * @depends testSerializeObject
     */
    public function testDeserializeObject( string $serialized )
    {
        $serializer = new JsonSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertInstanceOf( stdClass::class, $item->value );
        $this->assertEquals( $item->value->id,   123 );
        $this->assertEquals( $item->value->prop, "test" );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }
}
