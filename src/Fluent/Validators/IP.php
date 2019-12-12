<?php


namespace BrosSquad\FluVal\Fluent\Validators;


class IP extends AbstractFluentValidator
{
    public const IPV6 = FILTER_FLAG_IPV6;
    public const IPV4 = FILTER_FLAG_IPV4;

    public const NO_RESERVED = FILTER_FLAG_NO_RES_RANGE;
    public const NO_PRIVATE  = FILTER_FLAG_NO_PRIV_RANGE;

    protected int $flags;

    public function __construct(int $flags = self::IPV4 | self::IPV6, bool $required = false)
    {
        parent::__construct($required);
        $this->flags = $flags;
    }

    public function validate($value): bool
    {
        return $this->optional($value) ?? filter_var($value, FILTER_VALIDATE_IP, ['flags' => $this->flags]) !== false;
    }
}
