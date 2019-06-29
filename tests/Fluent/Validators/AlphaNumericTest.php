<?php


namespace BrosSquad\FluVal\Tests\Fluent\Validators;


use BrosSquad\FluVal\Fluent\Validators\AlphaNumeric;
use PHPUnit\Framework\TestCase;

class AlphaNumericTest extends TestCase
{
    public function test_valid_alpha() {
        $alphaValidator = new AlphaNumeric();

        $this->assertTrue($alphaValidator->validate('OnlyAlphaCharacters'));
    }

    public function test_alpha_numeric_characters() {
        $alphaValidator = new AlphaNumeric();
        $this->assertTrue($alphaValidator->validate('AlphaNumericCharacters12369500'));
    }

    public function test_alpha_numeric_characters_with_spaces() {
        $alphaValidator = new AlphaNumeric();
        $this->assertFalse($alphaValidator->validate('AlphaNumericCharacters12369500 with spaces'));
    }
}
