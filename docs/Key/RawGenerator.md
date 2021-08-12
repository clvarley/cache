# RawGenerator

Available since version 1.0.0

## About

Generator that simply returns the raw key.

Useful for easy refactoring or if you want to be able to control your cache keys
directly, without them being run through a hashing algorithm.

Implements the [KeyGeneratorInterface](../KeyGeneratorInterface.md).

## Overview

```php
namespace Clvarley\Cache\Key;

Class RawGenerator Implements KeyGeneratorInterface
{

    /* Methods */
    public function generate( string $subject ) : string;
}
```

## Methods
### *generate*

Simply return the provided subject.

```php
public function generate( string $subject ) : string;
```

#### Parameters

<dl>
  <dt>subject</dt>
  <dd>Subject string</dd>
</dl>

#### Return Value

Returns `$subject` unchanged.

## See Also

* [KeyGeneratorInterface](../KeyGeneratorInterface.md)
* [Crc32Generator](Crc32Generator.md)
* [Md5Generator](Md5Generator.md)
* [PosixGenerator](PosixGenerator.md)
* [Sha1Generator](Sha1Generator.md)
