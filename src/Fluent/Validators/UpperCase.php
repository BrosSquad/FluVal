<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


class UpperCase extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional() ?? ctype_upper($value);
    }
}
