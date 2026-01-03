<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen del viaje</title>
    <link rel="stylesheet" href="../CSS/Estiloinicio.css">
    <link rel="stylesheet" href="../CSS/Estiloestrella.css">

</head>
<body>
    <script src="../function/Ventanas.js"></script>
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
        <a href="#inicio" onclick="iniciopasajero()">
            <img src="https://marketplace.canva.com/eGqLY/MAGPH-eGqLY/1/tl/canva-round-house-icon-MAGPH-eGqLY.png">
            <span>Inicio</span>
        </a>

        <a href="#perfil" onclick="Perfilpasajero()">
            <img src="https://cdn-icons-png.flaticon.com/512/848/848006.png">
            <span>Perfil</span>
        </a>

        <a href="#viajes" onclick="Viajepasaje()">
            <img src="https://www.nicepng.com/png/full/89-891434_white-car-icon-png-car-icon-green-png.png">
            <span>Viajes</span>
        </a>
        <a href="#ruta" onclick="Rutapasajero()">
            <img src="https://cdn-icons-png.flaticon.com/512/599/599129.png">
            <span>Rutas</span>
        </a>
    </div>
    <div class="menu-links">
    <a href="#salir" class="logout" onclick="salir()">
        <img src="https://cdn-icons-png.flaticon.com/512/16385/16385164.png">
        <span>Salir</span>
    </a>
    </div>
</aside>
<div class="content">
            <h1>Resumen del viaje</h1>
    <h3>Conductor: </h3>
    <h3>Distancia: </h3>
    <h3>Costo aplicado: </h3>
    <h3>¿Cómo estuvo tu viaje?</h3>
    <div class="rating">
  <input type="radio" id="star5" name="rating" value="5">
  <label for="star5">★</label>

  <input type="radio" id="star4" name="rating" value="4">
  <label for="star4">★</label>

  <input type="radio" id="star3" name="rating" value="3">
  <label for="star3">★</label>

  <input type="radio" id="star2" name="rating" value="2">
  <label for="star2">★</label>

  <input type="radio" id="star1" name="rating" value="1">
  <label for="star1">★</label>
</div>
    <h3>Comentarios</h3>
    <input type="text" placeholder="¿Deseas dejar algun comentario?">
    <h2>¡Gracias por usar TUC!</h2>
    <h4>Ya no tienes viajes pendientes</h4>
    <button onclick="Viajepasaje()">Volver</button>
    </div>
</body>
</html>