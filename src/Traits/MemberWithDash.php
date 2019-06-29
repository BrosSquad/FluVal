<?php


namespace BrosSquad\FluVal\Traits;


trait MemberWithDash
{
    /**
     * @param string $name
     *
     * @return string
     */
    protected function memberWithDash(string $name) {
        $members = explode('_', $name);
        $newName = '';
        foreach($members as $member) {
            $newName .= ucfirst($member);
        }
        return $newName;
    }
}
