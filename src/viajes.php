<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIAJES</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
    <link rel="stylesheet" href="CSS/Estilotabla.css">

</head>
<body>
    
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

        <script src="function/pantallas.js"></script>

        <div class="menu-links">
            <a href="inicioconductor.php">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span>Inicio</span>
            </a>

            <a href="perfil.php">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span>Perfil</span>
            </a>

            <a href="vehiculo.php">
                <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
                <span>Vehículos</span>
            </a>

            <a href="viajes.php">
                <img src="https://cdn-icons-png.flaticon.com/512/3731/3731420.png">
                <span>Viaje</span>
            </a>

            <a href="formularioruta.php">
                <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
                <span>Rutas</span>
            </a>

        </div>
        <div class="menu-links">
            <a href="login.php" class="logout">
                <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
                <span>Salir</span>
            </a>
        </div>
    </aside>
<div class="card">
    <div class="Tit">
    <h1>VIAJES</h1>
    <h3>Solicitud de pasajeros</h3>
    <div class="Tabla"></div>
    <table>
        <thead>
            <tr>
        <th>Matricula</th>
        <th>Nombre del estudiante</th>
        <th>Ruta</th>
        </tr>
        </thead>
        <tbody>
            <tr>
               <td>202220326</td>
               <td>Alan</td>
               <td>Ecatepec-TESCO</td>
               <td><button>Aceptar</button></td>
               <td><button class="btn-eliminar">Eliminar</button></td>
            </tr>
        </tbody>

    </table>
    </div>
</div>


</body>
</html>