<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUTAS</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilos.css">
    <link rel="stylesheet" href="../CSS/Estilotabla.css">

</head>

<body>

        <script src="../function/Ventanas.js"></script>
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
    <div class="card">
        <div class="Tit">
            <h1>RUTAS</h1>
            <h3>Rutas ingresadas por el conductor</h3>
            <?php
            require_once('../function/conexion.php');
            try {
                $conn = Cconexion::ConexionBD();
                $stmt = $conn->query('SELECT * FROM rutas ORDER BY idruta DESC');
                echo '<div style="overflow-x:auto;">';
                echo '<table class="tabla">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Punto Salida</th>';
                echo '<th>Punto Llegada</th>';
                echo '<th>Horario Salida</th>';
                echo '<th>Auto</th>';
                echo '<th>Puntos de espera</th>';
                echo '<th>Días</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
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
                    echo '<td>';
                    echo '<form method="POST" action="../viajes.php" style="display:inline;">';
                    echo '<input type="hidden" name="idruta" value="' . htmlspecialchars($row['idruta']) . '">';
                    echo '<input type="hidden" name="puntosalida" value="' . htmlspecialchars($row['puntosalida']) . '">';
                    echo '<input type="hidden" name="puntollegada" value="' . htmlspecialchars($row['puntollegada']) . '">';
                    echo '<input type="hidden" name="horariosalida" value="' . htmlspecialchars($row['horariosalida']) . '">';
                    echo '<input type="hidden" name="placa" value="' . htmlspecialchars($row['placa']) . '">';
                    echo '<input type="hidden" name="puntos_espera" value="' . htmlspecialchars($row['puntos_espera']) . '">';
                    echo '<input type="hidden" name="dias" value="' . implode(', ', $dias) . '">';
                    echo '<button type="submit" class="btn-editar">Solicitar cupo</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } catch (Exception $e) {
                echo '<p>Error al cargar rutas: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
            ?>
        </div>
</a>
    </div>
    </div>

</body>

</html>