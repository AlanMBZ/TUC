<?php
$mensaje = "";
if (isset($_GET['msg'])) {
    $mensaje = $_GET['msg'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="CSS/Estilosesion.css">
</head>

<body>
    <div class="Sesion">
        <form method="POST" action="function/recuperar_contrasena.php">
            <h1>RECUPERAR CONTRASEÑA</h1>
            <h4>Ingresa tu correo electrónico</h4>

            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <br><br>

            <button type="submit">Enviar</button>
        </form>
    </div>

    <?php if ($mensaje != ""): ?>
        <script>
            alert("<?php echo $mensaje; ?>");
        </script>
    <?php endif; ?>
</body>
</html>
