<?php
session_start();
if ($_SESSION['TipoUsuario'] == 1) {
} else {
    echo '<script language="javascript">alert("No eres administrador");</script>';
    header('Location: ../../index.html');
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../../css/scroll.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

    <title>Aquafiltek-Administrador</title>
    <link rel="shortcut icon" href="../../img/aquafiltek.png" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="../../styles/Administrador/home.css" />
</head>

<body>
    <div id="snackbar"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../../img/aquafiltek.png" style="width: 100px; padding: 0;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto  navbar-nav navbar-center">
                <li class="nav-item active" id="PcrearU">
                    <a class="nav-link" href="#" id="CrearU">Usuarios <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="PcontrolP">
                    <a class="nav-link" href="#" id="ControlP">Control permisos</a>
                </li>
                <li class="nav-item" id="PinactivosP">
                    <a class="nav-link" href="#" id="ControlI">Inactivos</a>
                </li>
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="#" id="GenerarR">Generar reportes</a>
                </li>
                <li class="nav-item" id="PescalasOperador">
                    <a class="nav-link" href="#" id="ControlEscalas">Control Escalas </a>
                </li>
                <li class="nav-item" id="Ptira">
                    <a class="nav-link" href="#" id="ControlTira">Tira Informativa</a>
                </li>
            </ul>
            <button class="btn btn-outline-danger my-2 my-sm-0" id="cerrar_sesion">Cerrar sesion</button>
        </div>
    </nav>

    <div class="container">

        <div id="containerli">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" style="margin-top:15px">
                <li role="presentation" class="active"><a href="#containerRegister" style="text-decoration:none" id="CrearU1" aria-controls="home" role="tab" data-toggle="tab">Crear usuario</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerControl" style="text-decoration:none" id="ControlU" aria-controls="profile" role="tab" data-toggle="tab">Control de usuarios</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerCP" style="text-decoration:none" id="CambiarP" aria-controls="messages" role="tab" data-toggle="tab">Cambiar contraseñas</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerGrupo" style="text-decoration:none" id="GrupoP" aria-controls="messages" role="tab" data-toggle="tab">Grupos poblacionales</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerClientes" style="text-decoration:none" id="RouteSubirClientes" aria-controls="messages" role="tab" data-toggle="tab">Subir Clientes</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerVClientes" style="text-decoration:none" id="VerC" aria-controls="messages" role="tab" data-toggle="tab">Ver Clientes nuevos</a></li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane" id="containerClientes">
                <br />
                <div style='background-color:white; padding:15px'>
                    <h2 class="text-primary">Subir clientes</h2>

                    <br>
                    <div class="float-right">
                        <input type='button' style="width:200px" class='btn btn-primary' onclick="mostrar_asign()" value='Historial de Archivos'>
                    </div>
                    <br>

                    <div class="row">

                        <div class="col-md-4">
                            <strong>Subir archivo de clientes</strong>
                            <br>
                            <br>
                            <form action="xlsx_clientes.php" id="formulario_subir" method="post" enctype="multipart/form-data">
                                <input type="file" id="archivo_xlsx" name="lista" class="form-control">
                                <br>
                                <input id='boton_subir' type="submit" class="btn btn-success" value="Subir" required>
                            </form>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-4" align="center">
                            <strong>Descargar formato</strong>
                            <br>
                            <a href='https://test.aquafiltek.com/clientes.xlsx'>Formato clientes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>

    <script>
        <?php

        if (!empty($_GET["editar_cliente"])) {

            echo "abrirEditarCliente('" . $_GET["editar_cliente"] . "')";
        }

        ?>
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#CrearU1 a').click(function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#ControlU a').click(function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#CambiarP a').click(function(e) {
                e.preventDefault()
                $(this).tab('show')
            });
            $('#RouteSubirClientes a').click(function(e) {
                e.preventDefault()
                $(this).tab('show')
            });

            $('#table_inactivos').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });


            $('#c_nuevos').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            

            $('#tabla_archivados').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $('#tabla_ArchivosClientes').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $(function() {
                $('[data-toggle="tooltip"]').tooltip();

                $("#formulario_subir").on("submit", function(e) {
                    e.preventDefault();


                    var f = $(this);
                    var formData = new FormData(document.getElementById('formulario_subir'));

                    var arcre = document.getElementById('archivo_xlsx').value;

                    if (arcre == '') {
                        alert('Adjunte un archivo para continuar.');
                    } else {
                        document.getElementById('boton_subir').disabled = true;
                        $.ajax({
                                url: "xlsx_clientes.php",
                                type: "post",
                                dataType: "html",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false
                            })
                            .done(function(res) {
                                document.getElementById('formulario_subir').reset();
                                document.getElementById('boton_subir').disabled = false;
                                alert('Archivo de clientes subido correctamente.');
                            });
                    }

                });
            });

        });
    </script>

</body>

</html>