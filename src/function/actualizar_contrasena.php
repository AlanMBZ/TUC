<?php
session_start();
require_once('conexion.php');

if (!isset($_SESSION['matricula'])) {
    header("Location: ../login.php");
    exit;
}

$conexion = Cconexion::ConexionBD();
$matricula = $_SESSION['matricula'];

$contrasenaActual = $_POST['contrasena_actual'] ?? '';
$nuevaContrasena  = $_POST['nueva_contrasena'] ?? '';
$confirmar        = $_POST['confirmar_contrasena'] ?? '';

if ($nuevaContrasena !== $confirmar) {
    echo "Las nuevas contraseñas no coinciden";
    exit;
}

// Obtener contraseña actual
$sql = "SELECT contrasena FROM usuario WHERE matricula = :matricula";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}

// Comparación directa (SIN HASH)
if ($contrasenaActual !== $usuario['contrasena']) {
    echo "La contraseña actual es incorrecta";
    exit;
}

// Actualizar contraseña en texto plano
$sqlUpdate = "UPDATE usuario 
              SET contrasena = :contrasena 
              WHERE matricula = :matricula";

$stmtUpdate = $conexion->prepare($sqlUpdate);
$stmtUpdate->bindParam(':contrasena', $nuevaContrasena);
$stmtUpdate->bindParam(':matricula', $matricula, PDO::PARAM_INT);
$stmtUpdate->execute();

// Cerrar sesión y redirigir al login
session_destroy();
header("Location: ../login.php");
exit;
?>