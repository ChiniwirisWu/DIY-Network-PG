<?php
include "../include/session.php";
include "../include/connection.php";

if(!empty($_GET)){
  $post_id = $_GET["codigo"];
}

$materialesPrevios = [];

// obtener toda la informacion acerca de la publicacion para llenar los campos y expulsar intrusos.
try{
  $connection = conexion();
  $sql = "SELECT * FROM publicacion WHERE codigo = $post_id";
  $query = mysqli_query($connection, $sql);
  $post_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $post_data = $post_data[0];
  if(!is_null($row)){
    if($post_data["fk_autor"] == $_SESSION["codigo"]){
      header("Location: forum.php");
    }
  } 
} catch (Exception $e){
  //
}

// obtener los materiales para el dropdown de materiales.
try{
  $sql = "SELECT alias FROM material";
  $connection = conexion();
  $query = mysqli_query($connection, $sql);
  $rows = mysqli_fetch_all($query);
  foreach($rows as $row){
    array_push($materialesPrevios, $row[0]);
  }
} catch(Exception $e){
  //
}

if(!empty($_POST)){
  $title = $_POST["titulo"];
  $materials = $_POST["materiales"];
  $portada = $_POST["portada"];
  $instructions = $_POST["instrucciones"];
  $images = $_POST["imagenes"];
  $user_id = $_SESSION["codigo"];
  $post_id = $_POST["codigo"];
  $message = "";

  $connection = conexion();
  try{
    $sql = "UPDATE publicacion 
    SET titulo='$title', materiales='$materials', instrucciones='$instructions', imagenes='$images', fecha_publicacion=CURRENT_TIMESTAMP, portada='$portada' WHERE codigo=$post_id";

    $query = mysqli_query($connection, $sql);
    $message = "Se creo la publicacion exitosamente"; 

    $output = preg_split("/[&,]/", $materials);
    $newMaterialSql = "INSERT INTO material (alias) VALUES ";
    $counter = 0;

    for($i = 0; $i < count($output); $i++){
      if(!in_array($output[$i], $materialesPrevios)){

        $newMaterialSql = $newMaterialSql . "('$output[$i]')";
        $counter++;
        array_push($materialesPrevios, $output[$i]);

        if($i < count($output) - 2){
          $newMaterialSql = $newMaterialSql . ",";
          $counter++;
        }

      }
    }

    echo $newMaterialSql;

    if($counter > 0){
      $query = mysqli_query($connection, $newMaterialSql);
    }
    header("Location: edit.php?codigo=$post_id");

  } catch (Exception $e){
    //echo $e;
    $message = "Hubo un error creando la publicacion";
  }
}
// buscar los datos del perfil de la session por el id
// mostrar todos los datos del perfil que estan guardados en $_SESSION

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Idea</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="../images/edit-alt.png">
    <link rel="stylesheet" href="../styles/lside-bar.css">
    <link rel="stylesheet" href="../styles/idea.css">

</head>
<body>
<div id="container">
        <?php include "lside-bar.php"?> 

        <div id="center">
           <div id="info-container">
              <p id="message"><?php echo $message ?></p> 
              <div id="title">
              <div>
                <label for="diy-name" id="diy-title">Título para su creación: </label>
                <input id="title-inp" type="text" name="diy-name" class="txt-input" pattern="[a-zA-Z0-9]" required>
              </div>

              <div>
                <label for="diy-cover" id="diy-title">Imagen para la portada: </label>
                <input id="cover-inp" type="text" name="diy-cover" class="txt-input" pattern="[a-zA-Z0-9]" required>
              </div>
              </div>
            <div id="center-content">
                <div id="data-container">

                  <!-- parte izquierda del center -->
                  <div id="data-top">
                    <div id="tabs-container">
                      <button class="tab tab-selected" id="1">Tab 1</button>
                    </div>
                  <div style="display: flex; gap: 5px;">
                      <button id="remove-tab" class="tab-bttn"><span id="remove-icon"></span></button>
                      <button id="add-tab" class="tab-bttn"><span id="add-icon"></span></button>
                  </div>
                  </div>
                  <div id="data-content">
                    <textarea id="content-textarea" required></textarea>
                  </div>
                </div>


                <!-- parte derecha del center -->
                <div id="materials-container">
                  <!-- parte superior de la pesta;a de materiales -->
                  <div id="materials-form">

                    <div>
                      <select id="material-select">
                        <option>Elija material</option>
                        <?php foreach($materialesPrevios as $materialPrevio){ ?>
                        <option name="material" value="<?php echo $materialPrevio ?>"><?php echo $materialPrevio ?></option>
                        <?php } ?>
                      <select>
                      <button class="material-bttn" id="add-material-1">Agregar</button>
                    </div>

                    <div>
                      <input type="text" id="material-input"  placeholder="Material nuevo" />
                      <button class="material-bttn" id="add-material-2">Agregar</button>
                    </div>
                  </div>

                  <!-- parte inferior de la pesta;a de materiales -->
                  <div id="materials-list"></div>
                </div>
            </div>
            <div id="low-content">
                <div id="url-container">
                <label id="url">Ingrese el URL de su imagen: </label>
                <input id="url-inp" type="text" class="txt-input">
                </div>
                <form method="post" id="form" action="edit.php">
                    <input value="<?php echo $post_data["materiales"] ?>" id="post-materiales" type="hidden" name="materiales" pattern="[a-zA-Z0-9]" required />
                    <input value="<?php echo $post_data["instrucciones"] ?>" id="post-instrucciones" type="hidden" name="instrucciones" pattern="[a-zA-Z0-9]" required />
                    <input value="<?php echo $post_data["imagenes"] ?>" id="post-imagenes" type="hidden" name="imagenes" pattern="[a-zA-Z0-9]" required />
                    <input value="<?php echo $post_data["titulo"] ?>" id="post-titulo" type="hidden" name="titulo" pattern="[a-zA-Z0-9]" required />
                    <input value="<?php echo $post_data["portada"] ?>" id="post-portada" type="hidden" name="portada" pattern="[a-zA-Z0-9]" required />
                    <input value="<?php echo $post_id ?>" id="post-portada" type="hidden" name="codigo" pattern="[a-zA-Z0-9]" required />
                    <button type="submit" id="post">Publicar</button>
                </form>
                <form style="margin-top: 5px" action="../controllers/post/delete.php" method="post">
                  <input type="hidden" value="<?php echo $post_id ?>" name="codigo" />
                  <button type="submit" id="post">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../scripts/idea.js"></script>
</body>
</html>
