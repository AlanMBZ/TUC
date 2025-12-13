<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | TUC</title>
    <link rel="stylesheet" href="CSS/Estilopagina.css">
</head>

<body>

<main class="content">

    <section class="hero">
        <h1>Bienvenido a TUC</h1>
        <h3>Conectando estudiantes, transformando la movilidad</h3>
        <p>
            TUC (Transporte Universitario Colaborativo) es una plataforma digital (aplicación móvil
            y página web) diseñada para mejorar la movilidad de los estudiantes del Tecnológico de
            Estudios Superiores de Coacalco (TESCo).
        </p>

        <button class="btn-hero" onclick="login()">Comenzar viaje</button>
    </section>

    <section class="info">
        <h2>¿Qué es TUC?</h2>
        <p>
            Sistema informático de transporte colaborativo que conecta a estudiantes para compartir
            viajes de manera segura, económica y eficiente.
        </p>
    </section>

    <section class="info">
        <h2>Objetivo</h2>
        <p>
            Ofrecer una alternativa de movilidad segura y confiable, reduciendo la dependencia
            del transporte público convencional.
        </p>
    </section>

    <section class="beneficios">
        <h2>Beneficios de TUC</h2>

        <div class="beneficios-grid">
            <div class="card">
                <h4>Seguridad validada</h4>
                <p>Solo usuarios verificados con credencial TESCo.</p>
            </div>

            <div class="card">
                <h4>Economía colaborativa</h4>
                <p>Viajes más económicos y apoyo a conductores.</p>
            </div>

            <div class="card">
                <h4>Ahorro de tiempo</h4>
                <p>Optimización de rutas y menor espera.</p>
            </div>

            <div class="card">
                <h4>Comunidad</h4>
                <p>Fomenta la colaboración universitaria.</p>
            </div>
        </div>
    </section>

</main>

<script>
function login(){
    window.location.href = "login.php";
}
</script>

</body>
</html>
