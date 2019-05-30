<?php


namespace Dusan\PhpMvc\Validation;


use Dusan\PhpMvc\Validation\Fluent\FluentValidation;

interface SetValidator
{
    public function setValidator(): ?FluentValidation;
}
