<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<style>
    body{
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: #f8f8f8;
    }
    .Tit{
        text-align: center;
        margin-bottom: 30px;
    }
    .contenedor{
        display: flex;
        gap: 60px;
    }
    .columna{
        display: flex;
        flex-direction: column;
        width: 250px;
    }
    .columna h3{
        margin: 10px 0 5px;
        font-size: 14px;
        color: #000000;
    }
    input{
        padding: 10px;
        border: 1px solid #000000;
        border-radius: 6px;
        outline: none;
    }
    .Conductor{
        border: none;
        background: #ffffff;
        color: #000;
        cursor: pointer;
        width: 120px;            
        padding: 10px;
        border-radius: 10px;
        display: flex;
        flex-direction: column; 
        align-items: center;
        gap: 5px;
        margin-bottom: 15px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }

    .Conductor img{
        width: 50px;
        height: 50px;
    }

    .Conductor:hover {
        background-color: #e4e4e4;
    }
    
    button{
        margin-top: 30px;
        padding: 12px 20px;
        border: none;
        background: #000000;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
    }
    button:hover {
        background-color: #525252;
    }
</style>
</head>
<body>
    <div class="Tit">
        <h1>REGÍSTRATE</h1>
        <h4>¿Ya estás registrado? Inicia sesión</h4>
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
    <button onclick="formulario2()">Siguiente</button>
    <script>
        function formulario2(){
            window.open("Registrofo.html");
        }
    </script>
</body>
</html>