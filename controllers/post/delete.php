<?php 

include "../../include/session.php";
include "../../include/connection.php";

if(empty($_POST)){
  header("location: ../../views/forum.php");
}

$post_id = $_POST["codigo"];
echo $post_id;

try{
  $connection = conexion();
  $sql = "DELETE FROM publicacion WHERE codigo=$post_id";
  $query = mysqli_query($connection, $sql);
} catch (Exception $e){
  //
}

header("Location: ../../views/save.php");

?>
