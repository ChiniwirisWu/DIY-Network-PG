<?php

include "../include/session.php";
include "../include/connection.php";

$user_id = $_SESSION["codigo"];

try{
  $connection = conexion();
  $codigo = $_GET["codigo"];

  // query para calcular los datos de la publicacion
  $sql = "
  SELECT 
  *
  FROM publicacion p
  LEFT JOIN usuario u ON p.fk_autor = u.codigo
  WHERE p.codigo=$codigo";
  $query = mysqli_query($connection, $sql);
  $post = mysqli_fetch_array($query);
  
  $author_id = $post["fk_autor"];

  $instructions = explode("&", $post["instrucciones"]); 
  $images = explode("&", $post["imagenes"]); 
  $materials = explode("&", $post["materiales"]);
  $title = $post["titulo"];

  // query para ver si el usuario sigue al autor
  $sql = "SELECT * FROM seguidor WHERE fk_seguidor=$user_id AND fk_usuario=$author_id";
  $query = mysqli_query($connection, $sql);
  $follower = mysqli_fetch_array($query);

  // query para ver si el usuario tiene guardado esta publicacion
  $sql = "SELECT * FROM guardado WHERE fk_publicacion=$codigo AND fk_usuario=$user_id";
  $query = mysqli_query($connection, $sql);
  $saved = mysqli_fetch_array($query);

  
} catch(Exception $e){
  echo $e; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicacion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="../images/user.png">
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/lside-bar.css">
    <link rel="stylesheet" href="../styles/post.css">
</head>
<body>
    <div id="container">
    <?php include "lside-bar.php"?>

        <div id="center">
            <div id="info-container">
              <div id="up-title"><?php echo $title ?></div>
                  <div id="data-container">

                  <div id="instructions-container">

                  <?php for($i = 0; $i < count($instructions); $i++){ ?>
                    <div id="instruction-container">
                      <h2>Paso <?php echo ($i + 1) ?></h2>
                      <div class="instruction-image">
                      <?php
                      if($i + 1 <= count($images)){
                        echo "<img src='$images[$i]' alt='photo' />";   
                      }
                      ?> 
                      </div>
                      <p><strong>Materiales: <?php echo $materials[$i] ?></strong></p>
                      <p><?php echo $instructions[$i] ?></p>
                      <hr />
                    </div>
                    <?php } ?>
                  </div>
            
                  <div id="details-container">
                    <div id="details-profile">
                      <div id="details-l">
                        <img src="../images/user-pen-w.png" alt="user-pfp" />
                      </div>
                      <div id="details-r">
                        <h2><?php echo $post["alias"] ?></h2>
                        <?php 
                        if(is_null($follower)){
                          echo '<form id="follow-form" method="post" action="../controllers/post/follow.php">';
                          echo "<input type='hidden' name='page' value='$codigo' />";
                          echo "<input type='hidden' name='author' value='$author_id' />";
                          echo '<button class="bttn-modificar bttn-long">Seguir</button>';
                          echo '</form>';
                        } else {
                          echo '<form id="follow-form" method="post" action="../controllers/post/unfollow.php">';
                          echo "<input type='hidden' name='page' value='$codigo' />";
                          echo "<input type='hidden' name='author' value='$author_id' />";
                          echo '<button class="bttn-modificar bttn-long bttn-selected">Siguiendo</button>';
                          echo '</form>';
                        }
                        ?>
                        
                      </div>
                    </div>

                    <div id="details-post">
                      <?php if(is_null($saved)){
                        echo '<form id="follow-form" method="post" action="../controllers/post/save.php">';
                        echo "<input type='hidden' name='page' value='$codigo' />";
                        echo "<input type='hidden' name='author' value='$author_id' />";
                        echo '<button id="save-bttn" class="bttn-modificar bttn-long">Guardar</button>';
                        echo '</form>';
                      } else {
                        echo '<form id="follow-form" method="post" action="../controllers/post/unsave.php">';
                        echo "<input type='hidden' name='page' value='$codigo' />";
                        echo "<input type='hidden' name='author' value='$author_id' />";
                        echo '<button id="save-bttn" class="bttn-modificar bttn-long bttn-selected">Guardado</button>';
                        echo '</form>';
                      }
                      ?>
                      <div id="details-b">
                        <input type="range" min=0 max=5 list="markers" />
                        <datalist id="markers">
                          <option value="0"></option>
                          <option value="1"></option>
                          <option value="2"></option>
                          <option value="3"></option>
                          <option value="4"></option>
                          <option value="5"></option>
                        </datalist>
                        <button class="bttn-modificar">Votar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
