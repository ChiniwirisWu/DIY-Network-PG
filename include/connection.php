<?php

function conexion(){
  $host = "localhost";
  $user = "root";
  $password = "";
  $bd = "diynetwork";

  $conexion = new mysqli($host, $user, $password, $bd);
  $conexion->set_charset("utf8mb4");
  //$conexion = mysqli_connect($host, $user, $password);
  //mysqli_select_db($conexion, $bd);

  return $conexion;
}

?>
