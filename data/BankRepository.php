<?php

namespace Data;

use PDO;

require_once __DIR__ . "/Database.php";

class BankRepository
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUserAccount(int $id)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "SELECT * FROM accounts WHERE user_id = :id",
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

    public function openBalance(int $id, int $openBalance)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO accounts (user_id, balance, level)
            VALUES (:user_id, :open_balance, :level)"
        );

        $statement->execute([
            "user_id" => $id,
            "open_balance" => $openBalance,
            "level" => $openBalance > 150000 ? "premium" : "regular"
        ]);
    }

    public function transaction(int $id, int $amount, string $type)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO transactions (account_id, amount, type) VALUES (:id, :amount, :type)"
        );

        $statement->execute([
            "id" => $id,
            "amount" => $amount,
            "type" => $type,
        ]);
    }
}
