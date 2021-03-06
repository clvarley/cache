<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

use function hash;

/**
 * Generator that hashes keys using the Crc32 algorithm
 *
 * @package Cache
 * @author clvarley
 */
Class Crc32Generator Implements KeyGeneratorInterface
{

    /**
     * Create a key using the CRC32 algorithm
     *
     * @param string $subject Subject string
     * @return string         CRC32 key
     */
    public function generate( string $subject ) : string
    {
        return hash( 'crc32b', $subject );
    }
}
