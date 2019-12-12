<?php

namespace BrosSquad\FluVal;


abstract class ValidationModel extends AbstractValidationModel
{
    protected $token;

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

}
