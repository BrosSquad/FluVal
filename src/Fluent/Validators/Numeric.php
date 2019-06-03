<?php
declare(strict_types=1);

namespace Dusan\PhpMvc\Validation\Fluent\Validators;


class Numeric extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        if ($this->optional() === true) {
            return true;
        }
        if (ctype_digit($value) === true) {
            return true;
        }
        return is_int($value) || is_float($value);
    }
}
