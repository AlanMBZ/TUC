<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = Cconexion::ConexionBD();

    $matricula  = $_POST['matricula'];
    $nombres    = $_POST['nombre'];
    $apellidoP  = $_POST['apaterno'];
    $apellidoM  = $_POST['amaterno'];
    $correo     = $_POST['correo'];
    $password   = $_POST['password']; 
    $fecha      = $_POST['fecha_nac'];
    $rol        = $_POST['rol'];
    $credencial = 'pendiente';

    // Validar duplicados
    $check = $conn->prepare(
        "SELECT COUNT(*) FROM usuario WHERE matricula = ? OR correo = ?"
    );
    $check->execute([$matricula, $correo]);

    if ($check->fetchColumn() > 0) {
        header("Location: ../registro.php?error=duplicado");
        exit;
    }

    // Insertar usuario
    $sql = "INSERT INTO usuario
    (matricula, nombres, apellidoP, apellidoM, correo, contrasena, fechanacimiento, rol, credencial)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $matricula,
        $nombres,
        $apellidoP,
        $apellidoM,
        $correo,
        $password,
        $fecha,
        $rol,
        $credencial
    ]);

session_start();

$_SESSION['matricula'] = $matricula;
$_SESSION['rol'] = $rol;

header("Location: ../../registrofo.php");
exit;

}
