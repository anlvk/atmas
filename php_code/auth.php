<?php

require_once(__DIR__ . "/mysqli.php");

// $_POST
#print_r($_POST);

if(!empty($_POST['login']) && !empty($_POST['password'])) {
    // VALIDATE AUTHORIZATION
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT password FROM users WHERE name = :name;");
    $query->bindValue(':name', $login);

    $query->execute();
    $hashed_password = $query->fetchColumn();

    if(!$hashed_password) {
      echo "No such a user<br>";
      #echo("<script>window.location = '/login.php';</script>");
      exit;
    }

    $result = password_verify($password, $hashed_password);

    if(!$result) {
        echo "Incorrect password";
        exit;
    }

    $_SESSION['auth'] = true;

    $_SESSION['auth'] = [
      'auth' => TRUE,
      'user' => $login,
      'sid' => session_id(),
    ];

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/styles.css">
</head>

<body>

<div>
  <?php if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])): ?>
    <form action="/logout" method="POST">
        <input type="submit" value="Logout">
    </form>
  <?php endif; ?>

</div>

</body>

</html>
