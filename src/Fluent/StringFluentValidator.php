<?php


namespace Dusan\PhpMvc\Validation\Fluent;


class StringFluentValidator extends BaseFluentValidator
{

    public function equals(string $str)
    {
        $this->validations->push('equals', function (string $value) use ($str) {
            return strcmp($value, $str) === 0;
        });
        return $this;
    }

    public function caseInsensitiveEquals(string $str)
    {
        $this->validations->push('equals', function (string $value) use ($str) {
            return strcasecmp($value, $str) === 0;
        });

        return $this;
    }

    public function startsWith(string $str)
    {
        $this->validations->push('startsWith', function (string $value) use ($str) {
            return substr_compare($value, $str, 0);
        });
        return $this;
    }

    public function contains(string $str)
    {
        $this->validations->push('contains', function (string $value) use ($str) {
            return mb_strpos($str, $value) !== false;
        });
        return $this;
    }

    public function lowercase()
    {
        $this->validations->push('case', function (string $value) {
            return ctype_lower($value);
        });
        return $this;
    }

    public function uppercase()
    {
        $this->validations->push('case', function (string $value) {
            return ctype_upper($value);
        });
    }

    public function alphanumeric()
    {
        $this->validations->push('alpha', function (string $value) {
            return ctype_alnum($value);
        });
        return $this;
    }

    public function alpha()
    {
        $this->validations->push('case', function (string $value) {
            return ctype_alpha($value);
        });

        return $this;
    }

    public function required(bool $required)
    {
        $this->validations->push('empty', function (string $value) use ($required) {
            if ($required) {
                return empty($value) === false;
            }
            return true;
        });
        return $this;
    }

    public function pattern(string $pattern)
    {
        $this->validations->push('empty', function (string $value) use ($pattern) {
            return preg_match($pattern, $value) === 1;
        });
        return $this;
    }

    public function email(?string $message = 'Email is valid')
    {
        $this->validations->push('email', function (string $value) use ($message) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return NULL;
            };
            return $message;
        });
        return $this;
    }

    public function ip(?string $message = 'IP address is not valid')
    {
        $this->validations->push('ip', function (string $value) use ($message) {
            if (filter_var($value, FILTER_VALIDATE_IP)) {
                return NULL;
            }
            return $message;
        });
        return $this;
    }

    public function minLength(int $minLength, ?string $message = 'String must be at least %d characters')
    {
        $this->validations->push('min', function (string $value) use ($minLength, $message) {
            if (mb_strlen($value) > $minLength) {
                return NULL;
            }
            return sprintf($message, $minLength);
        });
        return $this;
    }

    public function maxLength(int $maxLength, ?string $message = 'String must have less than %d characters')
    {
        $this->validations->push('max', function (string $value) use ($maxLength, $message) {
            if (mb_strlen($value) < $maxLength) {
                return NULL;
            }
            return sprintf($message, $maxLength);
        });
        return $this;
    }

    public function exactLength(int $length, ?string $message = 'String must have %d characters') {
        $this->validations->push('exact', function (string $value) use ($length, $message) {
            if (mb_strlen($value) === $length) {
                return NULL;
            }
            return sprintf($message, $length);
        });

        return $this;
    }

    public function url(?string $message = 'URL is not valid')
    {
        $this->validations->push('url', function (string $value) use ($message) {
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                return NULL;
            }
            return $message;
        });
        return $this;
    }
}
