<?php

namespace Account\Authentication;

class AuthSession
{
    private bool $isLoggedIn = false;
    private ?int $currentUser;

    public function active(int $id)
    {
        $this->isLoggedIn = true;

        $this->currentUser = $id;
    }

    public function inactive()
    {
        $this->isLoggedIn = false;

        $this->currentUser = null;
    }

    public function isAuthenticated()
    {
        return $this->isLoggedIn;
    }

    public function currentUser(): ?string
    {
        return $this->currentUser;
    }
}
