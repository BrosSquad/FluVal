<?php

namespace BrosSquad\FluVal\Fluent\Validators;

use BrosSquad\FluVal\Fluent\IValidator;

class Username implements IValidator
{
    public function validate($value): bool
    {
        $regex = "#^(?=[a-zA-Z])[-\w.]+([a-zA-Z\d]|(?<![-.])_)$#";
        return preg_match($regex ,$value);
    }
}
