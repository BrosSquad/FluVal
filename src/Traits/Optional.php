<?php


namespace BrosSquad\FluVal\Traits;


trait Optional
{
    protected bool $isOptional = false;

    /**
     * Checks if the value is empty, if it is,
     * validation in validate method will be ignored
     *
     * @param string|array|float|int|object $value
     * If you don't want your value to be optional use NotEmpty validator or
     * simply don't put optional call in validation method
     *
     * @return bool|null
     */
    final protected function optional($value): ?bool
    {
        if (empty($value) && $this->isOptional === true) {
            return true;
        }
        return NULL;
    }
}