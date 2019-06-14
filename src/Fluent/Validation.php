<?php
declare(strict_types=1);

namespace Dusan\PhpMvc\Validation\Fluent;


use Dusan\PhpMvc\Validation\Fluent\Validators\{Alpha,
    AlphaNumeric,
    Between,
    Accepted,
    Email,
    ExactLength,
    FloatingPoint,
    Integer,
    Max,
    Min,
    NotEmpty,
    Pattern};

/**
 * Class Validation
 *
 * @package Dusan\PhpMvc\Validation\Fluent
 */
class Validation
{
    /**
     * Array containing instances of the IValidation interface
     * and the message that will be returned in the errors array
     * when data is processed
     *
     * @var array
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
     * @see \Dusan\PhpMvc\Validation\Fluent\IValidator
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\AbstractFluentValidator
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function customValidator(IValidator $validator, ?string $message = NULL): Validation
    {
        $this->validations[] = [
            'validator' => $validator,
            'message' => $message,
        ];
        $this->next();
        return $this;
    }

    /**
     * Sets the message for the current validator
     * Message will be returned in error array when data is processed
     *
     * @param string $message
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function withMessage(string $message): Validation
    {
        $this->validations[$this->current]['message'] = $message;
        return $this;
    }

    public final function password(?string $message = null): Validation
    {
        if ($message === null) {
            $message = <<<MESSAGE
            Password must contain at least one uppercase, one lowercase, one digit,
            one special character and must be at least 8 characters long.

MESSAGE;
        }
        return $this->customValidator(new Password(), $message);
    }

    public final function username(?string $message = null): Validation
    {
        if ($message === null) {
          $message = <<<MESSAGE
            Username can't contain special characters.

MESSAGE;
        }
        return $this->customValidator(new Username(), $message);
    }

    /**
     * Validator for Email
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Email
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function email(): Validation
    {
        return $this->customValidator(new Email(), 'Email is not valid');
    }

    /**
     * Validator for validating the minimum value for string, arrays or any countable object
     *
     * @param $min
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Min
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function min($min)
    {
        return $this->customValidator(new Min($min), 'Value must be bigger than ' . $min);
    }

    /**
     * Validator for validating the maximum value for string, arrays or any countable object
     *
     * @param $max
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Max
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function max($max): Validation
    {
        return $this->customValidator(new Max($max), 'Value must be smaller than ' . $max);
    }

    /**
     * Validates string, array or any countable object, this method will return true
     * only if $value is in boundaries of $min and $max
     *
     * @param int|float $min
     * @param int|float $max
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Between
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function length($min, $max): Validation
    {
        return $this->customValidator(
            new Between($min, $max),
            sprintf('Value must be between %d and %d', $min, $max)
        );
    }

    /**
     * This method will return true only if value is not empty()
     * Check the php docs to see, what is considered empty variable
     *
     * @see \empty()
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function notEmpty(): Validation
    {
        return $this->customValidator(new NotEmpty(), 'Value must not be empty');
    }

    /**
     * Checks the $value for alpha characters
     * This method will return true if $value contains only alpha characters (a-z, A-Z)
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Alpha
     * @see \ctype_alpha()
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function alpha(): Validation
    {
        return $this->customValidator(new Alpha(), 'Value must contain only alpha characters (a-z, A-Z)');
    }

    /**
     * Checks the $value for alphanumeric characters
     * This method will return true if $value contains only alphanumeric characters (a-z, A-Z, 0-9)
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\AlphaNumeric
     * @see \ctype_alnum()
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
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
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\FloatingPoint
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
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
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Integer
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function int(): Validation
    {
        return $this->customValidator(new Integer(), 'Value must be integer');
    }

    public final function accepted(): Validation {
        return $this->customValidator(new Accepted(), 'Value must be 1, yes, on or true');
    }

    /**
     * Validates the $value based on the regex provided into method
     *
     * @param string $pattern
     * @param string $flags
     * @param string $regexDelimiter
     *
     * @see \Dusan\PhpMvc\Validation\Fluent\Validators\Pattern
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function pattern(
        string $pattern,
        string $flags = '',
        string $regexDelimiter = '#'
    ): Validation
    {
        return $this->customValidator(
            new Pattern($pattern, $flags, $regexDelimiter),
            'Value must match ' . $pattern
        );
    }

    /**
     * @param int $length
     *
     * @return \Dusan\PhpMvc\Validation\Fluent\Validation
     */
    public final function exactLength(int $length): Validation
    {
        return $this->customValidator(
            new ExactLength($length),
            'Value must be exactly ' . $length . ' long'
        );
    }

    /**
     * Return the array of registered validators and their error messages
     *
     * @return array
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
