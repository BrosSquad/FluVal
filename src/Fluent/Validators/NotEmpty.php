<?php


namespace BrosSquad\FluVal\Fluent\Validators;


use BrosSquad\FluVal\Fluent\IValidator;

class NotEmpty implements IValidator
{
    public function validate($value): bool
    {
        if (is_countable($value)) {
            return count($value) > 0;
        }

        if (is_string($value)) {
            return strcmp($value, '') !== 0;
        }
        return !empty($value);
    }
}
