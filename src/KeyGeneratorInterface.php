<?php

namespace Clvarley\Cache;

/**
 * Contract for all classes that can hash cache keys
 *
 * @package Cache
 * @author clvarley
 */
Interface KeyGeneratorInterface
{

    /**
     * Generate a hash from the provided string
     *
     * @param string $subject Subject string
     * @return string         Hashed subject
     */
    public function generate( string $subject ) : string;

}
