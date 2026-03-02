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

    public function createRequest($description, $title, $status = 1) {
        $statement = $this->conn->prepare('INSERT INTO requests (description, status, title)
              VALUES (:description, :status, :title)');

        return $statement->execute([
          'description' => $description,
          'status' => $status,
          'title' => $title,
        ]);
    }

    public function getAllRequests() {
        $sql = "SELECT * FROM requests";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function load(int $ID) {
      $statement = $this->conn->prepare('SELECT * FROM requests WHERE task_id = :task_id');

      $statement->execute([
        'task_id' => $ID,
      ]);

      return $statement->fetchAll();
    }

    public function update(int $ID, string $description, string $title, int $status) {
      $statement = $this->conn->prepare('UPDATE requests SET description = :description, status = :status, title = :title WHERE task_id = :task_id');

      $statement->execute([
        'description' => $description,
        'status' => $status,
        'title' => $title,
        'task_id' => $ID,
      ]);

      return $statement->fetchAll();
    }

}
