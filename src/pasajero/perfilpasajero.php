<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilodocuemntacion.css">

</head>

<body>
    <script src="../function/Ventanas.js"></script>
<input type="checkbox" id="menu-toggle"/>
<label for="menu-toggle" class="toggle-btn">☰</label>

<input type="checkbox" id="menu-toggle"/>
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

    <div class="menu-links">
        <a href="#inicio">
            <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
            <span onclick="iniciopasajero()">Inicio</span>
        </a>

        <a href="#perfil">
            <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
            <span onclick="Perfilpasajero()">Perfil</span>
        </a>

        <a href="#viajes">
            <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
            <span onclick="Viajepasaje()">Viajes</span>
        </a>
        <a href="#ruta">
            <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
            <span onclick="Rutapasajero()">Rutas</span>
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