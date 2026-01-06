<?php
require_once('../function/session_usuariopasajero.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar viaje</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilos.css">

</head>

<body>
    <script src="../function/Ventanas.js"></script>
<input type="checkbox" id="menu-toggle"/>
<label for="menu-toggle" class="toggle-btn">☰</label>

<aside class="sidebar">
    <label for="menu-toggle" class="close-btn">×</label>

    <div class="user-info">
        <img src="<?= $imagenPerfil ?>" alt="Foto de perfil" class="foto-perfil" style="width: 50px; height: 50px; border-radius: 5%; object-fit: cover;">
        <div class="user-text">
            <span class="user-name">PASAJERO</span>
            <span class="user-role"><?= htmlspecialchars($nombreUsuario) ?></span>
        </div>
    </div>

    <div class="menu-links">
        <a href="inicioPasajero.php">
            <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
            <span>Inicio</span>
        </a>

        <a href="perfilpasajero.php">
            <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
            <span>Perfil</span>
        </a>

        <a href="viajepasajero.php">
            <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
            <span>Viajes</span>
        </a>
        <a href="rutaspasajero.php">
            <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
            <span>Rutas</span>
        </a>
    </div>
    <div class="menu-links">
    <a href="../login.php" class="logout">
        <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
        <span>Salir</span>
    </a>
    </div>
</aside>
 <div class="main">
    <div class="card">
    <div class="cuadro-principal">
        <div class="Tit">
            <h1>VIAJES</h1>
        </div>
    <h3>Solicitud de viaje</h3>
    <h4>Buscando conductor...</h4>
    <h3>Conductor: </h3>
    <h3>Auto: </h3>
    <h3>Placas: </h3>
    <button>Cancelar</button>
    <button onclick="ViajeCurso()">Aceptar viaje</button>
</div>
</div>
</div>
</div>
</body>
</html>