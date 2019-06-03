<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


class FloatingPoint extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional() ?? is_float($value);
    }
}
