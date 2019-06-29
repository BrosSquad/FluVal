<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


class Email extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional($value) ??
            filter_var($value, FILTER_VALIDATE_EMAIL, ['flags' => FILTER_NULL_ON_FAILURE]) !== NULL;
    }
}
