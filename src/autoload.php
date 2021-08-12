<?php
/**
 * Basic autoloader for developers not using composer
 *
 * While the preferred method of using this library is to install and autoload
 * via Composer, sometimes it can be helpful to just include the files directly.
 *
 * ```php
 * // Replace '...' with correct path
 * require_once '.../src/autoload.php';
 * ```
 *
 * @package Cache
 * @author clvarley
 */

// Register our custom handler
spl_autoload_register( function ( string $classname ) : void {
    // Not one of ours
    if ( substr( $classname, 0, 14 ) !== 'Clvarley\Cache' ) {
        return;
    }

    // Remove the namespace
    $classfile = substr( $classname, 15 );

    // Use correct path separator
    $classfile = strtr( $classfile, '\\', DIRECTORY_SEPARATOR );
    $classfile = __DIR__ . "/$classfile.php";

    /** @psalm-suppress UnresolvableInclude */
    require_once $classfile;
});
