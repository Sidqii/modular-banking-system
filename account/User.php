<?php

namespace Account;

use Traits\HasValidation;

require_once __DIR__ . "/../traits/HasValidation.php";

class User
{
    use HasValidation;

    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $this->validateUsername($username);
        $this->password = $this->validatePassword($password);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
