<?php


namespace BrosSquad\FluVal\Tests\Fluent;

use BrosSquad\FluVal\Fluent\FluentValidator;
use PHPUnit\Framework\TestCase;

class FluentValidatorTest extends TestCase
{
    public function test_fluent_validation(): void
    {
        $user = new User('Dusan', 'test@test.com', true, 'password123');
        $fluentValidator = new UserFluentValidator($user);

        self::assertNull($fluentValidator->validate(FluentValidator::BREAK_ON_ERROR));
    }

    public function test_fluent_validation_messages_on_error(): void
    {
        $user = new User('D', 'test@test.com', true, 'password123');
        $fluentValidator = new UserFluentValidator($user);
        $errors = $fluentValidator->validate();
        self::assertIsArray($errors);
        self::assertCount(1, $errors);
        self::assertIsArray($errors['FirstName']);
        self::assertCount(2, $errors['FirstName']);
        self::assertEquals('Name must have at least 3 characters', $errors['FirstName'][0]);
        self::assertEquals('Name must have at least 3 characters', $errors['FirstName'][0]);
    }

    public function test_fluent_on_valid_model(): void
    {
        $user = new User('Dusan', 'test@test.com', true, 'password123');
        $fluentValidator = new UserFluentValidator($user);
        $errors = $fluentValidator->validate();
        self::assertNull($errors);
    }
}
