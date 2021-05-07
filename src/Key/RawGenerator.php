<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

/**
 * Just returns the raw text for use as the key
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
     * Simply return the subject as the key
     *
     * @param string $subject Subject string
     * @return string         Subject string
     */
    public function generate( string $subject ) : string
    {
        return $subject;
    }
}
