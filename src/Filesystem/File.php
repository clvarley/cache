<?php

namespace Clvarley\Cache\Filesystem;

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
        // TODO:
    }

    public function write( string $content ) : bool
    {
        // TODO:
    }

    public function read() : string
    {
        // TODO:
    }
}
