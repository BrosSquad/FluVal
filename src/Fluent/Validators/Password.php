<?php

namespace BrosSquad\FluVal\Fluent\Validators;

use BrosSquad\FluVal\Fluent\IValidator;

class Password implements IValidator
{
    public function validate($value): bool
    {
        $regex = '#(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#';
        return preg_match($regex ,$value);
    }
}
