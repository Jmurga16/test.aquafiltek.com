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

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <title>Aquafiltek-Administrador</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
    <div id="snackbar"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../img/aquafiltek.png" style="width: 100px; padding: 0;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto  navbar-nav navbar-center">
                <li class="nav-item active" id="PcrearU">
                    <a class="nav-link" href="#" id="CrearU">Crear usuarios <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="PcontrolU">
                    <a class="nav-link" href="#" id="ControlU">Control de usuarios</a>
                </li>
                <li class="nav-item" id="PcambiarP">
                    <a class="nav-link" href="#" id="CambiarP">Cambiar contraseñas</a>
                </li>
                <li class="nav-item" id="PcontrolP">
                    <a class="nav-link" href="#" id="ControlP">Control permisos</a>
                </li>
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="#" id="GenerarR">Generar reportes</a>
                </li>
            </ul>
            <button class="btn btn-outline-danger my-2 my-sm-0" id="cerrar_sesion">Cerrar sesion</button>
        </div>
    </nav>
    <div class="container fondo" id="containerRegister">
        <form>
            <div class="form-group">
                <label for="inputNC">Nombre completo</label>
                <input type="text" class="form-control" id="RinputNC" placeholder="Nombre completo del operador">
            </div>
            <div class="form-group">
                <label for="inputUser">Usuario</label>
                <input type="text" class="form-control" id="RinputUser" aria-describedby="userHelp" placeholder="Nombre de usuario">
                <small id="userHelp" class="form-text text-muted">Identificador con el que el operador podra acceder al sistema</small>
            </div>
            <div class="form-group">
                <label for="inputPass">Password</label>
                <input type="password" class="form-control" id="RinputPass" placeholder="Contraseña" autocomplete="on">
            </div>
        </form>
        <div class="text-center">
            <button class="btn btn-primary btn-center botonForm" id="btn-registrar">Crear usuario</button>
        </div>
        <p class="t-success hide text-center msj" id="msj-succ"></p>
        <p class="t-errno hide  text-center msj" id="msj-err"></p>
    </div>
    <div class="container text-center" id="containerControl">
    </div>
    <div class="container text-center" id="containerCP">
    </div>
    <div class="container text-center" id="containerPO">
        <!-- <div class="search"></div>
        <div class="loader"> </div>
        <h2 class="text-success">Asignar un operador a un cliente</h2>
        <div class="input-group mb-2 mr-md-2" id="BP">
            <div class="input-group-prepend">
            <input type="text" class="form-control" id="input_BP" placeholder="Buscar cliente">
            </div>
                <button class="btn btn-success" id="btn-b"><i class="fa fa-search"></i></button>
        </div>
                <div class="conta">
           <a  href="asignar_operador_lotes.php" target="_blank" class="btn btn-success">Asignar operador por lotes</a>
        </div>
        <br>
        <div class="btn-group">
            <button type="button btn_xxl" class="btn btn-success">Selecciona cliente</button>
            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" id="AOC">
            </div>
        </div> -->
        <h2 class="text-primary">Modificar permisos a los operadores (agregar clientes)</h2>
        <div class="btn-group">
            <button type="button btn_xxl" class="btn btn-primary">Selecciona operador</button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" id="MPO">
            </div>
        </div>

				<h2 class="text-danger">Clientes repetidos</h2>
        <button id="ecr" type="button btn_xxl" class="btn btn-danger">Eliminar clientes repetidos</button>

    </div>


    <div class="container text-center" id="containerGR" style="display: none">
          <div class="report">
            <h1 class="text-warning">Reporte historial usuario</h1>
            <span class="badge badge-pill badge-warning">Seleccionar fechas</span>
            <div class="form-group">
                <input type="text" id="reportrange" name="daterange" value="01/01/2018 - 01/15/2018" />
            </div>
        <span class="badge badge-pill badge-warning">Operador</span>
        <select class="form-control" id="usuario_report">
<?php
include 'connect.php';

$result = mysqli_query($enlace, "SELECT `user`,`id` FROM `DatosIngreso` WHERE `name` !='Admin' AND `name` !='Programador'");

while ($fila = mysqli_fetch_array($result)) {
	echo '<option value="' . $fila['id'] . '">' . $fila['user'] . '</option>';
}
echo '<option value="-1">Todos</option>';

include 'QuitDB.php';
?>
        </select>
                <span class="badge badge-pill badge-warning">Ordenar por</span>
        <select class="form-control" id="tipo_ordenamiento">
                <option value="0">Selecciona opcion</option>
                <option value="1">Cliente (Orden alfabetico)</option>
                <option value="2">Resultado gestion</option>
                <option value="3">Duracion de gestion</option>
                <option value="4">Fecha</option>
        </select>
            <span class="badge badge-pill badge-warning">Exportar a</span>
            <select class="form-control" id="tipo_export">
                <option value="1">PDF</option>
                <option value="2">EXCEL</option>
            </select>

            <button class="btn btn-warning" id="generarReporte2">Generar reporte</button>
        </div>

        <div class="report">
            <h1 class="text-warning">Reporte ejecucion del servicio - mantenimiento de cisterna</h1>
        <span class="badge badge-pill badge-warning">Seleccionar fechas</span>
        <div class="form-group">
            <!-- <input id="fechaAcepto" class="datepicker" width="276"/> -->
            <input type="text" id="fechaAcepto" name="daterange2" value="01/01/2018 - 01/15/2018" 
            style="cursor: pointer; width: 25%; margin-left: 5%; text-align: center;"/>
        </div>
        <div class="alert alert-danger" role="alert" id="alert_date" >
            <h5><b><i class="fas fa-exclamation-circle"></i> Selecciona una fecha!!</b></h5>
        </div>
        <span class="badge badge-pill badge-warning">Exportar a</span>
        <select class="form-control" id="tipo_archivo">
            <option value="1">PDF</option>
            <option value="2">EXCEL</option>
        </select>

            <button class="btn btn-warning" id="generarReporte">Generar reporte</button>
        </div>
        <div class="report" style="margin-bottom: 50px">
            <h1 class="text-warning">Reporte clientes no gestionados</h1>
        <!-- <span class="badge badge-pill badge-warning">Selecciona Operador</span> -->
        <!-- <select class="form-control" id="usuario_reportCNG">
  <?php
//include 'connect.php';

//$result = mysqli_query($enlace, "SELECT `user`,`id` FROM `DatosIngreso` WHERE `name` !='Admin' AND `name` !='Programador'");

//while ($fila = mysqli_fetch_array($result)) {
//	echo '<option value="' . $fila['id'] . '">' . $fila['user'] . '</option>';
//}
//include 'QuitDB.php';
?>
        </select> -->
            <span class="badge badge-pill badge-warning">Exportar a</span>
            <select class="form-control" id="tipo_exportCNG">
                <option value="1">PDF</option>
                <option value="2">EXCEL</option>
            </select>
						<br>
            <button class="btn btn-warning" id="generarReporteCNG">Generar reporte</button>
        </div>


    </div>
    <!-- Buscar cliente -->
    <div class="modal fade" id="Modal_BC" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Buscar cliente</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cliente_gestionar">Selecciona el cliente</label>
                        <select class="form-control" id="cliente_gestionar">
                        <option>Selecciona el cliente</option>
                        </select>
                    </div>
                    <p class="hide" id="cliente_seleccionado"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="AsignarOBC">Asignar operador</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>
