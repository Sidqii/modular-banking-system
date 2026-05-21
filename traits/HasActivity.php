<?php

namespace Traits;

trait HasActivity
{
    public function loggerActivity(string $message)
    {
        return "[ACT]::{$message}";
    }
}
