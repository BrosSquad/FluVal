<?php


namespace Dusan\PhpMvc\Tests\Validation\Fluent;


use Dusan\PhpMvc\Validation\ValidationModel;

class User extends ValidationModel
{
    protected $name;
    protected $email;
    protected $accepted;
    protected $password;

    /**
     * User constructor.
     *
     * @param $name
     * @param $email
     * @param $accepted
     * @param $password
     */
    public function __construct($name, $email, $accepted, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->accepted = $accepted;
        $this->password = $password;
    }


}
