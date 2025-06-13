<?php 
include "../../include/session.php";
include "../../include/connection.php";

if(empty($_POST)){
  header("location: ../../views/forum.php");
}

$page = $_POST["page"];
$user_id = $_SESSION["codigo"];

try {
  $sql = "DELETE FROM guardado WHERE fk_publicacion=$page AND fk_usuario=$user_id";
  $connection = conexion();
  $query = mysqli_query($connection, $sql);

  header("location: ../../views/post.php?codigo=$page");
} catch (\Throwable $th) {
  //throw $th;
  header("location: ../../views/forum.php");
}
?>
>
