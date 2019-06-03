<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent\Validators;


use Dusan\PhpMvc\Validation\Fluent\Validators\Equals;
use PHPUnit\Framework\TestCase;

class EqualsTest extends TestCase
{
    public function test_equals_for_string()
    {
        $equals = new Equals('new string');

        $this->assertTrue($equals->validate('new string'));
    }

    public function test_string_not_equal()
    {
        $equals = new Equals('new string');

        $this->assertFalse($equals->validate('string not equal'));
    }


    public function test_integer_equality()
    {
        $equals = new Equals(5);

        $this->assertTrue($equals->validate(5));
    }

    public function test_floats_equality()
    {
        $equals = new Equals(3.647);

        $this->assertTrue($equals->validate(3.647));
    }

    public function test_null_equality()
    {
        $equals = new Equals(NULL);

        $this->assertTrue($equals->validate(NULL));
    }

    public function test_equality_int_with_float()
    {
        $equals = new Equals(10.5);

        $this->assertFalse($equals->validate(10));
    }
}
