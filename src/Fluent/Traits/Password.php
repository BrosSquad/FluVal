<?php

namespace BrosSquad\FluVal\Fluent\Traits;

trait Password
{
    public final function password(): Validation
    {
        $message = <<<MESSAGE
            Password must contain at least one uppercase, one lowercase, one digit,
            one special character and must be at least 8 characters long.
MESSAGE;
        return $this->customValidator(new Password(), $message);
    }
}
