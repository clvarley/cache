<?php

namespace Cache;

/**
 * Adapters used to generate cache keys
 *
 * @package Cache
 * @author clvarley
 */
Interface KeyGeneratorInterface
{

    /**
     * Generate a key from the provided string
     *
     * @param string $subject Subject string
     * @return string         Key
     */
    public function generate( string $subject ) : string;

}
