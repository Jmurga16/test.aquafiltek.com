<?php
session_start();

$fechaI = $_GET['day1'] . '/' . $_GET['month1'] . '/' . $_GET['year1'];
$fechaF = $_GET['day2'] . '/' . $_GET['month2'] . '/' . $_GET['year2'];
$operador = $_GET['op'];
$orden = $_GET['or'];

?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/styleU.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
        <!-- <div class="history_ge"></div> -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <div class="container">
            <table class="table table-striped table-dark" id="reporte">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Operador</th>
                    <th scope="col">Accion realizada</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Resultado</th>
                    <th scope="col">Duracion</th>
                    </tr>
                </thead>
                <tbody>
<?php
include 'connect.php';
include 'funciones_reporte.php';
$query = get_script($fechaI, $fechaF, $operador, $orden);

$resultado = mysqli_query($enlace, $query);
while ($data = mysqli_fetch_assoc($resultado)) {

	$accion = get_accion($data['tipo']);
	$resultadoG = get_resultado($data['tipo']);
	echo '
        <tr>
            <th scope="row">' . $data['fecha'] . '</th>
            <td>' . $data['operador'] . '</td>
            <td>' . $accion . '</td>
            <td>' . $data['cliente'] . '</td>
            <td>' . $resultadoG . '</td>
            <td>' . $data['duracion'] . '</td>
        </tr>';
}

include 'QuitDB.php';
?>
          </tbody>
            </table>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.min.js"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.plugin.autotable.js"></script>
        <script type="text/javascript" src="../js/create_pdf.js"></script>
</body>

</html>