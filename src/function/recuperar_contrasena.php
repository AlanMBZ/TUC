<?php
require_once('conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// RUTAS CORRECTAS SEGÚN TU ESTRUCTURA
require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

$correo = $_POST['correo'] ?? '';

if ($correo == "") {
    header("Location: ../recuperar_contrasena.php?msg=Correo inválido");
    exit;
}

$conexion = Cconexion::ConexionBD();

// Verificar si el correo existe
$sql = "SELECT matricula FROM usuario WHERE correo = :correo";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: ../recuperar_contrasena.php?msg=El correo no existe");
    exit;
}

// Generar contraseña aleatoria de 8 caracteres
$nuevaContrasena = substr(str_shuffle(
    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
), 0, 8);

// Actualizar contraseña en texto plano
$sqlUpdate = "UPDATE usuario SET contrasena = :contrasena WHERE correo = :correo";
$stmtUpdate = $conexion->prepare($sqlUpdate);
$stmtUpdate->bindParam(':contrasena', $nuevaContrasena);
$stmtUpdate->bindParam(':correo', $correo);
$stmtUpdate->execute();

// Enviar correo
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'TUC.tesco@gmail.com'; // CAMBIA ESTO
    $mail->Password   = 'nplm rovi hsma vqcj';     // 16 caracteres
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('TUC.tesco@gmail.com', 'TUC - Recuperacion de contrasena');
    $mail->addAddress($correo);

    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de contraseña';
    $mail->Body    = "
        <p>Se ha generado una nueva contraseña para tu cuenta:</p>
        <h2>$nuevaContrasena</h2>
        <p>Por favor inicia sesion y cambiala.</p>
    ";

    $mail->send();

} catch (Exception $e) {
    echo "Error al enviar correo: " . $mail->ErrorInfo;
    exit;
}

// Regresar al login
header("Location: ../login.php");
exit;
