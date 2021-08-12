# Crc32Generator

Available since version 1.0.0

## About

Generator that hashes keys using the Crc32 algorithm.

Implements the [KeyGeneratorInterface](../KeyGeneratorInterface.md).

## Overview

```php
namespace Clvarley\Cache\Key;

Class Crc32Generator Implements KeyGeneratorInterface
{

    /* Methods */
    public function generate( string $subject ) : string;
}
```

## Methods
### *generate*

Create a key using the CRC32 algorithm.

```php
public function generate( string $subject ) : string;
```

#### Parameters

<dl>
  <dt>subject</dt>
  <dd>Subject string</dd>
</dl>

#### Return Value

Returns the hashed `$subject`.

## See Also

* [KeyGeneratorInterface](../KeyGeneratorInterface.md)
* [Md5Generator](Md5Generator.md)
* [PosixGenerator](PosixGenerator.md)
* [RawGenerator](RawGenerator.md)
* [Sha1Generator](Sha1Generator.md)
