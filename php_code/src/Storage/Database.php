<?php

namespace App\Amasty\Storage;

require_once(__DIR__ . "/../../config.php");

class Database {
    private $host = DB_HOST;
    private $DBName = DB_DATABASE;
    private $DBPort = DB_PORT;
    private $username = DB_USER;
    private $password = DB_PASSWORD;
    private $conn;

    public function getConnection() {
        $this->conn = null;

        $dsn = "mysql:host=". $this->host .";dbname=". $this->DBName .";charset=utf8mb4;port=". $this->DBPort;
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,       // Default to associative arrays for fetches
            \PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulation for "real" prepared statements
        ];

        try {
            $this->conn = new \PDO($dsn, $this->username, $this->password, $options);
             // Установка режима обработки ошибок в исключения
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            #echo "Connected successfully to MariaDB! <br>";
        } catch (\PDOException $e) {
            // Log the error message to an error log, do not expose sensitive info to the user
            error_log($e->getMessage());
            exit('Something bad happened');
        }

        return $this->conn;
    }
}
