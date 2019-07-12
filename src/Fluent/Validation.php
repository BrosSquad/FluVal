<?php

declare(strict_types=1);

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
use BrosSquad\FluVal\Fluent\Validators\Integer;
use BrosSquad\FluVal\Fluent\Validators\Pattern;
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
    protected $validations = [];

    /**
     * Tracker for current position of the validations array
     * This tracer is used only for custom messages
     *
     * @var int
     */
    private $current = -1;

    /**
     * Registers custom validation class and it's message that will be returned in errors array
     * further down the pipeline
     *
     * @param IValidator  $validator
     * @param string|null $message
     *
     * @see \BrosSquad\FluVal\Fluent\IValidator
     * @see \BrosSquad\FluVal\Fluent\Validators\AbstractFluentValidator
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function customValidator(IValidator $validator, ?string $message = NULL): Validation
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
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function withMessage(string $message): Validation
    {
        $this->validations[$this->current]->value = $message;
        return $this;
    }


    /**
     * Validator for Email
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\Email
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function email(): Validation
    {
        return $this->customValidator(new Email(), 'Email is not valid');
    }


    /**
     * Checks the $value for alpha characters
     * This method will return true if $value contains only alpha characters (a-z, A-Z)
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\Alpha
     * @see \ctype_alpha()
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function alpha(): Validation
    {
        return $this->customValidator(new Alpha(), 'Value must contain only alpha characters (a-z, A-Z)');
    }

    /**
     * Checks the $value for alphanumeric characters
     * This method will return true if $value contains only alphanumeric characters (a-z, A-Z, 0-9)
     *
     * @see \BrosSquad\FluVal\Fluent\Validators\AlphaNumeric
     * @see \ctype_alnum()
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function alphaNumeric(): Validation
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
     * @see \BrosSquad\FluVal\Fluent\Validators\FloatingPoint
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function float(): Validation
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
     * @see \BrosSquad\FluVal\Fluent\Validators\Integer
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function int(): Validation
    {
        return $this->customValidator(new Integer(), 'Value must be integer');
    }

    public final function accepted(): Validation
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
     * @see \BrosSquad\FluVal\Fluent\Validators\Pattern
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    public final function pattern(
        string $pattern,
        string $flags = '',
        string $regexDelimiter = '#'
    ): Validation {
        return $this->customValidator(
            new Pattern($pattern, $flags, $regexDelimiter),
            'Value must match ' . $pattern
        );
    }


    /**
     * Return the array of registered validators and their error messages
     *
     * @return array<ValidationSet>
     */
    public final function getValidators(): array
    {
        return $this->validations;
    }

    protected final function next(): void
    {
        $this->current++;
    }

    protected final function getCurrent(): int
    {
        return $this->current;
    }

    protected final function getCurrentValidation(): array
    {
        return $this->validations[$this->current];
    }
}
