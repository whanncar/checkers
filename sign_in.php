<?php

  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["user_name"] == "jim" && $_POST["password"] == "bob") {
      echo "successful login!";
    }

    else {
      header("Location:index.html");
    }
  }

?>
