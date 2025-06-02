<?php

session_start();

include "../../include/connection.php";
include "../../include/function.php";

if(isset($_POST) && !empty($_POST)){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $clave = depurar($_POST["clave"]);

  $hash = password_hash($clave, PASSWORD_BCRYPT);
  $sql = "INSERT INTO usuario (alias, clave) VALUES ('$alias', '$hash')";
  $query = mysqli_query($connection, $sql);

  if($query)
    header("location: ../views/login.php");
}

?>
