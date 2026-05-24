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

    public function doRegis(string $name, string $email, string $password)
    {
        $connection = $this->database->getConnection();

        $statement = $connection->prepare(
            "INSERT INTO users (name, email, password) VALUES (:name, :email, :password) RETURNING id"
        );

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        return $statement->fetchColumn();
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
}
