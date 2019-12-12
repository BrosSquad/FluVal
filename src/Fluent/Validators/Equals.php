<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class Equals extends AbstractFluentValidator
{
    private $value;

    public function __construct($value, bool $required = false)
    {
        parent::__construct($required);
        $this->value = $value;
    }

    /**
     * @param string|array|integer|float|object $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if (is_string($value) && is_string($this->value)) {
            return strcmp($value, $this->value) === 0;
        }
        return $this->value === $value;
    }
}
