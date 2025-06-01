<?php
include "../include/session.php";
include "../include/function.php";

if(!empty($_POST)){
  include "../include/connection.php";
  $connection = conexion();
  $post = depurar($_POST["post"]);
  $user_id = $_SESSION["codigo"];

  $sql = "INSERT INTO favorito (fk_publicacion, fk_usuario) VALUES ('$post', '$user_id')";
  $query = mysqli_query($connection, $sql);

  if($sql){
    // se dio like a la publicacion y se redirige a la publicacion.
  } else {
    // cerrar session si existe y volver al login.
  }
}
?>
