<?php

namespace Account\Bank;

use Account\Authentication\AuthService;
use Data\DummyDatabase;
use Traits\HasActivity;

require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../traits/HasActivity.php';
require_once __DIR__ . '/../../data/DummyDatabase.php';
require_once __DIR__ . '/../authentication/AuthService.php';
require_once __DIR__ . '/../authentication/AuthSession.php';

abstract class BankAccount
{
    use HasActivity;

    protected DummyDatabase $balance;
    protected AuthService $service;

    protected const DEPOSITO = 'deposito';
    protected const WITHDRAW = 'withdraw';

    public function __construct(AuthService $service)
    {
        $this->balance = new DummyDatabase();
        $this->service = $service;
    }

    public function checkBalance()
    {
        if (!$this->service->authenticated()) {
            throw new \Exception("error: username are unauthenticated");
        }

        foreach ($this->balance->getData() as $balance) {

            if ($balance['username'] === $this->service->currentUser()) {

                return $this->loggerActivity('balance: total balance ' . $balance['balance']);
            }
        }

        throw new \Exception(
            $this->loggerActivity("error: username " . $this->service->currentUser() . " not found")
        );
    }

    protected function transaction(int $ammount, string $action)
    {
        foreach ($this->balance->getData() as $balance) {
            if ($balance['username'] === $this->service->currentUser()) {
                switch ($action) {
                    case self::DEPOSITO:

                        return $this->balance->updateBalance(
                            $this->service->currentUser(),
                            $balance['balance'] += $ammount
                        );

                    case self::WITHDRAW:

                        return $this->balance->updateBalance(
                            $this->service->currentUser(),
                            $balance['balance'] -= $ammount
                        );

                    default:
                        return $this->loggerActivity('failed: invalid action input');
                }
            }
        }
    }
}
