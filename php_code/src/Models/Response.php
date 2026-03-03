<?php

namespace App\Amasty\Models;

class Response {
  private $conn;
  private $tableName;

  public function __construct($db) {
      $this->conn = $db;
  }

  public function create(string $responseText) {
    $statement = $this->conn->prepare('INSERT INTO responses (description)
          VALUES (:description)');

    $statement->execute([
      'description' => trim($responseText),
    ]);

    return $this->conn->lastInsertId();
  }

  public function load(int $ID) {
    $statement = $this->conn->prepare('SELECT * FROM responses WHERE id = :id');

    $statement->execute([
      'id' => $ID,
    ]);

    return $statement->fetch();
  }
}
