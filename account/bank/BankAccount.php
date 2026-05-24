<?php

namespace Account\Bank;

use Account\Authentication\AuthService;
use Data\BankRepository;
use Traits\HasActivity;

require_once __DIR__ . "/../authentication/AuthService.php";
require_once __DIR__ . "/../../data/BankRepository.php";
require_once __DIR__ . "/../../traits/HasActivity.php";

abstract class BankAccount
{
    use HasActivity;

    protected AuthService $service;
    protected BankRepository $repository;

    protected const DEPOSITO = "deposito";
    protected const WITHDRAW = "withdraw";

    public function __construct(AuthService $service)
    {
        $this->service = $service;
        $this->repository = new BankRepository();
    }

    public function checkBalance()
    {
        if (!$this->service->authenticated()) {
            throw new \Exception("error: unauthenticated user");
        }

        $currentUser = $this->service->currentUser();

        $userAccount = $this->repository->getUserAccount($currentUser);

        return $this->loggerActivity("balance: IDR " . $userAccount->balance);
    }

    protected function transaction(int $currentUser, int $amount, string $action)
    {
        $userAccount = $this->repository->getUserAccount($currentUser);

        $balance = $userAccount->balance;

        switch ($action) {
            case self::DEPOSITO:
                $this->repository->updateBalance($currentUser, $balance += $amount);

                $this->repository->transaction($currentUser, $amount, self::DEPOSITO);

                return $balance;

            case self::WITHDRAW:
                $this->repository->updateBalance($currentUser, $balance -= $amount);

                $this->repository->transaction($currentUser, $amount, self::WITHDRAW);

                return $balance;

            default:
                throw new \Exception("error: invalid action input");
        }
    }
}
