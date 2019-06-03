<?php
declare(strict_types=1);

namespace Dusan\PhpMvc\Validation\Fluent\Validators;

class AlphaNumeric extends AbstractFluentValidator
{
    public function validate($value): bool
    {
        return $this->optional($value) ?? ctype_alnum($value);
    }
}
