<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

/**
 * Generator that simply returns the raw key
 *
 * Useful for easy refactoring or if you want to be able to control your cache
 * keys directly, without them being run through a hashing algorithm.
 *
 * @package Cache
 * @author clvarley
 */
Class RawGenerator Implements KeyGeneratorInterface
{

    /**
     * Simply return the provided subject
     *
     * @param string $subject Subject string
     * @return string         Subject string
     */
    public function generate( string $subject ) : string
    {
        return $subject;
    }
}
