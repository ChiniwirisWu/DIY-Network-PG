<?php
include "../../include/session.php";
include "../../include/function.php";

if(!empty($_POST)){
  include "../../include/connection.php";
  $connection = conexion();
  $post = $_POST["post"]; // codigo de publicacion.
  $user_id = $_SESSION["codigo"];

  $sql = "DELETE FROM favorito WHERE fk_publicacion='$post' AND fk_usuario='$user_id'";
  $query = mysqli_query($connection, $sql);

  if($sql){
    // se dio like a la publicacion y se redirige a la publicacion.
    echo "El usuario quito el me gusta de la publicacion exitosamente";
  } else {
    // cerrar session si existe y volver al login.
    echo "Ocurrio un problema quitando me gusta a la publicacion";
  }
}
?>
