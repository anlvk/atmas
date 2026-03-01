<?php

session_start();
//echo "HOME" . "</br>";

if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
    echo "You're authorized </br>";
} else {
    echo "You're not authorized.";
    #header("Location: auth.php");
    #exit;
}

include("auth.php");
