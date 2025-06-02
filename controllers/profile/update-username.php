<?php
include "../../include/session.php";
include "../../include/function.php";
include "../../include/connection.php";

if(!empty($_POST["alias"])){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $codigo = $_SESSION["codigo"];

  $sql = "UPDATE usuario SET alias='$alias' WHERE codigo='$codigo'";
  $query = mysqli_query($connection, $sql);

  if($query){
    echo "El alias fue actualizado con exito";
    $sql = "SELECT * FROM usuario WHERE codigo='$codigo'";
    $query = mysqli_query($connection, $sql);
    $_SESSION = mysqli_fetch_array($query);
  } else {
    echo "Ocurrio un problema actualizando el alias";
  }

}

header("Location: ../views/profile.php");

?>
