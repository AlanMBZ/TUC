<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once('function/conexion.php');
$idruta = $_GET['idruta'] ?? null;
$ruta = null;
$matricula = $_SESSION['matricula'] ?? null;
$opciones_autos = '';
if ($idruta) {
    $conn = Cconexion::ConexionBD();
    $stmt = $conn->prepare('SELECT * FROM rutas WHERE idruta = ?');
    $stmt->execute([$idruta]);
    $ruta = $stmt->fetch(PDO::FETCH_ASSOC);
    // Autos del conductor
    if ($matricula) {
        $stmtC = $conn->prepare('SELECT c.idconductor FROM conductor c WHERE c.matricula = ?');
        $stmtC->execute([$matricula]);
        $rowC = $stmtC->fetch(PDO::FETCH_ASSOC);
        if ($rowC) {
            $idconductor = $rowC['idconductor'];
            $stmt2 = $conn->prepare('SELECT placa, modelo, marca FROM autos WHERE idconductor = ?');
            $stmt2->execute([$idconductor]);
            while ($auto = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($ruta && $auto['placa'] == $ruta['placa']) ? 'selected' : '';
                $opciones_autos .= '<option value="' . htmlspecialchars($auto['placa']) . '" ' . $selected . '>' . htmlspecialchars($auto['placa']) . ' - ' . htmlspecialchars($auto['marca']) . ' ' . htmlspecialchars($auto['modelo']) . '</option>';
            }
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar ruta</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
</head>

<body>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const inputs = document.querySelectorAll(
        'input[type="text"], input[type="email"]'
    );

    inputs.forEach(input => {
        input.addEventListener("input", () => {
            const cursor = input.selectionStart;
            input.value = input.value.toUpperCase();
            input.setSelectionRange(cursor, cursor);
        });
    });

});
</script>

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
            <h1>MODIFICAR RUTA</h1>
            <?php if ($ruta): ?>
            <form action="function/modificar_ruta_guardar.php" method="POST">
                <input type="hidden" name="idruta" value="<?= htmlspecialchars($ruta['idruta']) ?>">
                <h3>Punto de salida:</h3>
                <input type="text" name="puntosalida" value="<?= htmlspecialchars($ruta['puntosalida']) ?>" required>
                <h3>Punto de llegada:</h3>
                <input type="text" name="puntollegada" value="<?= htmlspecialchars($ruta['puntollegada']) ?>" required>
                <h3>Horario de salida:</h3>
                <input type="text" name="horariosalida" value="<?= htmlspecialchars($ruta['horariosalida']) ?>" required>
                <h3>Auto:</h3>
                <select name="placa_auto" required>
                    <option value="">Seleccione un auto</option>
                    <?= $opciones_autos ?>
                </select>
                <h3>Puntos de espera:</h3>
                <input type="text" name="puntos_espera" value="<?= htmlspecialchars($ruta['puntos_espera']) ?>">
                <h3>Días:</h3>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <label><input type="checkbox" name="dia_lunes" value="1" <?= $ruta['dia_lunes'] ? 'checked' : '' ?>> Lunes</label>
                    <label><input type="checkbox" name="dia_martes" value="1" <?= $ruta['dia_martes'] ? 'checked' : '' ?>> Martes</label>
                    <label><input type="checkbox" name="dia_miercoles" value="1" <?= $ruta['dia_miercoles'] ? 'checked' : '' ?>> Miércoles</label>
                    <label><input type="checkbox" name="dia_jueves" value="1" <?= $ruta['dia_jueves'] ? 'checked' : '' ?>> Jueves</label>
                    <label><input type="checkbox" name="dia_viernes" value="1" <?= $ruta['dia_viernes'] ? 'checked' : '' ?>> Viernes</label>
                    <label><input type="checkbox" name="dia_sabado" value="1" <?= $ruta['dia_sabado'] ? 'checked' : '' ?>> Sábado</label>
                </div>
                <br>
                <button type="submit">Guardar cambios</button>
            </form>
            <?php else: ?>
                <p>No se encontró la ruta seleccionada.</p>
            <?php endif; ?>
        </div>
    </div>


</body>

</html>