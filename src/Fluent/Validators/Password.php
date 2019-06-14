<?php

namespace Dusan\PhpMvc\Validation\Fluent\Validators;

class Password  extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        $regex = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$";
        return preg_match($regex ,$value);
    }
}