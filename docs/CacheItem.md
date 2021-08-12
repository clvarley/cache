# CacheItem

Available since version 1.0.0

## About

Represents a single cache item.

## Overview

```php
namespace Clvarley\Cache;

Class CacheItem
{

    /* Properties */
    public mixed $value;
    public int $expires;

    /* Methods */
    public function __construct( mixed $value, int $expires );
    public function isValid() : bool;
}
```

## Properties

<dl>
  <dt>value</dt>
  <dd>The actual cache value</dd>
  <dt>expires</dt>
  <dd>Timestamp of when this item expires</dd>
</dl>

## Methods
### *__construct*

Creates a new cache item from the value supplied.

```php
public function __construct( mixed $value, int $expires );
```

#### Parameters

<dl>
  <dt>value</dt>
  <dd>Item value</dd>
  <dt>expires</dt>
  <dd>
    <p>Item lifetime</p>
    <p>If not provided, the <code>$expires</code> parameter will default to 0
    (never expire).</p>
  </dd>
</dl>

### *isValid*

Checks to see if this cache item has expired.

```php
public function isValid() : bool;
```

#### Parameters

This function has no parameters.

#### Return Value

Returns a boolean indicating if the cache item is valid (not expired).

## See Also

* [CacheInterface](CacheItem.md)
* [SerializerInterface](SerializerInterface.md)
