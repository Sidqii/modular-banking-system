<?php

trait HasTransactionLogger
{
    public function logTransaction(string $message)
    {
        return "[LOG]::{$message}";
    }
}
