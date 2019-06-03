<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent\Validators;


use Dusan\PhpMvc\Validation\Fluent\Validators\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_valid_email() {
        $emailValidator = new Email();

        $this->assertTrue($emailValidator->validate('test@test.com'));
    }

    public function test_invalid_email() {
        $emailValidator = new Email();

        $this->assertFalse($emailValidator->validate('test@localhost'));
    }
}
