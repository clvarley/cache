# MemcachedCache

Available since version 1.1.0

Requires the [APCu PHP extension](https://www.php.net/manual/en/book.apcu).

## About

Cache that acts as a wrapper around the APCu extension.

Implements the [CacheInterface](CacheInterface.md).

## Overview

```php
namespace Clvarley\Cache;

Class ApcuCache Implements CacheInterface
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
    <p>If left empty <code>$lifetime</code> defaults to 0 (never expire).</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

#### Throws

May throw a [CacheWriteException](Exception/CacheWriteException.md) if there was
an error when writing to the APCu store.

## See Also

* [CacheInterface](CacheInterface.md)
* [FileCache](FileCache.md)
* [MemcachedCache](MemcachedCache.md)
* [SimpleCache](SimpleCache.md)
* [VoidCache](VoidCache.md)
