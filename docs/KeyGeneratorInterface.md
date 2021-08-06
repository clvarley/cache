# KeyGeneratorInterface

Available since version 1.0.0

## About

Contract for all classes that can hash cache keys.

## Overview

```php
namespace Clvarley\Cache;

Interface KeyGeneratorInterface
{

    /* Methods */
    public function generate( string $subject ) : string;
}
```

## Methods
### *generate*

Generate a hash from the provided string.

```php
public function generate( string $subject ) : string;
```

#### Parameters

<dl>
  <dt>subject</dt>
  <dd>Subject string.</dd>
</dl>

#### Return Value

Returns the hashed subject.

## See Also

* [Crc32Generator](Key/Crc32Generator.md)
* [Md5Generator](Key/Md5Generator.md)
* [PosixGenerator](Key/PosixGenerator.md)
* [RawGenerator](Key/RawGenerator.md)
* [Sha1Generator](Key/Sha1Generator.md)
