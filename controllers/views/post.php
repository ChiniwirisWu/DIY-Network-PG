<?php

include "../../include/session.php";
include "../../include/connection.php";

if(!empty($_POST["codigo"])){

  $connection = conexion();
  $codigo = $_POST["codigo"];
  $sql = "SELECT * FROM publicacion WHERE codigo='$codigo'";
  $query = mysqli_query($connection, $sql);

  $post = mysqli_fetch_array($query);
  $materials = getMaterialsArray($post);

  if($query){
    echo "Se obtuvo la publicacion exitosamente";
  } else {
    echo "Ocurrio un problema en obtener la publicacion";
  }

}

function getMaterialsArray($post){
  $delimiter = "&";
  $materials = explode($delimiter, $post["materiales"]);
  //$materialsSQL example: [1, 2, 3] 
  
  $sql = "SELECT * FROM material WHERE codigo IN (";
  for($i = 0; $i < count($materials); $i++){
    $sql = $sql . strval($materials[$i]);

    if($i != count($materials) - 1){
      $sql = $sql . ",";
    }
  }
  $sql = $sql . ");";


}

?>
