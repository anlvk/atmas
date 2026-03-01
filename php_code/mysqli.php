<?php


require_once(__DIR__ . "/config.php");

use App\Amasty\Storage\Database;

$database = new Database();
$db = $database->getConnection();
