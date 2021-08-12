# PosixGenerator

Available since version 1.0.0

## About

Generator that guarantees [POSIX portable file name standard](https://www.ibm.com/docs/en/zos/2.2.0?topic=locales-posix-portable-file-name-character-set)
compliant keys.

Implements the [KeyGeneratorInterface](../KeyGeneratorInterface.md).

## Overview

```php
namespace Clvarley\Cache\Key;

Class PosixGenerator Implements KeyGeneratorInterface
{

    /* Methods */
    public function generate( string $subject ) : string;
}
```

## Methods
### *generate*

Strips out non-POSIX portable characters.

```php
public function generate( string $subject ) : string;
```

#### Parameters

<dl>
  <dt>subject</dt>
  <dd>Subject string</dd>
</dl>

#### Return Value

Returns `$subject` with any unsafe characters removed.

## See Also

* [KeyGeneratorInterface](../KeyGeneratorInterface.md)
* [Crc32Generator](Crc32Generator.md)
* [Md5Generator](Md5Generator.md)
* [RawGenerator](RawGenerator.md)
* [Sha1Generator](Sha1Generator.md)
