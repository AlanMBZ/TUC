<?php
require_once('../function/session_usuariopasajero.php');
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUTAS</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilos.css">
    <link rel="stylesheet" href="../CSS/Estilotabla.css">
<style>
        .tabla-scroll {
            max-height: 500px;
            /* Ajusta según tu diseño */
            overflow-y: auto;
            /* Scroll vertical */
            overflow-x: hidden;
            border-radius: 10px;
        }

        /* Opcional: mejora visual del scroll */
        .tabla-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .tabla-scroll::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .tabla-scroll::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .tabla-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
}

.tabla-centrada {
    width: 95%;
    max-width: 1200px;
    border-collapse: collapse;
    table-layout: fixed; /* evita que se salga */
}

.tabla-centrada th,
.tabla-centrada td {
    word-wrap: break-word;
    text-align: center;
}

    </style>
</head>

<body>

        <script src="../function/Ventanas.js"></script>
    <input type="checkbox" id="menu-toggle" />
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
    <div class="card">
        <div class="Tit">
            <h1>RUTAS</h1>
            <h3>Rutas ingresadas por el conductor</h3>
            <?php
            require_once('../function/conexion.php');
            try {
                $conn = Cconexion::ConexionBD();
                $stmt = $conn->query('SELECT * FROM rutas ORDER BY idruta DESC');
                echo '<div class="tabla-scroll">';
echo '<div class="tabla-wrapper">';
echo '<table class="tabla tabla-centrada">';

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
echo '</div>'; // tabla-wrapper
echo '</div>'; // tabla-scroll

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