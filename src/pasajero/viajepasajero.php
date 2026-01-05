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
<div class="cuadro-principal">
        <div class="Tit">
            <h1>VIAJES</h1>
        </div>
    <?php
    require_once('../function/conexion.php');
    $matricula = isset($_SESSION['matricula']) ? $_SESSION['matricula'] : null;
    $conn = Cconexion::ConexionBD();
    $viajes = [];
    if ($matricula) {
        $stmt = $conn->prepare('SELECT * FROM viajes_solicitudes WHERE matricula = ? AND estado = ? ORDER BY id DESC');
        $stmt->execute([$matricula, 'aceptado']);
        $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <?php if (count($viajes) === 0): ?>
        <h3>NO HAY VIAJES EN CURSO</h3>
    <?php else: ?>
        <h3>Mis viajes aceptados</h3>
        <table class="tabla">
            <thead>
                <tr>
                    <th>Ruta</th>
                    <th>Horario</th>
                    <th>Placa</th>
                    <th>Puntos de espera</th>
                    <th>Días</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viajes as $v): ?>
                    <tr>
                        <td><?= htmlspecialchars($v['ruta']) ?></td>
                        <td><?= isset($v['horariosalida']) ? htmlspecialchars($v['horariosalida']) : '' ?></td>
                        <td><?= isset($v['placa']) ? htmlspecialchars($v['placa']) : '' ?></td>
                        <td><?= isset($v['puntos_espera']) ? htmlspecialchars($v['puntos_espera']) : '' ?></td>
                        <td><?= isset($v['dias']) ? htmlspecialchars($v['dias']) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</div>
</body>
</html>