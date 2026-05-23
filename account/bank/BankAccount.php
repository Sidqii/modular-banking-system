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

    public function createAccount()
    {
        throw new \Exception("Unimplemented method");
    }

    public function checkBalance()
    {
        $currentUser = $this->repository->getUsername($this->service->currentUser());

        return $this->loggerActivity("balance: " . $currentUser->balance);
    }

    protected function transaction(object $currentUser, int $ammount, string $action)
    {
        $userBalance = $currentUser->balance;

        switch ($action) {

            case self::DEPOSITO:
                return $this->repository->updateBalance(
                    $currentUser->username,
                    $userBalance += $ammount
                );

            case self::WITHDRAW:
                return $this->repository->updateBalance(
                    $currentUser->username,
                    $userBalance -= $ammount
                );

            default:
                throw new \Exception("error: invalid transaction action");
        }
    }
}
