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

    public function doRegis(string $name, string $email, string $password): void
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)"
        );

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function doLogin(string $email)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "SELECT * FROM users WHERE email = :email",
        );

        $statement->execute([
            "email" => $email,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function userById(int $id)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "SELECT * FROM users WHERE id = :id",
        );

        $statement->execute([
            "id" => $id,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function getUserBalance(int $id)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "SELECT balance FROM accounts WHERE user_id = :id",
        );

        $statement->execute([
            "id" => $id,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function updateBalance(int $id, int $balance): void
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "UPDATE accounts SET balance = :balance WHERE user_id = :id",
        );

        $statement->execute([
            "id" => $id,
            "balance" => $balance,
        ]);
    }

    public function makeAccount(int $id, int $openBalance)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO account (user_id, balance, level)
            VALUES (:user_id, :open_balance, regular)"
        );

        $statement->execute([
            "user_id" => $id,
            "open_balance" => $openBalance,
        ]);
    }
}
