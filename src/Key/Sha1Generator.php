<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

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
     * Create a key using the MD5 algorithm
     *
     * @param string $subject Subject string
     * @return string         SHA1 key
     */
    public function generate( string $subject ) : string
    {
        return sha1( $subject );
    }
}
