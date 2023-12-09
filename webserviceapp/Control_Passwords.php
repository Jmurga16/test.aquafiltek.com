<?php
session_start();
if ($_SESSION['TipoUsuario'] == 1) {
} else {
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
     <a href="javascript:cerrar();"><img src="../img/flecha.png" class="regresar"></a>
    <div class="container fondo">
        <form>
            <div class="form-group">
                <label for="inputUser">Usuario</label>
                <input type="text" disabled="true" class="form-control" id="CPuser" aria-describedby="userHelp" placeholder="Nombre de usuario">
                <small id="userHelp" class="form-text text-muted">Usuario al que se le modificara la contraseña</small>
            </div>
            <div class="form-group">
                <label for="inputPass">Contraseña</label>
                <input type="password" class="form-control" id="CPPass" placeholder="Contraseña nueva" autocomplete="on" required="true">
            </div>
            <div class="form-group">
                <label for="inputPass">Confirmar contraseña</label>
                <input type="password" class="form-control" id="CPCPass" placeholder="Confirmar contraseña" autocomplete="on" required="true">
            </div>
        </form>
            <div class="text-center">
                <button class="botonForm btn btn-primary btn-center" id="btn-actualizar">Actualizar contraseña</button>
            </div>
            <p class="t-success hide text-center msj" id="msj-actu"></p>

            <p class="t-errno hide text-center msj" id="msj-nactu"></p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/scriptPass.js"></script>

</body>

</html>