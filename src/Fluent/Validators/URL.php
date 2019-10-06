<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


class URL extends AbstractFluentValidator
{
    public const PATH_REQUIRED = FILTER_FLAG_PATH_REQUIRED;
    public const QUERY_REQUIRED = FILTER_FLAG_QUERY_REQUIRED;

    public function validate($value): bool
    {
        return $this->optional($value) ??
            filter_var($value, FILTER_VALIDATE_URL, ['flags' => FILTER_NULL_ON_FAILURE]) !== false;
    }
}
