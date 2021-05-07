<?php

namespace Cache\Filesystem;

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
    protected $path;

    /**
     * Creates a new wrapper around the given directorys
     *
     * @param string $path Directory path
     */
    public function __construct( string $path )
    {
        $this->path = trim( $path, '\\/' );
    }

    /**
     * Attempt to create this (or a given child) directory
     *
     * @param string $directory Directory path
     * @param int $mode         (Optional) Directory permissions
     * @param bool $recursive   (Optional) Create nested directories?
     * @return bool             Directory created?
     */
    public function create(
        string $directory = '',
        int $mode = 0664,
        bool $recursive = false
    ) : bool {
        $path = "$this->path/$directory";

        // Already exists!
        if ( is_dir( $path ) ) {
            return true;
        }

        return mkdir( $path, $mode, $recursive );
    }

    /**
     * Check to see if this (or a given child) directory exists
     *
     * @param string $directory Directory path
     * @return bool             Directory exists?
     */
    public function exists( string $directory = '' ) : bool
    {
        return is_dir( "$this->path/$directory" );
    }

    /**
     * Attempt to delete this (or a given child) directory
     *
     * @param string $directory Directory path
     * @return bool             Directory deleted?
     */
    public function delete( string $directory = '' ) : bool
    {
        $path = "$this->path/$directory";

        return rmdir( $path );
    }
}
