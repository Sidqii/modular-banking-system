<?php

namespace Data;

class DummyDatabase
{
    private array $data = [
        [
            'username' => 'mathilda',
            'password' => 'mathilda123',
            'balance' => 50000,
        ],
        [
            'username' => 'anggoro',
            'password' => 'anggoro123',
            'balance' => 10000,
        ],
        [
            'username' => 'racoon',
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
