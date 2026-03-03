<?php

namespace App\Amasty\Models;

class RequestResponse {
    private $conn;
    private $tableName;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function add(int $requestID, int $responseID) {
        $statement = $this->conn->prepare('INSERT INTO request_response (task_id, response_id)
              VALUES (:task_id, :response_id)');

        return $statement->execute([
          'task_id' => $requestID,
          'response_id' => $responseID,
        ]);
    }

    public function getResponseID(int $requestID) {
      $statement = $this->conn->prepare('SELECT response_id FROM request_response WHERE task_id = :task_id');

      $statement->execute([
        'task_id' => $requestID,
      ]);

      return $statement->fetchColumn();
    }
}
