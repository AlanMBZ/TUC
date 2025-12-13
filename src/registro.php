<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link rel="stylesheet" href="CSS/Estilos.css">
</head>
<body>
    <div class="card">
    <div class="Tit">
        <h1>REGÍSTRATE</h1>
        <h4 onclick="login()">¿Ya estás registrado? Inicia sesión</h4>
    </div>

    <div class="contenedor">
        <div class="columna">
            <h3>Nombre</h3>
            <input type="text" placeholder="Nombre">

            <h3>Apellido paterno</h3>
            <input type="text" placeholder="Apellido paterno">

            <h3>Apellido materno</h3>
            <input type="text" placeholder="Apellido materno">

            <h3>Fecha de nacimiento</h3>
            <input type="date">
        </div>

        <div class="columna">
            <h3>Matrícula</h3>
            <input type="text" placeholder="Matrícula">
            <h3>Correo electrónico</h3>
            <input type="email" placeholder="Correo electrónico">
            <h3>Contraseña</h3>
            <input type="password" placeholder="Contraseña">
            <h3>Repite la contraseña</h3>
            <input type="password" placeholder="Contraseña">
                <button onclick="formulario2()">Siguiente</button>

    </div>
    <div class="columna">
        <h3>¿Como te quieres registrar?</h3>
        <button class="Conductor">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png" width="60" height="60"> 
        Conductor</button>
         <button class="Conductor">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png" width="60" height="60"> 
        Pasajero</button>
        </div>
    </div>
    </div>
    <script>
        function formulario2(){
            window.open("registrofo.php");
        }
         function login(){
            window.open("login.php");
        }
    </script>
</body>
</html>