<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <style>
        .Sesion{
            display: block;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        button{
            border: none;
            color: white;
            padding: 10px 40px;
            border-radius: 5px;
            background-color: #000000;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
        background-color: #525252;
        }
    </style>
</head>
<body>
    <div class="Sesion">
    <h1>INICIAR SESION / REGISTRATE</h1>
    <H4>Inicia sesion para continuar</H4>
    <h2>Usuario</h2>
    <input type="text" placeholder="Ingresa usuario">
    <h2>Contraseña:</h2>
    <input type="password" placeholder="Ingrese contraseña"><br><br>
    <button onclick="iniciarsesion()">Iniciar sesion</button><br><br>
    <button onclick="registro()">Registrate</button>
    </div>
    <script>
        function iniciarsesion(){
            alert("Iniciando sesion");
        }
        function registro(){
            window.open("Registro.html");
        }
    </script>
</body>
</html>