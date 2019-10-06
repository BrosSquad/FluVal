<?php


namespace BrosSquad\FluVal\Tests\Fluent\Validators;


use BrosSquad\FluVal\Fluent\Validators\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_valid_email() {
        $emailValidator = new Email();

        $this->assertTrue($emailValidator->validate('dusan.998@outlook.com'));
    }

    public function test_invalid_email() {
        $emailValidator = new Email();

        $this->assertFalse($emailValidator->validate('some random string that is not email'));
    }
}
