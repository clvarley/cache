<?php

namespace Clvarley\Cache\Tests\Key;

use PHPUnit\Framework\TestCase;
use Clvarley\Cache\Key\Md5Generator;

/**
 * @group Key
 */
Class Md5GeneratorTest Extends TestCase
{

    /**
     * The key generator
     *
     * @var Md5Generator $generator
     */
    public $generator;

    public function setUp()
    {
        $this->generator = new Md5Generator();
    }

    /**
     * Make sure the key generator works on simple strings
     */
    public function testSimpleStringKeys()
    {
        // value => expected
        $example_keys = [
            'test'     => '098f6bcd4621d373cade4e832627b4f6',
            'key.name' => 'a5c70e775c8c1bdec83ebed9e6f9be8e',
            'key name' => 'ab692e6a35e26725ab520c4d000ea7db'
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
            123 => '202cb962ac59075b964b07152d234b70',
            -12 => '29fe3cef22985ae07803bf456b8947dc',
            0   => 'cfcd208495d565ef66e7dff9f98764da'
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
            '#t3st@!*&' => 'a662db8e526573f6cb1a52658670ee5a',
            '@\"[]\\{}' => '67030177a8d8e88f3a3949b450f14fce',
            '?<php;\'~' => 'fe81201a10da910f900428842f1f7967'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected, "Hashing value: $value" );
        }
    }
}
