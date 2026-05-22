<?php

namespace Account\Bank;

use Contract\TransactionFee;

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/../../contract/TransactionFee.php';

class PremiumAccount extends BankAccount implements TransactionFee
{
    #[\Override]
    public function deductionByFee(int $ammount)
    {
        return $ammount + 150;
    }

    #[\Override]
    public function additionByFee(int $ammount)
    {
        throw new \Exception('Not implemented');
    }

    public function deposito(int $ammount)
    {
        $this->transaction($ammount, self::DEPOSITO);
    }

    public function withdraw(int $ammount)
    {
        $this->transaction(
            $this->deductionByFee($ammount),
            self::WITHDRAW,
        );
    }
}
