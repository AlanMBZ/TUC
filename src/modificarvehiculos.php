<?php
require_once('function/conexion.php');
require_once('function/session_usuario.php');
$conexion = Cconexion::ConexionBD();

/* =========================
   VALIDAR PLACA
========================= */
if (!isset($_GET['placa']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: vehiculo.php");
    exit;
}

/* =========================
   ACTUALIZAR VEHÍCULO
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $niv       = $_POST['niv'];
    $marca     = $_POST['marca'];
    $modelo    = $_POST['modelo'];
    $anio      = $_POST['anio'];
    $placas    = $_POST['placas'];
    $color     = $_POST['color'];
    $tipo      = $_POST['tipo'];
    $capacidad = $_POST['capacidad'];

    $sqlUpdate = "UPDATE autos SET
                    niv = :niv,
                    marca = :marca,
                    modelo = :modelo,
                    año = :anio,
                    color = :color,
                    tipo = :tipo,
                    capacidad = :capacidad
                  WHERE placa = :placas";

    $stmt = $conexion->prepare($sqlUpdate);
    $stmt->bindParam(':niv', $niv);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':anio', $anio);
    $stmt->bindParam(':color', $color);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':capacidad', $capacidad);
    $stmt->bindParam(':placas', $placas);
    $stmt->execute();

    header("Location: vehiculo.php?success=1");
    exit;
}

/* =========================
   OBTENER DATOS
========================= */
$placa = $_GET['placa'];

$sql = "SELECT * FROM autos WHERE placa = :placa";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
$stmt->execute();
$auto = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$auto) {
    header("Location: vehiculosrregistrados.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar vehículo</title>
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

<input type="checkbox" id="menu-toggle"/>
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

<div class="main">
<div class="card">
    <div class="Tit">
        <h1>Modificar vehículo</h1>
    </div>

    <form method="POST">
        <div class="contenedor">

            <div class="columna">
                <h3>NIV:</h3>
                <input type="text" name="niv" value="<?= htmlspecialchars($auto['niv']) ?>" required>

                <h3>Marca:</h3>
                <input type="text" name="marca" value="<?= htmlspecialchars($auto['marca']) ?>" required>

                <h3>Modelo:</h3>
                <input type="text" name="modelo" value="<?= htmlspecialchars($auto['modelo']) ?>" required>

                <h3>Año:</h3>
                <input type="text" name="anio" value="<?= htmlspecialchars($auto['año']) ?>" required>

                <h3>Placas:</h3>
                <input type="text" name="placas" value="<?= htmlspecialchars($auto['placa']) ?>" readonly>

                <h3>Color:</h3>
                <input type="text" name="color" value="<?= htmlspecialchars($auto['color']) ?>">
            </div>

            <div class="columna">
                <img src="https://cdn-icons-png.freepik.com/512/11133/11133502.png">

                <h3>Tipo de vehículo:</h3>
                <input type="text" name="tipo" value="<?= htmlspecialchars($auto['tipo']) ?>">

                <h3>Capacidad de pasajeros:</h3>
                <input type="text" name="capacidad" value="<?= htmlspecialchars($auto['capacidad']) ?>">

                <div class="botones-inferiores">
                    <button type="submit">Guardar cambios</button>
                </div>
            </div>

        </div>
    </form>

</div>
</div>



</body>
</html>
