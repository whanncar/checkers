<?php

  class move {

    var $x_start;
    var $y_start;
    var $x_end;
    var $y_end;

    function __construct($xi, $yi, $xf, $yf) {
      $this->x_start = $xi;
      $this->y_start = $yi;
      $this->x_end = $xf;
      $this->y_end = $yf;
    }

    /* Getter methods */

    function getXStart() {
      return $this->x_start;
    }

    function getYStart() {
      return $this->y_start;
    }

    function getXEnd() {
      return $this->x_end;
    }

    function getYEnd() {
      return $this->y_end;
    }


    /* Setter methods */

    function setXStart($val) {
      $this->x_start = $val;
    }

    function setYStart($val) {
      $this->y_start = $val;
    }

    function setXEnd($val) {
      $this->x_end = $val;
    }
    
    function setYEnd($val) {
      $this->y_end = $val;
    }
  }

?>
