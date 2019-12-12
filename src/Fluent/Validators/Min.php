<?php

declare(strict_types = 1);

namespace BrosSquad\FluVal\Fluent\Validators;

use TypeError;

/**
 * Class MinLength
 *
 * @package BrosSquad\FluVal\Fluent\Validators
 * @author  Dusan Malusev
 */
class Min extends AbstractFluentValidator
{

    /**
     * @var int
     */
    private $min;

    /**
     * MinLength constructor.
     *
     * @param int|float|double $min
     * @param bool             $required
     */
    public function __construct($min, bool $required = false)
    {
        parent::__construct($required);
        if (!is_numeric($min)) {
            throw new TypeError('Min must be number');
        }
        $this->min = $min;
    }

    /**
     * {@inheritDoc}
     * @throws TypeError
     */
    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }

        if (is_string($value)) {
            return mb_strlen($value) > $this->min;
        }

        if (is_countable($value)) {
            return count($value) > $this->min;
        }

        if (is_numeric($value)) {
            return $value > $this->min;
        }

        throw new TypeError('Value must be array, string or number');
    }
}
