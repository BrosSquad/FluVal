<?php


namespace BrosSquad\FluVal\Tests;


use Carbon\Carbon;
use BrosSquad\FluVal\Validator;
use PHPUnit\Framework\TestCase;
use TypeError;

class ValidatorTest extends TestCase
{
    protected $validator;

    public function __construct($name = NULL, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->validator = new Validator();
    }

    public function test_is_alpha() {
        $this->assertTrue($this->validator->isAlpha('Onlyalphacharacters'));
    }

    public function test_not_alpha() {
        $this->assertFalse($this->validator->isAlpha('Not Only alpha characters'));
    }

    public function test_string_has_numeric_characters() {
        $this->assertTrue($this->validator->isNumeric('56384'));
    }

    public function test_string_is_not_valid_email() {
        $this->assertFalse($this->validator->isEmail('test@test'));
    }

    public function test_string_is_valid_email() {
        $this->assertTrue($this->validator->isEmail('test@test.com'));
    }

    public function test_string_is_valid_ip() {
        $this->assertTrue($this->validator->isIp('192.168.0.1'));
    }

    public function test_is_before() {
        $now = Carbon::now();
        $yesterday = new Carbon('yesterday');

        $this->assertTrue($this->validator->isBefore($yesterday, $now));
    }

    public function test_is_before_throws_error() {
        $this->expectException(TypeError::class);
        $yesterday = new Carbon('yesterday');

        $this->assertTrue($this->validator->isBefore($yesterday, null));
    }

    public function test_is_after() {
        $now = Carbon::now();
        $yesterday = new Carbon('yesterday');

        $this->assertTrue($this->validator->isBefore($yesterday, $now));
    }

    public function test_is_after_throws_error() {
        $this->expectException(TypeError::class);
        $yesterday = new Carbon('yesterday');

        $this->assertTrue($this->validator->isAfter($yesterday, null));
    }

    public function test_starts_with() {
        $string = 'Testing string';
        $starsWith = 'Test';

        $this->assertTrue($this->validator->startsWith($string, $starsWith));
    }

    public function test_is_null() {
        $item = null;

        $this->assertTrue($this->validator->isNull($item));
    }
}
