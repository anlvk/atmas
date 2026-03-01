<?php

class Response {
  private $conn;
  private $tableName;

  public function __construct($db) {
      $this->conn = $db;
  }
}
