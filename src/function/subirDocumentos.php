<?php
session_start();
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

if (!isset($_SESSION['matricula'], $_SESSION['rol'])) {
    http_response_code(401);
    exit('Acceso no autorizado');
}

if (!isset($_FILES['credencial']) || $_FILES['credencial']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    exit('Archivo no válido');
}

$conn = Cconexion::ConexionBD();

$matricula = $_SESSION['matricula'];
$rol       = $_SESSION['rol'];

// Ruta física REAL
$carpeta = __DIR__ . '/../../img/';

if (!is_dir($carpeta)) {
    mkdir($carpeta, 0755, true);
}

$nombreOriginal = $_FILES['credencial']['name'];
$extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

$permitidas = ['jpg', 'jpeg', 'png'];

if (!in_array($extension, $permitidas)) {
    http_response_code(400);
    exit('Formato no permitido');
}

$nombreFinal = "credencial_" . $matricula . "." . $extension;
$rutaFinal   = $carpeta . $nombreFinal;

if (!move_uploaded_file($_FILES['credencial']['tmp_name'], $rutaFinal)) {
    http_response_code(500);
    exit('Error al guardar el archivo');
}

// Ruta RELATIVA para la BD
$rutaBD = "img/credenciales/" . $nombreFinal;

$sql = "UPDATE usuario SET credencial = ? WHERE matricula = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$rutaBD, $matricula]);

session_destroy();

echo "OK";
?>