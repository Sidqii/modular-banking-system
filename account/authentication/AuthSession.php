<?php

namespace Account\Authentication;

class AuthSession
{
    private bool $isLoggedIn = false;
    private string $currentUser;

    public function login(string $username)
    {
        $this->isLoggedIn = true;

        $this->currentUser = $username;
    }

    public function logout()
    {
        $this->isLoggedIn = false;
    }

    public function isAuthenticated()
    {
        return $this->isLoggedIn;
    }

    public function currentUser()
    {
        return $this->currentUser;
    }
}
