<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


use TypeError;

class Between extends AbstractFluentValidator
{
    private $min;
    private $max;

    public function __construct($min, $max)
    {
        if(!is_numeric($min)) {
            throw new TypeError('Min must be number');
        }
        if(!is_numeric($max)) {
            throw new TypeError('Max must be number');
        }
        $this->max = $max;
        $this->min = $min;
    }

    public function validate($value): bool
    {
        if($this->optional() === true) {
            return true;
        }
        return (new Min($value, $this->min))->validate() &&
            (new Max($value, $this->max))->validate();
    }
}