<?php
session_start();
require_once('../function/conexion.php');

if (!isset($_SESSION['matricula'])) {
    header("Location: login.php");
    exit;
}

$conexion = Cconexion::ConexionBD();
$matricula = $_SESSION['matricula'];

$sql = "SELECT nombres, apellidoP, apellidoM, fechanacimiento, matricula, correo, rol 
        FROM usuario 
        WHERE matricula = :matricula";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}
//-------------------------LLAMADO DE IMAGEN DE PERFIL-------------------------//
$directorio = "../../img/";
$extensiones = ['jpg', 'jpeg', 'png'];

$imagenPerfil = $directorio . "default.png"; // Imagen por defecto

foreach ($extensiones as $ext) {
    $ruta = $directorio . "credencial_" . $matricula . "." . $ext;
    if (file_exists($ruta)) {
        $imagenPerfil = $ruta;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERFIL</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilodocuemntacion.css">

</head>

<body>
<script src="direccion.js"></script>
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
        <a href="#inicio" onclick="validador()">
            <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
            <span>Inicio</span>
        </a>

        <a href="#perfil" onclick="perfil()">
            <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
            <span>Perfil</span>
        </a>
    </div>
    <div class="menu-links">
    <a href="#salir" class="logout" onclick="salir()">
        <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
        <span>Salir</span>
    </a>
    </div>
</aside>
    <div class="cuadro-principal">
        <div class="Tit">
            <h1>PERFIL</h1>
        </div>
        <div class="contenedor">
            <div class="columna">
                <img src="<?= $imagenPerfil ?>" alt="Foto de perfil" class="foto-perfil" style="width: 250px; height: 300px; border-radius: 5%; object-fit: cover;">


            </div>
            <div class="columna">
                <h3><strong>Nombre(s):</strong></h3>
                <?= htmlspecialchars($usuario['nombres']) ?>
                <h3><strong>Apellido paterno:</strong></h3>
                <?= htmlspecialchars($usuario['apellidoP']) ?>
                <h3><strong>Apellido materno:</strong></h3>
                <?= htmlspecialchars($usuario['apellidoM']) ?>
                <h3><strong>Fecha de nacimiento:</strong></h3>
                <?= $usuario['fechanacimiento'] ?>
                <h3><strong>Matrícula:</strong></h3>
                <?= $usuario['matricula'] ?>

                <h3>
                    <strong>Correo electrónico:</strong>
                </h3>
                <span id="correo-texto">
                    <?= htmlspecialchars($usuario['correo']) ?>
                </span>

                <form id="correo-form" action="function/actualizar_correo.php" method="POST" style="display:none;">
                    <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required style="border-radius: 5px; padding: 5px;">
                    <br><br>

                    <button type="submit">Guardar</button>
                    <br>
                    <button type="button" onclick="cancelarEdicion()">Cancelar</button>

                </form>

                <button id="btn-modificar" onclick="editarCorreo()">Modificar</button>

<h3><strong>Contraseña:</strong></h3>

<span id="contrasena-texto">
    ********
</span>

<form id="contrasena-form" action="../function/actualizar_contrasena.php" method="POST" style="display:none;">
    <input type="password" name="contrasena_actual" placeholder="Contraseña actual" required
           style="border-radius: 5px; padding: 5px; width: 250px;">
    <br><br>

    <input type="password" name="nueva_contrasena" placeholder="Nueva contraseña" required
           style="border-radius: 5px; padding: 5px; width: 250px;">
    <br><br>

    <input type="password" name="confirmar_contrasena" placeholder="Confirmar nueva contraseña" required
           style="border-radius: 5px; padding: 5px; width: 250px;">
    <br><br>

    <button type="submit">Guardar</button>
    <br>
    <button type="button" onclick="cancelarContrasena()">Cancelar</button>
</form>

<button id="btn-contrasena" onclick="editarContrasena()">Modificar</button>

                <h3><strong>Rol:</strong></h3>
                <?php
                if ($usuario['rol'] == 1) {
                    echo "Conductor";
                } else {
                    echo "Pasajero";
                } ?>

            </div>
        </div>
    </div>
    <script>
        function editarCorreo() {
            document.getElementById('correo-texto').style.display = 'none';
            document.getElementById('btn-modificar').style.display = 'none';
            document.getElementById('correo-form').style.display = 'inline';
        }

        function cancelarEdicion() {
            document.getElementById('correo-form').style.display = 'none';
            document.getElementById('correo-texto').style.display = 'inline';
            document.getElementById('btn-modificar').style.display = 'inline';
        }
        function editarContrasena() {
        document.getElementById('contrasena-texto').style.display = 'none';
        document.getElementById('btn-contrasena').style.display = 'none';
        document.getElementById('contrasena-form').style.display = 'inline';
    }

    function cancelarContrasena() {
        document.getElementById('contrasena-form').style.display = 'none';
        document.getElementById('contrasena-texto').style.display = 'inline';
        document.getElementById('btn-contrasena').style.display = 'inline';
    }
    </script>
</body>

</html>