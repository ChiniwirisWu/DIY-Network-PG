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
    <link rel="stylesheet" href="../styles/user-profile.css">
</head>
<body>
    <div id="container">
<div id="lside-bar">
    <div id="ltitle">
        <span class="icon-title"></span> Contenido
    </div>
    <a class="lcontent idea">
        <span class="icon"></span> Nueva idea
    </a>
    <a class="lcontent forum">
        <span class="icon"></span> Foro
    </a>
    <a class="lcontent saved">
        <span class="icon"></span> Guardados
    </a>
    <a class="lcontent likes">
        <span class="icon"></span> Likes
    </a>
</div>
        <div id="center">
            <div id="info-container">
                <div id="up-title">Datos de usuario</div>
                <div id="data-container">
                    <div id="username-info">
                        <p>Nombre de usuario: <span id="username">holas</span></p>
                        <button class="bttn-modificar" onclick="toggleInput('new-user')">Modificar</button> 
                        <div id="new-user">
                            <form action="procesar.php" method="POST">
                                <input type="text" name="nuevo_nombre" placeholder="Nuevo usuario">
                                <button type="submit" class="save-bttn">Guardar</button>
                                <button type="button" onclick="toggleInput('new-user')" class="exit-bttn">Cerrar</button>
                            </form>
                        </div>
                    </div>

                    <div id="password-info">
                        <p>Contraseña: <span id="password">********</span></p>
                        <button class="bttn-modificar" onclick="toggleInput('new-password')">Modificar</button> 
                        <div id="new-password">
                            <form action="procesar.php" method="POST">
                                <input type="password" name="nuevo_password" placeholder="Nueva contraseña" required>
                                <button type="submit" class="save-bttn">Guardar</button>
                                <button type="button" onclick="toggleInput('new-password')" class="exit-bttn">Cerrar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="down-bttns">
                    <form id="deleteForm" action="eliminar.php" method="POST">
                        <button class="low-bttn" type="button" onclick="confirmarEliminacion()">Borrar cuenta</button>
                    </form>
                    <button class="low-bttn exit-bttn"  type="button">Salir</button>
                </div>

                <script>
                    function confirmarEliminacion() {
                        if (confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.")) {
                            document.getElementById("deleteForm").submit();
                        }
                    }

                    function toggleInput(id) {
                        const element = document.getElementById(id);
                        if (!element.classList.contains("show")) {
                            element.style.display = "block";
                            setTimeout(() => {
                                element.classList.add("show");
                            }, 10);
                        } else {
                            element.classList.remove("show");
                            setTimeout(() => {
                                element.style.display = "none";
                            }, 500);
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
