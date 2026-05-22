<?php

namespace Account\Bank;

use Contract\TransactionFee;

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/../../contract/TransactionFee.php';

class PremiumAccount extends BankAccount implements TransactionFee
{
    #[\Override]
    public function additionByFee(int $ammount)
    {
        return $ammount + 150;
    }

    #[\Override]
    public function deductionByFee(int $ammount)
    {
        return $ammount - 150;
    }
}
