<?php
declare(strict_types=1);

namespace Dusan\PhpMvc\Validation\Fluent\Validators;

use TypeError;

/**
 * Class MinLength
 *
 * @author  Dusan Malusev
 * @package Dusan\PhpMvc\Validation\Fluent\Validators
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
     * @param string|array     $value
     * @param int|float|double $min
     * @throws TypeError
     */
    public function __construct($min)
    {
        if(!is_float($min) || !is_int($min)) {
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
        if ($this->optional() === true) {
            return true;
        } else if (is_string($value)) {
            return mb_strlen($value) > $this->min;
        } else if (is_countable($value)) {
            return count($value) > $this->min;
        } else if (is_numeric($value)) {
            return $value > $this->min;
        } else {
            throw new TypeError('Value must be array, string or number');
        }
    }
}
