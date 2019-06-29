<?php


namespace BrosSquad\FluVal\Tests;


use BrosSquad\FluVal\Traits\MemberWithDash;
use PHPUnit\Framework\TestCase;

class TestMemberWithDashTrait extends TestCase
{
    use MemberWithDash;

    public function test_member_with_dash() {
        $this->expectOutputString('SomeMemberWithDashes');

        echo $this->memberWithDash('some_member_with_dashes');
    }
}
