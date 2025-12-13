<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos</title>
    <link rel="stylesheet" href="CSS/Estiloinicio.css">
    <link rel="stylesheet" href="CSS/Estiloconsu.css">
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

        <a href="#viaje">
            <img src="https://cdn-icons-png.flaticon.com/512/3731/3731420.png">
            <span>Viaje</span>
        </a>

        <a href="#ruta">
            <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
            <span>Rutas</span>
        </a>

        <a href="#ajustes">
            <img src="https://cdn-icons-png.flaticon.com/512/456/456167.png">
            <span>Ajustes</span>
        </a>

        <a href="#ayuda">
            <img src="https://cdn.iconscout.com/icon/free/png-256/free-ayuda-icon-svg-download-png-2598199.png">
            <span>Ayuda</span>
        </a>
    </div>
    <div class="menu-links">
    <a href="#salir" class="logout">
        <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
        <span>Salir</span>
    </a>
    </div>
</aside>

<div class="cuadro-principal">
<div class="Tit">
    <h1>Vehículo</h1>
</div>
<div class="contenedor">

    <div class="columna">

        <button class="botonimagen">
            <img src="https://static.vecteezy.com/system/resources/previews/026/631/445/non_2x/add-photo-icon-symbol-design-illustration-vector.jpg" width="20">
        </button>

        <h3>Foto del vehículo</h3>

        <button>
            Cargar documento
            <img src="https://cdn-icons-png.flaticon.com/512/8919/8919259.png">
        </button>

        <div class="botones-inferiores">
            <button onclick="modificar()">Modificar</button>
        </div>

    </div>

    <div class="columna">

        <h3>Matrícula:</h3>
        <h3>Marca:</h3>
        <h3>Modelo:</h3>
        <h3>Estado:</h3>
        <h3>Año:</h3>
        <h3>Placas:</h3>
        <h3>Color:</h3>

        <h3>Licencia de conducir vigente</h3>
        <button>
            Cargar documento
            <img src="https://cdn-icons-png.flaticon.com/512/8919/8919259.png">
        </button>

        <h3>Tarjeta de circulación</h3>
        <button>
            Cargar documento
            <img src="https://cdn-icons-png.flaticon.com/512/8919/8919259.png">
        </button>

        <div class="botones-inferiores">
            <button>Salir</button>
        </div>

    </div>

</div>
</div>
<script>
    function modificar(){
        window.open("modificarvehiculos.php");
    }
     function vehiculo(){
        window.open("vehiculo.php");
    }
     function inicio(){
        window.open("inicio.php");
    }
</script>
</body>
</html>
