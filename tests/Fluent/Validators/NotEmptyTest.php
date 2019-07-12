<?php

namespace BrosSquad\FluVal\Tests\Fluent\Validators;

use PHPUnit\Framework\TestCase;
use BrosSquad\FluVal\Fluent\Validators\NotEmpty;
use stdClass;

class NotEmptyTest extends TestCase
{
    public function test_not_empty()
    {
        $empty = new NotEmpty();

        return $this->assertTrue($empty->validate('not empty'));
    }

    public function test_string_is_empty()
    {
        $empty = new NotEmpty();

        return $this->assertFalse($empty->validate(''));
    }

    public function test_empty_array()
    {

        $empty = new NotEmpty();

        return $this->assertFalse($empty->validate([]));
    }

    public function test_full_array()
    {

        $empty = new NotEmpty();

        return $this->assertTrue($empty->validate(['not', 'empty', 'array']));
    }

    public function test_null()
    {
        $empty = new NotEmpty();

        return $this->assertFalse($empty->validate(null));
    }

    public function test_object()
    {
        $empty = new NotEmpty();

        return $this->assertTrue($empty->validate(new stdClass()));
    }

    public function test_number()
    {
        $empty = new NotEmpty();

        return $this->assertTrue($empty->validate(5));
    }
}
