# SimpleCache

Available since version 1.0.0

## About

Cache that simply holds items in memory.

Implements the [CacheInterface](CacheInterface.md).

## Overview

```php
namespace Clvarley\Cache;

Class SimpleCache Implements CacheInterface
{

    /* Properties */
    private array $items = [];

    /* Methods */
    public function get( string $key ) : mixed;
    public function set( string $key, mixed $value, int $lifetime = 0 ) : void;
}
```

## Properties

<dl>
  <dt>items</dt>
  <dd>
    <p>Currently stored items</p>
    <p>A key-value hashmap containing all held <a href="CacheItem.md">CacheItems</a>.</p>
  </dd>
</dl>

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
    <p>If not provided, the <code>$lifetime</code> parameter will default to 0 (never expire).</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

## See Also

* [CacheInterface](CacheInterface.md)
* [ApcuCache](ApcuCache.md)
* [FileCache](FileCache.md)
* [MemcachedCache](MemcachedCache.md)
* [VoidCache](VoidCache.md)
