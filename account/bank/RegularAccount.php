<?php

namespace Account\Bank;

require_once __DIR__ . '/BankAccount.php';

class RegularAccount extends BankAccount
{
    #[\Override]
    public function deposito()
    {
        throw new \Exception('Not implemented');
    }

    #[\Override]
    public function withdraw()
    {
        throw new \Exception('Not implemented');
    }
}
