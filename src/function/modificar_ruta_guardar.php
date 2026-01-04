<?php
require_once('conexion.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idruta = $_POST['idruta'] ?? null;
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

    if ($idruta && $puntosalida && $puntollegada && $horariosalida && $placa_auto) {
        try {
            $conn = Cconexion::ConexionBD();
            $sql = 'UPDATE rutas SET puntosalida=?, puntollegada=?, horariosalida=?, placa=?, puntos_espera=?, dia_lunes=?, dia_martes=?, dia_miercoles=?, dia_jueves=?, dia_viernes=?, dia_sabado=? WHERE idruta=?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([
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
                $dia_sabado,
                $idruta
            ]);
            echo '<script>alert("Ruta modificada exitosamente."); window.location.href = "../rutas.php";</script>';
        } catch (Exception $e) {
            echo '<script>alert("Error al modificar la ruta: ' . addslashes($e->getMessage()) . '"); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Por favor, complete todos los campos obligatorios."); window.history.back();</script>';
    }
} else {
    header('Location: ../rutas.php');
    exit();
}
?>
