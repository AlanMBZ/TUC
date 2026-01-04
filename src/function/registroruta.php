<?php
require_once('conexion.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$puntosalida = $_POST['puntosalida'] ?? '';
	$puntollegada = $_POST['puntollegada'] ?? '';
	$horariosalida = $_POST['horariosalida'] ?? '';
	$placa_auto = $_POST['placa_auto'] ?? '';
	$puntos_espera = $_POST['puntos_espera'] ?? '';
	$dia_lunes = isset($_POST['dia_lunes']) ? '1' : '';
	$dia_martes = isset($_POST['dia_martes']) ? '1' : '';
	$dia_miercoles = isset($_POST['dia_miercoles']) ? '1' : '';
	$dia_jueves = isset($_POST['dia_jueves']) ? '1' : '';
	$dia_viernes = isset($_POST['dia_viernes']) ? '1' : '';
	$dia_sabado = isset($_POST['dia_sabado']) ? '1' : '';

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
	if ($puntosalida && $puntollegada && $horariosalida && $placa_auto) {
		try {
			// Obtener el siguiente idruta
			$stmt = $conn->query('SELECT ISNULL(MAX(idruta),0)+1 AS next_id FROM rutas');
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$idruta = $row['next_id'];

			// Guardar la ruta en la tabla rutas
			$sql = 'INSERT INTO rutas (idruta, idconductor, puntosalida, puntollegada, horariosalida, placa, puntos_espera, dia_lunes, dia_martes, dia_miercoles, dia_jueves, dia_viernes, dia_sabado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$stmt = $conn->prepare($sql);
			$stmt->execute([
				$idruta,
				$idconductor,
				$puntosalida,
				$puntollegada,
				$horariosalida,
				$placa_auto,
				$puntos_espera,
				$dia_lunes,
				$dia_martes,
				$dia_miercoles,
				$dia_jueves,
				$dia_viernes,
				$dia_sabado
			]);

			echo '<script>alert("Ruta registrada exitosamente."); window.location.href = "../rutas.php";</script>';
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
