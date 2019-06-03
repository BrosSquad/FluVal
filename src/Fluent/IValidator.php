<?php


namespace Dusan\PhpMvc\Validation\Fluent;


/**
 * Every Validator must implement IValidator interface
 * validate method is called by the library for every registered validator
 * There are two ways to create validators, first one is to implement the IValidator interface
 * the second is to extend the AbstractFluentValidator::class {@see \Dusan\PhpMvc\Validation\Fluent\Validators\AbstractFluentValidator}
 *
 * @author Dusan Malusev
 * @api
 * @package Dusan\PhpMvc\Validation\Fluent
 */
interface IValidator
{
    /**
     * @param string|array|integer|float|object $value
     * @return bool
     */
    public function validate($value): bool;
}
