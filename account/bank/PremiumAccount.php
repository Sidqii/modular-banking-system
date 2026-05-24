<?php

namespace Account\Bank;

use Traits\HasActivity;
use Traits\HasValidation;
use Contract\TransactionFee;

require_once __DIR__ . "/BankAccount.php";
require_once __DIR__ . "/../../contract/TransactionFee.php";

class PremiumAccount extends BankAccount implements TransactionFee
{
    use HasActivity, HasValidation;

    #[\Override]
    public function deductionByFee(int $amount)
    {
        return $amount + 150;
    }

    public function deposito(int $amount)
    {
        $currentUser = $this->service->currentUser();

        $userAccount = $this->repository->getUserAccount($currentUser);

        $userBalance = $userAccount->balance;

        $this->validateAmmount(
            $userBalance,
            $amount,
            self::DEPOSITO
        );

        $this->transaction(
            $currentUser,
            $amount,
            self::DEPOSITO
        );

        return $this->loggerActivity("deposito: IDR {$amount}");
    }

    public function withdraw(int $amount)
    {
        $currentUser = $this->service->currentUser();

        $userAccount = $this->repository->getUserAccount($currentUser);

        $totalAmount = $this->deductionByFee($amount);

        if ($userAccount->level === "regular") {
            $totalAmount += 300;
        }

        $this->validateAmmount(
            $userAccount->balance,
            $totalAmount,
            self::WITHDRAW
        );

        $this->transaction(
            $currentUser,
            $totalAmount,
            self::WITHDRAW
        );

        return $this->loggerActivity("withdraw: IDR {$amount}");
    }
}
