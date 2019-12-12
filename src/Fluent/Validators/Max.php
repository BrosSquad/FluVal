<?php

declare(strict_types = 1);

namespace BrosSquad\FluVal\Fluent\Validators;


use TypeError;

class Max extends AbstractFluentValidator
{
    private $max;

    public function __construct($max, bool $required = false)
    {
        parent::__construct($required);
        if (!is_numeric($max)) {
            throw new TypeError('$max must be integer or float');
        }
        $this->max = $max;
    }

    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }
        if (is_numeric($value)) {
            return $value < $this->max;
        }

        if (is_string($value)) {
            return mb_strlen($value) < $this->max;
        }

        if (is_countable($value)) {
            return count($value) < $this->max;
        }

        throw new TypeError('Value must be array, string or number');
    }
}
