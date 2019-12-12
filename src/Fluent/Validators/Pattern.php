<?php


namespace BrosSquad\FluVal\Fluent\Validators;


use \Error;

class Pattern extends AbstractFluentValidator
{
    private string $regex;

    public function __construct(
        string $pattern,
        string $flags = '',
        string $regexDelimiter = '#',
        bool $required =
        false
    ) {
        parent::__construct($required);
        $this->regex = $regexDelimiter . $pattern . $regexDelimiter . $flags;
    }

    /**
     * @param string|array|integer|float|object $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if ($this->optional($value) === true) {
            return true;
        }

        if (($match = preg_match($this->regex, $value)) === false) {
            throw new Error(preg_last_error());
        }

        return $match === 1;
    }
}
