# SerializerInterface

Available since version 1.0.0

## About

Contract for all classes that can perform serialization of cache items.

## Overview

```php
namespace Clvarley\Cache;

Interface SerializerInterface
{

    /* Methods */
    public function serialize( CacheItem $item ) : string;
    public function deserialize( string $serialized ) : CacheItem;
}
```

## Methods
### *serialize*

Serialize the cache item using the appropriate method.

```php
public function serialize( CacheItem $item ) : string;
```

#### Parameters

<dl>
  <dt>item</dt>
  <dd>The <a href="./CacheItem.md">CacheItem</a> to serialize.</dd>
</dl>

#### Return Value

Returns the string representation of the given cache item.

#### Throws

May throw a [SerializationException](Exception/SerializationException.md) if
the value cannot be serialized.

### *deserialize*

Deserialize the string into a cache item using the appropriate method.

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
the value cannot be deserialized.

## See Also

* [CacheItem](CacheItem.md)
* [SerializationException](Exception/SerializationException.md)
* [DeserializationException](Exception/DeserializationException.md)
