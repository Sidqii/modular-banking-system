<?php

abstract class BankAccount
{
    protected string $name;
    protected int $balance;

    public function __construct(string $name, int $balance)
    {
        $this->name = $name;
        $this->balance = $balance;
    }

    public function checkBalance()
    {
        return "welcome {$this->name}.\ntotal saldo: {$this->balance}.";
    }

    abstract public function deposit(int $amount);

    abstract public function withdraw(int $amount);
}
