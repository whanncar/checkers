<?php

  session_start();

  include("php/utils.php");

  if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    header("Location:index.html");
  }

?>

<html>

  <head>

    <title>

      <?php echo $_SESSION["user_name"];?>'s Dashboard

    </title>

  </head>

  <body>

    <table>

      <tr>

        <td>

          <u>Current games</u><br>

          <?php

            $games = get_user_games($_SESSION["user_id"]);

            for ($i = 0; $i < count($games); $i++) {
              echo "{$games[$i]["game_id"]} (with {$games[$i]["opponent"]})<br>";
            }

          ?>

        </td>

      </tr>

    </table>

  </body>

</html>
