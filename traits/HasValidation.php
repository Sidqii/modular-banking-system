<?php

namespace Traits;

class HasValidation
{
    public function validateUsername(string $text)
    {
        // if (!preg_match('/^[a-zA-Z]+$/', $text)) {
        //     throw new \Exception('error: name can only contain alphabetical characters');
        // }

        if (!str_contains(explode('@', $text)[1], '.')) {
            throw new \Exception("error: invalid usename");
        }

        if (strlen($text) <= 3) {
            throw new \Exception("error: username must be more than 3 characters");
        }
    }
}
