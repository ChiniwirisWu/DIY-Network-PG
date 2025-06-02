<?php

include "../../include/session.php";
include "../../include/connection.php";

$sql = "SELECT * FROM guardado";
$connection = conexion();
$query = mysqli_query($connection, $sql);

$row = mysqli_fetch_array($query);

//include view

?>
