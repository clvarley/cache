# MemcachedCache

Available since version 1.0.0

Requires the [Memcached PHP extension](https://www.php.net/manual/en/book.memcached).

## About

Cache that acts as a wrapper around Memcached.

Implements the [CacheInterface](CacheInterface.md).

## Overview

```php
namespace Clvarley\Cache;

Class MemcachedCache Implements CacheInterface
{

    /* Properties */
    protected Memcached $memcached;

    /* Methods */
    public function __construct( Memcached $memcached );
    public static function create( string $host, int $port, int $weight = 0 ) : MemcachedCache;
    public function addServer( string $host, int $port, int $weight = 0 ) : self;
    public function get( string $key ) : mixed;
    public function set( string $key, mixed $value, int $lifetime = 60 ) : void;
}
```

## Properties

<dl>
  <dt>memcached</dt>
  <dd>Handle to memcached instance</dd>
</dl>

## Methods
### *__construct*

Create a wrapper around the provided Memcached instance.

Allows you to pass in a [Memcached](https://www.php.net/manual/en/class.memcached)
instance, letting you perform any required configuration beforehand.

```php
public function __construct( Memcached $memcached );
```

#### Parameters

<dl>
  <dt>memcached</dt>
  <dd>Memcached instance</dd>
</dl>

### *create*

Creates a new instance with sensible defaults.

Starts a new memcached session and connects to the provided server. The method
signature mirrors that of [Memcached::addServer](https://www.php.net/manual/en/memcached.addserver.php),
allowing you to perform construction in one place.

```php
public static function create( string $host, int $port, int $weight = 0 ) : MemcachedCache;
```

#### Parameters

<dl>
  <dt>host</dt>
  <dd>Server hostname</dd>
  <dt>port</dt>
  <dd>Memcached port</dd>
  <dt>weight</dt>
  <dd>
    <p>Server weighting</p>
    <p>If not provided, the <code>$weight</code> parameter will to 0.</p>
  </dd>
</dl>

#### Return Value

Returns a pre-configured MemcachedCache instance.

### *addServer*

Adds a new server to the server pool.

Merely a proxy for the [Memcached::addServer](https://www.php.net/manual/en/memcached.addserver.php)
method.

```php
public function addServer( string $host, int $port, int $weight = 0) : self;
```

#### Parameters

<dl>
  <dt>host</dt>
  <dd>Server hostname</dd>
  <dt>port</dt>
  <dd>Memcached port</dd>
  <dt>weight</dt>
  <dd>
    <p>Server weighting</p>
    <p>If not provided, the <code>$weight</code> parameter will to 0.</p>
  </dd>
</dl>

#### Return Value

Returns the current instance. (Fluent interface)

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
public function set( string $key, mixed $value, int $lifetime = 60 ) : void;
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
    <p>If not provided, the <code>$lifetime</code> parameter will default to 60 seconds.</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

## See Also

* [CacheInterface](CacheInterface.md)
* [ApcuCache](ApcuCache.md)
* [FileCache](FileCache.md)
* [SimpleCache](SimpleCache.md)
* [VoidCache](VoidCache.md)
