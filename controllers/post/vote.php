<?php
include "../../include/session.php";
include "../../include/connection.php";

if(empty($_POST)){
  header("location: ../../views/forum.php");
}

$user_id = $_SESSION["codigo"];
$post_id = $_POST["page"];
$vote = $_POST["vote"];

// verificar si existe una publicacion previa del usuario a esta publicacion.
try{
  $connection = conexion();
  $sql = "SELECT * FROM voto WHERE fk_publicacion=$post_id AND fk_usuario=$user_id"; 
  $query = mysqli_query($connection, $sql);
  $voted = mysqli_fetch_array($query);

  if(is_null($voted)){
    // no hubieron votos previos.
    $sql = "INSERT INTO voto (fk_publicacion, fk_usuario, puntuacion) 
    VALUES ($post_id, $user_id, $vote)";
  } else {
    $sql = "UPDATE voto SET puntuacion=$vote WHERE fk_publicacion=$post_id AND fk_usuario=$user_id";
  }

  $query = mysqli_query($connection, $sql);
  header("location: ../../views/post.php?codigo=$post_id");
} catch(Exception $e){
  header("location: ../../views/post.php?codigo=$post_id");
}


?>
