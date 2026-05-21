<?php

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/../contracts/TransactionFee.php';
require_once __DIR__ . '/../traits/HasTransactionLogger.php';

class PremiumAccount extends BankAccount implements TransactionFee
{
    #[Override]
    public function calculateDeduction(int $amount)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function deposit(int $amount)
    {
        throw new \Exception('Not implemented');
    }

    #[Override]
    public function withdraw(int $amount)
    {
        throw new \Exception('Not implemented');
    }
}
