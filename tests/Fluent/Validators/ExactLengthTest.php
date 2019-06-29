<?php


namespace BrosSquad\FluVal\Tests\Fluent\Validators;


use BrosSquad\FluVal\Fluent\Validators\ExactLength;
use PHPUnit\Framework\TestCase;

class ExactLengthTest extends TestCase
{
    public function test_length_for_arrays() {
        $lengthValidator = new ExactLength(2);

        $this->assertTrue($lengthValidator->validate(['item1', 'item2']));
    }

    public function test_length_for_strings() {
        $lengthValidator = new ExactLength(4);

        $this->assertTrue($lengthValidator->validate('Test'));
    }
}
