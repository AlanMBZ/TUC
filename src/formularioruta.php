<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar ruta</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
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
        <script src="function/pantallas.js"></script>

        <div class="menu-links">
            <a href="#inicio">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span onclick="inicio()">Inicio</span>
            </a>
            <a href="#perfil">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span onclick="perfil()">Perfil</span>
            </a>
            <a href="#vehiculos">
                <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
                <span onclick="vehiculo()">Vehículos</span>
            </a>
            <a href="#viaje">
                <img src="https://cdn-icons-png.flaticon.com/512/3731/3731420.png">
                <span onclick="viajes()">Viaje</span>
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

    <div class="card">
        <div class="Tit">
            <h2>Rutas Registradas</h2>
            <?php
            require_once('function/conexion.php');
            try {
                $conn = Cconexion::ConexionBD();
                $stmt = $conn->query('SELECT * FROM rutas ORDER BY idruta DESC');
                echo '<div style="overflow-x:auto;"><table border="1" cellpadding="5" style="width:100%;background:#fff;">';
                echo '<tr><th>ID</th><th>ID Conductor</th><th>Punto Salida</th><th>Punto Llegada</th><th>Horario Salida</th></tr>';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['idruta']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['idconductor']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puntosalida']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puntollegada']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['horariosalida']) . '</td>';
                    echo '</tr>';
                }
                echo '</table></div>';
            } catch (Exception $e) {
                echo '<p>Error al cargar rutas: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
            ?>
            <hr style="margin: 30px 0;">
            <h1>REGISTRO DE RUTA</h1>
            <form action="function/registroruta.php" method="POST">
                <h3>Ruta:</h3>
                <input type="text" name="ruta" placeholder="Ingrese la ruta" required>
                <h3>Horario de salida:</h3>
                <input type="text" name="horariosalida" placeholder="Ingrese la hora de salida" required>
                <h3>Cupos disponibles:</h3>
                <input type="text" name="cupos" placeholder="Ingrese NO.pasajeros" required>
                <h3>Dfirentes puntos de espera:</h3>
                <input type="text" name="puntos_espera" placeholder="Ingrese los puntos de espera">
                <br>
                <button type="submit">Activar ruta</button>
            </form>
        </div>
    </div>
</body>

</html>