<?php

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/../contracts/TransactionFee.php';
require_once __DIR__ . '/../traits/HasTransactionLogger.php';

class RegularAccount extends BankAccount implements TransactionFee
{
    use HasTransactionLogger;

    #[Override]
    public function calculateDeduction(int $amount)
    {
        return $amount + 300;
    }

    #[Override]
    public function deposit(int $amount)
    {
        if ($amount <= 3000) {
            throw new Exception("failed: minimal deposit is 3000.");
        }

        $this->balance += $amount;

        return $this->logTransaction(
            "success: deposit of {$amount} was successfully made."
        );
    }

    #[Override]
    public function withdraw(int $amount)
    {
        if ($amount <= 0) {
            throw new Exception("failed: enter the correct balance.");
        }

        if ($this->calculateDeduction($amount) > $this->balance) {
            throw new Exception("failed: your balance is insufficient.");
        }

        $this->balance -= $this->calculateDeduction($amount);

        return $this->logTransaction(
            "success: withdraw of {$amount} was succeefully made."
        );
    }
}
