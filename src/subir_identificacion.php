<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center; 
            font-family: Arial, sans-serif;
        }

        .Tit{
            text-align: center;
            margin-bottom: 30px;
        }

        .Conductor{
            border: none;
            background: #ffffff;
            cursor: pointer;
            padding: 10px;
            display: flex;
            justify-content: center;  
            align-items: center;      
            border-radius: 10px;
        }

        .Conductor img{
            display: block;
            margin: auto;           
            width: 100px;            
            height: 100px;
        }
      .subir{
            border: none;
            color: white;
            padding: 10px 40px;
            border-radius: 5px;
            background-color: #000000;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .subir:hover {
        background-color: #525252;
        }
    </style>
</head>
<body>

    <div class="Tit">
        <h1>REGÍSTRATE</h1>
        <h4 onclick="iniciarsesion()">¿Ya estás registrado? Inicia sesión</h4>
        <h3>SUBE UNA IMAGEN/FOTO EN FORMATO PNG/JPG DE TU CREDENCIAL VIGENTE</h3>
    </div>
    <button class="Conductor">
        <img src="https://cdn-icons-png.flaticon.com/512/25/25399.png">
    </button>
    <button class="subir" onclick="subirf()">SUBIR</button>
<script>
    function iniciarsesion(){
            window.open("index.php");
        }
    function subirf(){
        alert("SE HA REGISTRADO EXITOSAMENTE");
    }
</script>
</body>
</html>
