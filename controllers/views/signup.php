<?php

session_start();

include "../../include/connection.php";
include "../../include/function.php";

// si se crea un usuario se muestra en la pagina de crear usuario
if(isset($_POST) && !empty($_POST)){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $clave = depurar($_POST["clave"]);

  $hash = password_hash($clave, PASSWORD_BCRYPT);
  $sql = "INSERT INTO usuario (alias, clave) VALUES ('$alias', '$hash')";

  $mensaje = "";

  try{
    $query = mysqli_query($connection, $sql);
    $mensaje = "El usuario se ha creado exitosamente";
  } catch(Exception $e){
    $mensaje = "Este nombre de usuario es invalido";
    
  }
} 
// me envia a la pagina de signup.
include "../../views/signup.php";

?>
