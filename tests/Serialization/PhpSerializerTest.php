<?php

namespace Clvarley\Cache\Tests\Serialization;

use Clvarley\Cache\Tests\Serialization\AbstractSerializerTest;
use Clvarley\Cache\Serialization\PhpSerializer;
use stdClass;
use SplFixedArray;

use function serialize;

/**
 * @group Serialization
 */
Class PhpSerializerTest Extends AbstractSerializerTest
{

    /**
     * Make sure the PhpSerializer can serialize a string
     */
    public function testCanSerializeString()
    {
        $item = $this->createItem( "testString" );

        $serializer = new PhpSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            serialize( $item )
        );

        return $serialized;
    }

    /**
     * Make sure the PhpSerializer can deserialize a string
     *
     * @depends testCanSerializeString
     */
    public function testCanDeserializeString( string $serialized )
    {
        $serializer = new PhpSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  "testString"  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the PhpSerializer can serialize an array
     */
    public function testCanSerializeArray()
    {
        $item = $this->createItem( [ 1, 2, 3 ] );

        $serializer = new PhpSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            serialize( $item )
        );

        return $serialized;
    }

    /**
     * Make sure the PhpSerializer can deserialize an array
     *
     * @depends testCanSerializeArray
     */
    public function testCanDeserializeArray( string $serialized )
    {
        $serializer = new PhpSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  [ 1, 2, 3 ]  );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the PhpSerializer can serialize an anonymous object
     */
    public function testCanSerializeAnonymousClass()
    {
        $object = new stdClass;
        $object->id = 123;
        $object->prop = "test";

        $item = $this->createItem( $object );

        $serializer = new PhpSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            serialize( $item )
        );

        return $serialized;
    }

    /**
     * Make sure the PhpSerializer can deserialize an anonymous object
     *
     * @depends testCanSerializeAnonymousClass
     */
    public function testCanDeserializeAnonymousClass( string $serialized )
    {
        $serializer = new PhpSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertInstanceOf( stdClass::class, $item->value );
        $this->assertEquals( $item->value->id, 123 );
        $this->assertEquals( $item->value->prop, "test" );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
    }

    /**
     * Make sure the PhpSerializer can serialize a known object
     */
    public function testCanSerializeKnownClass()
    {
        $vector = new SplFixedArray(2);
        $vector[0] = 123;
        $vector[1] = "test";

        $item = $this->createItem( $vector );

        $serializer = new PhpSerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals(
            $serialized,
            serialize( $item )
        );

        return $serialized;
    }

    /**
     * Make sure the PhpSerializer can deserialize a known object
     *
     * @depends testCanSerializeKnownClass
     */
    public function testCanDeserializeKnownClass( string $serialized )
    {
        $serializer = new PhpSerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertInstanceOf( SplFixedArray::class, $item->value );
        $this->assertEquals( $item->value[0], 123 );
        $this->assertEquals( $item->value[1], "test" );
        $this->assertEqualsWithDelta( $item->expires, self::$start_time, 1 );
     }
}
