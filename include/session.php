<?php

session_start();

if(!isset($_SESSION) || empty($_SESSION)){
  // TODO: redirigir a login si no existe una session activa.
  header("location: ../views/login.php");
}

?>
