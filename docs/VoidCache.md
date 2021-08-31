# VoidCache

Available since version 1.0.0

## About

Cache that never stores items, simply discarding them.

Useful when refactoring or testing. Allows you to type hint against the
[CacheInterface](CacheInterface.md) contract, but with a cache that is
guaranteed to never store items.

Implements the [CacheInterface](CacheInterface.md).

## Overview

```php
namespace Clvarley\Cache;

Class VoidCache Implements CacheInterface
{

    /* Methods */
    public function get( string $key ) : mixed;
    public function set( string $key, mixed $value, int $lifetime = 0 ) : void;
}
```

## Methods
### *get*

Does nothing.

```php
public function get( string $key ) : mixed;
```

#### Parameters

<dl>
  <dt>key</dt>
  <dd>Item key.</dd>
</dl>

#### Return Value

Will always return **null**.

### *set*

Does nothing.

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
    <p>If left empty <code>$lifetime</code> defaults to 0 (never expire).</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

## See Also

* [CacheInterface](CacheInterface.md)
* [ApcuCache](ApcuCache.md)
* [FileCache](FileCache.md)
* [MemcachedCache.md](MemcachedCache.md)
* [SimpleCache](SimpleCache.md)
