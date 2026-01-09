<?php
require_once('../function/session_usuariopasajero.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viajes</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilodocuemntacion.css">
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
            overflow-x: auto;
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tabla-rutas {
            width: 90%;
            max-width: 1200px;
            border-collapse: collapse;
            background-color: #ffffff;
            text-align: center;
        }

        .tabla-rutas th,
        .tabla-rutas td {
            padding: 14px 12px;
            border: 1px solid #ccc;
            vertical-align: middle;
        }

        .tabla-rutas th {
            background-color: #f2f2f2;
            font-weight: bold;
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
    <div class="cuadro-principal">
        <div class="Tit">
            <h1>VIAJES</h1>
        </div>
        <div class="tabla-scroll">
            <?php
            require_once('../function/conexion.php');
            $matricula = isset($_SESSION['matricula']) ? $_SESSION['matricula'] : null;
            $conn = Cconexion::ConexionBD();
            $viajes = [];
            if ($matricula) {
                $stmt = $conn->prepare('
            SELECT vs.*, r.puntosalida, r.puntollegada, r.horariosalida, r.placa, c.idconductor, u.nombres, u.apellidoP, u.apellidoM
            FROM viajes_solicitudes vs
            INNER JOIN rutas r ON vs.idruta = r.idruta
            INNER JOIN conductor c ON r.idconductor = c.idconductor
            INNER JOIN usuario u ON c.matricula = u.matricula
            WHERE vs.matricula = ? AND vs.estado = ?
            ORDER BY vs.id DESC
        ');
                $stmt->execute([$matricula, 'aceptado']);
                $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            <?php if (count($viajes) === 0): ?>
                <h3>NO HAY VIAJES EN CURSO</h3>
            <?php else: ?>
                <h3>Mis viajes aceptados</h3>
                <div class="tabla-wrapper">
                    <table class="tabla-rutas">

                        <thead>
                            <tr>
                                <th style="padding:10px; border:1px solid #155e21ff; text-align:center; background-color: #155e21ff;">Conductor</th>
                                <th style="padding:10px; border:1px solid #155e21ff; text-align:center; background-color: #155e21ff;">Auto/Placa</th>
                                <th style="padding:10px; border:1px solid #155e21ff; text-align:center; background-color: #155e21ff;">Ruta establecida</th>
                                <th style="padding:10px; border:1px solid #155e21ff; text-align:center; background-color: #155e21ff;">Horario de salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($viajes as $v): ?>
                                <tr>
                                    <td style="padding:8px; border:1px solid #ccc; text-align:center;"><?= htmlspecialchars($v['nombres'] . ' ' . $v['apellidoP'] . ' ' . $v['apellidoM']) ?></td>
                                    <td style="padding:8px; border:1px solid #ccc; text-align:center;"><?= htmlspecialchars($v['placa']) ?></td>
                                    <td style="padding:8px; border:1px solid #ccc; text-align:center;"><?= htmlspecialchars($v['puntosalida']) ?> - <?= htmlspecialchars($v['puntollegada']) ?></td>
                                    <td style="padding:8px; border:1px solid #ccc; text-align:center;"><?= htmlspecialchars($v['horariosalida']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>