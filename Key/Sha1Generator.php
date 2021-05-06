<?php

namespace Cache\Key;

use Cache\KeyGeneratorInterface;

use function sha1;

/**
 * SHA1 based key generator
 *
 * @package Cache
 * @author clvarley
 */
Class Sha1Generator Implements KeyGeneratorInterface
{

    /**
     * Creates a key using the MD5 algorithm
     *
     * @param string $subject Subject string
     * @return string         SHA1 key
     */
    public function hash( string $subject ) : string
    {
        return sha1( $subject );
    }
}
