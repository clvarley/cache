<?php

namespace Clvarley\Cache\Tests\Key;

use PHPUnit\Framework\TestCase;
use Clvarley\Cache\Key\Crc32Generator;

/**
 * @group Key
 */
Class Crc32GeneratorTest Extends TestCase
{

    /**
     * The key generator
     *
     * @var Crc32Generator $generator
     */
    public $generator;

    public function setUp()
    {
        $this->generator = new Crc32Generator();
    }

    /**
     * Make sure the key generator works on simple strings
     */
    public function testSimpleStringKeys()
    {
        // value => expected
        $example_keys = [
            'test'     => 'd87f7e0c',
            'key.name' => '1c966cb0',
            'key name' => 'a3a6d2d1'
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
            123 => '884863d2',
            -12 => 'c15e5a93',
            0   => 'f4dbdf21'
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
            '#t3st@!*&' => '72fd8e32',
            '@\"[]\\{}' => '13d369b7',
            '?<php;\'~' => 'da152460'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected, "Hashing value: $value" );
        }
    }
}
