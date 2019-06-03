<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


use Dusan\PhpMvc\Validation\Fluent\IValidator;

class NotEmpty implements IValidator
{
    public function validate($value): bool
    {
        if(is_countable($value)) {
            return count($value) > 0;
        } else if(is_string($value)) {
            return mb_strlen($value) > 0;
        }
        return !empty($value);
    }
}
