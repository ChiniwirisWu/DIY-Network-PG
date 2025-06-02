<?php
include "../../include/session.php";
include "../../include/function.php";
include "../../include/connection.php";

$connection = conexion();
$codigo = $_SESSION["codigo"];

$sql = "DELETE FROM usuario WHERE codigo='$codigo'";
$query = mysqli_query($connection, $sql);

if($query){
  echo "El usuario fue eliminado exitosamente";
} else {
  echo "Ocurrio un problema eliminando el usuario";
}

?>
