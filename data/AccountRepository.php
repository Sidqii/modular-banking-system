<?php

namespace Data;

use PDO;

require_once __DIR__ . "/Database.php";

class AccountRepository
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function createAccount(string $name, string $username, string $password)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO accounts (name, username, password) VALUES (:name, :username, :password)"
        );

        $statement->execute([
            'name' => $name,
            'username' => $username,
            'password' => $password,
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsername(string $username)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "SELECT * FROM accounts WHERE username = :username",
        );

        $statement->execute([
            "username" => $username,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function updateBalance(string $username, int $balance)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "UPDATE accounts SET balance = :balance WHERE username = :username",
        );

        $statement->execute([
            "username" => $username,
            "balance" => $balance,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }
}
