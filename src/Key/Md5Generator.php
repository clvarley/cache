<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

use function md5;

/**
 * Generator that hashes keys using the Crc32 algorithm
 *
 * @package Cache
 * @author clvarley
 */
Class Md5Generator Implements KeyGeneratorInterface
{

    /**
     * Create a key using the Md5 algorithm
     *
     * @param string $subject Subject string
     * @return string         MD5 key
     */
    public function generate( string $subject ) : string
    {
        return md5( $subject );
    }
}
