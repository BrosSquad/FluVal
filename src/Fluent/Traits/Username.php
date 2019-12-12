<?php

namespace BrosSquad\FluVal\Fluent\Traits;

use BrosSquad\FluVal\Fluent\Validators\Username as UsernameValidator;

use BrosSquad\FluVal\Fluent\Validation;

trait Username
{
    final public function username(bool $isOptional = false): Validation
    {
        return $this->customValidator(new UsernameValidator(), 'Username can\'t contain special characters.');
    }
}