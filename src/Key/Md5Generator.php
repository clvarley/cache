<?php

namespace Cache\Key;

use Cache\KeyGeneratorInterface;

use function md5;

/**
 * MD5 based key generator
 *
 * @package Cache
 * @author clvarley
 */
Class Md5Generator Implements KeyGeneratorInterface
{

    /**
     * Creates a key using the MD5 algorithm
     *
     * @param string $subject Subject string
     * @return string         MD5 key
     */
    public function generate( string $subject ) : string
    {
        return md5( $subject );
    }
}
