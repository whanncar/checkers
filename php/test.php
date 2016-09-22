<html>
<body>
<table border="1">

<?php

  include("utils.php");

  add_user("anna", "banana");
  add_user("jim", "bob");

  $game_id = create_new_game("anna", "jim");

  set_up_new_game_board($game_id);

  $board_state = get_board_state($game_id);

  for ($i = 0; $i < 8; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 8; $j++) {
      if ($board_state[$j][7-$i] == 1) {
       echo "<td width=\"50\" height=\"50\"><img src=\"../img/red_circle.png\" width=\"50\" height=\"50\"></td>"; 
      }
      else if ($board_state[$j][7-$i] == 2) {
        echo "<td width=\"50\" height=\"50\"><img src=\"../img/black_circle.png\" width=\"50\" height=\"50\"></td>";
      }
      else {
        echo "<td width=\"50\" height=\"50\"></td>";
      } 
    }
    echo "</tr>";
  }

?>

</table>
</body>
</html>
