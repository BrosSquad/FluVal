<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


use TypeError;

class ExactLength extends AbstractFluentValidator
{
    /**
     * @var int
     */
    private int $length;

    public function __construct(int $length, bool $required = false)
    {
        parent::__construct($required);
        $this->length = $length;
    }

    /**
     * @param string|array|integer|float|object $value
     *
     * @throws TypeError
     * @return bool
     */
    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }
        if (is_string($value)) {
            return mb_strlen($value) === $this->length;
        }

        if (is_countable($value)) {
            return count($value) === $this->length;
        }

        throw new TypeError('$value must be string or countable');
    }
}
