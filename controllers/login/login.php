<?php

include "../../include/session.php";
include "../../include/connection.php";
include "../../include/function.php";

if(isset($_POST) && !empty($_POST)){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $clave = depurar($_POST["clave"]);

  $sql = "SELECT * FROM `usuario` WHERE BINARY alias='$alias'";
  $query = mysqli_query($connection, $sql);

  $row = mysqli_fetch_array($query);

  if(!is_null($row)){
    if(password_verify($clave, $row["clave"])){
      $_SESSION = $row;
      header("Location: ../views/profile.php");

    } else {
      echo "Usuario y/o clave erroreo";
    }
  } else {
    echo "No se encontro usuario";
  }

}

?>
