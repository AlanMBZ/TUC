<?php
require_once('../function/session_usuariopasajero.php');
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estilopagina.css">
</head>

<body>
    <script src="../function/Ventanas.js"></script>
    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="toggle-btn">☰</label>

    <aside class="sidebar">
        <label for="menu-toggle" class="close-btn">×</label>

        <div class="user-info">
            <img src="<?= $imagenPerfil ?>" alt="Foto de perfil" class="foto-perfil" style="width: 50px; height: 50px; border-radius: 5%; object-fit: cover;">
            <div class="user-text">
                <span class="user-name">PASAJERO</span>
                <span class="user-role"><?= htmlspecialchars($nombreUsuario) ?></span>
            </div>
        </div>

        <div class="menu-links">
            <a href="inicioPasajero.php">
                <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
                <span>Inicio</span>
            </a>

            <a href="perfilpasajero.php">
                <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
                <span>Perfil</span>
            </a>

            <a href="viajepasajero.php">
                <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
                <span>Viajes</span>
            </a>
            <a href="rutaspasajero.php">
                <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
                <span>Rutas</span>
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

        <section class="hero">
            <h1>Bienvenido a TUC</h1>
            <h3>Conectando estudiantes, transformando la movilidad</h3>
            <p>
                TUC (Transporte Universitario Colaborativo) es una plataforma digital —aplicación móvil
                y página web— diseñada para mejorar la movilidad de los estudiantes del Tecnológico de
                Estudios Superiores de Coacalco (TESCo).
            </p>
        </section>

        <section class="info">
            <h2>¿Qué es TUC?</h2>
            <p>
                TUC es un sistema informático de transporte colaborativo que permite a estudiantes
                compartir viajes de manera organizada, segura y eficiente, conectando a conductores
                y pasajeros dentro de la misma comunidad universitaria.
            </p>
        </section>

        <section class="info">
            <h2>Objetivo</h2>
            <p>
                Ofrecer una alternativa de movilidad segura, accesible y confiable, reduciendo la
                dependencia del transporte público convencional y mejorando la experiencia diaria
                de traslado de los estudiantes.
            </p>
        </section>

        <section class="beneficios">
            <h2>Beneficios de TUC</h2>

            <div class="beneficios-grid">
                <div class="card">
                    <h4>Seguridad validada</h4>
                    <p>Solo usuarios verificados con credencial TESCo, garantizando viajes entre compañeros.</p>
                </div>

                <div class="card">
                    <h4>Economía colaborativa</h4>
                    <p>Viajes más económicos para pasajeros y apoyo a conductores con gastos de combustible.</p>
                </div>

                <div class="card">
                    <h4>⏱️ Ahorro de tiempo</h4>
                    <p>Optimiza rutas y reduce tiempos de espera, mejorando la puntualidad.</p>
                </div>

                <div class="card">
                    <h4>Comunidad</h4>
                    <p>Fomenta la colaboración y el compañerismo dentro del entorno universitario.</p>
                </div>
            </div>

        </section>

    </main>

</body>

</html>