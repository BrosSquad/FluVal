<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent\Validators;


use Dusan\PhpMvc\Validation\Fluent\Validators\Alpha;
use PHPUnit\Framework\TestCase;

class AlphaTest extends TestCase
{
    public function test_valid_alpha() {
        $alphaValidator = new Alpha();

        $this->assertTrue($alphaValidator->validate('OnlyAlphaCharacters'));
    }

    public function test_alpha_with_spaces() {
        $alphaValidator = new Alpha();

        $this->assertFalse($alphaValidator->validate('Alpha characters with spaces'));
    }

    public function test_alpha_with_numbers() {
        $alphaValidator = new Alpha();

        $this->assertFalse($alphaValidator->validate('AlphaWithNumbers123900'));
    }
}
