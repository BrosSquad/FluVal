<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


use \Error;

class Pattern extends AbstractFluentValidator
{
    private $regex;

    public function __construct(string $pattern, string $flags = '', string $regexDelimiter = '#')
    {
        $this->regex = $regexDelimiter . $pattern . $regexDelimiter . $flags;
    }

    /**
     * @param string|array|integer|float|object $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if(($match = preg_match($this->regex, $value)) === false) {
            throw new Error('Regex is not valid');
        }

        return $match === 1;
    }
}
