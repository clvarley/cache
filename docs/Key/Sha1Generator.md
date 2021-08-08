# Sha1Generator

Available since version 1.0.0

## About

Generator that hashes keys using the SHA1 algorithm.

Implements the [KeyGeneratorInterface](../KeyGeneratorInterface.md).

## Overview

```php
namespace Clvarley\Cache\Key;

Class Sha1Generator Implements KeyGeneratorInterface
{

    /* Methods */
    public function generate( string $subject ) : string;
}
```

## Methods
### *generate*

Create a key using the SHA1 algorithm.

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
* [Crc32Generator](Crc32Generator.md)
* [Md5Generator](Md5Generator.md)
* [PosixGenerator](PosixGenerator.md)
* [RawGenerator](RawGenerator.md)
