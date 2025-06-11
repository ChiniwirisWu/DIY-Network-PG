<?php
if(!empty($_POST)){
  var_dump($_POST);
}
// buscar los datos del perfil de la session por el id
// mostrar todos los datos del perfil que estan guardados en $_SESSION
include "../include/session.php";

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
                    <div id="title">
                    <label for="diy-name" id="diy-title">Título para su creación: </label>
                    <input id="title-inp" type="text" name="diy-name" class="txt-input" pattern="[a-zA-Z0-9]" required>
                    <button type="submit" class="bttn-agregar">Agregar</button>
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
                        <option name="material" value="Tierra">Tierra</option>
                        <option name="material" value="Palitos de madera">Palitos de madera</option>
                        <option name="material" value="Pega blanca">Pega blanca</option>
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
                <form method="post" id="form" action="idea.php">
                    <input id="post-materiales" type="hidden" name="materiales" pattern="[a-zA-Z0-9]" required />
                    <input id="post-instrucciones" type="hidden" name="instrucciones" pattern="[a-zA-Z0-9]" required />
                    <input id="post-imagenes" type="hidden" name="imagenes" pattern="[a-zA-Z0-9]" required />
                    <input id="post-titulo" type="hidden" name="titulo" pattern="[a-zA-Z0-9]" required />
                    <button type="submit" id="post">Publicar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../scripts/idea.js"></script>
</body>
</html>
