<?php

/**
 * Basic autoloader for developers not using composer
 *
 * While the preferred method of using this library is to install and autoload
 * via Composer, sometimes it can be helpfull to just include the files
 * directly.
 */
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

    require_once $classfile;
});
