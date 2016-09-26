<?php

  session_start();

  include("php/utils.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (validate_user_login($_POST["user_name"], $_POST["password"])) {
      /* Save user name */
      $_SESSION["user_name"] = $_POST["user_name"];

      /* Save user id */
      $user = get_user_from_db($_POST["user_name"]);
      $_SESSION["user_id"] = $user["user_id"];

      /* Set logged in */
      $_SESSION["logged_in"] = 1;
    }
  }

  header("Location:dashboard.php");

?>

