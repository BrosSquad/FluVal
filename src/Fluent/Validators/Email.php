<?php

declare(strict_types = 1);

namespace BrosSquad\FluVal\Fluent\Validators;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\EmailValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

class Email extends AbstractFluentValidator
{
    protected static array $validators = [];
    protected static MultipleValidationWithAnd $multipleValidatorsWithAnd;

    public function validate($value): bool
    {
        if (static::$multipleValidatorsWithAnd === null) {
            if (empty(static::$validators)) {
                static::$validators = [new RFCValidation()];
            }

            static::$multipleValidatorsWithAnd = new MultipleValidationWithAnd(static::$validators);
        }
        return $this->optional($value) ??
               (new EmailValidator())->isValid($value, static::$multipleValidatorsWithAnd) === true;
    }

    public static function addValidation(EmailValidation $validator)
    {
        static::$validators[] = $validator;
    }

    public static function addValidators(array $validators)
    {
        if (empty(static::$validators)) {
            static::$validators = $validators;
        } else {
            static::$validators = [...static::$validators, ...$validators];
        }
    }
}
