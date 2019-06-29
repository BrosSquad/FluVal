<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;

class HexNumber extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional($value) ?? ctype_xdigit($value);
    }
}
