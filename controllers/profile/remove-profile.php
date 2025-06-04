<?php
include "../../include/session.php";
include "../../include/function.php";
include "../../include/connection.php";

$connection = conexion();
$codigo = $_SESSION["codigo"];
$mensaje = "";

try{
  $sql = "DELETE FROM usuario WHERE codigo='$codigo'";
  $query = mysqli_query($connection, $sql);
  $mensaje = "El usuario fue eliminado exitosamente";

} catch(Exception $e){
  $mensaje = "Ocurrio un problema eliminando el usuario";
}

header("Location: ../../views/login.php");

?>
