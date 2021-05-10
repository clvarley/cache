<?php

namespace Clvarley\Cache\Filesystem;

use function rtrim;
use function is_dir;
use function mkdir;
use function rmdir;

/**
 * Utility class for managing directories
 *
 * @package Cache
 * @author clvarley
 */
Class Directory
{

    /**
     * Path to the directory
     *
     * @var string $path Directory path
     */
    private $path;

    /**
     * Creates a new wrapper around the given directorys
     *
     * @param string $path Directory path
     */
    public function __construct( string $path )
    {
        $this->path = rtrim( $path, '\\/' );
    }

    /**
     * Return the absolute path to this directory
     *
     * @return string Directory path
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * Attempt to create this (or a given child) directory
     *
     * @param string $directory Directory path
     * @param int $mode         (Optional) Directory permissions
     * @param bool $recursive   (Optional) Create nested directories?
     * @return Directory|null   Directory
     */
    public function create(
        string $directory = '',
        int $mode = 0755,
        bool $recursive = false
    ) : ?Directory {
        $path = rtrim( "$this->path/$directory", '\\/' );

        // Already exists or we've created it!
        if ( is_dir( $path ) || mkdir( $path, $mode, $recursive ) ) {
            return new self( $path );
        }

        return null;
    }

    /**
     * Check to see if this (or a given child) directory exists
     *
     * @param string $directory Directory path
     * @return bool             Directory exists?
     */
    public function exists( string $directory = '' ) : bool
    {
        $path = rtrim( "$this->path/$directory", '\\/' );

        return is_dir( $path );
    }

    /**
     * Attempt to delete this (or a given child) directory
     *
     * @param string $directory Directory path
     * @return bool             Directory deleted?
     */
    public function delete( string $directory = '' ) : bool
    {
        $path = rtrim( "$this->path/$directory", '\\/' );

        return rmdir( $path );
    }
}
