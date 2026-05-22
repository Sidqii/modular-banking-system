<?php

namespace Account\Authentication;

use Account\User;
use Data\DummyDatabase;
use Traits\HasActivity;

require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/AuthSession.php';
require_once __DIR__ . '/../../data/DummyDatabase.php';
require_once __DIR__ . '/../../traits/HasActivity.php';

class AuthService
{
    use HasActivity;

    private AuthSession $session;
    private DummyDatabase $database;

    public function __construct()
    {
        $this->session = new AuthSession();
        $this->database = new DummyDatabase();
    }

    public function login(User $user)
    {
        $username = $user->getUsername();
        $password = $user->getPassword();

        foreach ($this->database->getData() as $data) {

            if ($data['username'] === $username && $data['password'] === $password) {

                $this->session->login($username);

                return $this->loggerActivity('success: login successfully');
            }
        }

        throw new \Exception($this->loggerError($username . " not found."));
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
