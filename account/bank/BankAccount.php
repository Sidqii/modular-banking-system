<?php

namespace Account\Bank;

use Account\Authentication\AuthService;
use Data\AccountRepository;
use Traits\HasActivity;

require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/../../traits/HasActivity.php";
require_once __DIR__ . "/../authentication/AuthService.php";
require_once __DIR__ . "/../authentication/AuthSession.php";

abstract class BankAccount
{
    use HasActivity;

    protected AuthService $service;
    protected AccountRepository $repository;

    protected const DEPOSITO = "deposito";
    protected const WITHDRAW = "withdraw";

    public function __construct(AuthService $service)
    {
        $this->service = $service;
        $this->repository = new AccountRepository();
    }

    public function checkBalance()
    {
        $getBalance = $this->repository->getUserBalance(
            $this->service->currentUser()
        );

        return $this->loggerActivity("balance: IDR " . $getBalance->balance);
    }

    public function createAccount()
    {
        throw new \Exception("unimplemented method");
    }

    protected function transaction(int $currentUser, int $ammount, string $action)
    {
        $getBalance = $this->repository->getUserBalance($currentUser);

        $balance = $getBalance->balance;

        switch ($action) {
            case self::DEPOSITO:
                $this->repository->updateBalance($currentUser, $balance += $ammount);

                return $balance;

            case self::WITHDRAW:
                $this->repository->updateBalance($currentUser, $balance -= $ammount);

                return $balance;

            default:
                throw new \Exception("error: invalid action input");
        }
    }
}
