<?php

namespace App\Amasty\Models;

class User {
    private $conn;
    private $tableName;

    public int $id;
    public string $name;
    public string $password;

    public function __construct($db, $login, $password) {
      $this->conn = $db;
      $this->name = $login;
      $this->password = create_password_hash($password);
    }


    public function create_user() {
        $sql = "INSERT INTO users (name, password) VALUES(:name, :password)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':password', $this->password);

        $stmt->execute();

        return $this->conn->lastInsertId();
    }


    public function create_password_hash(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
