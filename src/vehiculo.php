<?php
require_once('function/conexion.php');

$conexion = Cconexion::ConexionBD();

/* ELIMINAR VEHÍCULO */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_placa'])) {
    $placa = $_POST['eliminar_placa'];

    $sqlDelete = "DELETE FROM autos WHERE placa = :placa";
    $stmtDelete = $conexion->prepare($sqlDelete);
    $stmtDelete->bindParam(':placa', $placa, PDO::PARAM_STR);
    $stmtDelete->execute();
}

/* CONSULTA DE VEHÍCULOS */
$sql = "SELECT placa, marca, modelo, color, año, tipo, capacidad, fechaalta 
        FROM autos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilove.css">
    <style>
        /* CONTENEDOR CENTRADO */
        .tabla-contenedor {
            margin-top: 40px;
            padding: 30px;
            width: 90%;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;

            background-color: #f7f7f7;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        /* TÍTULO */
        .titulo-tabla {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
            font-weight: 600;
        }

        /* TABLA */
        .tabla-autos {
            width: max-content;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        /* ENCABEZADOS */
        .tabla-autos th {
            background-color: #e0e0e0;
            color: #444;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
        }

        /* FILAS */
        .tabla-autos td {
            background-color: #ffffff;
            padding: 12px;
            text-align: center;
            border-radius: 8px;
            color: #333;
        }

        /* EFECTO HOVER */
        .tabla-autos tbody tr:hover td {
            background-color: #ededed;
            transition: background-color 0.3s;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* BOTÓN EDITAR */
        .btn-editar {
            background-color: #5bc0de;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-editar:hover {
            background-color: #31b0d5;
        }

        /* BOTÓN ELIMINAR */
        .btn-eliminar {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-eliminar:hover {
            background-color: #c9302c;
        }

        /* HACER QUE EL MAIN SE EXPANDA SEGÚN LA TABLA */
        .content {
            width: fit-content;
            max-width: none;
            min-width: 900px;

            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
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

        <script src="function/pantallas.js"></script>

        <div class="menu-links">
            <a href="inicioconductor.php">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span>Inicio</span>
            </a>

            <a href="perfil.php">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span>Perfil</span>
            </a>

            <a href="vehiculo.php">
                <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
                <span>Vehículos</span>
            </a>

            <a href="viajes.php">
                <img src="https://cdn-icons-png.flaticon.com/512/3731/3731420.png">
                <span>Viaje</span>
            </a>

            <a href="formularioruta.php">
                <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
                <span>Rutas</span>
            </a>

        </div>
        <div class="menu-links">
            <a href="login.php" class="logout">
                <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
                <span>Salir</span>
            </a>
        </div>
    </aside>

    <main class="content">
        <h1>Bienvenido a TUC</h1>
        <h2>Registre un vehiculo</h2>
        <a href="registrovehiculo.php">
            <button onclick="Regisvehiculo()">
                <img src="https://static.thenounproject.com/png/621382-200.png">
            </button>
        </a>

        <h2 class="titulo-tabla">Vehículos registrados</h2>

        <table class="tabla-autos">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Año</th>
                    <th>Tipo</th>
                    <th>Capacidad</th>
                    <th>Fecha Alta</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($autos as $auto): ?>
                    <tr>
                        <td><?= htmlspecialchars($auto['placa']) ?></td>
                        <td><?= htmlspecialchars($auto['marca']) ?></td>
                        <td><?= htmlspecialchars($auto['modelo']) ?></td>
                        <td><?= htmlspecialchars($auto['color']) ?></td>
                        <td><?= htmlspecialchars($auto['año']) ?></td>
                        <td><?= htmlspecialchars($auto['tipo']) ?></td>
                        <td><?= htmlspecialchars($auto['capacidad']) ?></td>
                        <td><?= htmlspecialchars($auto['fechaalta']) ?></td>
                        <td class="acciones">
                            <!-- BOTÓN EDITAR -->
                            <a href="modificarvehiculos.php?placa=<?= urlencode($auto['placa']) ?>" class="btn-editar">Editar</a>

                            <!-- BOTÓN ELIMINAR -->
                            <form method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este vehículo?');" style="display:inline;">
                                <input type="hidden" name="eliminar_placa" value="<?= $auto['placa'] ?>">
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>


    </main>

</body>

</html>