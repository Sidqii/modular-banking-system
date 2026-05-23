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

    #[\Override]
    public function additionByFee(int $ammount)
    {
        throw new \Exception("Not implemented");
    }

    public function deposito(int $ammount)
    {
        $currentUser = $this->repository->getUsername(
            $this->service->currentUser()
        );

        $this->validateAmmount(
            $currentUser->balance,
            $ammount,
            self::DEPOSITO
        );

        $this->transaction(
            $currentUser,
            $ammount,
            self::DEPOSITO
        );

        return $this->loggerActivity(
            "deposito: {$ammount}"
        );
    }

    public function withdraw(int $ammount)
    {
        $currentUser = $this->repository->getUsername(
            $this->service->currentUser()
        );

        $this->validateAmmount(
            $currentUser->balance,
            $ammount,
            self::WITHDRAW
        );

        $this->transaction(
            $currentUser,
            $this->deductionByFee($ammount),
            self::WITHDRAW
        );

        return $this->loggerActivity(
            "withdraw: {$ammount}"
        );
    }
}
