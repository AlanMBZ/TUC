<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: login.php");
    exit;
}

require_once('../function/conexion.php');
$conn = Cconexion::ConexionBD();

$sql = "
SELECT matricula, nombres, apellidoP, apellidoM, fechanacimiento,
       correo, rol, credencial
FROM usuario
WHERE estado = 0
";

$stmt = $conn->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos a TUC</title>
    <link rel="stylesheet" href="../CSS/Estilos.css">
    <link rel="stylesheet" href="../CSS/Estilotabla.css">
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <style>
    .tabla-scroll {
    max-height: 500px;          /* Ajusta según tu diseño */
    overflow-y: auto;           /* Scroll vertical */
    overflow-x: hidden;
    border-radius: 10px;
}

/* Opcional: mejora visual del scroll */
.tabla-scroll::-webkit-scrollbar {
    width: 8px;
}

.tabla-scroll::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.tabla-scroll::-webkit-scrollbar-thumb:hover {
    background: #555;
}

    </style>

</head>

<body>
    <script src="direccion.js"></script>
    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="toggle-btn">☰</label>

    <aside class="sidebar">
        <label for="menu-toggle" class="close-btn">×</label>

        <div class="user-info">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png">
            <div class="user-text">
                <span class="user-name">Usuario</span>
                <span class="user-role">No conectado</span>
            </div>
        </div>

        <div class="menu-links">
            <a href="validador.php">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span>Inicio</span>
            </a>

            <a href="perfilvalidador.php">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span>Perfil</span>
            </a>
        </div>
        <div class="menu-links">
            <a href="../login.php" class="logout">
                <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
                <span>Salir</span>
            </a>
        </div>
    </aside>
    <main class="content">

        <div class="Tit">
            <h1>Candidatos a registrarse a TUC</h1>
        </div>
        <div class="card">
            <div class="Tit">
                <div class="contenedor-centro">
                    <div class="tabla-scroll">
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre(s)</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Fecha de nacimiento</th>
                                <th>Matrícula</th>
                                <th>Correo electrónico</th>
                                <th>ROL</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>

<?php if (empty($usuarios)): ?>

    <tr>
        <td colspan="9" style="text-align:center; padding:20px;">
            No hay candidatos pendientes por validar.
        </td>
    </tr>

<?php else: ?>

    <?php foreach ($usuarios as $u): ?>

        <?php
        $directorio = "../../img/";
        $extensiones = ['jpg', 'jpeg', 'png'];
        $imagenPerfil = $directorio . "default.png";

        foreach ($extensiones as $ext) {
            $ruta = $directorio . "credencial_" . $u['matricula'] . "." . $ext;
            if (file_exists($ruta)) {
                $imagenPerfil = $ruta;
                break;
            }
        }
        ?>

        <tr>
            <td>
                <img src="<?= $imagenPerfil ?>"
                     alt="Foto de perfil"
                     style="width:250px;height:300px;object-fit:cover;border-radius:5%;">
            </td>
            <td><?= htmlspecialchars($u['nombres']) ?></td>
            <td><?= htmlspecialchars($u['apellidoP']) ?></td>
            <td><?= htmlspecialchars($u['apellidoM']) ?></td>
            <td><?= date('d/m/Y', strtotime($u['fechanacimiento'])) ?></td>
            <td><?= $u['matricula'] ?></td>
            <td><?= htmlspecialchars($u['correo']) ?></td>
            <td><?= ($u['rol'] == 2 ? 'Conductor' : 'Pasajero') ?></td>
            <td>
                <form action="../function/validar_usuario.php" method="POST" style="display:inline;">
                    <input type="hidden" name="matricula" value="<?= $u['matricula'] ?>">
                    <input type="hidden" name="accion" value="aceptar">
                    <button>Aceptar</button>
                </form>

                <form action="../function/validar_usuario.php" method="POST" style="display:inline;">
                    <input type="hidden" name="matricula" value="<?= $u['matricula'] ?>">
                    <input type="hidden" name="accion" value="rechazar">
                    <button>Rechazar</button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>

<?php endif; ?>

</tbody>


                    </table>

                </div>
            </div>
        </div>
        </div>
    </main>
</body>

</html>