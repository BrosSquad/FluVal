<?php

namespace BrosSquad\FluVal\Fluent\Traits;


trait Username
{
    public final function username(): Validation
    {
        return $this->customValidator(new Username(), 'Username can\'t contain special characters.');
    }
}