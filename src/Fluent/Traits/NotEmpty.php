<?php

namespace BrosSquad\FluVal\Fluent\Traits;

use BrosSquad\FluVal\Fluent\Validation;
use BrosSquad\FluVal\Fluent\Validators\NotEmpty as NotEmptyValidator;

trait NotEmpty
{
    /**
     * This method will return true only if value is not empty()
     * Check the php docs to see, what is considered empty variable
     *
     * @see \empty()
     * @return \BrosSquad\FluVal\Fluent\Validation
     */
    final public function notEmpty(): Validation
    {
        return $this->customValidator(new NotEmptyValidator(), 'Value must not be empty');
    }
}
