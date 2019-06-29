<?php
declare(strict_types=1);

namespace BrosSquad\FluVal\Fluent\Validators;


use TypeError;

class ExactLength extends AbstractFluentValidator
{
    /**
     * @var int
     */
    private $length;

    public function __construct(int $length)
    {
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
        } else if (is_countable($value)) {
            return count($value) === $this->length;
        } else {
            throw new TypeError('$value must be string or countable');
        }
    }
}
