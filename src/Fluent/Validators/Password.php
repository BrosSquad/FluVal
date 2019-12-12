<?php

namespace BrosSquad\FluVal\Fluent\Validators;

use BrosSquad\FluVal\Fluent\IValidator;

class Password extends AbstractFluentValidator
{
    protected string $regex = '#(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#';

    public function validate($value): bool
    {
        return $this->optional($value) ?? preg_match($this->regex ,$value);
    }
}
