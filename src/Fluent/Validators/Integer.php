<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class Integer extends AbstractFluentValidator
{

    public function validate($value): bool
    {
        return $this->optional($value) ?? is_int($value);
    }
}
