<?php

namespace BrosSquad\FluVal\Fluent\Traits;

use BrosSquad\FluVal\Fluent\Validators\{Max, Min, Between, ExactLength};

trait Length
{
    /**
     * Validator for validating the minimum value for string, arrays or any countable object
     *
     * @param $min
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\Min
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function min($min)
    {
        return $this->customValidator(new Min($min), 'Value must be bigger than ' . $min);
    }

    /**
     * Validator for validating the maximum value for string, arrays or any countable object
     *
     * @param $max
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\Max
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function max($max): Validation
    {
        return $this->customValidator(new Max($max), 'Value must be smaller than ' . $max);
    }

    /**
     * Validates string, array or any countable object, this method will return true
     * only if $value is in boundaries of $min and $max
     *
     * @param int|float $min
     * @param int|float $max
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\Between
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function length($min, $max): Validation
    {
        return $this->customValidator(
            new Between($min, $max),
            sprintf('Value must be between %d and %d', $min, $max)
        );
    }

     /**
     * @param int $length
     *
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function exactLength(int $length): Validation
    {
        return $this->customValidator(
            new ExactLength($length),
            'Value must be exactly ' . $length . ' long'
        );
    }
}
