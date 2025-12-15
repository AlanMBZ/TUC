<?php
session_start();
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $niv       = trim($_POST['niv'] ?? '');
    $marca     = trim($_POST['marca'] ?? '');
    $modelo    = trim($_POST['modelo'] ?? '');
    $anio      = trim($_POST['anio'] ?? '');
    $placa     = trim($_POST['placas'] ?? '');
    $color     = trim($_POST['color'] ?? '');
    $tipo      = trim($_POST['tipo'] ?? '');
    $capacidad = trim($_POST['capacidad'] ?? '');

    $required = ['niv','marca','modelo','anio','placas','color','tipo','capacidad'];
    foreach ($required as $r) {
        if (empty($_POST[$r])) {
            header('Location: ../registrovehiculo.php?error=missing');
            exit;
        }
    }

    if (!isset($_SESSION['matricula'])) {
        header('Location: ../registrovehiculo.php?error=sesion');
        exit;
    }
    $matricula = $_SESSION['matricula'];

    try {
        $conn = Cconexion::ConexionBD();

        $stmt = $conn->prepare('SELECT idconductor FROM conductor WHERE matricula = ?');
        $stmt->execute([$matricula]);
        $idconductor = $stmt->fetchColumn();

        if (!$idconductor) {
            // Crear registro en conductor si no existe
            // Se requiere un número de licencia, aquí puedes pedirlo en el formulario o asignar uno temporal
            $nolicencia = isset($_POST['nolicencia']) ? trim($_POST['nolicencia']) : 'SIN-LICENCIA';
            // Obtener nuevo idconductor
            $id = $conn->query("SELECT ISNULL(MAX(idconductor),0)+1 FROM conductor")->fetchColumn();
            $sqlInsert = "INSERT INTO conductor (idconductor, matricula, nolicencia) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->execute([$id, $matricula, $nolicencia]);
            $idconductor = $id;
        }

        $check = $conn->prepare('SELECT COUNT(*) FROM autos WHERE placa = ? OR niv = ?');
        $check->execute([$placa, $niv]);
        if ($check->fetchColumn() > 0) {
            header('Location: ../registrovehiculo.php?error=duplicado');
            exit;
        }

        $sql = "INSERT INTO autos (idconductor, placa, niv, color, modelo, marca, capacidad, año, tipo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $idconductor,
            $placa,
            $niv,
            $color,
            $modelo,
            $marca,
            $capacidad,
            $anio,
            $tipo
        ]);

        header('Location: ../vehiculo.php?success=1');
        exit;

    } catch (Exception $e) {
        header('Location: ../registrovehiculo.php?error=server');
        exit;
    }
}
?>