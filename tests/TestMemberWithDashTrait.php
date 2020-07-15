<?php


namespace BrosSquad\FluVal\Tests;


use BrosSquad\FluVal\Traits\MemberWithDash;
use PHPUnit\Framework\TestCase;

class TestMemberWithDashTrait extends TestCase
{
    use MemberWithDash;

    public function test_member_with_dash(): void
    {
        $this->expectOutputString('SomeMemberWithDashes');

        echo $this->memberWithUnderscore('some_member_with_dashes');
    }
}
