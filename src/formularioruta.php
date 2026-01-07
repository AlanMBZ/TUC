<?php
session_start();
require_once('function/conexion.php');
require_once('function/session_usuario.php');
$matricula = $_SESSION['matricula'] ?? null;
$opciones_autos = '';
if ($matricula) {
    $conn = Cconexion::ConexionBD();
    $stmt = $conn->prepare('SELECT c.idconductor FROM conductor c WHERE c.matricula = ?');
    $stmt->execute([$matricula]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $idconductor = $row['idconductor'];
        $stmt2 = $conn->prepare('SELECT placa, modelo, marca FROM autos WHERE idconductor = ?');
        $stmt2->execute([$idconductor]);
        while ($auto = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $opciones_autos .= '<option value="' . htmlspecialchars($auto['placa']) . '">' . htmlspecialchars($auto['placa']) . ' - ' . htmlspecialchars($auto['marca']) . ' ' . htmlspecialchars($auto['modelo']) . '</option>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar ruta</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        .card {
    max-height: 90vh;        /* ocupa casi toda la pantalla */
    overflow-y: auto;        /* scroll vertical */
    padding-right: 10px;     /* evita que el scroll tape contenido */
}

    </style>

</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const inputs = document.querySelectorAll(
                'input[type="text"], input[type="email"]'
            );

            inputs.forEach(input => {
                input.addEventListener("input", () => {
                    const cursor = input.selectionStart;
                    input.value = input.value.toUpperCase();
                    input.setSelectionRange(cursor, cursor);
                });
            });

        });
    </script>
   

    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="toggle-btn">☰</label>

    <aside class="sidebar">
        <label for="menu-toggle" class="close-btn">×</label>

        <div class="user-info">
            <img src="<?= $imagenPerfil ?>" alt="Foto de perfil" class="foto-perfil" style="width: 50px; height: 50px; border-radius: 5%; object-fit: cover;">
            <div class="user-text">
                <span class="user-name">CONDUCTOR</span>
                <span class="user-role"><?= htmlspecialchars($nombreUsuario) ?></span>
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

            <a href="rutas.php">
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

    <div class="card">
        <div class="Tit">
            <h1>REGISTRO DE RUTA</h1>
            <form action="function/registroruta.php" method="POST">
                <!--Mapa-->
                <h3>Punto de salida:</h3>
                <input type="text" id="puntoSalida" name="puntosalida"
                    placeholder="Seleccione un punto en el mapa"
                    required readonly>
                <div id="map" style="width: 100%; height: 350px; margin-bottom: 20px;"></div>
                <!--Mapa-->
                <h3>Punto de llegada:</h3>
                <input type="text" name="puntollegada" placeholder="Ingrese el punto de llegada" required>
                <h3>Horario de salida:</h3>
                <input type="text" name="horariosalida" placeholder="Ingrese la hora de salida" required>
                <h3>Auto:</h3>
                <select name="placa_auto" required>
                    <option value="">Seleccione un auto</option>
                    <?php echo $opciones_autos; ?>
                </select>
                <h3>Puntos de espera:</h3>
                <input type="text" name="puntos_espera" placeholder="Ingrese los puntos de espera">
                <h3>Días:</h3>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <label><input type="checkbox" name="dia_lunes" value="1"> Lunes</label>
                    <label><input type="checkbox" name="dia_martes" value="1"> Martes</label>
                    <label><input type="checkbox" name="dia_miercoles" value="1"> Miércoles</label>
                    <label><input type="checkbox" name="dia_jueves" value="1"> Jueves</label>
                    <label><input type="checkbox" name="dia_viernes" value="1"> Viernes</label>
                    <label><input type="checkbox" name="dia_sabado" value="1"> Sábado</label>
                </div>
                <br>
                <button type="submit">Activar ruta</button>
            </form>
        </div>
    </div>
     <!-- Mapa con Leaflet.js -->
    <script>
        const map = L.map('map').setView([19.432608, -99.133209], 13); // CDMX

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }

            obtenerDireccion(lat, lng);
        });

        function obtenerDireccion(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.display_name) {
                        document.getElementById('puntoSalida').value = data.display_name;
                    } else {
                        document.getElementById('puntoSalida').value =
                            lat.toFixed(6) + ', ' + lng.toFixed(6);
                    }
                })
                .catch(() => {
                    document.getElementById('puntoSalida').value =
                        lat.toFixed(6) + ', ' + lng.toFixed(6);
                });
        }
    </script>
    <!-- Mapa con Leaflet.js -->
</body>

</html>