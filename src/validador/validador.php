<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: login.php");
    exit;
}
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


</head>
<body>
    <script src="direccion.js"></script>
    <input type="checkbox" id="menu-toggle"/>
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
    <a href="#salir" class="logout" onclick="salir()">
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
                <tr>
                    <td>foto</td>
                    <td>Hanna Jazmin</td>
                    <td>Arias</td>
                    <td>Rios</td>
                    <td>28/04/2004</td>
                    <td>202220232</td>
                    <td>hanna@gmail.com</td>
                    <td>Conductor</td>
                    <td>
                        <button>Aceptar</button>
                        <button>Rechazar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
    </div>
</div>
</div>
</main>
</body>
</html>
