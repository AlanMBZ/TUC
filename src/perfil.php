<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilodocuemntacion.css">

</head>

<body>

    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="toggle-btn">☰</label>

    <aside class="sidebar">
        <label for="menu-toggle" class="close-btn">×</label>

        <div class="user-info">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png">
            <div class="user-text">
                <span class="user-name">Usuario</span>
                <span class="user-role">No conectado</span>
            </div>
        </div>

        <script src="function/pantallas.js"></script>

        <div class="menu-links">
            <a href="#inicio">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span onclick="inicio()">Inicio</span>
            </a>

            <a href="#perfil">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span>Perfil</span>
            </a>

            <a href="#vehiculos">
                <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
                <span onclick="vehiculo()">Vehículos</span>
            </a>

            <a href="#viaje">
                <img src="https://cdn-icons-png.flaticon.com/512/3731/3731420.png">
                <span>Viaje</span>
            </a>

            <a href="#ruta">
                <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
                <span onclick="Formularioruta()">Rutas</span>
            </a>

        </div>
        <div class="menu-links">
            <a href="#salir" class="logout">
                <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
                <span>Salir</span>
            </a>
        </div>
    </aside>
    <div class="cuadro-principal">
        <div class="Tit">
            <h1>PERFIL</h1>
        </div>
        <div class="contenedor">
            <div class="columna">
                <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png">
            </div>
            <div class="columna">
                <h3>Apelido paterno</h3>
                <h3>Apellido materno</h3>
                <h3>Fecha de nacimiento</h3>
                <h3>Matricula</h3>
                <h3>Correo electronico</h3>
                <h3>Rol</h3>
            </div>
        </div>

</body>

</html>