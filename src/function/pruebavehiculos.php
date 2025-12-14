<?php
require_once('function/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = trim($_POST['matricula'] ?? '');
    $marca     = trim($_POST['marca'] ?? '');
    $modelo    = trim($_POST['modelo'] ?? '');
    $anio      = trim($_POST['anio'] ?? '');
    $placas    = trim($_POST['placas'] ?? '');
    $color     = trim($_POST['color'] ?? '');
    $tipo      = trim($_POST['tipo'] ?? '');
    $capacidad = trim($_POST['capacidad'] ?? '');
    $estado    = trim($_POST['estado'] ?? '');

    $required = ['matricula','marca','modelo','anio','placas'];
    foreach ($required as $r) {
        if (empty($_POST[$r])) {
            header('Location: registrovehiculo.php?error=missing');
            exit;
        }
    }

    try {
        $conn = Cconexion::ConexionBD();

        $check = $conn->prepare('SELECT COUNT(*) FROM vehiculo WHERE matricula = ? OR placas = ?');
        $check->execute([$matricula, $placas]);
        if ($check->fetchColumn() > 0) {
            header('Location: registrovehiculo.php?error=duplicado');
            exit;
        }

        $sql = "INSERT INTO vehiculo (matricula, marca, modelo, anio, placas, color, tipo, capacidad, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $matricula,
            $marca,
            $modelo,
            $anio,
            $placas,
            $color,
            $tipo,
            $capacidad,
            $estado
        ]);

        header('Location: vehiculosrregistrados.php?success=1');
        exit;

    } catch (Exception $e) {
        header('Location: registrovehiculo.php?error=server');
        exit;
    }
}
?>