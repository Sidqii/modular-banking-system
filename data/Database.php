<?php

namespace Data;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            sprintf(
                "pgsql:host=%s;port=%s;dbname=%s",
                $_ENV["DB_HOST"],
                $_ENV["DB_PORT"],
                $_ENV["DB_NAME"],
            ),
            $_ENV["DB_USER"],
            $_ENV["DB_PASSWORD"],
        );
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
