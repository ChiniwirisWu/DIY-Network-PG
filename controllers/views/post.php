<?php

include "../../include/session.php";
include "../../include/connection.php";

if(!empty($_POST["codigo"])){

  $connection = conexion();
  $codigo = $_POST["codigo"];
  $sql = "SELECT * FROM publicacion WHERE codigo='$codigo'";
  $query = mysqli_query($connection, $sql);
  

  $post = mysqli_fetch_array($query);
  $delimiter = "&";
  $materials = explode($delimiter, $post["materiales"]);

  if($query){
    echo "Se obtuvo la publicacion exitosamente";
  } else {
    echo "Ocurrio un problema en obtener la publicacion";
  }

}

function getMaterialsArray(array $materialsCode){
  //$materialsSQL example: [1, 2, 3] 
}

?>
