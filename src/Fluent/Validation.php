<?php

declare(strict_types = 1);

namespace BrosSquad\FluVal\Fluent;


use BrosSquad\FluVal\Fluent\Traits\Length;
use BrosSquad\FluVal\Fluent\Traits\NotEmpty;
use BrosSquad\FluVal\Fluent\Traits\Password;
use BrosSquad\FluVal\Fluent\Traits\Username;
use BrosSquad\FluVal\Fluent\Validators\Accepted;
use BrosSquad\FluVal\Fluent\Validators\Alpha;
use BrosSquad\FluVal\Fluent\Validators\AlphaNumeric;
use BrosSquad\FluVal\Fluent\Validators\Email;
use BrosSquad\FluVal\Fluent\Validators\FloatingPoint;
use BrosSquad\FluVal\Fluent\Validators\HexNumber;
use BrosSquad\FluVal\Fluent\Validators\Integer;
use BrosSquad\FluVal\Fluent\Validators\IP;
use BrosSquad\FluVal\Fluent\Validators\LowerCase;
use BrosSquad\FluVal\Fluent\Validators\Numeric;
use BrosSquad\FluVal\Fluent\Validators\Pattern;
use BrosSquad\FluVal\Fluent\Validators\UpperCase;
use BrosSquad\FluVal\Fluent\Validators\URL;
use BrosSquad\FluVal\ValidationSet;

/**
 * Class Validation
 *
 * @package BrosSquad\FluVal\Fluent
 */
class Validation
{
    use Username;
    use Password;
    use Length;
    use NotEmpty;

    /**
     * Array containing instances of the IValidation interface
     * and the message that will be returned in the errors array
     * when data is processed
     *
     * @var array<ValidationSet>
     */
    protected array $validations = [];

    /**
     * Tracker for current position of the validations array
     * This tracer is used only for custom messages
     *
     * @var int
     */
    private int $current = -1;

    /**
     * Registers custom validation class and it's message that will be returned in errors array
     * further down the pipeline
     *
     * @param IValidator  $validator
     * @param string|null $message
     *
     * @return Validation
     * @see \BrosSquad\FluVal\Fluent\Validators\AbstractFluentValidator
     * @see \BrosSquad\FluVal\Fluent\IValidator
     */
    final public function customValidator(IValidator $validator, ?string $message = null): Validation
    {
        $this->validations[] = new ValidationSet($validator, $message);
        $this->next();
        return $this;
    }

    /**
     * Sets the message for the current validator
     * Message will be returned in error array when data is processed
     *
     * @param string $message
     *
     * @return Validation
     */
    final public function withMessage(string $message): Validation
    {
        $this->validations[$this->current]->value = $message;
        return $this;
    }


    /**
     * Validator for Email
     *
     * @return Validation
     * @see \BrosSquad\FluVal\Fluent\Validators\Email
     */
    final public function email(): Validation
    {
        return $this->customValidator(new Email(), 'Email is not valid');
    }


    /**
     * Checks the $value for alpha characters
     * This method will return true if $value contains only alpha characters (a-z, A-Z)
     *
     * @return Validation
     * @see \ctype_alpha()
     * @see \BrosSquad\FluVal\Fluent\Validators\Alpha
     */
    final public function alpha(): Validation
    {
        return $this->customValidator(new Alpha(), 'Value must contain only alpha characters (a-z, A-Z)');
    }

    /**
     * Checks the $value for alphanumeric characters
     * This method will return true if $value contains only alphanumeric characters (a-z, A-Z, 0-9)
     *
     * @return Validation
     * @see \ctype_alnum()
     * @see \BrosSquad\FluVal\Fluent\Validators\AlphaNumeric
     */
    final public function alphaNumeric(): Validation
    {
        return $this->customValidator(
            new AlphaNumeric(),
            'Value must contain only alphanumeric characters (a-z, A-Z, 0-9)'
        );
    }

    /**
     * Checks if the $value is floating point number
     * WARNING: strings in floating point format are not considered a number
     *
     * @return Validation
     * @see \BrosSquad\FluVal\Fluent\Validators\FloatingPoint
     */
    final public function float(): Validation
    {
        return $this->customValidator(
            new FloatingPoint(),
            'Value must be floating point number'
        );
    }

    /**
     * Checks if the $value is integer
     * WARNING: strings in integer format are not considered a number
     *
     * @param int $flags
     *
     * @return Validation
     * @see \BrosSquad\FluVal\Fluent\Validators\Integer
     */
    final public function int(int $flags = Integer::OCTAL | Integer::HEX): Validation
    {
        return $this->customValidator(new Integer($flags), 'Value must be integer');
    }

    final public function accepted(): Validation
    {
        return $this->customValidator(new Accepted(), 'Value must be 1, yes, on or true');
    }

    /**
     * Validates the $value based on the regex provided into method
     *
     * @param string $pattern
     * @param string $flags
     * @param string $regexDelimiter
     *
     * @return Validation
     * @see \BrosSquad\FluVal\Fluent\Validators\Pattern
     */
    final public function pattern(
        string $pattern,
        string $flags = '',
        string $regexDelimiter = '#'
    ): Validation {
        return $this->customValidator(
            new Pattern($pattern, $flags, $regexDelimiter),
            'Value must match ' . $pattern
        );
    }


    final public function url(): Validation
    {
        return $this->customValidator(new URL(), 'URL is not valid');
    }

    final public function hex(): Validation
    {
        return $this->customValidator(new HexNumber(), 'Number is not hexadecimal');
    }

    final public function ip(int $flags = IP::IPV4 | IP::IPV6): Validation
    {
        return $this->customValidator(new IP($flags), 'IP is not valid');
    }

    final public function lowerCase(): Validation
    {
        return $this->customValidator(new LowerCase(), 'String must be all lowercase');
    }

    final public function upperCase(): Validation
    {
        return $this->customValidator(new UpperCase(), 'String must be all uppercase');
    }

    final public function numeric(int $integerFlags = Integer::HEX | Integer::OCTAL): Validation
    {
        return $this->customValidator(new Numeric($integerFlags), 'Must be numeric type');
    }


    /**
     * Return the array of registered validators and their error messages
     *
     * @return array<ValidationSet>
     */
    final public function getValidators(): array
    {
        return $this->validations;
    }

    final protected function next(): void
    {
        $this->current++;
    }

    final protected function getCurrent(): int
    {
        return $this->current;
    }

    final protected function getCurrentValidation(): array
    {
        return $this->validations[$this->current];
    }
}
