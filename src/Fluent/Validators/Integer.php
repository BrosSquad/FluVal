<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


class Integer extends AbstractFluentValidator
{

    public function validate($value): bool
    {
        return is_int($value);
    }
}
