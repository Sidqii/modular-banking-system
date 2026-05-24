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

    public function validateAmmount(int $balance, int $amount, string $action)
    {
        if ($action === 'withdraw' && $amount <= 25000) {
            throw new \Exception("error: amount transaction minimum 25000");
        }

        if ($action === 'withdraw' && $amount >= $balance) {
            throw new \Exception("failed: insufficient balance");
        }

        return $amount;
    }
}
