<?php

namespace Account\Authentication;

use Account\User;
use Data\AccountRepository;
use Traits\HasActivity;

require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/AuthSession.php";
require_once __DIR__ . "/../../data/AccountRepository.php";
require_once __DIR__ . "/../../traits/HasActivity.php";

class AuthService
{
    use HasActivity;

    private AuthSession $session;
    private AccountRepository $repository;

    public function __construct()
    {
        $this->session = new AuthSession();
        $this->repository = new AccountRepository();
    }

    public function login(User $user)
    {
        $account = $this->repository->getUsername($user->getUsername());

        if (!$account) {
            throw new \Exception("error: unauthenticate user");
        }

        if ($account->password !== $user->getPassword()) {
            throw new \Exception("error: invalid credentials");
        }

        $this->session->login($account->username);

        return $this->session->isAuthenticated();
    }

    public function authenticated()
    {
        return $this->session->isAuthenticated();
    }

    public function currentUser()
    {
        return $this->session->currentUser();
    }
}
