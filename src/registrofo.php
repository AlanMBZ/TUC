<?php
session_start();

if (!isset($_SESSION['matricula']) || !isset($_SESSION['rol'])) {
    header("Location: registro.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación</title>
    <link rel="stylesheet" href="CSS/Estilos.css">
</head>
<body>

<div class="card">

    <div class="Tit">
        <h1>TERMINO REGISTRO</h1>
        <h4>Completa registro</h4>
    </div>

    <div class="contenedor contenedor-centro">
        <div class="columna columna-centro">


            <form action="http://localhost:3000/src/function/subirDocumentos.php"
                  method="POST"
                  enctype="multipart/form-data">

                <h3>
                    SUBE UNA IMAGEN/FOTO EN FORMATO PNG/JPG  
                    DE TU CREDENCIAL VIGENTE
                </h3>

                <input type="file"
                       name="credencial"
                       id="credencial"
                       accept="image/png, image/jpeg"
                       required
                       hidden>

                <button type="button"
                        class="Conductor"
                        onclick="openFileDialog()">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25399.png">
                </button>

                <button class="subir" type="button" onclick="uploadFile()">
                    SUBIR
                </button>

                <div id="uploadStatus" style="margin-top:12px;color:#333"></div>

            </form>

        </div>
    </div>

</div>

</body>
</html>

<script>
function openFileDialog() {
    document.getElementById('credencial').click();
}

async function uploadFile() {
    const input = document.getElementById('credencial');
    const status = document.getElementById('uploadStatus');
    if (!input.files || input.files.length === 0) {
        status.textContent = 'Por favor selecciona una imagen antes de subir.';
        return;
    }

    const file = input.files[0];
    console.log('Archivo seleccionado:', file);
    const url = 'http://localhost:3000/src/function/subirDocumentos.php';

    const fd = new FormData();
    fd.append(input.name, file);

    try {
        status.textContent = 'Subiendo...';
        const resp = await fetch(url, {
            method: 'POST',
            body: fd
        });
        console.log('Respuesta del servidor:', resp);

        if (!resp.ok) throw new Error('Error en la subida: ' + resp.status);

        const text = await resp.text();
        status.textContent = 'Subida completada.';
        console.log('Respuesta del servidor:', text);
    } catch (err) {
        status.textContent = 'Error al subir archivo.';
        console.error(err);
    }
}

document.getElementById('credencial').addEventListener('change', function(e){
    const status = document.getElementById('uploadStatus');
    if (this.files && this.files.length) {
        status.textContent = 'Archivo seleccionado: ' + this.files[0].name;
    } else {
        status.textContent = '';
    }
});
</script>
