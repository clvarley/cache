# IgbinarySerializer

Available since version 1.0.0

Requires the [igbinary PHP extension](https://github.com/igbinary/igbinary).

## About

Serializes cache items using the igbinary extension.

Implements the [SerializerInterface](../SerializerInterface.md).

## Overview

```php
namespace Clvarley\Cache\Serialization;

Class IgbinarySerializer Implements SerializerInterface
{

    /* Methods */
    public function serialize( CacheItem $item ) : string;
    public function deserialize( string $serialized ) : CacheItem;
}
```

## Methods
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

Returns the igbinary string representation of the given cache item.

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
the igbinary string cannot be deserialized.

## See Also

* [SerializerInterface](../SerializerInterface.md)
* [JsonSerializer](JsonSerializer.md)
* [PhpSerializer](PhpSerializer.md)
