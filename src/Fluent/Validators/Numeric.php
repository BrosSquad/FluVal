<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


class Numeric extends AbstractFluentValidator
{
    protected $integerFlags;

    public function __construct(int $integerFlags = Integer::HEX | Integer::OCTAL)
    {
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
