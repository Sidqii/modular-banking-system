<?php

namespace Account\Bank;

use Account\Authentication\AuthService;
use Account\Authentication\AuthSession;
use Account\User;
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
            if ($balance['username'] === $this->service->credentials()) {
                return $this->loggerActivity('balance: total balance ' . $balance['balance']);
            }
        }

        throw new \Exception(
            $this->loggerActivity("error: username " . $this->service->credentials() . " not found")
        );
    }

    abstract function deposito();

    abstract function withdraw();
}
