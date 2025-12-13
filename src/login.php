<?php
include_once 'conexion.php';
include_once 'validar_login.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (Cvalidar_login::validarUsuario($usuario, $contrasena)) {
        $mensaje = "Inicio de sesión correcto";
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <div class="Sesion">
        <h1>INICIAR SESIÓN</h1>

        <form method="POST">
            <h2>Usuario</h2>
            <input type="text" name="usuario" required>

            <h2>Contraseña</h2>
            <input type="password" name="contrasena" required><br><br>

            <button type="submit">Iniciar sesión</button>
        </form>

        <button onclick="registro()">Registrate</button>
    </div>

    <?php if ($mensaje != ""): ?>
        <script>
            alert("<?php echo $mensaje; ?>");
        </script>
    <?php endif; ?>

    <script>
        function registro() {
            window.open("subir_identificacion.php");
        }
    </script>
</body>
</html>
