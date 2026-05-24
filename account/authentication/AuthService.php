<?php

namespace Account\Authentication;

use Account\User;
use Data\AccountRepository;
use Data\BankRepository;
use Traits\HasActivity;

require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/AuthSession.php";

require_once __DIR__ . "/../../data/BankRepository.php";
require_once __DIR__ . "/../../data/AccountRepository.php";

require_once __DIR__ . "/../../traits/HasActivity.php";

class AuthService
{
    use HasActivity;

    private AuthSession $session;
    private BankRepository $bankRepository;
    private AccountRepository $accountRepository;

    public function __construct()
    {
        $this->session = new AuthSession();
        $this->bankRepository = new BankRepository();
        $this->accountRepository = new AccountRepository();
    }

    public function createAccount(User $user, int $ammount)
    {
        $id = $this->accountRepository->doRegis(
            $user->getName(),
            $user->getUsername(),
            $user->getPassword(),
        );

        $this->bankRepository->openBalance($id, $ammount);
    }

    public function login(User $user)
    {
        $currentUser = $this->accountRepository->doLogin($user->getUsername());

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
