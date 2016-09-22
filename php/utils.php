<?php

  include("db.php");


  function add_user($user_name, $password) {

    $rv = add_user_to_db($user_name, $password);

    return ($rv != -1);
  }



  function get_board_state($game_id) {

    $raw_board_state = get_board_state_from_db($game_id);

    for ($i = 0; $i < 8; $i++) {
      for ($j = 0; $j < 8; $j++) {

        $board_state[$i][$j] = 0;
      }
    }

    for ($i = 0; $i < count($raw_board_state); $i++) {
      $entry = $raw_board_state[$i];
      $board_state[$entry["y_coord"]][$entry["x_coord"]] = $entry["color"];
    }

    return $board_state;
  }



  function create_new_game($first_user_name, $second_user_name) {

    $first_user = get_user_from_db($first_user_name);
    $second_user = get_user_from_db($second_user_name);

    return create_new_game_in_db($first_user["user_id"], $second_user["user_id"]);
  }



  function validate_move($game_id, $user_id, $xi, $yi, $xf, $yf) {

    $game = get_game_from_db($game_id);

    if ($game["red_player"] == $user_id) {
      $user_color = 1;
    }
    else {
      $user_color = 2;
    }

    $board_state = get_board_state($game_id);

    /* Make sure positions are valid */
    if ($xi < 0 || $xi >= 8) {
      return 0;
    }
    if ($yi < 0 || $yi >= 8) {
      return 0;
    }
    if ($xf < 0 || $xf >= 8) {
      return 0;
    }
    if ($yf < 0 || $yf >= 8) {
      return 0;
    }

    /* Make sure piece belongs to player */
    if ($board_state[$yi][$xi] != $user_color) {
      return 0;
    }

    /* Make sure destination is not occupied */
    if ($board_state[$yf][$xf] != 0) {
      return 0;
    }

    /* Red player case */
    if ($user_color == 1) {

      /* Case 1: player is doing simple move */
      if (($yf == $yi + 1) && (($xf == $xi - 1) || ($xf == $xi + 1))) {
        return 1;
      }

      /* Case 2: player is doing jump move */
      else if (($yf == $yi + 2) && (($xf == $xi - 2) || ($xf == $xi + 2))) {
        $x_mid = ($xf + $xi) / 2;
        $y_mid = ($yf + $yi) / 2;
        return $board_state[$y_mid][$x_mid] == 2;
      }

      /* Case 3: player is doing some other illegal move */
      else {
        return 0;
      }

    }

    /* Black player case */
    else {

      /* Case 1: player is doing simple move */
      if (($yf == $yi - 1) && (($xf == $xi - 1) || ($xf == $xi + 1))) {
        return 1;
      }

      /* Case 2: player is doing jump move */
      else if (($yf == $yi - 2) && (($xf == $xi - 2) || ($xf == $xi + 2))) {
        $x_mid = ($xf + $xi) / 2;
        $y_mid = ($yf + $yi) / 2;
        return $board_state[$y_mid][$x_mid] == 1;
      }

      /* Case 3: player is doing some other illegal move */
      else {
        return 0;
      }

    }
  }



  function make_move($game_id, $xi, $yi, $xf, $yf) {

    $board_state = get_board_state($game_id);

    $moved_piece_color = $board_state[$yi][$xi];

    remove_piece_from_board_in_db($game_id, $xi, $yi);

    add_piece_to_board_in_db($game_id, $moved_piece_color, $xf, $yf);

    /* If player jumped other player's piece */
    if (($yi - $yf != 1) && ($yf - $yi != 1)) {
      $x_jumped = ($xi + $xf) / 2;
      $y_jumped = ($yi + $yf) / 2;
      remove_piece_from_board_in_db($game_id, $x_jumped, $y_jumped);
    }
  }



  function set_up_new_game_board($game_id) {

    /* Add red player's pieces */
    for ($i = 0; $i < 4; $i++) {
      add_piece_to_board_in_db($game_id, 1, 0, 2 * $i);
      add_piece_to_board_in_db($game_id, 1, 1, 2 * $i + 1);
      add_piece_to_board_in_db($game_id, 1, 2, 2 * $i);
    }

    /* Add black player's pieces */
    for ($i = 0; $i < 4; $i++) {
      add_piece_to_board_in_db($game_id, 2, 5, 2 * $i + 1);
      add_piece_to_board_in_db($game_id, 2, 6, 2 * $i);
      add_piece_to_board_in_db($game_id, 2, 7, 2 * $i + 1);
    }
  }


  function echo_board_state($board_state) {

    for ($i = 0; $i < 8; $i++) {
      echo "<tr>";
      for ($j = 0; $j < 8; $j++) {
        if ($board_state[$j][7-$i] == 1) {
        echo "<td width=\"50\" height=\"50\">" .
             "<img src=\"../img/red_circle.png\" width=\"50\" " .
             "height=\"50\"></td>"; 
        }
        else if ($board_state[$j][7-$i] == 2) {
          echo "<td width=\"50\" height=\"50\">" .
               "<img src=\"../img/black_circle.png\" width=\"50\" " .
               "height=\"50\"></td>";
        }
        else {
          echo "<td width=\"50\" height=\"50\"></td>";
        } 
      }
      echo "</tr>";
    }
  }


?>
