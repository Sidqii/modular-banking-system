<?php

namespace Traits;

trait HasActivity
{
    public function loggerActivity(string $message)
    {
        return "[LOG]:{$message}\n";
    }

    public function loggerError(string $message)
    {
        return "[ERROR]: {$message}\n";
    }
}
