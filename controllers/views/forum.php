<?php

include "../../include/session.php";
include "../../include/connection.php";

$sql = "SELECT * FROM publicacion ORDER BY fecha_publicacion DESC";
$connection = conexion();
$query = mysqli_query($connection, $sql);

$row = mysqli_fetch_array($query);

//include view
include "../../views/forum.php";

?>
