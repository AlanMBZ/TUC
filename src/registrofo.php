<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="CSS/Estilos.css">
</head>
<body>

    <div class="card">

        <div class="Tit">
            <h1>REGÍSTRATE</h1>
            <h4 onclick="iniciarsesion()">¿Ya estás registrado? Inicia sesión</h4>
        </div>

        <div class="contenedor contenedor-centro">
            <div class="columna columna-centro">

                <h3>SUBE UNA IMAGEN/FOTO EN FORMATO PNG/JPG DE TU CREDENCIAL VIGENTE</h3>

                <button class="Conductor">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25399.png">
                </button>

                <button class="subir" onclick="subirf()">SUBIR</button>

            </div>
        </div>

    </div>

<script>
    function iniciarsesion(){
        window.open("login.php");
    }
    function subirf(){
        alert("SE HA REGISTRADO EXITOSAMENTE");
    }
</script>

</body>
</html>
