<?php


namespace BrosSquad\FluVal\Fluent\Validators;


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
        if($this->optional($value) === true) {
            return true;
        }
        return (new Min($this->min))->validate($value) &&
            (new Max($this->max))->validate($value);
    }
}
