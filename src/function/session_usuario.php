<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* VALIDAR SESIÓN */
if (!isset($_SESSION['matricula'], $_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

/* CONEXIÓN BD */
require_once('conexion.php');
$conexion = Cconexion::ConexionBD();

/* DATOS DE USUARIO */
$matricula = $_SESSION['matricula'];

$sqlUsuario = "SELECT nombres, apellidoP, apellidoM
               FROM usuario
               WHERE matricula = :matricula";

$stmtUsuario = $conexion->prepare($sqlUsuario);
$stmtUsuario->bindParam(':matricula', $matricula, PDO::PARAM_INT);
$stmtUsuario->execute();

$usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

$nombreUsuario = $usuario
    ? $usuario['nombres'] . ' ' . $usuario['apellidoP'] . ' ' . $usuario['apellidoM']
    : 'Usuario';

/* TEXTO DEL ROL */
$rolTexto = match ($_SESSION['rol']) {
    1 => 'CONDUCTOR',
    2 => 'PASAJERO',
    3 => 'ADMINISTRADOR',
    default => 'USUARIO',
};

/* IMAGEN DE PERFIL */
$directorioImg = "../img/";
$imagenPerfil = $directorioImg . 'default.png';

foreach (['jpg', 'jpeg', 'png'] as $ext) {
    $ruta = $directorioImg . "credencial_{$matricula}.{$ext}";
    if (file_exists($ruta)) {
        $imagenPerfil = $ruta;
        break;
    }
}
?>