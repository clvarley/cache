# Directory

Available since version 1.0.0

## About

Utility class for managing directories.

## Overview

```php
namespace Clvarley\Cache\Filesystem;

Class Directory
{

    /* Properties */
    private string $path;

    /* Methods */
    public function __construct( string $path );
    public function getPath() : string;
    public function exists( string $directory = '' ) : bool;
    public function create( string $directory = '', int $mode = 0755, bool $recursive = false ) : ?Directory;
    public function delete( string $directory = '' ) : bool;
}
```

## Properties

<dl>
  <dt>path</dt>
  <dd>Path to the directory</dd>
</dl>

## Methods
### *__construct*

Creates a new wrapper around the given directory.

```php
public function __construct( string $path );
```

#### Parameters

<dl>
  <dt>path</dt>
  <dd>Absolute path to the directory</dd>
</dl>

### *getPath*

Return the absolute path to this directory

```php
public function getPath() : string;
```

#### Parameters

This function has no parameters.

#### Return Value

Returns the absolute path to this directory.

### *exists*

Check to see if this (or a named child) directory exists.

```php
public function exists( string $directory = '' ) : bool;
```

#### Parameters

<dl>
  <dt>directory</dt>
  <dd>
    <p>Child directory path</p>
    <p>If left empty, will check for the existance of the current directory instead.</p>
  </dd>
</dl>

#### Return Value

Returns a boolean indicating if the directory exists.

### *create*

Attempt to create this (or a named child) directory

```php
public function create( string $directory = '', int $mode = 0755, bool $recursive = false ) : ?Directory;
```

#### Parameters

<dl>
  <dt>directory</dt>
  <dd>
    <p>Child directory name</p>
    <p>If left empty, will attempt to create the current directory instead.</p>
  </dd>
  <dt>mode</dt>
  <dd>
    <p>Directory permissions</p>
    <p>Takes an octal value, representing the permissions/mode to use when
    creating the directory. For more info, see the PHP <a href="https://www.php.net/manual/en/function.mkdir.php">mkdir<a/> function.</p>
    <p>If left empty, defaults to 0755.</p>
  </dd>
  <dt>recursive</dt>
  <dd>
    <p>Create nested directories?</p>
    <p>If left empty, defaults to false.</p>
  </dd>
</dl>

#### Return Value

Returns a new `Directory` instance or **null** on failure.

### *delete*

Attempt to delete this (or a named child) directory

```php
public function delete( string $directory = '' ) : bool;
```

#### Parameters

<dl>
  <dt>directory</dt>
  <dd>
    <p>Child directory name</p>
    <p>If left empty, will attempt to delete the current directory instead.</p>
  </dd>
</dl>

#### Return Value

Returns a boolean indicating if the directory was successfully deleted.

## See Also

* [File](File.md)
* [FileCache](../FileCache.md)
