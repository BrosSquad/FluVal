<?php


namespace BrosSquad\FluVal;


use BrosSquad\FluVal\Traits\MemberWithDash;
use BrosSquad\FluVal\Exceptions\PropertyNotFoundException;

abstract class AbstractValidationModel
{
    use MemberWithDash;

    /**
     * @throws \BrosSquad\FluVal\Exceptions\PropertyNotFoundException
     *
     * @param  string  $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        $modified = $this->memberWithUnderscore($name);
        if (method_exists($this, 'get'.$modified)) {
            return $this->{'get'.$modified}();
        }

        if (method_exists($this, 'is'.$modified)) {
            return $this->{'is'.$modified}();
        }

        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        throw new PropertyNotFoundException("Property {$name} is not found");
    }

    /**
     * @throws \BrosSquad\FluVal\Exceptions\PropertyNotFoundException
     *
     * @param  string  $name
     * @param  mixed  $value
     *
     */
    public function __set(string $name, $value)
    {
        $modified = $this->memberWithUnderscore($name);

        if (method_exists($this, 'set'.$modified)) {
            $this->{'set'.$modified}($value);
            return;
        }

        if (property_exists($this, $name)) {
            $this->{$name} = $value;
            return;
        }

        throw new PropertyNotFoundException("Property {$name} is not found");
    }

    public function __isset($name)
    {
        if (property_exists($this, $name)) {
            return true;
        }

        if (method_exists($this, 'set'.$this->memberWithUnderscore($name))) {
            return true;
        }

        return false;
    }

}
