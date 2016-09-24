<?php

  /* Connect to database server */

  $dbhost = 'localhost';
  $dbuser = 'admin';
  $dbpass = 'password';

  $db_connection = mysql_connect($dbhost, $dbuser, $dbpass);

  /* Create the database */

  mysql_query("CREATE DATABASE checkers_data;");

  mysql_select_db("checkers_data");

  /* Create the tables */

  mysql_query("CREATE TABLE users " .
              "(user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY," .
              " user_name TEXT, password TEXT);");

  mysql_query("CREATE TABLE games " .
              "(game_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY," .
              " red_player INT, black_player INT);");

  mysql_query("CREATE TABLE game_data " .
              "(datum_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY," .
              " game_id INT, x_coord INT, y_coord INT, color INT);");

  mysql_query("CREATE TABLE invites " .
              "(invite_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY," .
              " invite_sender INT, invite_recipient INT);");


  /* Disconnect from database */

  mysql_close($db_connection);

?>
