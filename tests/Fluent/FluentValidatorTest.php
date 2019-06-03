<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent;




use PHPUnit\Framework\TestCase;

class FluentValidatorTest extends TestCase
{
    public function test_fluent_validation() {
        $user = new User('Dusan', 'test@test.com', true, 'somePassword');
        $fluentValidator = new UserFluentValidator($user);

        $this->assertNull($fluentValidator->validate());
    }

    public function test_fluent_validation_messages_on_error() {
        $user = new User('D', 'test@test.com', true, 'somePassword');
        $fluentValidator = new UserFluentValidator($user);
        $errors = $fluentValidator->validate();
        $this->assertIsArray($errors);
        $this->assertCount(1, $errors);
        $this->assertIsArray($errors['name']);
        $this->assertCount(2, $errors['name']);
        $this->assertEquals('Name must have at least 3 characters', $errors['name'][0]);
        $this->assertEquals('Name must have at least 3 characters', $errors['name'][0]);
    }
}
