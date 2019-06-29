<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


class Numeric extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }
        if (ctype_digit($value) === true) {
            return true;
        }
        return is_int($value) || is_float($value);
    }
}
