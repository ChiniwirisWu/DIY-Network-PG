<?php

include "../include/session.php";
include "../include/connection.php";

// these are the primary variables of this logic.
$row = [];
$posts_sql = "";
$parameter = "";
$orientation = "";
$user_id = $_SESSION["codigo"];
// filter the response.

try {

  // check if there is a filter query.
  if(!empty($_POST["filter-parameter"]) && !empty($_POST["filter-orientation"])){
    $parameter = $_POST["filter-parameter"];
    $orientation = $_POST["filter-orientation"];
    $_SESSION["filter-parameter"] = $parameter;
    $_SESSION["filter-orientation"] = $orientation;
  }

  // select the right sql statement.
  switch($parameter){
  case "date": 
      $posts_sql = "
                      SELECT 
                      p.codigo, 
                      p.titulo, 
                      p.portada,
                      DATE_FORMAT(DATE(p.fecha_publicacion), '%d de %M de %Y') as fecha_publicacion,
                      COUNT(v.fk_publicacion) AS votos, 
                      ROUND(AVG(v.puntuacion), 1) AS puntuacion
                    FROM 
                        publicacion p 
                    LEFT JOIN 
                        voto v ON p.codigo = v.fk_publicacion 
                    WHERE p.fk_autor = $user_id
                    GROUP BY 
                        p.codigo, p.fecha_publicacion
                    ORDER BY 
                        p.fecha_publicacion $orientation;";
    break;
  case "vote":
      $posts_sql = " 
                      SELECT 
                      p.codigo, 
                      p.titulo, 
                      p.portada,
                      DATE_FORMAT(DATE(p.fecha_publicacion), '%d de %M de %Y') as fecha_publicacion,
                      COUNT(v.fk_publicacion) AS votos, 
                      ROUND(AVG(v.puntuacion), 1) AS puntuacion
                    FROM 
                        publicacion p 
                    LEFT JOIN 
                        voto v ON p.codigo = v.fk_publicacion 
                    WHERE p.fk_autor = $user_id
                    GROUP BY 
                        p.codigo, p.fecha_publicacion
                    ORDER BY 
                        puntuacion $orientation;";
    break;
  default: 
      $posts_sql = " 
                      SELECT 
                      p.codigo, 
                      p.titulo, 
                      p.portada,
                      DATE_FORMAT(DATE(p.fecha_publicacion), '%d de %M de %Y') as fecha_publicacion,
                      COUNT(v.fk_publicacion) AS votos, 
                      ROUND(AVG(v.puntuacion), 1) AS puntuacion
                    FROM 
                        publicacion p 
                    LEFT JOIN 
                        voto v ON p.codigo = v.fk_publicacion 
                    WHERE p.fk_autor = $user_id
                    GROUP BY 
                        p.codigo, p.fecha_publicacion
                    ORDER BY 
                        p.fecha_publicacion asc;";
    break;
  }

  
  // posts query
  $connection = conexion();

  $query = mysqli_query($connection, "SET lc_time_names = 'es_ES'");

  $posts_query = mysqli_query($connection, $posts_sql);
  $posts_rows = mysqli_fetch_all($posts_query, MYSQLI_ASSOC);

  // add "puntuacion" property to each element of $posts_rows.

} catch (Exception $e){
  // error message.
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicados</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="../images/user.png">
    <link rel="stylesheet" href="../styles/lside-bar.css">
    <link rel="stylesheet" href="../styles/save.css">
</head>
<body>
    <div id="container">
    <?php include "lside-bar.php"?>
        <div id="center">
          <div id="info-container">
           
            <div id="up-title">Publicados</div> 
            <div id="filter-info">
              <p>Filtrar por</p>
              <!-- Filtros --> 
              <form action="published.php" method="post" id="filters-container">
              <select name="filter-parameter">
                <option name="filter-parameter" value="date" <?php if($_SESSION["filter-parameter"] == "date") echo "selected" ?>>Fecha de añadido</option>
                  <option name="filter-parameter" value="vote" <?php if($_SESSION["filter-parameter"] == "vote") echo "selected" ?>>Puntuacion</option>
                </select>
                <select name="filter-orientation">
                  <option name="filter-orientation" value="asc"  <?php if($_SESSION["filter-orientation"] == "asc") echo "selected" ?> >Menor - Mayor</option>
                  <option name="filter-orientation" value="desc" <?php if($_SESSION["filter-orientation"] == "desc") echo "selected" ?> >Mayor - Menor</option>
                </select>
                <button class="bttn-modificar">Filtrar</button>
              </form>
              </div>

              <div id="data-container">
            <?php foreach($posts_rows as $post){ ?>
                <a class="idea-container" href="edit.php?codigo=<?php echo $post["codigo"] ?>">
                  <div class="idea-info">
                      <div class="idea-image">
                      <image src="<?php echo $post["portada"] ?>" alt="idea image" />
                      </div>
                      <h3 class="idea-title"><?php echo (strlen($post["titulo"]) > 20) ? substr($post["titulo"], 0, 30) : $post["titulo"] ?>...</h3>
                      <p><b>Votos: </b> <?php echo $post["votos"] ?></p>
                      <p><?php echo $post["fecha_publicacion"] ?></p>
                      <div class="idea-votes">
                      <?php 
                        for($j = 0; $j < 5; $j++){
                          if($j == $post["puntuacion"] || $j > $post["puntuacion"]){
                            echo '<img class="vote-star" src="../images/star empty.png" />';

                          } else if($j + 1 < $post["puntuacion"]){
                            echo '<img class="vote-star" src="../images/star full.png" />';

                          }else if($j < $post["puntuacion"]){
                            echo '<img class="vote-star" src="../images/star half.png" />';

                          } else {
                            echo '<img class="vote-star" src="../images/star empty.png" />';
                          }

                        }
                      ?>
                      </div>
                  </div>
                </a>

            <?php } ?>
                </div>
          </div>
        </div>
    </div>
</body>
</html>




