# FileCache

Available since version 1.0.0

## About

Cache that persists items to the filesystem.

Implements the [CacheInterface](CacheInterface.md).

## Overview

```php
namespace Clvarley\Cache;

Class FileCache Implements CacheInterface
{

    /* Properties */
    protected Directory $directory;
    protected SerializerInterface $serializer;
    protected KeyGeneratorInterface $generator;
    protected int $permissions = 0755;

    /* Methods */
    public function __construct( string $directory, SerializerInterface $serializer, KeyGeneratorInterface $generator  );
    public static function create( string $directory ) : FileCache;
    public function setPermissions( int $permissions ) : void;
    public function get( string $key ) : mixed;
    public function set( string $key, mixed $value, int $lifetime = 60 ) : void;
    private function splitKey( string $key ) : array;
}
```

## Properties

<dl>
  <dt>directory</dt>
  <dd>Root directory for this cache system</dd>
  <dt>serializer</dt>
  <dd>Adapter responsible for serializing values</dd>
  <dt>generator</dt>
  <dd>Adapter responsible for generating cache keys</dd>
  <dt>permissions</dt>
  <dd>Permission flags to use during calls to <code>mkdir</code></dd>
</dl>

## Methods
### *__construct*

Create a file cache using the serialization and hashing methods provided.

If you just want to create a cache with sensible default values, you can use the
[`::create()`](#create) static helper function.

```php
public function __construct( string $directory, SerializerInterface $serializer, KeyGeneratorInterface $generator  );
```

#### Parameters

<dl>
  <dt>directory</dt>
  <dd>
    <p>Root directory</p>
    <p>Absolute path to the directory to use as the root for this cache.</p>
  </dd>
  <dt>serializer</dt>
  <dd>
    <p>Serialization method</p>
    <p>Any class that implements the <a href="./SerializerInterface.md">SerializerInterface</a>.</p>
  </dd>
  <dt>generator</dt>
  <dd>
    <p>Key generator</p>
    <p>Any class that implements the <a href="./KeyGeneratorInterface.md">KeyGeneratorInterface</a>.</p>
  </dd>
</dl>

### *create*

Creates a FileCache with sensible defaults.

Returns a cache adapter configured to use the [PhpSerializer](Serialization/PhpSerializer.md)
and the [Md5Generator](Key/Md5Generator.md).

```php
public static function create( string $directory ) : FileCache;
```

#### Parameters

<dl>
  <dt>directory</dt>
  <dd>
    <p>Root directory</p>
    <p>Absolute path to the directory to use as the root for this cache.</p>
  </dd>
</dl>

#### Return Value

Returns a pre-configured FileCache instance.

### *setPermissions*

Set the permission level to be used when creating directories.

```php
public function setPermissions( int $permissions ) : void;
```

#### Parameters

<dl>
  <dt>permissions</dt>
  <dd>
    <p>Directory permissions</p>
    <p>Permission flags to use during calls to <code>mkdir</code>.</p>
  </dd>
</dl>

#### Return Value

This function has no return value.

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

Will attempt to write the provided value to the filesystem.

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

#### Throws

May throw a [CacheWriteException](Exception/CacheWriteException.md) if there was
an error writing the cache file to the filesystem.

### *splitKey*

Splits the key into an array of hashes.

```php
private function splitKey( string $key ) : array;
```

#### Parameters

<dl>
  <dt>key</dt>
  <dd>Item key</dd>
</dl>

#### Return Value

Returns an array of hashes.

## See Also

* [CacheInterface](CacheInterface.md)
* [ApcuCache](ApcuCache.md)
* [MemcachedCache](MemcachedCache.md)
* [SimpleCache](SimpleCache.md)
* [VoidCache](VoidCache.md)
