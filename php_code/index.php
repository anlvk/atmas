<?php

session_start();
//echo "INDEX PHP" . "</br>";

//echo "PURE PHP";

require 'vendor/autoload.php';

#require_once('mysqli.php');

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// q
//print_r($request);

if(preg_match("/^\/request\/([a-z0-9\-]+)\/?$/", $request)) {
  require_once(__DIR__ . "/request.php");
  exit;
}

if(preg_match("/^\/request\/([a-z0-9\-]+)\/response\/?$/", $request)) {
  require_once(__DIR__ . "/response.php");
  exit;
}

$result = match($request) {
    "/authorize" => require_once(__DIR__ . "/auth.php"),
    "/logout" => require_once(__DIR__ . "/logout.php"),
    "/login" => require_once(__DIR__ . "/login.php"),
    "/register" => require_once(__DIR__ . "/register.php"),

    "", "/" => require_once(__DIR__ . "/home.php"),
    "/mysqli" => require_once(__DIR__ . "/mysqli.php"),

    "/requests" => require_once(__DIR__ . "/requests.php"),
    "/request" => require_once(__DIR__ . "/request.php"),

    "/response" => require_once(__DIR__ . "/response.php"),

    default => http_response_code(404),
};

//include "auth.php";
