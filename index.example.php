<?php

use Data\Env;
use Account\User;
use Account\Bank\PremiumAccount;
use Account\Authentication\AuthService;

require_once __DIR__ . "/data/Env.php";
require_once __DIR__ . "/account/bank/PremiumAccount.php";
require_once __DIR__ . "/account/authentication/AuthService.php";

/**
 * HERE LIES 🥀
 * AUTHOR'S
 * COFFEE AND DEBUG
 */

Env::load(__DIR__ . "/.env");

try {
    $user = new User(
        name: 'racoon',
        username: 'racoon@test.com',
        password: 'racoon123',
    );

    $services = new AuthService();

    // change into login method to access check balance👍
    $services->createAccount($user, 185000);

    $bankAccount = new PremiumAccount($services);

    echo $bankAccount->checkBalance();
} catch (\Throwable $th) {
    echo $th->getMessage();
}
