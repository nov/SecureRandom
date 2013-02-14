<?php

require_once 'SecureRandom.php';

class SecureRandomTest extends PHPUnit_Framework_TestCase
{
    function setup() {
        $this->custom_byte_length = SecureRandom::DEFAULT_BYTE_LENGTH * 2;
    }

    /**
     * @todo How to test?
     */
    function testOpenSSLNotFound() {
        $this->markTestIncomplete('How to test?');
    }

    /**
     * @todo How to test?
     */
    function testOpenSSLNotAvailable() {
        $this->markTestIncomplete('How to test?');
    }

    function testBytes() {
        $this->assetOutputLength(
            SecureRandom::bytes(),
            SecureRandom::DEFAULT_BYTE_LENGTH
        );
    }

    function testBytesWithCustomLength() {
        $this->assetOutputLength(
            SecureRandom::bytes($this->custom_byte_length),
            $this->custom_byte_length
        );
    }

    function testHex() {
        $this->assetOutputLength(
            SecureRandom::hex(),
            SecureRandom::DEFAULT_BYTE_LENGTH * 2
        );
    }

    function testHexWithCustomLength() {
        $this->assetOutputLength(
            SecureRandom::hex($this->custom_byte_length),
            $this->custom_byte_length * 2
        );
    }

    function testBase64() {
        $this->assetOutputLength(
            SecureRandom::base64(),
            ceil(SecureRandom::DEFAULT_BYTE_LENGTH / 3) * 4
        );
    }

    function testBase64WithCustomLength() {
        $this->assetOutputLength(
            SecureRandom::base64($this->custom_byte_length),
            ceil($this->custom_byte_length / 3) * 4
        );
    }

    private function assetOutputLength($output, $expected_byte_length)
    {
        $this->assertEquals(
            $expected_byte_length,
            strlen($output),
            "should return $expected_byte_length bytes of string."
        );
    }
}