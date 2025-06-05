<?php
// buscar los datos del perfil de la session por el id
// mostrar todos los datos del perfil que estan guardados en $_SESSION
include "../../include/session.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="website icon" type="png" href="../images/user.png">
    <link rel="stylesheet" href="../styles/idea.css">
    <link rel="stylesheet" href="../styles/lside-bar.css">
</head>
<body>
    <div id="container">
    <?php include "lside-bar.php"?>
        <div id="center">
           <div id="info-container">
                    <div id="title">
                    <label for="diy-name" id="diy-title">Título para su creación: </label>
                    <input type="text" name="diy-name" id="diy-name" pattern="[a-zA-Z0-9]" required>
                    <input type="submit" value="Agregar">
                    </div>
                    <div id="center-content">
                <div id="data-container"></div>
                <div id="materials-container"></div>
            </div>
            <div>
                <label>Ingrese el URL de su imagen</label>
                <input type="text">
                <input type="submit" value="Agregar">
            </div>
            <div>
                <button type="submit" id="post-bttn">Publicar</button>
            </div>

        </div>
    </div>
</body>
</html>
