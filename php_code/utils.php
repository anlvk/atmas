<?php

require_once('mysqli.php');

function create_users() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table users (id integer auto_increment primary key, name varchar(30), password varchar(255));";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Users has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}


function create_requests() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table requests (task_id integer auto_increment primary key, created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, status tinyint, title varchar(255), description text);";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Requests has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}

function create_responses() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table responses (id integer auto_increment primary key, description text);";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Responses has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}

function create_request_response() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table request_response (task_id integer, response_id integer);";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Request - Response has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}

function create_roles() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table roles (id integer auto_increment primary key, title varchar(255));";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Roles has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}

function create_users_roles() {
  // SQL-выражение для создания таблицы
  try {
      $sql = "create table users_roles (user_id integer, role_id integer);";
      // выполняем SQL-выражение
      $pdo->exec($sql);
      echo "Table Users - Roles has been created";
  }  catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
  }
}
