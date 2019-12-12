<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class FloatingPoint extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional($value) ??
               (is_float($value) || (filter_var($value, FILTER_VALIDATE_FLOAT) !== false));
    }
}
