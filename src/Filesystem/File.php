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

    private $filepath;

    public function __construct( string $filepath )
    {
        $this->filepath = $filepath;
    }

    public function exists() : bool
    {
        return is_file( $this->filepath );
    }

    public function write( string $content ) : bool
    {
        return (bool)file_put_contents( $this->filepath, $content, LOCK_EX );
    }

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
