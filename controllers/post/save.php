<?php 

include "../../include/session.php";
include "../../include/connection.php";

if(empty($_POST)){
  header("location: ../../views/forum.php");
}

$page = $_POST["page"];
$user_id = $_SESSION["codigo"];

try {
  $sql = "INSERT INTO guardado (fk_publicacion, fk_usuario, fecha_agregacion) 
  VALUES ($page, $user_id, DATE(NOW()))";
  $connection = conexion();
  $query = mysqli_query($connection, $sql);

  header("location: ../../views/post.php?codigo=$page");
} catch (\Throwable $th) {
  //throw $th;
  header("location: ../../views/forum.php");
}
?>
