<?php
declare(strict_types=1);

namespace BrosSquad\FluVal;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use DateTimeInterface;
use TypeError;

class Validator
{
    /**
     * @param string $str
     *
     * @return bool
     */
    public function isAlpha(string $str): bool
    {
        return ctype_alpha($str);
    }

    /**
     * @param string $str
     *
     * @return bool
     */
    public function isNumeric(string $str): bool
    {
        return ctype_digit($str);
    }

    /**
     * @param string $str
     *
     * @return bool
     */
    public function isAlphaNumeric(string $str): bool
    {
        return ctype_alnum($str);
    }

    /**
     * @param string $str
     *
     * @return bool
     */
    public function isLowerCase(string $str): bool
    {
        return ctype_lower($str);
    }

    /**
     * @param string $str
     *
     * @return bool
     */
    public function isUpperCase(string $str): bool
    {
        return ctype_upper($str);
    }

    /**
     * @param string $str
     *
     * @return bool
     */
    public function isHex(string $str): bool
    {
        return ctype_xdigit($str);
    }

    /**
     * @param $var
     *
     * @return bool
     */
    public function isBoolean($var): bool
    {
        return filter_var($var, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param string $email
     *
     * @return bool
     */
    public function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @param string $ip
     *
     * @return bool
     */
    public function isIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @param string $ip
     *
     * @return bool
     */
    public function isIpv4(string $ip): bool
    {
        return filter_var($ip) !== false;
    }

    /**
     * @param string $ip
     *
     * @return bool
     */
    public function isIpv6(string $ip): bool
    {
        return filter_var($ip) !== false;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    public function isUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @param string $mac
     *
     * @return bool
     */
    public function isMacAddress(string $mac): bool
    {
        return filter_var($mac, FILTER_VALIDATE_MAC) !== false;
    }

    /**
     * @param string $domain
     *
     * @return bool
     */
    public function isDomain(string $domain): bool
    {
        return filter_var($domain, FILTER_VALIDATE_DOMAIN) !== false;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function isInteger($item): bool
    {
        return is_int($item);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function isInfinite($item): bool
    {
        return is_infinite($item);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function isFloat($item): bool
    {
        return is_float($item);
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function isString($item): bool
    {
        return is_string($item);
    }

    /**
     * @param string $str
     * @param string $checkString
     *
     * @return bool
     */
    public function startsWith(string $str, string $checkString): bool
    {
        $len = strlen($checkString);
        for($i = 0; $i < $len; $i++) {
            if($str[$i] !== $checkString[$i]) {
                return false;
            }
        }
        return true;
    }

    public function isNull($item): bool
    {
        return $item === null;
    }

    public function isArray($item): bool
    {
        return is_array($item);
    }

    /**
     * @param CarbonInterface|string                    $item
     * @param \Carbon\CarbonInterface|DateTimeInterface $date
     * @param string                                    $format
     *
     * @return bool
     */
    public function isAfter($item, ?DateTimeInterface $date, string $format = 'Y-m-d H:i:s'): bool
    {
        // Transform $date into Carbon object
        if ($date instanceof DateTimeInterface && !($date instanceof CarbonInterface)) {
            $date = Carbon::instance($date);
        }
        if (is_string($item)) {
            $item = CarbonImmutable::createFromFormat($format, $item);
        } // Only check for DateTimeInterface because CarbonInterface inherits it
        else if ($item instanceof DateTimeInterface && !($item instanceof CarbonInterface)) {
            $item = Carbon::instance($item);
        } else if ($item instanceof CarbonInterface) {
            // Do nothing
        } else {
            throw new TypeError('$item must be of type string or DateTimeInterface');
        }
        return $item->isAfter($date);
    }

    /**
     * @param DateTimeInterface|CarbonInterface|string $item
     * @param \DateTimeInterface| CarbonInterface      $date
     * @param string                                   $format
     *
     * @return bool
     */
    public function isBefore($item, ?DateTimeInterface $date = null, string $format = 'Y-m-d H:i:s')
    {
        // Transform $date into Carbon object
        if ($date instanceof DateTimeInterface && !($date instanceof CarbonInterface)) {
            $date = Carbon::instance($date);
        }

        if($date == null)
        {
            $date = Carbon::now();
        }

        if (is_string($item)) {
            $item = CarbonImmutable::createFromFormat($format, $item);
        } // Only check for DateTimeInterface because CarbonInterface inherits it
        else if ($item instanceof DateTimeInterface && !($item instanceof CarbonInterface)) {
            $item = Carbon::instance($item);
        } else if ($item instanceof CarbonInterface) {
            // Do nothing
        } else {
            throw new TypeError('$item must be of type string or DateTimeInterface');
        }
        return $item->isBefore($date);
    }

    public function hasDateTimeFormat($item, string $format = 'Y-m-d H:i:s')
    {
        return Carbon::hasFormat($item, $format);
    }

    public function isDate($item)
    {
        return $item instanceof CarbonInterface || $item instanceof DateTimeInterface;
    }

    public function minLength(int $minLength, string $item)
    {
        return strlen($item) > $minLength;
    }

    public function minLengthIncluding(int $minLength, string $item)
    {
        return strlen($item) >= $minLength;
    }

    public function maxLength(int $minLength, string $item)
    {
        return strlen($item) <= $minLength;
    }

    public function maxLengthIncluding(int $minLength, string $item)
    {
        return strlen($item) <= $minLength;
    }

}
