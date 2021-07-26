# File

Available since version 1.0.0

## About

Utility class used to interact with text files.

## Overview

```php
namespace Clvarley\Cache\Filesystem;

Class File {

    /* Properties */
    private string $filepath;

    /* Methods */
    public function __construct( string $filepath );
    public function exists() : bool;
    public function write( string $content ) : bool;
    public function read() : string;
}
```

## Properties

<dl>
  <dt>filepath</dt>
  <dd>Path to the current text file</dd>
</dl>

## Methods
### __construct

Creates a new wrapper around the given text file.

```php
public function __construct( string $filepath );
```

#### Parameters

<dl>
  <dt>filepath</dt>
  <dd>Absolute path to file</dd>
</dl>

### exists

Check to see if this file exists.

```php
public function exists() : bool;
```

#### Parameters

This function has no parameters.

#### Return Value

Returns a boolean indicating if the file exists.

### write

Attempt to write content to the file.

```php
public function write( string $content ) : bool;
```

#### Parameters

<dl>
  <dt>content</dt>
  <dd>Content to be written</dd>
</dl>

#### Return Value

Returns a boolean indicating if the write was successful.

### read

Attempt to read content from the file.

```php
public function read() : string;
```

#### Parameters

This function has no parameters.

#### Return Value

Returns the file contents on success or an empty string on failure.

## See Also

* [Directory](Directory.md)
* [FileCache](../FileCache.md)
