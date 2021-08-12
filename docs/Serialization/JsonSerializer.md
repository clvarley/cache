# JsonSerializer

Available since version 1.0.0

## About

Serializes cache items into JSON strings.

Implements the [SerializerInterface](../SerializerInterface.md).

## Overview

```php
namespace Clvarley\Cache\Serialization;

Class JsonSerializer Implements SerializerInterface
{

    /* Properties */
    private int $encoding = JSON_PRESERVE_ZERO_FRACTION;

    /* Methods */
    public function setEncoding( int $encoding ) : void;
    public function serialize( CacheItem $item ) : string;
    public function deserialize( string $serialized ) : CacheItem;
}
```

## Properties

<dl>
  <dt>encoding</dt>
  <dd>Flags to use when calling json_encode</dd>
</dl>

## Methods
### *setEncoding*

Set the JSON encoding option flags.

Provided to allow configuration of the `JSON_` flags to be used as the second
argument to [json_encode](https://www.php.net/manual/en/function.json-encode.php).

```php
public function setEncoding( int $encoding ) : void;
```

#### Parameters

<dl>
  <dt>encoding</dt>
  <dd>Encoding options</dd>
</dl>

#### Return Value

This function has no return value.

### *serialize*

Serialize the cache item.

```php
public function serialize( CacheItem $item ) : string;
```

#### Parameters

<dl>
  <dt>item</dt>
  <dd>The <a href="../CacheItem.md">CacheItem</a> to serialize.</dd>
</dl>

#### Return Value

Returns the JSON string representation of the given cache item.

#### Throws

Does not throw exceptions.

### *deserialize*

Deserialize into a cache item.

```php
public function deserialize( string $serialized ) : CacheItem;
```

#### Parameters

<dl>
  <dt>serialized</dt>
  <dd>Serialized item.</dd>
</dl>

#### Return Value

Returns the deserialized [CacheItem](CacheItem.md).

#### Throws

May throw a [DeserializationException](Exception/DeserializationException.md) if
the JSON string cannot be deserialized.

## See Also

* [SerializerInterface](../SerializerInterface.md)
* [IgbinarySerializer](IgbinarySerializer.md)
* [PhpSerializer](PhpSerializer.md)
