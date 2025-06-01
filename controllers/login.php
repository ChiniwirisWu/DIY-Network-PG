<?php

session_start();
include "../include/connection.php";
include "../include/function.php";
if(isset($_POST) && !empty($_POST)){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $clave = depurar($_POST["clave"]);

  $sql = "SELECT FROM usuario WHERE alias='$alias'";
  $query = mysqli_query($connection, $sql);

  $row = mysqli_fetch_array($query);

  if(is_null(!$row)){
    if(password_verify($clave, $row["clave"])){
      echo "Usuario encontrado " . $row["alias"];
    } else {
      echo "Usuario y/o clave erroreo";
    }
  }

}

?>
