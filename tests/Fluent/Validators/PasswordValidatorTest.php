<?php


namespace BrosSquad\FluVal\Tests\Fluent\Validators;


use BrosSquad\FluVal\Fluent\Validators\Password;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    public function test_password_validation_good_password() {
        $password = 'ThisisReallyGoodPa$$word123';

        $passwordValidator = new Password();

        $this->assertTrue($passwordValidator->validate($password));
    }

    public function test_bad_password() {
        $password = 'thisisbadpassword12';

        $passwordValidator = new Password();

        $this->assertFalse($passwordValidator->validate($password));
    }
}
