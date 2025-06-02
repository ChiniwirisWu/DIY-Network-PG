<?php
include "../../include/session.php";
include "../../include/function.php";
include "../../include/connection.php";

if(!empty($_POST["password"])){
  $connection = conexion();
  $password = depurar($_POST["password"]);
  $hash = password_hash($password, PASSWORD_BCRYPT);
  $codigo = $_SESSION["codigo"];

  $sql = "UPDATE usuario SET password='$hash' WHERE codigo='$codigo'";
  $query = mysqli_query($connection, $sql);

  if($query){
    echo "La clave fue actualizada con exito";
  } else {
    echo "Ocurrio un problema actualizando la clave";
  }
}

?>
