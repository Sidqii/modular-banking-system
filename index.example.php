<?php

use Data\Env;
use Account\User;
use Account\Bank\RegularAccount;
use Account\Authentication\AuthService;

require_once __DIR__ . "/data/Env.php";
require_once __DIR__ . "/account/bank/RegularAccount.php";
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
        username: 'racoon@mail.com',
        password: 'racoon123',
    );

    $service = new AuthService();

    $service->login($user);

    $bank = new RegularAccount($service);

    $bank->withdraw(5200);
    // $bank->deposito(5500);

    echo $bank->checkBalance();
} catch (\Throwable $th) {
    echo $th->getMessage();
}
