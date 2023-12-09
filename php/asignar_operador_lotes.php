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
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/scroll.css">
	<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.checkboxes.css">
    <title>Aquafiltek - Administrador</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
        <div class="loader"> </div>
    <div class="container lote">

		<table class="datatable table striped hovered cell-hovered border bordered" id="table_lote">
			  <thead class="thead-dark">
			    <tr>
			      <th></th>
			      <th scope="col">Codigo cliente</th>
			      <th scope="col">Nombre cliente</th>
			      <th scope="col">Nombre operador</th>
			    </tr>
			  </thead>
			  <tbody>

			  </tbody>
		</table>
    </div>

    <div class="alert alert-success" role="alert" id="operador_seleccionado">Operador no seleccionado <br></div>
            <div class="btn-group text-center" id="inputNuevoO">
                <button type="button btn_xxl" class="btn btn-warning">Selecciona nuevo operador</button>
                <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" id="OAC">
                </div>
            </div>
            <br>
    <button  class="btn btn-success" id="change_operators">Cambiar operador</button>
   <!-- Modal confirmacion -->
   <div class="modal fade" id="modal_confirmacion" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-center text-dark"><span class="text-success" id="cant_cl"></span> Clientes van a ser asginados al operador <span class="text-success" id="name_op"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-dark" id="table_confirmacion">
                      <thead>
                        <tr>
                          <th scope="col">Identificador</th>
                          <th scope="col">Nombre</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="regresar">Regresar</button>
                    <button type="button" class="btn btn-primary" id="continuar">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Datatable dependences -->
    <script type="text/javascript" src="../js/datatables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.checkboxes.min.js"></script>
    <script type="text/javascript" src="../js/script_lotes.js"></script>
</body>

</html>