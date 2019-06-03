<?php
declare(strict_types=1);
namespace Dusan\PhpMvc\Validation\Fluent\Validators;


use TypeError;

class Max extends AbstractFluentValidator
{
    private $max;

    public function __construct($max)
    {
        if(!is_int($max) || !is_float($max)) {
            throw new TypeError('$max must be integer or float');
        }
        $this->max = $max;
    }

    public function validate($value): bool
    {
        if($this->optional() === true) {
            return true;
        }
        if(is_numeric($value)) {
            return $value < $this->max;
        } else if(is_string($value)) {
            return mb_strlen($value) < $this->max;
        } else if(is_countable($value)) {
            return count($value) < $this->max;
        } else {
            throw new TypeError('Value must be array, string or number');
        }
    }
}
