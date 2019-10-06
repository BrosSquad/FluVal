<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class Integer extends AbstractFluentValidator
{
    public const OCTAL = FILTER_FLAG_ALLOW_OCTAL;
    public const HEX = FILTER_FLAG_ALLOW_HEX;

    protected $flags;

    public function __construct(int $flags = self::OCTAL | self::HEX)
    {
        $this->flags = $flags;
    }

    public function validate($value): bool
    {
        return $this->optional($value) ??
            is_int($value) || (filter_var($value, FILTER_VALIDATE_INT, ['flags' => $this->flags]) !== false);
    }
}
