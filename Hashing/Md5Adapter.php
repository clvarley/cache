<?php

namespace Cache\Hashing;

use Cache\HashInterface;

use function md5;

/**
 * Hash adapter for the MD5 algorithm
 *
 * @package Cache
 * @author clvarley
 */
Class Md5Adapter Implements HashInterface
{

    /**
     * Hash the string using the MD5 algorithm
     *
     * @param string $subject Subject string
     * @return string         MD5 hash
     */
    public function hash( string $subject ) : string
    {
        return md5( $subject );
    }
}
