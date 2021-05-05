<?php

namespace Cache\Hashing;

use Cache\HashInterface;

use function sha1;

/**
 * Hash adapter for the SHA1 algorithm
 *
 * @package Cache
 * @author clvarley
 */
Class Sha1Adapter Implements HashInterface
{

    /**
     * Hash the string using the SHA1 algorithm
     *
     * @param string $subject Subject string
     * @return string         SHA1 hash
     */
    public function hash( string $subject ) : string
    {
        return sha1( $subject );
    }
}
