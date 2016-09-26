<?php

  class user {

    var $user_name;
    var $password;

    function __construct($un, $p) {
      $this->user_name = $un;
      $this->password = $p;
    }


    /* Getter methods */

    function getUserName() {
      return $this->user_name;
    }

    function getPassword() {
      return $this->password;
    }


    /* Setter methods */

    function setUserName($val) {
      $this->user_name = $val;
    }

    function setPassword($val) {
      $this->password = $val;
    }

  }

?>
