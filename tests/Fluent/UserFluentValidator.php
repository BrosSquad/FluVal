<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent;


use Dusan\PhpMvc\Validation\AbstractValidationModel;
use Dusan\PhpMvc\Validation\Fluent\FluentValidator;

class UserFluentValidator extends FluentValidator
{
    public function __construct(AbstractValidationModel $model)
    {
        parent::__construct($model);
        // Name validation
        $this->forMember('name')
            ->min(3)
            ->withMessage('Name must have at least 3 characters')
            ->max(50)
            ->withMessage('Name cannot have more than 50 characters')
            ->alpha()
            ->withMessage('Name can contain only alpha characters')
            ->pattern('^[A-Z][a-z]+$')
            ->withMessage('Name must start with uppercase letter');

        // Email validation
        $this->forMember('email')
            ->min(5)
            ->withMessage('Email must have at least 5 characters')
            ->max(150)
            ->withMessage('Email cannot have more than 150 characters')
            ->email();

        $this->forMember('accepted')
            ->accepted();

        $this->forMember('password')
            ->min(8)
            ->withMessage('Password must have at least 8 characters');
    }
}
