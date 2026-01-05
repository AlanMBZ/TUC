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

            <a href="rutas.php">
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

<?php

require_once('function/conexion.php');
session_start();

// Procesar solicitud de cupo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idruta'])) {
    $matricula = isset($_SESSION['matricula']) ? $_SESSION['matricula'] : null;
    $nombre = '';
    if ($matricula) {
        // Obtener nombre del pasajero desde la sesión si está disponible
        if (isset($_SESSION['nombre_pasajero'])) {
            $nombre = $_SESSION['nombre_pasajero'];
        } else {
            $conn = Cconexion::ConexionBD();
            $stmt = $conn->prepare('SELECT nombres, apellidoP, apellidoM FROM usuario WHERE matricula = ?');
            $stmt->execute([$matricula]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $nombre = $user['nombres'] . ' ' . $user['apellidoP'] . ' ' . $user['apellidoM'];
            }
        }
    }
    $ruta = $_POST['puntosalida'] . ' - ' . $_POST['puntollegada'];
    $idruta = $_POST['idruta'];
    // Guardar solicitud en la tabla viajes_solicitudes (crear si no existe)
    $conn = Cconexion::ConexionBD();
    $conn->query("IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='viajes_solicitudes' AND xtype='U')
        CREATE TABLE viajes_solicitudes (
            id INT IDENTITY(1,1) PRIMARY KEY,
            matricula NVARCHAR(20),
            nombre NVARCHAR(100),
            ruta NVARCHAR(200),
            idruta INT,
            estado NVARCHAR(20) DEFAULT 'pendiente'
        )");
    $stmt = $conn->prepare('INSERT INTO viajes_solicitudes (matricula, nombre, ruta, idruta, estado) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$matricula, $nombre, $ruta, $idruta, 'pendiente']);
    header('Location: pasajero/rutaspasajero.php');
    exit();
}

// Procesar aceptar/rechazar
if (isset($_GET['accion']) && isset($_GET['id'])) {
    $conn = Cconexion::ConexionBD();
    $estado = ($_GET['accion'] === 'aceptar') ? 'aceptado' : 'rechazado';
    $stmt = $conn->prepare('UPDATE viajes_solicitudes SET estado = ? WHERE id = ?');
    $stmt->execute([$estado, $_GET['id']]);
}

// Mostrar solicitudes
$conn = Cconexion::ConexionBD();
$solicitudes = $conn->query('SELECT * FROM viajes_solicitudes ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card">
    <div class="Tit">
    <h1>VIAJES</h1>
    <h3>Solicitud de pasajeros</h3>
    <div class="Tabla"></div>
    <table class="tabla">
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Nombre del estudiante</th>
                <th>Ruta</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $sol) : ?>
                <tr>
                    <td><?= htmlspecialchars($sol['matricula']) ?></td>
                    <td><?= htmlspecialchars($sol['nombre']) ?></td>
                    <td><?= htmlspecialchars($sol['ruta']) ?></td>
                    <td><?= htmlspecialchars($sol['estado']) ?></td>
                    <td>
                        <?php if ($sol['estado'] === 'pendiente') : ?>
                            <a href="?accion=aceptar&id=<?= $sol['id'] ?>" class="btn-editar">Aceptar</a>
                            <a href="?accion=rechazar&id=<?= $sol['id'] ?>" class="btn-eliminar">Rechazar</a>
                        <?php else: ?>
                            ---
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>


</body>
</html>