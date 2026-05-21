<?php

require_once __DIR__ . '/accounts/RegularAccount.php';

$account = new RegularAccount('mathilda', 5000);

try {
    echo $account->checkBalance();
} catch (\Throwable $th) {
    echo $th->getMessage();
}