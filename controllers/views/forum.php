<?php

include "../../include/session.php";
include "../../include/connection.php";

$sql = "SELECT * FROM publicacion ORDER BY fecha_publicacion DESC";
$connection = conexion();
$query = mysqli_query($connection, $sql);
$mensaje = "";

$posts = mysqli_fetch_array($query);
// reviso si no hay publicaciones para mostrar un mensaje de que no existen publicaciones.
if(empty($post)){
  $mensaje = "No hay publicaciones todavia"; 
} 

//include view
include "../../views/forum.php";

?>
