# PhpSerializer

Available since version 1.0.0

## About

Serializes cache items using the standard PHP serializer.

Implements the [SerializerInterface](../SerializerInterface.md).

## Overview

```php
namespace Clvarley\Cache\Serialization;

Class PhpSerializer Implements SerializerInterface
{

    /* Methods */
    public function serialize( CacheItem $item ) : string;
    public function deserialize( string $serialized ) : CacheItem;
}
```

## Methods
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

Returns the PHP string representation of the given cache item.

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
the PHP string cannot be deserialized.

## See Also

* [SerializerInterface](../SerializerInterface.md)
* [IgbinarySerializer](IgbinarySerializer.md)
* [JsonSerializer](JsonSerializer.md)
