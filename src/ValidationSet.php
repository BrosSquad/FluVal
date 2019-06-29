<?php

namespace BrosSquad\FluVal;

use BrosSquad\FluVal\Fluent\IValidator;
use Exception;

class ValidationSet {
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function __get($name)
    {
        if($name === 'key' || $name === 'value')
        {
            return $this->{$name};
        }

        throw new Exception('Property is not defined in class ValidationSet');
    }
}