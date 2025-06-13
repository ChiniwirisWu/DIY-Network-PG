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
  $sql = "INSERT INTO seguidor (fk_seguidor, fk_usuario) VALUES ($follower, $user)";
  $connection = conexion();
  $query = mysqli_query($connection, $sql);

  header("location: ../../views/post.php?codigo=$page");
} catch (\Throwable $th) {
  //throw $th;
  header("location: ../../views/forum.php");
}
?>
