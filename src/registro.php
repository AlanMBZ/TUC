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

<form id="formRegistro" action="function/registroprueba.php" method="POST">

<div class="contenedor">

    <div class="columna">
        <h3>Nombre</h3>
        <input type="text" name="nombre" required>

        <h3>Apellido paterno</h3>
        <input type="text" name="apaterno" required>

        <h3>Apellido materno</h3>
        <input type="text" name="amaterno" required>

        <h3>Fecha de nacimiento</h3>
        <input type="date" name="fecha_nac" required>
    </div>

    <div class="columna">
        <h3>Matrícula</h3>
        <input type="number" name="matricula" required>

        <h3>Correo electrónico</h3>
        <input type="email" name="correo" required>

        <h3>Contraseña</h3>
        <input type="password" id="password" name="password" required>

        <h3>Repite la contraseña</h3>
        <input type="password" id="password2" required>

        <input type="hidden" name="rol" id="rol">

        <button type="submit">Siguiente</button>
    </div>

    <div class="columna">
        <h3>¿Como te quieres registrar?</h3>

        <button type="button" class="Conductor" onclick="seleccionarRol(1)">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png" width="60" height="60">
            Conductor
        </button>

        <button type="button" class="Conductor" onclick="seleccionarRol(2)">
            <img src="https://cdn-icons-png.flaticon.com/512/552/552721.png" width="60" height="60">
            Pasajero
        </button>

    </div>

</div>
</form>
</div>

<script>
function login(){
    window.location.href = "login.php";
}

function seleccionarRol(valor){
    document.getElementById("rol").value = valor;
    alert(valor == 2 ? "Rol seleccionado: Pasajero" : "Rol seleccionado: Conductor");
}

document.getElementById("formRegistro").addEventListener("submit", function(e){
    const pass1 = document.getElementById("password").value;
    const pass2 = document.getElementById("password2").value;
    const rol = document.getElementById("rol").value;

    if(pass1 !== pass2){
        alert("Las contraseñas no coinciden");
        e.preventDefault();
    }

    if(rol === ""){
        alert("Selecciona Conductor o Pasajero");
        e.preventDefault();
    }
});
</script>

</body>
</html>
