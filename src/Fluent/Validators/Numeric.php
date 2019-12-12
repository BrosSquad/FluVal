<?php

declare(strict_types = 1);

namespace BrosSquad\FluVal\Fluent\Validators;


class Numeric extends AbstractFluentValidator
{
    protected int $integerFlags;

    public function __construct(int $integerFlags = Integer::HEX | Integer::OCTAL, bool $required = false)
    {
        parent::__construct($required);

        $this->integerFlags = $integerFlags;
    }

    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }

        if (ctype_digit($value) === true) {
            return true;
        }

        return (new Integer($this->integerFlags))->validate($value) || (new FloatingPoint())->validate($value);
    }
}
