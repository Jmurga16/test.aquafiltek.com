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
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

    <title>Aquafiltek-Administrador</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
    <style>
        #table_escalas {
            background-color: white;
        }

        @media(min-width:700px) {
            #table_escalas {
                width: 50%;
                margin: auto;
            }
        }

        @media(max-width:700px) {
            #table_escalas {
                width: 90%;
                margin: auto;
            }
        }

        .nombre_user a {
            margin-left: 8px;
        }

        a.show.active {
            font-weight: bold;
        }
    </style>
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
                <li role="presentation" style="margin-left:25px"><a href="#containerClientes" style="text-decoration:none" id="SubirClientes" aria-controls="messages" role="tab" data-toggle="tab">Subir Clientes</a></li>
                <li role="presentation" style="margin-left:25px"><a href="#containerVClientes" style="text-decoration:none" id="VerClientesNuevos" aria-controls="messages" role="tab" data-toggle="tab">Ver Clientes nuevos</a></li>
            </ul>
        </div>
        <!-- Menu Usuarios -->
        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="containerRegister">
                <div class="container fondo">
                    <!-- EMPIEZA USUARIOS -->
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
            </div>

            <div role="tabpanel" class="tab-pane" class="container text-center" style="display: flex; flex:1; flex-direction: column" id="containerControl">

            </div>

            <div role="tabpanel" class="tab-pane" class="container text-center" id="containerCP">

            </div>

            <div role="tabpanel" class="tab-pane" id="containerGrupo">

            </div>


            <!-- Contenido del Popover Asignar Operador -->
            <div class="containerPopover hidden d-none" id="popoverAsignarOperador">

            </div>

            <!--SubMenu Subir Clientes-->
            <div role="tabpanel" class="tab-pane" id="containerClientes">
                <br />

                <div id="subirClientesMain" style='background-color:white; padding:15px'>
                    <h2 class="text-primary">Subir clientes</h2>

                    <br>
                    <div class="float-right">
                        <input type='button' style="width:200px" class='btn btn-primary' onclick="mostrarHistorialArchivosClientes()" value='Historial de Archivos'>
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
                        <div class="col-md-4">
                            <strong>Descargar formato</strong>
                            <br>
                            <a href='https://test.aquafiltek.com/clientes.xlsx'>Formato clientes</a>
                        </div>

                    </div>

                </div>

                <div id="subirClientesHistorial" style='background-color:white; padding:15px; display:none'>
                    <h2 class="text-primary">Historial de Archivos de Clientes</h2>

                    <br>
                    <div class="float-right">
                        <input type='button' style="width:200px" class='btn btn-primary' onclick="goToSubirClientes()" value='Subir Clientes'>
                    </div>

                    <br>
                    </br>

                    <div class="table-responsive" style="padding-right:1rem">
                        <table class="table table-bordered" id="tabla_ArchivosClientes">
                            <thead>
                                <tr>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Usuario
                                    </th>
                                    <th>
                                        Nombre Archivo
                                    </th>

                                    <th>
                                        Fecha de Subida
                                    </th>
                                    <th>
                                        Opciones
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once('connect.php');
                                $data = mysqli_query($enlace, "SELECT * FROM Archivos_SubirClientes INNER JOIN DatosIngreso ON Archivos_SubirClientes.IdUsuario = DatosIngreso.id WHERE Archivos_SubirClientes.Activo = 1");
                                while ($res = mysqli_fetch_array($data)) {
                                    echo "<tr>
                                            <td>" . $res['Id'] . "</td>
                                            <td>" . $res['name'] . "</td>
                                            <td>" . $res['NombreArchivo'] . "</td>
                                            <td>" . $res['FechaSubida'] . "</td>
                                            <td align=center>";
                                ?>
                                    <!-- <a type='button' class='btn btn-info' style="width:100%" href="<?PHP echo $res['RutaArchivo']; ?>" target="_blank">
                                        Descargar
                                    </a> -->
                                    <br>
                                    <input type='button' class='btn btn-danger' value='Eliminar' onclick="eliminarArchivoCliente('<?PHP echo $res['Id']; ?>')" />
                                <?PHP echo "</td>
                                        </tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>

            <!-- SubMenu Ver Clientes Nuevos -->
            <div role="tabpanel" class="tab-pane" id="containerVClientes">
                <br>
                <br>

                <div class="row" style="background-color:white">

                    <div class="col-md-12" id="divClientesNuevos">
                        <h3 class="text-primary">Clientes nuevos</h3>
                        <br />

                        <div class="row mb-3 pr-3">
                            <?php
                            include_once('connect.php');
                            $num = mysqli_query($enlace, "SELECT * FROM DatosClientes LEFT JOIN grupo_asignacion on DatosClientes.codigo = grupo_asignacion.id_cliente WHERE actualizar_pendiente = 1 AND grupo_asignacion.id_cliente IS NULL");
                            $num_all = mysqli_num_rows($num);
                            ?>
                            <input type='button' style="width:200px; margin-left:auto" class='btn btn-primary' onclick="goToRepartirClientes()" value='Repartir clientes (<?php echo "$num_all"; ?>)' <?php if ($num_all == 0) {
                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                        }   ?> />
                        </div>


                        <br />
                        <table class="table table-bordered" id="c_nuevos">
                            <thead>
                                <tr>
                                    <th>
                                        Código
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Dirección
                                    </th>
                                    <th>
                                        Coordenadas
                                    </th>
                                    <th>
                                        Fecha de subida
                                    </th>
                                    <th>
                                        Opciones
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once('connect.php');
                                $data = mysqli_query($enlace, "SELECT * FROM DatosClientes WHERE actualizar_pendiente = 1");
                                while ($res = mysqli_fetch_array($data)) {
                                    echo "<tr>
                                            <td>" . $res['codigo'] . "</td>
                                            <td>" . $res['nombre_completo'] . "</td>
                                            <td>" . $res['direccion'] . "</td>
                                            <td>" . $res['coordenadas'] . "</td>
                                            <td>" . $res['fecha_subida'] . "</td>
                                            <td align=center>";
                                ?>
                                    <input type='button' class='btn btn-info' value='Editar' onclick="editar_nuevo('<?PHP echo $res['codigo']; ?>')" />
                                    <br>
                                    <input type='button' class='btn btn-danger' value='Eliminar' onclick="eliminar('<?PHP echo $res['codigo']; ?>')" />
                                <?PHP echo "</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </div>

                    <div class="col-md-12" id="divRepartirClientes" style="display:none">
                        <h3 class="text-primary">Repartir Clientes</h3>
                        <br />

                        <div class="row mb-3 pr-3">
                            <button type="button" id="btnClientesNuevos" class="btn btn-primary" style="margin-left:auto" onclick="goToClientesNuevos()">
                                Ver Clientes Nuevos
                            </button>
                        </div>

                        <div id="containerRepartirClientes">
                            <div id="formControlGrupoPoblacional">

                            </div>

                            <div class='row mb-3' id='divFiltroRepartirClientes'>
                                <div class='col-md-6'>
                                    <div class='mb-2'>
                                        <strong class='mb-2'>Clientes disponibles</strong>

                                        <input type='text' name='fitro_disponible' id='fitro_disponible' class='form-control' onkeyup='getListGroupRepartirClientes()' placeholder='Filtro Clientes Disponibles'>
                                    </div>
                                    <br />
                                </div>
                                <div class='col-md-6'>
                                    <div class='mb-2'>
                                        <strong>Clientes asignados</strong>

                                        <input type='text' name='filtro_asignado' id='filtro_asignado' class='form-control' onkeyup='getListGroupRepartirClientes()' placeholder='Filtro Clientes Disponibles'>
                                    </div>
                                    <br />
                                </div>

                            </div>

                            <div id="listGroupRepartirClientes">

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

    </div>

    <!--Menu Control Permisos-->
    <div class="container text-center" id="containerPO">

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
        <br />
        <br />
        <br />
        <h2>Solicitudes de edición de Id</h2>
        <br />
        <br />
        <table class="table" style="background-color:white">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Operador</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="llenar_iediciones">


                </tr>
            </tbody>
        </table>
    </div>

    <!--Menu Control Escalas-->
    <!--28072021 escalas usuarios-->
    <div class="container text-center" id="containerEscalasUsuario" style="display:none">

        <h2 class="text-primary">Modificar escalas a los operadores </h2>
        <div class="btn-group">
            <select class="form-control" id="operador_escala" style="width:250px" onchange="mostrarEscalas(this.value)">
                <option value="">Seleccionar operador</option>
                <?php
                include 'connect.php';
                $arr_filas = [];
                $result = mysqli_query($enlace, "SELECT `user`,`id` FROM `DatosIngreso` WHERE `name` !='Admin' AND `name` !='Programador'");

                while ($fila = mysqli_fetch_array($result)) {
                    $arr_filas[] = $fila;
                    echo '<option value="' . $fila['id'] . '">' . $fila['user'] . '</option>';
                }

                //29072021
                $data_tira = [];
                $result = mysqli_query($enlace, "SELECT * FROM `tira_informativa` ");
                if ($result) {
                    $data_tira = mysqli_fetch_array($result);
                }
                ?>
            </select>
        </div>
        <hr />
        <div id="div_escalas" style="display:none">
            <table id="table_escalas" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Escala</th>
                        <th>Número</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($enlace, "SELECT * FROM `escalas`");

                    while ($fila = mysqli_fetch_array($result)) {

                        echo '<tr><td>' . $fila['descripcion'] . '</td><td ><input id="txt_escala_' . $fila['id'] . '" type="number" step="0.01" class="form-control txt_escala" data-id="' . $fila['id'] . '"/></td></tr>';
                    }

                    ?>
                </tbody>
            </table>
            <br />
            <button id="bt_guardar_escalas" type="button btn_xxl" class="btn btn-primary">Guardar Escalas</button>
        </div>

        <br />
        <br />
        <div style="background-color: white">
            <h2 style="padding:8px; background-color: white"><strong>Modificar cantidad de dias para recordatorios urgentes</strong></h2>
            <br />
            <center>
                <h4 style="padding:4px; background-color: white; width:150px; margin-right:20px"><strong>Filtro actual:
                        <?php
                        $result = mysqli_query($enlace, "SELECT * FROM `filtros` WHERE id = 1");

                        while ($fila = mysqli_fetch_array($result)) {

                            echo '' . $fila['r_urgentes'] . '';
                        }

                        include 'QuitDB.php';
                        ?> </strong></h4>
            </center>
            <center><strong>Nuevo filtro: </strong><select name='dias' id='dias' class="form-control" style='width:200px'>
                    <option value=''>--SELECCIONE--</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                    <option value='25'>25</option>
                    <option value='30'>30</option>

                </select>
                <br />
                <input type='button' class='btn btn-primary' style='width:150px' value='Guardar' onclick="actualizar_filtro()" />
            </center>
            <br />
        </div>
    </div>

    <!--Menu Tira Informativa-->
    <!--28072021-->
    <!--29072021 tira informativa  -->
    <div class="container text-center" id="containerTira" style="display:none">

        <h2 class="text-primary">Administración de tira informativa</h2>

        <div class="form-group">
            <label for="sel_opcion_tira">Tira Permanente </label>
            <select class="form-control" id="sel_opcion_tira" onchange="mostrarTiempoTira(this.value)">
                <option value="">Seleccionar</option>
                <option value="1" <?php echo isset($data_tira["permanente"]) && $data_tira["permanente"] == 1 ? "selected" : "" ?>>Sí</option>
                <option value="0" <?php echo isset($data_tira["permanente"]) && $data_tira["permanente"] == 0 ? "selected" : "" ?>>No</option>

            </select>

        </div>
        <div class="form-group">
            <label for="sel_opcion_tira">Mensaje </label>
            <textarea id="text_mensaje" resizable="false" class="form-control" rows="3"><?php echo isset($data_tira["mensaje"]) ? $data_tira["mensaje"] : ''  ?></textarea>

        </div>
        <div id="tiempo_tira" class="form-group" style="display:<?php echo isset($data_tira["permanente"]) && $data_tira["permanente"] == 0 ? "block" : "none" ?>">
            <label for="cliente_gestionar">Tiempo en minutos </label>
            <input id="txt_minutos_tira" type="number" class="form-control" min="0" max="9999" value="<?php echo isset($data_tira["minutos"]) ? $data_tira["minutos"] : "0"; ?>" />

            <input id="guardar_ti" type="hidden" value="<?php echo isset($data_tira["id"]) ? "0" : "1"; ?>" />
        </div>
        <br>
        <button type="button" class="btn btn-primary" id="bt_guardar_tira">Guardar</button>


    </div>

    <!--Menu Inactivos-->
    <!--29072021-->
    <!-- administrar inactivos -->
    <div class="container text-center" id="containerInac" style="display:none">
        <br />
        <h2 class="text-primary">Administración de clientes inactivos</h2>

        <div align=right>
            <input type="button" style="width:180px" id="mostrar_archivados" class="btn btn-info" value="Ver archivados" onclick='mostrar_archivados()'>
        </div>
        <br>
        <div id="div_archivados" style="display:none">
            <table class="table table-bordered table-striped" id="tabla_archivados" style="background-color:white">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Operador</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "connect.php";

                    $script_ar = "SELECT codigo, nombre_completo, direccion, id_operador, fecha, hora, motivo, tipo_inactivo FROM DatosClientes LEFT JOIN gestion_inactivos on DatosClientes.codigo = gestion_inactivos.id_cliente WHERE inactivo = 1 AND deleted = 1 ORDER BY fecha DESC";
                    $ejecutar = mysqli_query($enlace, $script_ar);
                    while ($fila = mysqli_fetch_array($ejecutar)) {
                        $script1 = "SELECT `user` from DatosIngreso WHERE id =" . $fila['id_operador'] . "";
                        $resultado2 = mysqli_query($enlace, $script1);
                        $res = mysqli_fetch_array($resultado2);

                        if ($fila['tipo_inactivo'] == 1) {
                            $tipo_in = 'Inactivación normal';
                        } else if ($fila['tipo_inactivo'] == 2) {
                            $tipo_in = 'Inactivación averiado';
                        } else if ($fila['tipo_inactivo'] == 3) {
                            $tipo_in = 'Inactivación por rechazo';
                        } else {
                            $tipo_in = 'Inactivación';
                        }

                        $full = $fila['motivo'];
                        $fila['motivo'] = substr($fila['motivo'], 0, 30);

                        echo "<tr><td>" . $fila['codigo'] . "</td><td>" . $fila['nombre_completo'] . "</td><td data-toggle='tooltip' data-placement='top' title='" . $full . "'>" . $fila['motivo'] . "</td><td>" . $tipo_in . "</td><td>" . $fila['fecha'] . " - " . $fila['hora'] . "</td><td>" . $res['user'] . "</td><td><input type='button' class='btn btn-success' onclick=desarchivar_cli('" . $fila['codigo'] . "') value='Desarchivar'><br/><br/><input type='button' class='btn btn-danger' value='Eliminar' onclick=eliminar('" . $fila['codigo'] . "')></td></tr>";
                    }


                    include "QuitDB.php";
                    ?>
                </tbody>
            </table>
        </div>
        <div id="div_inactivos">
            <table class="table table-bordered" id='table_inactivos' style="background-color:white">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Operador</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody id="llenar_inactivo">
                    <?php
                    include "connect.php";

                    $script = "SELECT codigo, nombre_completo, direccion, id_operador, fecha, hora, motivo, tipo_inactivo FROM DatosClientes LEFT JOIN gestion_inactivos on DatosClientes.codigo = gestion_inactivos.id_cliente WHERE inactivo = 1 AND deleted = 0 ORDER BY fecha DESC";

                    $resultado = mysqli_query($enlace, $script);
                    $total = "";
                    while ($fila = mysqli_fetch_array($resultado)) {
                        $script1 = "SELECT `user` from DatosIngreso WHERE id =" . $fila['id_operador'] . "";
                        $resultado2 = mysqli_query($enlace, $script1);
                        $res = mysqli_fetch_array($resultado2);

                        if ($fila['tipo_inactivo'] == 1) {
                            $tipo_in = 'Inactivación normal';
                        } else if ($fila['tipo_inactivo'] == 2) {
                            $tipo_in = 'Inactivación averiado';
                        } else if ($fila['tipo_inactivo'] == 3) {
                            $tipo_in = 'Inactivación por rechazo';
                        } else {
                            $tipo_in = 'Inactivación';
                        }

                        $full = $fila['motivo'];
                        $fila['motivo'] = substr($fila['motivo'], 0, 30);


                        $total .= "<tr><td>" . $fila['codigo'] . "</td><td>" . $fila['nombre_completo'] . "</td><td data-toggle='tooltip' data-placement='top' title='" . $full . "'>" . $fila['motivo'] . "</td><td>" . $tipo_in . "</td><td>" . $fila['fecha'] . " - " . $fila['hora'] . "</td><td>" . $res['user'] . "</td><td><input type='button' class='btn btn-success' onclick=reactivar_cli('" . $fila['codigo'] . "') value='Reactivar'> <br/><input type='button' style='margin-top:3px' class='btn btn-warning' value='Archivar' onclick=eliminar_cliente('" . $fila['codigo'] . "')> </td></tr>";
                    }
                    echo $total;
                    include "QuitDB.php";


                    ?>


                </tbody>
            </table>
        </div>


    </div>
    <!-- termina inactivos -->

    <!--Menu Generar Reportes-->
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

                //$result = mysqli_query($enlace, "SELECT `user`,`id` FROM `DatosIngreso` WHERE `name` !='Admin' AND `name` !='Programador'");
                foreach ($arr_filas as $fila) {
                    //while ($fila = mysqli_fetch_array($result)) {
                    echo '<option value="' . $fila['id'] . '">' . $fila['user'] . '</option>';
                }
                echo '<option value="-1">Todos</option>';


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
                <input type="text" id="fechaAcepto" name="daterange2" value="01/01/2018 - 01/15/2018" style="cursor: pointer; width: 25%; margin-left: 5%; text-align: center;" />
            </div>
            <div class="alert alert-danger" role="alert" id="alert_date">
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

            <span class="badge badge-pill badge-warning">Exportar a</span>
            <select class="form-control" id="tipo_exportCNG">
                <option value="1">PDF</option>
                <option value="2">EXCEL</option>
            </select>
            <br>
            <button class="btn btn-warning" id="generarReporteCNG">Generar reporte</button>
        </div>


    </div>


    <!-- MODAL Buscar cliente -->
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
    <!-- fin buscar cliente -->


    <!-- MODAL GRUPOS -->
    <div class="modal fade bs-example-modal-lg" id="n_grupo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Agregar grupo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                    <label>Nombre:</label>
                    <input type='text' class='form-control' name='name_group' id='name_group'>
                    <br>
                    <label>Provincia:</label>
                    <select name='provincia' id='provincia_group' class='form-control' onchange="mostrar_canton(this.value)">
                        <option value=''>--SELECCIONE--</option>
                        <?php
                        include('getProvincias.php');
                        ?>

                    </select>
                    <br>
                    <label>Canton:</label>
                    <select name="canton" id="canton_group" class="form-control" onchange="mostrar_parro(this.value)">
                        <option value=''>--SELECCIONE--</option>
                    </select>
                    <br>
                    <label>Parroquia:</label>
                    <select name="canton" id="parroquia_group" class="form-control">
                        <option value=''>--SELECCIONE--</option>
                    </select>
                    <br>
                    <label>Comentario:</label>
                    <input type='text' class='form-control' name='comentario_group' id='comentario_group' placeholder="(OPCIONAL)">
                    <br>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" onclick='guardar_grupo()'>Crear grupo</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL GRUPOS -->


    <!-- MODAL ASIGNAR NUEVOS -->
    <div class="modal fade bs-example-modal-lg" id="n_grupo_asig" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Repartir clientes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                    <strong>Clientes pendientes de asignar: <?php
                                                            include('connect.php');
                                                            $num = mysqli_query($enlace, "SELECT * FROM DatosClientes LEFT JOIN grupo_asignacion on DatosClientes.codigo = grupo_asignacion.id_cliente WHERE actualizar_pendiente = 1 AND grupo_asignacion.id_cliente IS NULL");
                                                            $num_all = mysqli_num_rows($num);
                                                            echo "$num_all <input type='hidden' name='cps' id='cps' value='$num_all'/>";

                                                            mysqli_close($enlace); ?></strong>
                    <br>
                    <br>
                    <label>Cantidad de clientes a repartir:</label> <input type='number' style="width:100px" name='repartir' id='repartir'>
                    <br>
                    <br>
                    <label>Seleccione los grupos entre los que se repartirán:</label>
                    <br>
                    <br>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Operador</th>
                                <th style='text-align:center'><small><strong>Seleccionar todos</strong><input type='checkbox' name='sel_all' onchange='sel_all()' id='sel_all' /></small></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('connect.php');
                            $grupos = mysqli_query($enlace, "SELECT grupos.id idgrupo,  grupos.nombre, grupos.comentario, DatosIngreso.id, DatosIngreso.user  FROM grupos LEFT JOIN grupo_asignacion on grupos.id = grupo_asignacion.id_grupo LEFT JOIN DatosIngreso on grupo_asignacion.id_cliente = DatosIngreso.id WHERE grupo_asignacion.tipo = 2");
                            while ($res = mysqli_fetch_array($grupos)) {
                                echo "<tr>
        <td>" . $res['nombre'] . " - " . $res['comentario'] . "</td>
        <td>" . $res['user'] . "</td>
        <td align=center><input type='checkbox' id='" . $res['idgrupo'] . "' onchange='grupos_rep(" . $res['idgrupo'] . ")'/></td>
        </tr>";
                            }
                            mysqli_close($enlace);
                            ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" onclick='guardar_grupo_asig()'>Guardar cambios</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL ASIGNAR NUEVOS -->


    <!-- MODAL Modificar cliente -->
    <div class="modal fade" id="ModalMC" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Modifica los datos del cliente</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="ID_clienteM">ID cliente</label>

                            <?php
                            $idc = $_GET['editar_cliente'];

                            require('connect.php');

                            $script_id = "SELECT * FROM sol_edicion_id WHERE id_cliente = '$idc' AND `status` != 2 ORDER BY id DESC LIMIT 1";
                            $check_per = mysqli_query($enlace, $script_id);
                            $cant = mysqli_num_rows($check_per);

                            if ($cant != 0) {

                                $newd = mysqli_fetch_array($check_per);
                                if ($newd['status'] == 1) {
                                    echo '<input type="text" class="form-control" id="ID_clienteM">';
                                    echo '<small id="editartag">Ya puede editar el Id</small>';
                                } else {
                                    echo '<input type="text" class="form-control" id="ID_clienteM" disabled="true">';
                                    echo '<small id="editartag">Su solicitud de edición de Id no ha sido autorizada, favor de revisar más tarde</small>';
                                }
                            } else {


                                echo '<input type="text" class="form-control" id="ID_clienteM" disabled="true">';
                                echo '<small id="editartag"><a style="text-decoration:none" href="javascript:hedicion()">Habilitar edición</a></small>';
                            }


                            echo "<input type='hidden' id='idcpre' value='$idc'>"

                            ?>
                        </div>
                        <div class="form-group">
                            <label for="coordenadas_clienteM">Coordenadas</label>
                            <input type="text" class="form-control" id="coordenadas_clienteM" placeholder="Coordenadas geograficas lugar de residencia (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="nombre_clienteM">Nombre cliente</label>
                            <input type="text" class="form-control" id="nombre_clienteM" placeholder="Nombre completo cliente (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="datos_facturaM">Datos de la factura</label>
                            <input type="text" class="form-control" id="datos_facturaM" placeholder="Datos de la factura (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="direccion_clienteM">Direccion</label>
                            <input type="text" class="form-control" id="direccion_clienteM" placeholder="Direccion de residencia del cliente (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label>Provincia</label>
                            <select name='provincia' id='provincia_group' class='form-control' onchange="mostrar_canton(this.value)">
                                <option value=''>--SELECCIONE--</option>
                                <?php
                                include('getProvincias.php');
                                ?>

                            </select>
                            <br />
                            <label>Canton</label>
                            <select name="canton" id="canton_group" class="form-control" onchange="mostrar_parro(this.value)">
                                <option value=''>--SELECCIONE--</option>
                            </select>
                            <br>
                            <label>Parroquia:</label>
                            <select name="canton" id="parroquia_group" class="form-control">
                                <option value=''>--SELECCIONE--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tel_clienteM">Telefono principal</label>
                            <input type="text" class="form-control" id="tel_clienteM" placeholder="Telefono principal cliente  (Obligatorio)">
                            <select class="form-control" id="tipo_persona_tel_clienteM">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                                <input type="text" class="form-control" id="obser_tel_clienteM" placeholder="Observación">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tel_ofM">Telefono oficina</label>
                            <input type="text" class="form-control" id="tel_ofM" placeholder="Telefono de la oficina del cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_tel_ofM">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_tel_ofM" placeholder="Observación">
                        </div>
                        <div class="form-group">
                            <label for="cel1M">Celular 1</label>
                            <input type="text" class="form-control" id="cel1M" placeholder="Celular principal cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_cel1M">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_cel1M" placeholder="Observación">

                        </div>
                        <div class="form-group">
                            <label for="cel2M">Celular 2</label>
                            <input type="text" class="form-control" id="cel2M" placeholder="Celular secundario del cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_cel2M">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_cel2M" placeholder="Observación">

                        </div>
                        <div class="form-group">
                            <label for="correoCM">Correo electronico</label>
                            <input type="text" class="form-control" id="correoCM" placeholder="Correo electronico cliente (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="comentarios_clienteM">Comentarios inciales</label>
                            <input type="text" class="form-control" id="comentarios_clienteM" placeholder="Comentarios iniciales sobre el cliente (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="cisterna">Informacion cisterna</label>
                            <input type="text" class="form-control" id="cisternaM" placeholder="Informacion inicial sobre la cisterna (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="cisterna">Campo Libre </label>
                            <input type="text" class="form-control" id="numerolibreM" placeholder="Campo Libre (Opcional)">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="actualizarC">Actualizar Cliente</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

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
            $('#SubirC a').click(function(e) {
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
                                url: "./Administrador/SubirClientes/subirArchivoClientes.php",
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
                                location.reload();
                            });
                    }

                });
            });

        });
    </script>

</body>

</html>