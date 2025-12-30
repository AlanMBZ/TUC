<?php
session_start();
require_once('conexion.php'); 
// Si este archivo está dentro de /function, usa: require_once('conexion.php');

if (!isset($_SESSION['matricula'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: perfil.php");
    exit;
}

$correo = trim($_POST['correo'] ?? '');
$matricula = $_SESSION['matricula'];

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Correo inválido");
}

$conexion = Cconexion::ConexionBD();

$sql = "UPDATE usuario 
        SET correo = :correo 
        WHERE matricula = :matricula";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
$stmt->bindParam(':matricula', $matricula, PDO::PARAM_INT);
$stmt->execute();

/* ---------------- CERRAR SESIÓN ---------------- */
session_unset();
session_destroy();

/* ---------------- REDIRIGIR AL LOGIN ---------------- */
header("Location: ../login.php");
exit;
