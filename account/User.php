<?php

namespace Account;

use Traits\HasValidation;

require_once __DIR__ . "/../traits/HasValidation.php";

class User
{
    use HasValidation;

    private ?string $name;
    private string $username;
    private string $password;

    public function __construct(string $username, string $password, ?string $name = null)
    {
        $this->username = $this->validateUsername($username);
        $this->password = $this->validatePassword($password);
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
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
