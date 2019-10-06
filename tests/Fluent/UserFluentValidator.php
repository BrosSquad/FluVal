<?php

namespace BrosSquad\FluVal\Tests\Fluent;

use BrosSquad\FluVal\Fluent\FluentValidator;
use BrosSquad\FluVal\ValidationModel;

class UserFluentValidator extends FluentValidator
{
    public function __construct(ValidationModel $model)
    {
        parent::__construct($model);
        // Name validation
        $this->forMember('name', 'FirstName')
            ->notEmpty()
            ->withMessage('Name must not be empty')
            ->min(3)
            ->withMessage('Name must have at least 3 characters')
            ->max(50)
            ->withMessage('Name cannot have more than 50 characters')
            ->alpha()
            ->withMessage('Name can contain only alpha characters')
            ->pattern('^[A-Z][a-z]+$')
            ->withMessage('Name must start with uppercase letter');

        // Email validation
        $this->forMember('email', 'Email')
            ->min(5)
            ->withMessage('Email must have at least 5 characters')
            ->max(150)
            ->withMessage('Email cannot have more than 150 characters')
            ->email();

        $this->forMember('accepted', 'accept')
            ->accepted();

        $this->forMember('password', 'Password')
            ->password();
    }
}
