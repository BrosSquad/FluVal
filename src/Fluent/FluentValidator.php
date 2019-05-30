<?php


namespace Dusan\PhpMvc\Validation\Fluent;


use Closure;
use Dusan\PhpMvc\Collections\Map;

class FluentValidator extends BaseFluentValidator
{

    public function __construct(Closure $callback)
    {
        parent::__construct($callback, Map::fromArray([]));
    }

    /**
     * @param string|null $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\NumericFluentValidator
     */
    public function number(?string $message = 'Type must be number'): NumericFluentValidator
    {
        $this->validations->push('number', function ($value) use ($message) {
            return (is_float($value) || is_integer($value) || ctype_digit($value)) ? NULL : $message;
        });
        return new NumericFluentValidator($this->callback, $this->validations);
    }

    public function float(?string $message = 'Number must be floating point'): FloatFluentValidator
    {
        $this->validations->push('number', function ($value) use ($message) {
            return is_float($value) ? NULL : $message;
        });
        return new FloatFluentValidator($this->callback, $this->validations);
    }

    public function integer(?string $message = 'Number must be integer'): IntegerFluentValidator
    {
        $this->validations->push('number', function ($value) use ($message) {
            return is_integer($value) ? NULL : $message;
        });
        return new IntegerFluentValidator($this->callback, $this->validations);
    }


    public function string(?string $message = 'Type must be string')
    {
        $this->validations->push('string', function ($value) use ($message) {
            return is_string($value) ? NULL : $message;
        });
        return new StringFluentValidator($this->callback, $this->validations);
    }

    public function accepted(?string $message = 'Field must be accepted')
    {
        $this->validations->push('accepted', function ($value) use ($message) {
            if (filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
                return NULL;
            }
            return $message;
        });
        return $this;
    }


//    public function array($field)
//    {
//        return new ArrayValidator(static::getValidator(), $field);
//    }
}
