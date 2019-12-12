<?php

namespace BrosSquad\FluVal\Fluent\Validators;


class Username extends AbstractFluentValidator
{

    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }
        $regex = "#^(?=[a-zA-Z])[-\w.]+([a-zA-Z\d]|(?<![-.])_)$#";
        return preg_match($regex, $value);
    }
}
