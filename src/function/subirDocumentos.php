<?php
session_start();
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['matricula'])) {
        die("Acceso no autorizado");
    }

    $conn = Cconexion::ConexionBD();

    $matricula = $_SESSION['matricula'];
    $rol = $_SESSION['rol'];

    $carpeta = "C:\\Users\\alanp\\Documents\\upload\\credential\\";

    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $nombreOriginal = $_FILES['credencial']['name'];
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));

    if (!in_array($extension, ['jpg','jpeg','png'])) {
        die("Formato no permitido");
    }

    $nombreFinal = "credencial_" . $matricula . "." . $extension;
    $rutaFinal = $carpeta . $nombreFinal;

    if (!move_uploaded_file($_FILES['credencial']['tmp_name'], $rutaFinal)) {
        $error = error_get_last();
        die("Error al subir archivo: " . print_r($error, true) . " | Ruta destino: $rutaFinal");
    }

    $rutaBD = $carpeta . $nombreFinal;

    $sql = "UPDATE usuario
            SET credencial = ?
            WHERE matricula = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$rutaBD, $matricula]);

    if ($rol == 2 && isset($_POST['licencia']) && !empty($_POST['licencia'])) {
        $licencia = $_POST['licencia'];

        $id = $conn->query(
            "SELECT ISNULL(MAX(idconductor),0)+1 FROM conductor"
        )->fetchColumn();

        $sql2 = "INSERT INTO conductor
                (idconductor, matricula, nolicencia)
                VALUES (?, ?, ?)";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$id, $matricula, $licencia]);
    }

    session_destroy();

    header("Location: ../../login.php");
    exit;
}
