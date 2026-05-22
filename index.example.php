<?php

use Account\Authentication\AuthService;
use Account\Bank\RegularAccount;
use Account\User;

require_once __DIR__ . '/account/authentication/AuthService.php';
require_once __DIR__ . '/account/User.php';
require_once __DIR__ . '/account/bank/RegularAccount.php';

/**
 * here some example what i've learn😁
 */

try {
    $user = new User('anggoro', 'anggoro123');

    $auth = new AuthService();

    $auth->login($user);

    $bank = new RegularAccount($auth);

    $bank->withdraw(5000);

    echo $bank->checkBalance();
} catch (\Throwable $th) {
    echo $th->getMessage();
}
