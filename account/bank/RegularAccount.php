<?php

namespace Account\Bank;

use Contract\TransactionFee;
use Traits\HasActivity;
use Traits\HasValidation;

require_once __DIR__ . "/BankAccount.php";
require_once __DIR__ . "/../../contract/TransactionFee.php";

class RegularAccount extends BankAccount implements TransactionFee
{
    use HasActivity, HasValidation;

    #[\Override]
    public function deductionByFee(int $ammount)
    {
        return $ammount + 300;
    }

    public function deposito(int $ammount)
    {
        $currentUser = $this->service->currentUser();

        $userBalance = $this->repository->getUserBalance($currentUser)->balance;

        $this->validateAmmount(
            $userBalance,
            $ammount,
            self::DEPOSITO
        );

        $this->transaction(
            $currentUser,
            $ammount,
            self::DEPOSITO
        );

        return $this->loggerActivity("deposito: IDR {$ammount}");
    }

    public function withdraw(int $ammount)
    {
        $currentUser = $this->service->currentUser();

        $userBalance = $this->repository->getUserBalance($currentUser)->balance;

        $this->validateAmmount(
            $userBalance,
            $this->deductionByFee($ammount),
            self::WITHDRAW
        );

        $this->transaction(
            $currentUser,
            $ammount,
            self::WITHDRAW
        );

        return $this->loggerActivity("witdraw: IDR {$ammount}");
    }
}
