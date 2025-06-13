<?php 
include "../../include/session.php";
include "../../include/connection.php";

if(empty($_POST)){
  header("location: ../../views/forum.php");
}

$page = $_POST["page"];
$user = $_POST["author"];
$follower = $_SESSION["codigo"];

try {
  $sql = "DELETE FROM seguidor WHERE fk_seguidor=$follower AND fk_usuario=$user";
  $connection = conexion();
  $query = mysqli_query($connection, $sql);

  header("location: ../../views/post.php?codigo=$page");
} catch (\Throwable $th) {
  //throw $th;
  header("location: ../../views/forum.php");
}
?>
