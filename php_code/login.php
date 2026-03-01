<?php

require_once(__DIR__ . "/mysqli.php");


if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT password FROM users WHERE name = $login;");

    $hashed_password = $query->execute();

    $result = password_verify($password, $hashed_password);

    if(!$result) {
        echo 'Incorrect password';
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/styles.css">
    <title>Login</title>
</head>

<body>

<div>

  <?php if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])): ?>
    <form action="/logout.php" method="POST">
        <input type="submit" value="Logout">
    </form>
  <?php else: ?>
    <form action="/auth.php" method="POST">
        <input type="text" name="login" value=""><br>
        <input type="text" name="password" value=""><br>
        <input type="submit">
    </form>
  <?php endif; ?>
</div>

</body>

</html>
