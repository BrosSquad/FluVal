# PhpMvc Validation library

> Fluent validation library for PhpMvc framework written by Dusan Malusev


## Usage
```php

<?php

use Dusan\PhpMvc\Validation\AbstractValidationModel;
use Dusan\PhpMvc\Validation\Fluent\FluentValidator;
use Dusan\PhpMvc\Validation\ValidationModel;

// Define your models as ValidationModel
class User extends ValidationModel
{
    protected $name;
    protected $email;
    protected $accepted;
    protected $password;

    /**
     * User constructor.
     *
     * @param $name
     * @param $email
     * @param $accepted
     * @param $password
     */
    public function __construct($name, $email, $accepted, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->accepted = $accepted;
        $this->password = $password;
    }


}

// Extend the base FluentValidation class and use it to it's full potential
class UserFluentValidator extends FluentValidator
{
    public function __construct(AbstractValidationModel $model)
    {
        parent::__construct($model);
        // Name validation
        $this->forMember('name')
            ->min(3)
            ->withMessage('Name must have at least 3 characters')
            ->max(50)
            ->withMessage('Name cannot have more than 50 characters')
            ->alpha()
            ->withMessage('Name can contain only alpha characters')
            ->pattern('^[A-Z][a-z]+$')
            ->withMessage('Name must start with uppercase letter');

        // Email validation
        $this->forMember('email')
            ->min(5)
            ->withMessage('Email must have at least 5 characters')
            ->max(150)
            ->withMessage('Email cannot have more than 150 characters')
            ->email();

        $this->forMember('accepted')
            ->accepted();

        $this->forMember('password')
            ->min(8)
            ->withMessage('Password must have at least 8 characters');
    }
}

```

### Custom Validators

You can define your own validators by extending the IValidator interface or AbstractFluentValidator

Example:

```php
<?php


namespace Dusan\PhpMvc\Validation\Fluent\Validators;


use \Error;

// Start by defining the Validator
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
// To use your validator call the customValidator() method in Validation class
// e.g.

class CustomValidator extends FluentValidator
{
    public function __construct(AbstractValidationModel $model)
    {
        parent::__construct($model);
        $this->forMember('member')
            // customValidator method expects first parameter to
            // be of type IValidator interface which is
            // implemented by AbstractFluentValidator class
            // Second parameter is the error message that will be 
            // returned in error array after calling the validate() method on
            // FluentValidator class
            ->customValidator(
                new Pattern('your pattern', 'flags', 'regex delimiter'), 
                'Error message'
            );
    }
}
```

## Inspiration

This library was inspired by [Fluent Validation](https://fluentvalidation.net/) (.NET Library)
