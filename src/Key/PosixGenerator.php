<?php

namespace Clvarley\Cache\Key;

use Clvarley\Cache\KeyGeneratorInterface;

use preg_replace;

/**
 * Makes keys safe according to the POSIX portable filename standard
 *
 * @package Cache
 * @author clvarley
 */
Class PosixGenerator Implements KeyGeneratorInterface
{

    /**
     * Strips out non-POSIX portable characters
     *
     * @param string $subject Subject string
     * @return string         Key
     */
    public function generate( string $subject ) : string
    {
        return preg_replace( '/[^A-Za-z0-9_\-\.]/', '', $subject );
    }
}
