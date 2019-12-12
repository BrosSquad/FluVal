<?php


namespace BrosSquad\FluVal\Fluent\Validators;


use BrosSquad\FluVal\Traits\Optional;
use BrosSquad\FluVal\Fluent\IValidator;

abstract class AbstractFluentValidator implements IValidator
{
    use Optional;

    /**
     * AbstractFluentValidator constructor.
     *
     * @param bool $isRequired
     */
    public function __construct(bool $isRequired = false)
    {
        $this->isOptional = $isRequired;
    }
}