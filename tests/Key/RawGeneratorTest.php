<?php

namespace Clvarley\Cache\Tests\Key;

use PHPUnit\Framework\TestCase;
use Clvarley\Cache\Key\RawGenerator;

/**
 * @group Key
 */
Class RawGeneratorTest Extends TestCase
{

    /**
     * The key generator
     *
     * @var RawGenerator $generator
     */
    public $generator;

    public function setUp() : void
    {
        $this->generator = new RawGenerator();
    }

    /**
     * Make sure the key generator works on simple strings
     */
    public function testCanHashSimpleStrings()
    {
        // value => expected
        $example_keys = [
            'test'     => 'test',
            'key.name' => 'key.name',
            'key name' => 'key name'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected );
        }
    }

    /**
     * Make sure the key generator works on simple numeric values
     */
    public function testCanHashNumericStrings()
    {
        $example_keys = [
            123 => '123',
            -12 => '-12',
            0   => '0'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected );
        }
    }

    /**
     * Make sure the key generator behaves correctly with symbol characters
     */
    public function testCanHashStringsWithSymbols()
    {
        $example_keys = [
            '#t3st@!*&' => '#t3st@!*&',
            '@\"[]\\{}' => '@\"[]\\{}',
            '?<php;\'~' => '?<php;\'~'
        ];

        foreach ( $example_keys as $value => $expected ) {
            $key = $this->generator->generate( $value );

            $this->assertEquals( $key, $expected );
        }
    }
}
