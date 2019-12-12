<?php

namespace BrosSquad\FluVal;

use Error;

class ValidationSet
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @throws \Error
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'key' || $name === 'value') {
            return $this->{$name};
        }

        throw new Error('Property is not defined in class ValidationSet');
    }

    /**
     * @throws \Error
     *
     * @param $value
     * @param $name
     */
    public function __set($name, $value)
    {
        if ($name === 'key' || $name === 'value') {
            $this->{$name} = $value;
            return;
        }

        throw new Error('Property is not defined in class ValidationSet');
    }
}
