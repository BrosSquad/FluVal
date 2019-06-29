<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class IP extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        if($this->optional($value) === true) {
            return true;
        }
        return filter_var($value, FILTER_VALIDATE_IP, ['flags' => FILTER_NULL_ON_FAILURE]) !== null;
    }
}
