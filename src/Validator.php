<?php

namespace Dusan\PhpMvc\Validation;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;

class Validator
{
    public function isAlpha(string $str): bool
    {
        return ctype_alpha($str);
    }

    public function isNumeric(string $str): bool
    {
        return ctype_digit($str);
    }

    public function isAlphaNumeric(string $str): bool
    {
        return ctype_alnum($str);
    }

    public function isLowerCase(string $str): bool
    {
        return ctype_lower($str);
    }

    public function isUpperCase(string $str): bool
    {
        return ctype_upper($str);
    }

    public function isHex(string $str): bool
    {
        return ctype_xdigit($str);
    }

    public function isBoolean($var): bool
    {
        return filter_var($var, FILTER_VALIDATE_BOOLEAN);
    }

    public function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    public function isIpv4(string $ip): bool
    {
        return filter_var($ip);
    }

    public function isIpv6(string $ip): bool
    {
        return filter_var($ip);
    }

    public function isUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public function isMacAddress(string $mac): bool
    {
        return filter_var($mac, FILTER_VALIDATE_MAC);
    }

    public function isDomain(string $domain): bool
    {
        return filter_var($domain, FILTER_VALIDATE_DOMAIN);
    }

    public function isInteger($item)
    {
        return is_int($item);
    }

    public function isInfinite($item)
    {
        return is_infinite($item);
    }

    public function isFloat($item)
    {
        return is_float($item);
    }

    public function isString($item)
    {
        return is_string($item);
    }

    public function startsWith($str, $item)
    {
        return strcmp(substr($item, 0, strlen($str)), $str);
    }

    public function isNull($item)
    {
        return is_null($item);
    }

    public function isArray($item)
    {
        return is_array($item);
    }

    public function isBefore(Carbon $date, $item, string $format)
    {
        if (!$item instanceof CarbonInterface) {
            $item = Carbon::createFromFormat($format, $item);
        }
        return $item->isBefore($date);
    }

    public function isAfter(Carbon $date, $item, string $format)
    {
        if (!$item instanceof CarbonInterface) {
            $item = Carbon::createFromFormat($format, $item);
        }

        return $item->isAfter($date);
    }

    public function isDateFormat($item, $format)
    {
        return Carbon::hasFormat($item, $format);
    }

    public function isDate($item)
    {
        return $item instanceof CarbonInterface || $item instanceof DateTimeInterface;
    }

    public function minLength(int $minLength, $item)
    {
        return strlen($item) > $minLength;
    }

    public function minLengthIncluding(int $minLength, $item)
    {
        return strlen($item) >= $minLength;
    }

    public function maxLength(int $minLength, $item)
    {
        return strlen($item) <= $minLength;
    }

    public function maxLengthIncluding(int $minLength, $item)
    {
        return strlen($item) <= $minLength;
    }

}
