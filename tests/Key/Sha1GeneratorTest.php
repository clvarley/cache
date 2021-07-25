<?php

namespace Clvarley\Cache\Tests\Key;

use PHPUnit\Framework\TestCase;
use Clvarley\Cache\Key\Sha1Generator;

/**
 * @group Key
 */
Class Sha1GeneratorTest Extends TestCase
{

    /**
     * The key generator
     *
     * @var Sha1Generator $generator
     */
    public $generator;

    public function setUp()
    {
        $this->generator = new Sha1Generator();
    }

    /**
     * Make sure the key generator works on simple strings
     */
    public function testSimpleStringKeys()
    {
        // value => expected
        $example_keys = [
            'test'     => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',
            'key.name' => '66e31e9e339042b2128a7a323bc609005d414dd5',
            'key name' => '504a540221fa1a67b73ef4edfbb5529523aafa5c'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected, "Hashing value: $value" );
        }
    }

    /**
     * Make sure the key generator works on simple numeric values
     */
    public function testSimpleNumericKeys()
    {
        $example_keys = [
            123 => '40bd001563085fc35165329ea1ff5c5ecbdbbeef',
            -12 => 'b7a473697b449336ffa89ad58b46ab604991f258',
            0   => 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected, "Hashing value: $value" );
        }
    }

    /**
     * Make sure the key generator behaves correctly with symbol characters
     */
    public function testKeysWithSymbols()
    {
        $example_keys = [
            '#t3st@!*&' => 'a84a276df80b61a2851ea2b3d14ba9206b83d309',
            '@\"[]\\{}' => '975a66d52e4db27143aad5984033100cc703231f',
            '?<php;\'~' => '4571d19d2348346ea81a537b0401808c2492257f'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected, "Hashing value: $value" );
        }
    }
}
