<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../styles/user-profile.css">
</head>
<body>
    <div id="container">
        <div id="lside-bar">
            <div class="lcontent" id="ltitle">Contenido</div>
            <div class="lcontent">Nueva idea</div>
            <div class="lcontent">Foro</div>
            <div class="lcontent">Guardados</div>
            <div class="lcontent">Likes</div>
        </div>
        <div id="center">
            <div id="info-container">
                <div id="up-title">Datos de usuario</div>
                <div id="data-container">
        <div id="username-info">
            <p>Nombre de usuario: <span id="username">holas</span></p>
            <button onclick="mostrarInput('new-user')">Modificar nombre</button> 
            <div id="new-user" style="display: none;">
                <form action="procesar.php" method="POST">
                    <input type="text" name="nuevo_nombre" placeholder="Nuevo nombre">
                    <button type="submit">Guardar</button>
                    <button type="button" onclick="cerrarFormulario('new-user')">Cerrar</button>
                </form>
            </div>
        </div>

        <div id="password-info">
            <p>Contraseña: <span id="password">********</span></p>
            <button onclick="mostrarInput('new-password')">Modificar contraseña</button> 
            <div id="new-password" style="display: none;">
                <form action="procesar.php" method="POST">
                    <input type="password" name="nuevo_password" placeholder="Nueva contraseña" required>
                    <button type="submit">Guardar</button>
                    <button type="button" onclick="cerrarFormulario('new-password')">Cerrar</button>
                </form>
            </div>
        </div>
        
                <div id="elim-user">
        <form id="deleteForm" action="eliminar.php" method="POST">
            <button type="button" onclick="confirmarEliminacion()">Borrar cuenta</button>
        </form>
    </div>

    <script>
        function confirmarEliminacion() {
            if (confirm("¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.")) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
    </div>

    <script>
        function mostrarInput(id) {
            document.getElementById(id).style.display = "block";
        }

        function cerrarFormulario(id) {
            document.getElementById(id).style.display = "none";
        }
    </script>
            </div>
        </div>
    </div>
</body>
</html>
