<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

use function sha1;

/**
 * Generator that hashes keys using the SHA1 algorithm
 *
 * @package Cache
 * @author clvarley
 */
Class Sha1Generator Implements KeyGeneratorInterface
{

    /**
     * Create a key using the SHA1 algorithm
     *
     * @param string $subject Subject string
     * @return string         SHA1 key
     */
    public function generate( string $subject ) : string
    {
        return sha1( $subject );
    }
}
