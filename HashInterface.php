<?php

namespace Cache;

/**
 * Adapters used to provide string hashing
 *
 * @package Cache
 * @author clvarley
 */
Interface HashInterface
{

    /**
     * Hash the subject using the appropriate algorithm
     *
     * @param string $subject Subject string
     * @return string         Hash
     */
    public function hash( string $subject ) : string;

}
