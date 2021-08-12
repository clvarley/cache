# CacheInterface

Available since version 1.0.0

## About

Contract for all classes that can cache values.

## Overview

```php
namespace Clvarley\Cache;

Interface CacheInterface
{

    /* Methods */
    public function get( string $key ) : mixed;
    public function set( string $key, mixed $value, int $lifetime = 0 ) : void;
}
```

## Methods
### *get*

Retrieve an item from the cache.

```php
public function get( string $key ) : mixed;
```

#### Parameters

<dl>
  <dt>key</dt>
  <dd>Item key</dd>
</dl>

#### Return Value

Returns the item value or **null** if the given key doesn't exist (or is
expired).

#### Throws

May throw a [CacheReadException](Exception/CacheReadException.md) if there was
an error reading from the cache.

### *set*

Store an item in the cache.

```php
public function set( string $key, mixed $value, int $lifetime = 0 ) : void;
```

#### Parameters

<dl>
  <dt>key</dt>
  <dd>Item key</dd>
  <dt>value</dt>
  <dd>Item value</dd>
  <dt>lifetime</dt>
  <dd>
    <p>Item lifetime (in seconds)</p>
    <p>If not provided, the <code>$lifetime</code> parameter should default to a
    value sensible for the implementation/cache method being used.</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

#### Throws

May throw a [CacheWriteException](Exception/CacheWriteException.md) if there was
an error writing to the cache.

## See Also

* [CacheItem](CacheItem.md)
* [FileCache](FileCache.md)
* [MemcachedCache](MemcachedCache.md)
* [SimpleCache](SimpleCache.md)
* [VoidCache](VoidCache.md)
