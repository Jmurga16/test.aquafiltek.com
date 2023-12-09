<?php 
    session_start();
    if($_SESSION['TipoUsuario']==1){
    }else{
        echo '<script language="javascript">alert("No eres administrador");</script>';
        header('Location: ../index.html');  
    }
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/scroll.css">
       <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <title>Aquafiltek-Administrador</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
    <div class="container fondo" id="containerRegister">
        <form id="formulario">
            <div class="form-group">
                <label for="inputNC">Nombre operador</label>
                <input type="text" class="form-control" id="RinputNC" placeholder="Nombre completo del operador" readonly="true">
            </div>
        
        </form>
            <div class="text-center">
                <button class="btn btn-primary btn-center botonForm" id="btn-actualizar">Cambiar permisos</button>
            </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/cambiarPermisos.js"></script>
    
</body>
</html>