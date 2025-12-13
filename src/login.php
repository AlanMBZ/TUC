<?php
session_start();
include_once 'conexion.php';
include_once 'validar_login.php';

$mensaje = ""; // ← SIEMPRE definida

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Verificar que existan los datos
    if (isset($_POST['correo'], $_POST['contrasena'])) {

        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $usuario = Cvalidar_login::validarUsuario($correo, $contrasena);

        if ($usuario) {

            $_SESSION['matricula'] = $usuario['matricula'];
            $_SESSION['rol'] = $usuario['rol'];

            if ($usuario['rol'] == 1) {
                header("Location: conductor.php");
                exit;
            } elseif ($usuario['rol'] == 2) {
                header("Location: pasajero.php");
                exit;
            }
        } else {
            $mensaje = "Correo o contraseña incorrectos";
        }
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
            <input type="email" name="correo" required>
            <h2>Contraseña</h2>
            <input type="password" name="contrasena" required>
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
            window.open("menu_usuario.html");
        }
    </script>
</body>

</html>