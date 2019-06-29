<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class Alpha extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional($value) ?? ctype_alpha($value);
    }
}
