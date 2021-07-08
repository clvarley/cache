<?php

namespace Clvarley\Cache\Tests;

use Clvarley\Cache\Serialization\IgbinarySerializer;
use Clvarley\Cache\CacheItem;
use PHPUnit\Framework\TestCase;
use stdClass;

use function time;

/**
 * @group Serialization
 * @requires extension igbinary
 */
Class IgbinarySerializerTest Extends TestCase
{

    /**
     * Time tests were started
     *
     * @var int $start_time Timestamp
     */
    private $start_time = 0;

    /**
     * Creates a new cache item with the given value
     *
     * @param mixed $value Cache value
     * @return CacheItem   Cache item
     */
    private function createItem( /* mixed */ $value ) : CacheItem
    {
        $this->start_time = time();

        $item = new CacheItem( $value, 10 );
        return $item;
    }

    /**
     * Make sure the IgbinarySerializer can serialize a string
     */
    public function testSerializeString()
    {
        $item = $this->createItem( "testString" );

        $serializer = new IgbinarySerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals( $serialized, "" ); // TODO: get serialized value

        return $serialized;
    }

    /**
     * Make sure the IgbinarySerializer can deserialize a string
     *
     * @depends testSerializeString
     */
    public function testDeserializeString( string $serialized )
    {
        $serializer = new IgbinarySerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  "testString"  );
        $this->assertEqualsWithDelta( $item->expires, $this->start_time, 1 );
    }

    /**
     * Make sure the IgbinarySerializer can serialize an array
     */
    public function testSerializeArray()
    {
        $item = $this->createItem( [ 1, 2, 3 ] );

        $serializer = new IgbinarySerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals( $serialized, "" ); // TODO: get serialized value

        return $serialized;
    }

    /**
     * Make sure the IgbinarySerializer can deserialize an array
     *
     * @depends testSerializeArray
     */
    public function testDeserializeArray( string $serialized )
    {
        $serializer = new IgbinarySerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertEquals(          $item->value,  [ 1, 2, 3 ]  );
        $this->assertEqualsWithDelta( $item->expires, $this->start_time, 1 );
    }

    /**
     * Make sure the IgbinarySerializer can serialize an object
     */
    public function testSerializeObject()
    {
        $object = new stdClass;
        $object->id = 123;
        $object->prop = "test";

        $item = $this->createItem( $object );

        $serializer = new IgbinarySerializer();
        $serialized = $serializer->serialize( $item );

        $this->assertEquals( $serialized, "" ); // TODO: get serialized value

        return $serialized;
    }

    /**
     * Make sure the IgbinarySerializer can deserialize an object
     *
     * @depends testSerializeObject
     */
    public function testDeserializeObject( string $serialized )
    {
        $serializer = new IgbinarySerializer();
        $item = $serializer->deserialize( $serialized );

        $this->assertInstanceOf( stdClass::class, $item->value );
        $this->assertEquals( $item->value->id,   123 );
        $this->assertEquals( $item->value->prop, "test" );
        $this->assertEqualsWithDelta( $item->expires, $this->start_time, 1 );
    }
}
