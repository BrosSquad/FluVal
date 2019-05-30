<?php

namespace Dusan\PhpMvc\Validation;

/**
 * @version 1.0
 * @author  Dusan Malusev
 * @license GPL-2.0
 * @since   1.0
 * <h3>Default validators<h3>
 * These validators are ment to be uses in request validation, not in actual ValidationModels
 * Is you want Validation inside the ValidationModel use Fluent Validation which is more powerful and better
 * than it's counterpart Request validators
 * @see     \Dusan\PhpMvc\Validation\Fluent\ModelValidator
 * <b> Fluent validation will be available in version 2</b>
 * <b>How to write custom validators</b>
 * <p>
 * FluentValidator is a function that returns Closure
 * Inner function will accept two arguments which will be supplied by the framework
 * FluentValidator::class and the value that is validated, it's really important for the validator function
 * to return the inner Closure so that the framework could supply the arguments needed for the validation
 * If a function is not provided by the FluentValidator::class, free feel to write the implementation as an Decorator
 * pattern
 *</p>
 *<p>
 * Every validator function should have the $msg variable as it's arguments
 * this will allow the customization of the underlining function to better return the errors
 * for the given context
 * </p>
 * <b>
 * Every inner closure must return NULL if the value is valid and anything else if the value is not
 * This value will be used for further processing by the framework
 * </b>
 */

use Carbon\Carbon;
use Dusan\PhpMvc\Regex\Pattern;

/**
 * Checks if the string is numeric
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isNumeric($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isNumeric($item) ? null : $msg;
    };
}

function minLength(int $minLength, string $msg)
{
    return function (Validator $validator, $item) use ($minLength, $msg) {
        return $validator->minLength($minLength, $item) ? null : $msg;
    };
}

function maxLength(int $maxLength, string $msg)
{
    return function (Validator $validator, $item) use ($maxLength, $msg) {
        return $validator->maxLength($maxLength, $item) ? null : $msg;
    };
}

function maxLengthIncluding(int $maxLengthIncluding, string $msg)
{
    return function (Validator $validator, $item) use ($maxLengthIncluding, $msg) {
        return $validator->maxLengthIncluding($maxLengthIncluding, $item) ? null : $msg;
    };
}

function minLengthIncluding(int $minLengthIncluding, string $msg)
{
    return function (Validator $validator, $item) use ($minLengthIncluding, $msg) {
        return $validator->minLengthIncluding($minLengthIncluding, $item) ? null : $msg;
    };
}

/**
 * Checks if the string contains only alpha characters
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isAlpha($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isAlpha($item) ? null : $msg;
    };
}

/**
 * Checks if the string contains only alpha numeric characters
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isAlphaNumeric($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isAlphaNumeric($item) ? null : $msg;
    };
}

/**
 * Checks if the string contains only lower case characters
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isLowerCase($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isLowerCase($item) ? null : $msg;
    };
}

/**
 * Checks if the string contains only upper case characters
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isUpperCase($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isUpperCase($item) ? null : $msg;
    };
}

/**
 * Checks if the string is hexadecimal number
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */

function isHex($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isHex($item) ? null : $msg;
    };
}

/**
 * Checks if the value is of type boolean
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isBoolean($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isBoolean($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid email
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isEmail($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isEmail($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid IP address
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isIp($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isIp($item);
    };
}

/**
 * Checks if the string is valid IPv4 address
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isIPv4($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isIpv4($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid IPv6 address
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isIPv6($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isIpv6($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid URL
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isUrl($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isUrl($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid MAC address
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isMacAddress($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isMacAddress($item) ? null : $msg;
    };
}

/**
 * Checks if the string is valid domain
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isDomain($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isDomain($item) ? null : $msg;
    };
}

/**
 * Checks if the value is of type integer
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isInteger($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isInteger($item) ? null : $msg;
    };
}

/**
 * Checks if the value is of type float
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isFloat($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isFloat($item) ? null : $msg;
    };
}

/**
 * Checks if the value is of type string
 *
 * @param string $msg Error message
 *
 * @return \Closure
 */
function isString($msg = '')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isString($item) ? null : $msg;
    };
}

/**
 * Checks if the value is greater than the supplied value
 *
 * @param int    $value
 * @param string $msg Error message
 *
 * @return \Closure
 */
function greaterThan(int $value, string $msg = '')
{
    return function (Validator $validator, $item) use ($value, $msg) {
        return ($item > $value) ? null : $msg;
    };
}

/**
 * Checks if the value is greater than or equal to the supplied value
 *
 * @param int    $value
 * @param string $msg Error message
 *
 * @return \Closure
 */
function greaterThanOrEqual(int $value, $msg = '')
{
    return function (Validator $validator, $item) use ($value, $msg) {
        return ($item >= $value) ? null : $msg;
    };
}

/**
 * Checks if the value is less than the supplied value
 *
 * @param int    $value
 * @param string $msg Error message
 *
 * @return \Closure
 */
function lessThan(int $value, $msg = '')
{
    return function (Validator $validator, $item) use ($value, $msg) {
        return ($item < $value) ? null : $msg;
    };
}

/**
 * Checks if the value is less than or equal to the supplied value
 *
 * @param int    $value
 * @param string $msg Error message
 *
 * @return \Closure
 */
function lessThanOrEqual(int $value, $msg = '')
{
    return function (Validator $validator, $item) use ($value, $msg) {
        return ($item <= $value) ? null : $msg;
    };
}

/**
 * Checks if the value between the values of start and end
 *
 * @param int    $start
 * @param int    $end
 * @param string $msg Error message
 *
 * @return \Closure
 */
function between($start, $end, $msg = '')
{
    return function (Validator $validator, $item) use ($start, $end, $msg) {
        return ($item > $start && $item < $end) ? null : $msg;
    };
}

/**
 * Checks if the value between the values of start and end including those two values
 *
 * @param int    $start
 * @param int    $end
 * @param string $msg Error message
 *
 * @return \Closure
 */
function betweenEqual($start, $end, $msg = '')
{
    return function (Validator $validator, $item) use ($start, $end, $msg) {
        return ($item >= $start && $item <= $end) ? null : $msg;
    };
}

/**
 * Checks if the string matches the regular expression
 *
 * @param string $regex
 * @param string $flags
 * @param string $msg Error message
 *
 * @return \Closure
 */
function match($regex, $flags = '', $msg = '')
{
    return function (Validator $validator, $item) use ($regex, $flags, $msg) {
        $pattern = new Pattern($regex, $flags);
        return $pattern->matches($item) ? null : $msg;
    };
}

/**
 * Checks if the string starts with the given string
 *
 * @param string $str
 * @param string $msg
 *
 * @return \Closure
 */
function startsWith(string $str, string $msg)
{
    return function (Validator $validator, $item) use ($str, $msg) {
        return $validator->startsWith($str, $item) ? null : $msg;
    };
}

/**
 * Checks if the values is accepted
 * Values considered valid are booleans (true or false) strings (1, yes) or integer 1
 *
 * @param string $msg
 *
 * @return \Closure
 */
function accepted($msg = 'Field must be accepted')
{
    return function (Validator $validator, $item) use ($msg) {
        return ($item === true ||
            $item === 'true' ||
            $item === 'yes' ||
            $item === 1 ||
            $item === '1') ? null : $msg;
    };
}

/**
 * Checks if the array contains the value with the supplied key
 *
 * @param int|string $key
 * @param string     $msg
 *
 * @return \Closure
 */
function inArray($key, $msg = 'Value must be exist in array')
{
    return function (Validator $validator, $item) use ($key, $msg) {
        return isset($item[$key]) ? null : $msg;
    };
}

/**
 * Checks if the string is valid date
 *
 * @param string $msg
 *
 * @return \Closure
 */
function date($msg = 'Input value must be of date type')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isDate($item) ? null : $msg;
    };
}

/**
 * Check if the supplied date is before the value in validator
 *
 * @param \Carbon\Carbon $date
 * @param string         $format
 * @param string         $msg
 *
 * @return \Closure
 */
function beforeDate(Carbon $date, string $format = 'Y-m-d H:i:s', $msg = '')
{
    return function (Validator $validator, $item) use ($date, $format, $msg) {
        return $validator->isBefore($date, $item, $format) ? null : $msg;
    };
}

/**
 * Check if the supplied date is after the value in validator
 *
 * @param \Carbon\Carbon $date
 * @param string         $format
 * @param string         $msg
 *
 * @return \Closure
 */
function afterDate(Carbon $date, string $format = 'Y-m-d H:i:s', $msg = '')
{
    return function (Validator $validator, $item) use ($date, $format, $msg) {
        return $validator->isAfter($date, $item, $format) ? null : $msg;
    };
}

/**
 * Checks the string if is type date and has the given format
 * @param        $format
 * @param string $msg
 *
 * @return \Closure
 */
function dateFormat($format, $msg = 'Input date must be of correct format')
{
    return function (Validator $validator, $item) use ($format, $msg) {
        return $validator->isDateFormat($item, $format) ? null : $msg;
    };
}

/**
 * Checks the variables if it's null
 * (Nulls are considered values empty values, on not set or explicitly set to null)
 *
 * @param string $msg
 *
 * @return \Closure
 */
function notNull($msg = 'Input value must not be null')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isNull($item) ? null : $msg;
    };
}

/**
 * Checks the variables for the type of array
 * @param string $msg
 *
 * @return \Closure
 */
function isArray($msg = 'Input must be the array type')
{
    return function (Validator $validator, $item) use ($msg) {
        return $validator->isArray($item);
    };
}
