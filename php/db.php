<?php

  $db_connection;

  function connect_to_db() {

    global $db_connection;

    $dbhost = 'localhost';
    $dbuser = 'admin';
    $dbpass = 'password';

    $db_connection = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db("checkers_data");
  }



  function disconnect_from_db() {
    global $db_connection;
    mysql_close($db_connection);
  }



  function add_user_to_db($user_name, $password) {

    connect_to_db();

    /* Make sure username does not already exist */

    $exist_query = mysql_query("SELECT * FROM users " .
                               "WHERE user_name=\"$user_name\";");

    if (mysql_fetch_assoc($exist_query)) {
      disconnect_from_db();
      return -1;
    }

    /* Add user to database */

    mysql_query("INSERT INTO users (user_name, password) " .
                "VALUES (\"$user_name\", \"$password\");");

    $query = mysql_query("SELECT * FROM users WHERE " .
                         "user_name=\"$user_name\";");

    $row = mysql_fetch_assoc($query);

    $user_id = $row["user_id"];

    disconnect_from_db();

    return $user_id;
  }



  function get_user_from_db($user_name) {

    connect_to_db();

    $query = mysql_query("SELECT * FROM users WHERE " .
                         "user_name=\"$user_name\";");

    $row = mysql_fetch_assoc($query);

    disconnect_from_db();

    return $row;
  }



  function get_game_from_db($game_id) {

    connect_to_db();

    $query = mysql_query("SELECT * FROM games " .
                         "WHERE game_id=$game_id;");

    $game = mysql_fetch_assoc($query);

    disconnect_from_db();

    return $game;
  }


  function get_board_state_from_db($game_id) {

    connect_to_db();

    $query = mysql_query("SELECT * FROM game_data " .
                         "WHERE game_id=\"$game_id\";");

    $i = 0;

    while ($row = mysql_fetch_assoc($query)) {
      $results[$i] = $row;
      $i++;
    }

    disconnect_from_db();

    return $results;
  }



  function create_new_game_in_db($first_user_id, $second_user_id) {

    connect_to_db();

    mysql_query("INSERT INTO games (red_player, black_player) " .
                "VALUES ($first_user_id, $second_user_id);");

    $query = mysql_query("SELECT * FROM games where " .
                         "red_player=$first_user_id AND " .
                         "black_player=$second_user_id;");

    $i = 0;

    while ($row = mysql_fetch_assoc($query)) {
      $games[$i] = $row;
      $i++;
    }

    $new_game = $games[count($games)-1];

    $new_game_id = $new_game["game_id"];

    disconnect_from_db();

    return $new_game_id;
  }



  function add_piece_to_board_in_db($game_id, $color, $x, $y) {

    connect_to_db();

    mysql_query("INSERT INTO game_data " .
                "(game_id, x_coord, y_coord, color) " .
                "VALUES ($game_id, $x, $y, $color);");

    disconnect_from_db();
  }



  function remove_piece_from_board_in_db($game_id, $x, $y) {

    connect_to_db();

    mysql_query("DELETE FROM game_data WHERE " .
                "game_id=$game_id AND x_coord=$x AND y_coord=$y;");

    disconnect_from_db();
  }
 


  function get_user_games_from_db($user_id) {

    connect_to_db();

    $query = mysql_query("SELECT a.game_id AS game_id, b.user_name AS opponent FROM games a, users b " .
                         "WHERE (a.red_player=$user_id AND a.black_player=b.user_id) " .
                         "OR (a.black_player=$user_id AND a.red_player=b.user_id);");

    $i = 0;

    while ($row = mysql_fetch_assoc($query)) {
      $games[$i] = $row;
      $i++;
    }

    disconnect_from_db();
 
    return $games;
  }
 

?>
















