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

    public function register(User $user)
    {
        $this->repository->doRegis(
            $user->getName(),
            $user->getUsername(),
            $user->getPassword(),
        );
    }

    public function login(User $user)
    {
        $currentUser = $this->repository->doLogin($user->getUsername());

        if (!$currentUser) {
            throw new \Exception("error: account not found");
        }

        if ($user->getPassword() !== $currentUser->password) {
            throw new \Exception("error: invalid credentials");
        }

        return $this->session->active($currentUser->id);
    }

    public function logout()
    {
        $this->session->inactive();
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
