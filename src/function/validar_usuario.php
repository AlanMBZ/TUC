<?php
session_start();
require_once('conexion.php');

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    exit('Acceso denegado');
}

if (!isset($_POST['matricula'], $_POST['accion'])) {
    exit('Datos incompletos');
}

$conn = Cconexion::ConexionBD();

$matricula = $_POST['matricula'];
$accion = $_POST['accion'];

$estado = ($accion === 'aceptar') ? 1 : 2;

$sql = "UPDATE usuario SET estado = ? WHERE matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$estado, $matricula]);

header("Location: ../validador/validador.php");
exit;
?>