<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class Accepted extends AbstractFluentValidator
{

    /**
     * @param string|array|integer|float|object $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if ($this->optional($value) === true) return true;
        if (is_bool($value)) return true;
        switch ($value) {
            case 'yes':
            case 'on':
            case'true':
            case 'y':
            case '1':
                return true;
            default:
                return false;
        }
    }
}
