<!DOCTYPE html>
<html lang="en">

<?php
require_once('function/conexion.php');
require_once('function/session_usuario.php');

// Eliminar ruta si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idruta'])) {
    $idruta = $_POST['idruta'];
    try {
        $conn = Cconexion::ConexionBD();
        $stmt = $conn->prepare('DELETE FROM rutas WHERE idruta = ?');
        $stmt->execute([$idruta]);
        echo '<script>alert("Ruta eliminada exitosamente."); window.location.href = "rutas.php";</script>';
        exit();
    } catch (Exception $e) {
        echo '<script>alert("Error al eliminar la ruta: ' . addslashes($e->getMessage()) . '"); window.history.back();</script>';
        exit();
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUTAS</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
    <link rel="stylesheet" href="CSS/Estilotabla.css">

</head>

<body>

    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="toggle-btn">☰</label>

    <aside class="sidebar">
        <label for="menu-toggle" class="close-btn">×</label>

        <div class="user-info">
            <img src="<?= $imagenPerfil ?>" alt="Foto de perfil" class="foto-perfil" style="width: 50px; height: 50px; border-radius: 5%; object-fit: cover;">
            <div class="user-text">
                <span class="user-name">CONDUCTOR</span>
                <span class="user-role"><?= htmlspecialchars($nombreUsuario) ?></span>
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
    <div class="card">
        <div class="Tit">
            <h1>RUTAS</h1>
            <h3>Rutas ingresadas por el conductor</h3>
            <?php
            require_once('function/conexion.php');
            try {
                $conn = Cconexion::ConexionBD();
                $stmt = $conn->query('SELECT * FROM rutas ORDER BY idruta DESC');
                echo '<div style="overflow-x:auto;"><table border="1" cellpadding="5" style="width:100%;background:#fff;">';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Punto Salida</th>';
                echo '<th>Punto Llegada</th>';
                echo '<th>Horario Salida</th>';
                echo '<th>Auto (Placa)</th>';
                echo '<th>Puntos de espera</th>';
                echo '<th>Días</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dias = [];
                    if ($row['dia_lunes']) $dias[] = 'Lunes';
                    if ($row['dia_martes']) $dias[] = 'Martes';
                    if ($row['dia_miercoles']) $dias[] = 'Miércoles';
                    if ($row['dia_jueves']) $dias[] = 'Jueves';
                    if ($row['dia_viernes']) $dias[] = 'Viernes';
                    if ($row['dia_sabado']) $dias[] = 'Sábado';
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['idruta']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puntosalida']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puntollegada']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['horariosalida']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['placa']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['puntos_espera']) . '</td>';
                    echo '<td>' . implode(', ', $dias) . '</td>';
                    echo '<td class="acciones">';
                    echo '<a href="modificarruta.php?idruta=' . urlencode($row['idruta']) . '" class="btn-editar">Modificar</a> ';
                    echo '<form method="POST" action="" style="display:inline;" onsubmit="return confirm(\'¿Seguro que deseas eliminar esta ruta?\');">';
                    echo '<input type="hidden" name="idruta" value="' . htmlspecialchars($row['idruta']) . '">';
                    echo '<button type="submit" class="btn-eliminar">Eliminar</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table></div>';
            } catch (Exception $e) {
                echo '<p>Error al cargar rutas: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
            ?>
        </div>
        <a href="formularioruta.php">
        <button>Solicitar cargar ruta</button>
</a>
    </div>
    </div>

</body>

</html>