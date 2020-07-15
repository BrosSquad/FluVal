<?php


namespace BrosSquad\FluVal\Tests;


use TypeError;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use BrosSquad\FluVal\Validator;

class ValidatorTest extends TestCase
{
    protected Validator $validator;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->validator = new Validator();
    }

    public function test_is_alpha(): void
    {
        self::assertTrue($this->validator->isAlpha('Onlyalphacharacters'));
    }

    public function test_not_alpha(): void
    {
        self::assertFalse($this->validator->isAlpha('Not Only alpha characters'));
    }

    public function test_string_has_numeric_characters(): void
    {
        self::assertTrue($this->validator->isNumeric('56384'));
    }

    public function test_string_is_not_valid_email(): void
    {
        self::assertFalse($this->validator->isEmail('test@test'));
    }

    public function test_string_is_valid_email(): void
    {
        self::assertTrue($this->validator->isEmail('test@test.com'));
    }

    public function test_string_is_valid_ip(): void
    {
        self::assertTrue($this->validator->isIp('192.168.0.1'));
    }

    public function test_is_before(): void
    {
        $now = Carbon::now();
        $yesterday = new Carbon('yesterday');

        self::assertTrue($this->validator->isBefore($yesterday, $now));
    }

    public function test_is_before_throws_error(): void
    {
        $this->expectException(TypeError::class);
        $yesterday = new Carbon('yesterday');

        self::assertTrue($this->validator->isBefore(null, $yesterday));
    }

    public function test_is_after(): void
    {
        $now = Carbon::now();
        $yesterday = new Carbon('yesterday');

        self::assertTrue($this->validator->isBefore($yesterday, $now));
    }

    public function test_is_after_throws_error(): void
    {
        $this->expectException(TypeError::class);
        $yesterday = new Carbon('yesterday');

        self::assertFalse($this->validator->isAfter(null, $yesterday));
    }

    public function test_starts_with(): void
    {
        $string = 'Testing string';
        $starsWith = 'Test';

        $this->assertTrue($this->validator->startsWith($string, $starsWith));
    }

    public function test_is_null()
    {
        $item = null;

        $this->assertTrue($this->validator->isNull($item));
    }
}
