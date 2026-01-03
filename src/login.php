<?php
session_start();
include_once 'function/conexion.php';
include_once 'function/validar_login.php';

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
                header("Location: inicioconductor.php");
                exit;
            } elseif ($usuario['rol'] == 2) {
                header("Location: pasajero/inicioPasajero.php");
                exit;
            }
        } else {
            $mensaje = "Correo o contraseña incorrectos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/Estilosesion.css">
</head>

<body>
    <div class="Sesion">
        <form method="POST">
            <h1>INICIAR SESION / REGISTRATE</h1>

            <H4>Inicia sesion para continuar</H4>
            <h2>Usuario:</h2>
            <input type="email" placeholder="Ingresa usuario" name="correo" required>
            <h2>Contraseña:</h2>
            <input type="password" placeholder="Ingrese contraseña" name="contrasena" required><br><br>
            <button type="submit">Iniciar sesion</button><br><br>
            <a href="recuperar_contrasena.php" class="link-recuperar" style="color: black;">
                ¿Olvidaste tu contraseña?
            </a>
            <br><br>

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
            window.open("registro.php");
        }
    </script>
</body>

</html>