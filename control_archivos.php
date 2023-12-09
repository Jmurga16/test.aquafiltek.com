<?php 
require "php/check_session.php";
?>
<!doctype html>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
    <div class="loader"></div>
    <div class="container" id="SubirArchivo">
        <h2 class="text-center text-primary">Sube un PDF</h2>
        <form id="formul" action="php/subir_archivo.php" method="post" enctype="multipart/form-data">
            <input type="text" name="operador" id="operador" class="hide">
            <br><br>
            <input type="text" name="cliente" id="cliente" class="hide">
            <br><br>
            <input type="file" id="fileToUpload" name="fileToUpload">
            <button id="enviar" class="btn btn-primary">Subir archivo</button>
        </form>
    </div>
    <div class="container" id="DescargarArchivo">
        <h2 class="text-center text-primary">Descarga un PDF</h2>
        <form id="formul" action="php/salvar_archivo.php" method="post" enctype="multipart/form-data">
            <input type="text" name="operador2" id="operador2" class="hide">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Selecciona PDF a descargar</label>
                <select class="form-control" id="ruta" name="ruta">
                    <option>Seleccionar Archivo</option>
                </select>
                <br>
                <button id="descargarPDF" class="btn btn-primary hide">Descargar PDF</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/archivos.js"></script>
    <script type="text/javascript" src="js/auxiliares.js"></script>
    <script type="text/javascript" src="js/verificar_actividad.js"></script>
      
</body>

</html>