<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro vehículo</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estilos.css">
</head>
<body>
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
        <a href="#inicio">
            <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
            <span onclick="inicio()">Inicio</span>
        </a>
        <a href="#perfil">
            <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
            <span>Perfil</span>
        </a>
        <a href="#vehiculos">
            <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
            <span onclick="vehiculo()">Vehículos</span>
        </a>
    </div>
</aside>

    <div class="main">
    <div class="card">
        <div class="Tit">
            <h1>Registro vehículo</h1>
        </div>

        <?php if (!empty($_GET['error'])): ?>
            <div style="color:red; padding:10px;">Error: <?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php elseif (!empty($_GET['success'])): ?>
            <div style="color:green; padding:10px;">Vehículo registrado correctamente.</div>
        <?php endif; ?>

        <form method="post" action="function/pruebavehiculos.php">
            <div class="contenedor">
                <div class="columna">
                    <h3>NIV:</h3>
                    <input type="text" name="niv" placeholder="Ingrese el NIV" required>
                    <h3>Marca:</h3>
                    <input type="text" name="marca" placeholder="Marca del vehículo" required>
                    <h3>Modelo:</h3>
                    <input type="text" name="modelo" placeholder="Modelo del vehículo" required>
                    <h3>Año:</h3>
                    <input type="text" name="anio" placeholder="Año del vehículo" required>
                    <h3>Placas:</h3>
                    <input type="text" name="placas" placeholder="Placas del vehículo" required>
                    <h3>Color:</h3>
                    <input type="text" name="color" placeholder="Color vehículo">
                </div>

                <div class="columna">
                    <img src="https://cdn-icons-png.freepik.com/512/11133/11133502.png">
                    <h3>Tipo de vehículo:</h3>
                    <input type="text" name="tipo" placeholder="Tipo vehículo">
                    <h3>Capacidad de pasajeros:</h3>
                    <input type="text" name="capacidad" placeholder="Capacidad de pasajeros">
                    <div class="botones-inferiores">
                        <button type="submit">Registrar vehículo</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    </div>

    <script>
    function vehiculo(){
        window.open("vehiculo.php");
    }
     function inicio(){
        window.open("inicioconductor.php");
    }
    </script>
</body>
</html>