<?php

require_once(__DIR__ . "/mysqli.php");

use App\Amasty\Models\User;

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat-password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['repeat-password'];

    if(strcmp($password, $password2) == 0) {
      // CREATE A USER IN DATABASE
      try {
          // SQL statement to create a new database user
          // Note: Syntax might vary slightly depending on your specific database system (MySQL, PostgreSQL, etc.)
          if (!empty($username)) {
            $user = new User($db, $username, $password);
            $user->create_user();
            echo "User '{$username}' created successfully." . "<br>";
          }

          // Optionally, grant privileges to the new user here using further SQL statements and exec() or prepare()/execute()
          // Example (requires another query, not parameterized in this simple example for clarity):
          // $pdo->exec("GRANT SELECT, INSERT, UPDATE ON `your_database_name`.* TO '{$new_username}'@'{$host_name}'");

      } catch (PDOException $e) {
          die("Error creating database user: " . $e->getMessage());
      }
    } else {
         echo "Passwords don't match. Fix the problem and try again." . "<br>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>

<body>

<div>
    <form action="/register.php" method="POST">
        <input type="text" name="username" value="">
        <input type="text" name="password" value="">
        <input type="text" name="repeat-password" value="">
        <input type="submit">
    </form>
</div>

</body>

</html>
