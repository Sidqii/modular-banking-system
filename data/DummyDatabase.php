<?php

namespace Data;

class DummyDatabase
{
    private array $data = [
        [
            'name' => 'mathilda',
            'username' => 'mathilda@mail.com',
            'password' => 'mathilda123',
            'balance' => 50000,
        ],
        [
            'name' => 'anggoro',
            'username' => 'anggoro@mail.com',
            'password' => 'anggoro123',
            'balance' => 10000,
        ],
        [
            'name' => 'racoon',
            'username' => 'racoon@mail.com',
            'password' => 'racoon123',
            'balance' => 80000,
        ],
    ];

    public function updateBalance(string $userName, int $newBalance)
    {
        foreach ($this->data as $index => $value) {

            if ($value['username'] === $userName) {

                return $this->data[$index]['balance'] = $newBalance;
            }
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
