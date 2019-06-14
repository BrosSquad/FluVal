<?php

namespace Dusan\PhpMvc\Validation\Fluent\Validators;

class Username extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        $regex = "#^(?=[a-zA-Z])[-\w.]+([a-zA-Z\d]|(?<![-.])_)$#";
        return preg_match($regex ,$value);
    }
}
