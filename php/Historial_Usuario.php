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
  <link rel="stylesheet" type="text/css" href="../css/styleH.css">
  <link rel="stylesheet" type="text/css" href="../css/scroll.css">
  <title>Aquafiltek-Historial</title>
  <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
  <a href="javascript:cerrar();"><img src="../img/flecha.png" class="regresar" title="Cerrar Ventana"></a>
  <div class="container fondo" style="margin-top: 20px; padding-bottom: 1rem;">
    <h1 class="text-center">Historial de ingresos <span id="user"></span></h1>

    <br>

    <div class="row ml-3">
      <div class="col-3">
        <div class="form-group">
          <label for="startDate">Fecha Inicio</label>
          <input type="date" class="form-control" id="startDate">
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="endDate">Fecha Fin</label>
          <input type="date" class="form-control" id="endDate">
        </div>
      </div>
      <div class="col-2" style="align-self: center;">
        <button type="button" id="filtrar" class="btn btn-primary" style="width:100%; margin-top:1rem" onclick="getDataTable()">
          Filtrar
        </button>
      </div>
    </div>

    <table class="table table-bordered table-hover" id="registros">
      <thead>
        <tr>
          <th scope="col">Fecha ingreso</th>
          <th scope="col">Hora ingreso</th>
          <th scope="col">Hora salida</th>
          <th scope="col">Direccion IP</th>
          <th scope="col">Tiempo inactivo</th>
          <th scope="col">Tiempo almuerzo</th>
        </tr>
      </thead>
      <tbody id="tbodyid">

      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/Administrador/ControlUsuarios/historialUsuario.js"></script>
</body>

</html>