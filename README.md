# Simple Cache

[![Release](https://img.shields.io/badge/release-v1.0.0-blue)](https://github.com/clvarley/cache/tags)
[![PHP Version](https://img.shields.io/badge/php-^7.3-blue)](https://www.php.net/supported-versions)
[![Build Status](https://travis-ci.com/clvarley/cache.svg?branch=main)](https://travis-ci.com/clvarley/cache)

A very simple collection of cache utilities.

## Contents

- [Requirements](#requirements)
- [About](#about)
  - [Overview](#overview)
  - [Installation](#installation)
  - [Contributions](#contributions)
- [Cache Types](#cache-types)
  - [File](#file)
    - [Usage](#usage)
      - [Basic Setup](#basic-setup)
      - [Expired Items](#expired-items)
      - [Configuration](#configuration)
    - [Documentation](#documentation)
  - [Memcached](#memcached)
    - [Usage](#usage-1)
    - [Documentation](#documentation-1)
  - [Simple](#simple)
    - [Usage](#usage-2)
    - [Documentation](#documentation-2)
  - [Void](#void)
    - [Usage](#usage-3)
    - [Documentation](#documentation-3)

## Requirements

* PHP >= 7.3
* Composer

## About
### Overview

When writing large applications for the web, it can often be useful to cache
computationally expensive data to increase performance and reduce calls to
potentially slow storage devices (API requests, databases, filesystem etc...).

This library is a collection of simple utilities that tries to make serializing
and caching data in PHP as painless as possible.

To this end, the library provides a range of adapters to work with a variety of
cache medium and configurations, as well as several helper methods to make
working with some of the more common cache types as straightforward and less
finicky as possible.

For developers working with frameworks that offer dependency injection, all
cache adapters adhere to a shared [CacheInterface](docs/CacheInterface.md)
contract, allowing you to build (and type hint) against the abstract interface
instead of the concrete implementation.

The adapters currently available are:

* [FileCache](docs/FileCache.md)
* [MemcachedCache](docs/MemcachedCache.md)
* [SimpleCache](docs/SimpleCache.md)
* [VoidCache](docs/VoidCache.md)

I'm always looking to add more adapters to the library, so if you have a
different use case (or can think of a caching solution I should support), feel
free to send me a suggestion for consideration in future releases.

### Installation

For those of you using Composer, the library can be added to your project by
running the following command:

```sh
composer require clvarley/cache
```

If you don't want to use Composer (and all the benefits it brings), or if you
just want to include the library directly, you can do so by downloading this
repo and including the provided `autoload.php` file:

```php
// Replace '...' with correct path
require_once '.../src/autoload.php';
```

All of the `Clvarley\Cache\*` classes should now be loaded automatically.

### Contributions

While in the future I'd like to open the project to contributors, at the current
time I won't be accepting pull requests.

## Cache Types
### File

One of the most basic forms of caches there are. The FileCache adapter writes
all cache values to the underlying filesystem, providing a persistent medium
that is available to all requests.

To allow greater configuration, the FileCache can be configured to use the
[serialization](docs/SerializerInterface.md) and [key generation](docs/KeyGeneratorInterface.md)
methods of your choosing. See the documentation for the [constructor](docs/FileCache.md#__construct)
for more information. In most cases however, the default values should suffice.

#### Usage
##### Basic Setup

To get started with a basic cache in place, we provide the [create](docs/FileCache.md#create)
utility method.

This will return an adapter where the cache keys are [md5](docs/Key/Md5Generator.md)
hashed and serialized using the internal [PHP serializer](docs/Serialization/PhpSerializer.md).

```php
use Clvarley\Cache\FileCache;

$cache = FileCache::create( 'path/to/cache/dir' );
$cache->set( 'test', 'Data to be cached!' );

// ...

$value = $cache->get( 'test' );

echo $value; // Data to be cached!
```

This creates a new cache (rooted in the `path/to/cache/dir` directory) and sets
a value with the key `test`. By default, the FileCache is set to persist items
for 60 seconds, but this can be controlled with the `$lifetime` parameter:

```php
use Clvarley\Cache\FileCache;

$cache = FileCache::create( 'path/to/cache/dir' );

$cache->set( 'short',   'My short lived value!',     10 );
$cache->set( 'long',    'My long lived value!',      120 );
$cache->set( 'forever', 'This should last forever!', 0 );
```

In the above example, we cache the values for 10 seconds, 120 seconds and - by
specifying a lifetime of 0 - forever respectively.

##### Expired Items

If you try to access an item that doesn't exist in the cache, or has expired
since it was set, the [get](docs/FileCache.md#get) method will return **null**.

This behaviour is standard across all adapters.

```php
use Clvarley\Cache\FileCache;

$cache = FileCache::create( 'path/to/cache/dir' );

$value = $cache->get( 'key' );

if ( $value === null ) {
    // Cache miss, possibly time to rehydrate
}
```

Unless you can guarantee for certain a cache item exists, it's always a good
idea to check for **null** return values.

##### Configuration

If you wish to change the way cache keys are hashed or values are serialized,
you can specify the methods via the [constructor](docs/FileCache.md#__construct).

```php
use Clvarley\Cache\FileCache;
use Clvarley\Cache\Key\PosixGenerator;
use Clvarley\Cache\Serialization\JsonSerializer;

$serializer = new JsonSerializer();
$generator = new PosixGenerator();

$cache = new FileCache( 'path/to/cache/dir', $serializer, $generator );
```

The above will write cache files with [POSIX safe](docs/Key/PosixGenerator.md)
filenames and encode the values as JSON.

Any classes implementing the appropriate [key generator](docs/KeyGeneratorInterface.md)
and [serializer](docs/SerializerInterface.md) interfaces can be passed, allowing
you to write your own adapters if required.

#### Documentation

[Read more about the FileCache](docs/FileCache.md).

### Memcached

// TODO:

#### Usage

#### Documentation

[Read more about the MemcachedCache](docs/MemcachedCache.md).

### Simple

#### Usage

#### Documentation

[Read more about the SimpleCache](docs/SimpleCache.md).

### Void

#### Usage

// TODO:

#### Documentation

[Read more about the VoidCache](docs/VoidCache.md).
