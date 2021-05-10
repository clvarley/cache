<?php

namespace Clvarley\Cache\Filesystem;

use function is_file;
use function file_put_contents;
use function file_get_contents;

use const LOCK_EX;

/**
 * Utility class for managing files
 *
 * @package Cache
 * @author clvarley
 */
Class File
{

    /**
     * Path to the cache file
     *
     * @var string $filepath File path
     */
    private $filepath;

    /**
     * Creates a new wrapper around the given cache file
     *
     * @param string $filepath File path
     */
    public function __construct( string $filepath )
    {
        $this->filepath = $filepath;
    }

    /**
     * Check to see if this file exists
     *
     * @return bool File exists?
     */
    public function exists() : bool
    {
        return is_file( $this->filepath );
    }

    /**
     * Attempt to write content to the given file
     *
     * @param string $content File content
     * @return bool           Write successful?
     */
    public function write( string $content ) : bool
    {
        return (bool)file_put_contents( $this->filepath, $content, LOCK_EX );
    }

    /**
     * Attempt to read content from the given file
     *
     * @return string File content
     */
    public function read() : string
    {
        // TODO: Possibly throw exception?
        if ( !$this->exists() ) {
            return '';
        }

        $content = file_get_contents( $this->filepath );
        $content = (string)$content;

        return $content;
    }
}
