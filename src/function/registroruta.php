<?php
require_once('conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$ruta = $_POST['ruta'] ?? '';
	$horariosalida = $_POST['horariosalida'] ?? '';
	$cupos = $_POST['cupos'] ?? '';
	$puntos_espera = $_POST['puntos_espera'] ?? '';

	// Obtener matrícula del usuario en sesión
	$matricula = $_SESSION['matricula'] ?? null;
	if (!$matricula) {
		echo '<script>alert("No hay sesión activa. Inicie sesión para registrar una ruta."); window.location.href = "../login.php";</script>';
		exit();
	}

	// Buscar idconductor correspondiente a la matrícula
	try {
		$conn = Cconexion::ConexionBD();
		$stmt = $conn->prepare('SELECT idconductor FROM conductor WHERE matricula = ?');
		$stmt->execute([$matricula]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row) {
			echo '<script>alert("No se encontró un conductor asociado a este usuario."); window.history.back();</script>';
			exit();
		}
		$idconductor = $row['idconductor'];
	} catch (Exception $e) {
		echo '<script>alert("Error al buscar el conductor: ' . addslashes($e->getMessage()) . '"); window.history.back();</script>';
		exit();
	}

	// Validación básica
	if ($ruta && $horariosalida && $cupos) {
		try {
			// Obtener el siguiente idruta
			$stmt = $conn->query('SELECT ISNULL(MAX(idruta),0)+1 AS next_id FROM rutas');
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$idruta = $row['next_id'];

			// Guardar la ruta en la tabla rutas
			$sql = 'INSERT INTO rutas (idruta, idconductor, puntosalida, puntollegada, horariosalida) VALUES (?, ?, ?, ?, ?)';
			$stmt = $conn->prepare($sql);
			$stmt->execute([$idruta, $idconductor, $ruta, $puntos_espera, $horariosalida]);

			echo '<script>alert("Ruta registrada exitosamente."); window.location.href = "../formularioruta.php";</script>';
		} catch (Exception $e) {
			echo '<script>alert("Error al registrar la ruta: ' . addslashes($e->getMessage()) . '"); window.history.back();</script>';
		}
	} else {
		echo '<script>alert("Por favor, complete todos los campos obligatorios."); window.history.back();</script>';
	}
} else {
	header('Location: ../formularioruta.php');
	exit();
}
?>
