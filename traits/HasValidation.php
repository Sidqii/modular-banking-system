<?php

namespace Traits;

trait HasValidation
{
    public function validateUsername(string $text)
    {
        if (!str_contains(explode("@", $text)[1], ".")) {
            throw new \Exception("error: invalid username input");
        }

        if (strlen($text) <= 3) {
            throw new \Exception("error: username must be more than 3 characters");
        }

        return $text;
    }

    public function validatePassword(string $text)
    {
        if (strlen($text) <= 5) {
            throw new \Exception("error: password length less than 5 characters");
        }

        return $text;
    }

    public function validateAmmount(int $balance, int $ammount, string $action)
    {
        if ($ammount <= 5000) {
            throw new \Exception("error: ammount transaction minimum 5000");
        }

        if ($action === 'withdraw' && $ammount >= $balance) {
            throw new \Exception("failed: insufficient balance");
        }

        return $ammount;
    }
}
