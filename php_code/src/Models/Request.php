<?php

namespace App\Amasty\Models;

class Request {
    private $conn;
    private $tableName;

    public int $task_id;
    public string $createdDate;
    public string $updatedDate;
    public string $status;
    public string $description;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createRequest($description, $status = 1) {
        $statement = $this->conn->prepare('INSERT INTO requests (description, status)
              VALUES (:description, :status)');

        return $statement->execute([
          'description' => $description,
          'status' => $status,
        ]);
    }

    public function getAllRequests() {
        $sql = "SELECT * FROM requests";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function load(int $ID) {
      $this->task_id = $ID;
      $statement = $this->conn->prepare('SELECT * FROM requests WHERE task_id = :task_id');

      $statement->execute([
        'task_id' => $ID,
      ]);

      return $statement->fetchAll();
    }

    public function load2(int $ID) {
      $this->task_id = $ID;
      $statement = $this->conn->prepare('SELECT * FROM requests WHERE task_id = :task_id');

      #$statement->setFetchMode(\PDO::FETCH_CLASS, Request::class, $this->conn);
      $statement->execute([
        'task_id' => $ID,
      ]);

      return $statement->fetchAll();
    }

    public function update() {
      $statement = $this->conn->prepare('SELECT * FROM requests WHERE task_id = :task_id');

      $statement->execute([
        'task_id' => $ID,
      ]);

      return $statement->fetchAll();
    }

}
