<?php


namespace BrosSquad\FluVal\Tests\Fluent\Validators;


use BrosSquad\FluVal\Fluent\Validators\Between;
use PHPUnit\Framework\TestCase;

class BetweenTest extends TestCase
{
    public function test_between_for_ints()
    {
        $betweenValidator = new Between(1, 5);

        $this->assertTrue($betweenValidator->validate(2));
    }

    public function test_between_for_floats()
    {
        $betweenValidator = new Between(1, 5);

        $this->assertTrue($betweenValidator->validate(3.5));
    }

    public function test_between_underflow_integer()
    {
        $betweenValidator = new Between(1, 5);

        $this->assertFalse($betweenValidator->validate(-5));
    }

    public function test_overflow_ints()
    {
        $betweenValidator = new Between(1, 5);

        $this->assertFalse($betweenValidator->validate(8));
    }

    public function test_between_for_string()
    {
        $betweenValidator = new Between(1, 8);

        $this->assertTrue($betweenValidator->validate('String'));
    }

    public function test_between_for_string_overflow()
    {
        $betweenValidator = new Between(1, 4);

        $this->assertFalse($betweenValidator->validate('String'));
    }

    public function test_between_for_string_empty()
    {
        $betweenValidator = new Between(1, 8);

        $this->assertTrue($betweenValidator->validate(''));
    }

    public function test_between_for_arrays() {
        $betweenValidator = new Between(1, 8);

        $this->assertTrue($betweenValidator->validate(['item1','item2']));
    }

    public function test_between_for_empty_arrays() {
        $betweenValidator = new Between(1, 8);

        $this->assertTrue($betweenValidator->validate([]));
    }
}
