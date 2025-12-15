<?php
require_once('function/conexion.php');

$conexion = Cconexion::ConexionBD();

$sql = "SELECT placa, marca, modelo, color, año, tipo, capacidad, fechaalta 
        FROM autos";

$stmt = $conexion->prepare($sql);
$stmt->execute();
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
<link rel="stylesheet" href="CSS/Estiloinicio.css">
<link rel="stylesheet" href="CSS/Estilove.css">
<style>
    /* CONTENEDOR CENTRADO */
.tabla-contenedor {
    margin-top: 40px;
    padding: 30px;
    width: 90%;
    max-width: 1100px;
    margin-left: auto;
    margin-right: auto;

    background-color: #f7f7f7;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* TÍTULO */
.titulo-tabla {
    text-align: center;
    margin-bottom: 20px;
    color: #555;
    font-weight: 600;
}

/* TABLA */
.tabla-autos {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

/* ENCABEZADOS */
.tabla-autos th {
    background-color: #e0e0e0;
    color: #444;
    padding: 12px;
    font-weight: 600;
    border-radius: 8px;
}

/* FILAS */
.tabla-autos td {
    background-color: #ffffff;
    padding: 12px;
    text-align: center;
    border-radius: 8px;
    color: #333;
}

/* EFECTO HOVER */
.tabla-autos tbody tr:hover td {
    background-color: #ededed;
    transition: background-color 0.3s;
}

</style>
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
            <span>Rutas</span>
        </a>

        <a href="#ajustes">
            <img src="https://cdn-icons-png.flaticon.com/512/456/456167.png">
            <span>Ajustes</span>
        </a>

        <a href="#ayuda">
            <img src="https://cdn.iconscout.com/icon/free/png-256/free-ayuda-icon-svg-download-png-2598199.png">
            <span>Ayuda</span>
        </a>
    </div>
    <div class="menu-links">
    <a href="#salir" class="logout">
        <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
        <span>Salir</span>
    </a>
    </div>
</aside>

    <main class="content">
    <h1>Bienvenido a TUC</h1>
    <h2>Registre un vehiculo</h2>

    <button onclick="Regisvehiculo()">
        <img src="https://static.thenounproject.com/png/621382-200.png">
    </button>


    <h2 class="titulo-tabla">Vehículos registrados</h2>

    <table class="tabla-autos">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Año</th>
                <th>Tipo</th>
                <th>Capacidad</th>
                <th>Fecha Alta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autos as $auto): ?>
                <tr>
                    <td><?= $auto['placa'] ?></td>
                    <td><?= $auto['marca'] ?></td>
                    <td><?= $auto['modelo'] ?></td>
                    <td><?= $auto['color'] ?></td>
                    <td><?= $auto['año'] ?></td>
                    <td><?= $auto['tipo'] ?></td>
                    <td><?= $auto['capacidad'] ?></td>
                    <td><?= $auto['fechaalta'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>

<script>
    function Regisvehiculo(){
        window.open("registrovehiculo.php");
    }
    function vehiculo(){
        window.open("vehiculo.php");
    }
     function inicio(){
        window.open("inicioconductor.php");
    }
</script>
</body>
</html>
