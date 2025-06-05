<?php

session_start();

include "../include/connection.php";
include "../include/function.php";

// si se crea un usuario se muestra en la pagina de crear usuario
if(isset($_POST) && !empty($_POST)){
  $connection = conexion();
  $alias = depurar($_POST["alias"]);
  $clave = depurar($_POST["clave"]);

  $hash = password_hash($clave, PASSWORD_BCRYPT);
  $sql = "INSERT INTO usuario (alias, clave) VALUES ('$alias', '$hash')";

  $mensaje = "";

  try{
    $query = mysqli_query($connection, $sql);
    $mensaje = "El usuario se ha creado exitosamente";
  } catch(Exception $e){
    $mensaje = "Este nombre de usuario es invalido";
    
  }
} 
// me envia a la pagina de signup.

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cuenta</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link rel="website icon" type="png" href="../images/user-pen-w.png">
<link rel="stylesheet" href="../styles/signup.css" />
</head>

<body>
  <div class="outer-container">
    <div class="left-pane">
      <form action="signup.php" method="post">
        <p><?php echo $mensaje ?></p>
        <h2>Crear cuenta</h2>
        <label for="alias">Usuario:</label>
        <input type="text" name="alias" id="alias" pattern="[a-zA-Z0-9]{4,10}" required>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" pattern="[a-zA-Z0-9@#$%&-_+*/]{4,20}" required>
        <button type="submit">Crear</button>
      </form>
      <h4>¿Ya tienes cuenta?</h4><a class="create-user" href="../views/login.php">Haz click aquí para ingresar</a>
    </div>
    <div class="right-pane">

    </div>
  </div>
</body>
</html>
