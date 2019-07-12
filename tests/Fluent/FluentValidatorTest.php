<?php


namespace BrosSquad\FluVal\Tests\Fluent;

use BrosSquad\FluVal\Fluent\FluentValidator;
use PHPUnit\Framework\TestCase;

class FluentValidatorTest extends TestCase
{
    public function test_fluent_validation()
    {
        $user = new User('Dusan', 'test@test.com', true, 'Pa$$w0rd');
        $fluentValidator = new UserFluentValidator($user);

        $this->assertNull($fluentValidator->validate(FluentValidator::BREAK_ON_ERROR));
    }

    public function test_fluent_validation_messages_on_error()
    {
        $user = new User('D', 'test@test.com', true, 'Pa$$w0rd');
        $fluentValidator = new UserFluentValidator($user);
        $errors = $fluentValidator->validate();
        $this->assertIsArray($errors);
        $this->assertCount(1, $errors);
        $this->assertIsArray($errors['First Name']);
        $this->assertCount(2, $errors['First Name']);
        $this->assertEquals('Name must have at least 3 characters', $errors['First Name'][0]);
        $this->assertEquals('Name must have at least 3 characters', $errors['First Name'][0]);
    }
}
