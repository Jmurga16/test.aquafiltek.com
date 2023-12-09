<?php
session_start();
?>
<!doctype html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/styleU.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../libs/select2-4.0.3/dist/css/select2.css">
</head>

<body>
<!--Nav bar tech plus lhr ---->
<div id="snackbar"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="../img/aquafiltek.png" style="width: 100px; padding: 0;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto  navbar-nav navbar-center">
                <li class="nav-item active" id="PMotivate">
                    <a class="nav-link" href="#" id="Motivate">Motivate <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" id="PRecordatorio">
                    <a class="nav-link" href="#" id="Recordatorio">Recordatorios</a>
                </li>
                <li class="nav-item" id="PGllamada">
                    <a class="nav-link" href="#" id="Gllamada">Gestion de llamadas</a>
                </li>
                <li class="nav-item" id="PPventa">
                    <a class="nav-link" href="#" id="Pventa">Post-Venta</a>
                </li>
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="#" id="GenerarR">Generar reportes</a>
                </li>
                <!--tech plus -->
            <li class="nav-item" style="padding-top: 8px;">
                     <h6 class="text-center" style="display: contents;">Ingresaste a las <span> <?php echo $_SESSION['horaIn']; ?></span></h6>
                </li>
            
            </ul>
             
            <button class="btn btn-outline-danger my-2 my-sm-0" id="cerrar_sesion">Cerrar sesion</button>
        </div>
    </nav>

<!--Nav bar --------->
    <div class="container hide" id="ContainerVM" style="margin-top: 20px;">
    </div>
    <div class="container hide" id="ContainerR" style="margin-top: 20px;">
        <div class="loader"></div>
        <div class="alert alert-danger" role="alert" id="tableDanger" class="hide">
            <h1 class="text-center">LLAMADAS URGENTES</h1>
            <table class="table table-bordered table-hover table-danger" id="registrosD">
                <thead>
                    <tr>
                        <th scope="col">ID Cliente</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Fecha de llamada</th>
                        <th scope="col">Hora de llamada</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <button class="btn btn-danger btn-lg margin hide" id="botonUrgente">Siguiente</button>
        <div class="alert alert-warning hide" role="alert" id="tableWarning">
            <h1 class="text-center">LLAMADAS ESTA SEMANA</h1>
            <table class="table table-bordered table-hover" id="registrosW">
                <thead>
                    <tr>
                        <th scope="col">ID Cliente</th>
                        <th scope="col">Nombre Cliente</th>
                        <th scope="col">Fecha de llamada</th>
                        <th scope="col">Hora de llamada</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <button class="btn btn-warning btn-lg margin hide" id="botonWarning">Regresar</button>
        <span id="identificador_usuario" class="hide"><?php echo $_SESSION['ide']; ?></span>
    </div>
    <div class="container hide" id="ContainerGL" style="margin-top: 20px;">
        <div class="loader"></div>
        <div class="search"></div>
        <div class="history_ge"></div>
        <button class="btn btn-primary btn-md btn-top" id="descansar">Descansar</button>
        <button class="btn btn-primary btn-md btn-top" id="almorzar">Hora Almuerzo</button>
        <?php if ($_SESSION['permisos'] == 1) {
	echo "<button class=\"btn btn-primary btn-md btn-top\" id=\"addCN\">Agregar nuevo cliente</button>";
	echo "<button class=\"btn btn-primary btn-md btn-top\" id=\"modCA\">Modificar cliente actual</button>";
}
?>
        <button class="btn btn-primary btn-md btn-top" id="rh">Resumen Historial</button>
        <button class="btn btn-primary btn-md btn-top" id="bPDF">Buscar PDF</button>
        <button class="btn btn-primary btn-md btn-top" id="bCL">Buscar cliente</button>
        <button class="btn btn-primary btn-md btn-top" id="btn_mantenimiento">Consultar calendario mantenimiento</button>
        <br><br>


       



         <!--tech plus lhr -->
        <div style="display:none!important"><br /><br /></div>


<div class="container search-box" style="margin-bottom:10px" >
  <div class="row">
    <div class="col-sm-1" style="padding-right:0px;">
    <button class="btn btn-success float-right" id="GestionarC"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-sm-11" style="padding-left:0px">
       
            <select class="form-control " id="cliente_gestionar" >
                <option value="">Buscar cliente por nombre</option>

                
            </select>
            <p  class="hide"  id="cliente_seleccionado"></p>
     
    </div>
  </div>  
</div>
        
      
     
        
        <!--to hide preview search-->
        <div style="float:right;display:none!important ; height:100px;overflow-y:scroll" id="results"></div>
        

  <div class="container search-box" style="margin-bottom:10px">
  <div class="row">
    <div class="col-sm-1" style="padding-right:0px;">
    <button class="btn btn-success float-right" id="btn-buscar-c"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-sm-11" style="padding-left:0px">       
    <input type="text" class="form-control" id="input_BCC" placeholder="Buscar cliente por ciudadela">
    </div>
  </div>  
</div>


       
<div class="container search-box" style="margin-bottom:10px">
  <div class="row">
    <div class="col-sm-1" style="padding-right:0px;">
    <button class="btn btn-success float-right" id="btn-buscar-cc"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-sm-11" style="padding-left:0px">       
    <input type="text" class="form-control" id="input_BCCC" placeholder="Buscar cliente por telefono">
    </div>
  </div>  
</div>

<input type="hidden" id="cliente_selc_pargestion">



<!---------------------------------sohaib----------------------------------->
<!--<div class="input-group mb-2 mr-md-2" id="BCCC">
            <div class="input-group-prepend">
                <button class="btn btn-success" id="btn-buscar-cc"><i class="fa fa-search"></i></button>
            </div>
      <input type="text" class="form-control" id="input_BCCC" placeholde="Buscar cliente por telefono">
        </div>-->
<!-------------------------------sohaib----------------------------------->
        <!-- cliente anterior -->
        <div class="accordion accordion-margin" id="clienteAnterior">
            <div class="card card-dark">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
        <button class="btn btn-link text-center text-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Cliente anterior
                  <button style="float: right; margin-left: 20px;" class="btn btn-info btn-sm" id="gestionarAnterior">Gestionar cliente</button>
                <button style="float: right" class="btn btn-primary btn-sm" id="historialAnterior">Ver historial gestion</button>
        </button>
      </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#clienteAnterior">
                    <div class="card-body Cbody">
                        <table class="table table-bordered table-sm table-ligth" id="tabla_clienteAN">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre Cliente</th>
                                    <th scope="col">Datos Factura</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Telefono Casa</th>
                                    <th scope="col">Telefono Trabajo</th>
                                    <th scope="col">Celular 1</th>
                                    <th scope="col">Celular 2</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- cliente actual -->
        <div class="text-center hide" id="Cliente_gestionado">
            <h4 class="text-warning">Este cliente ya se encuentra gestionado</h4>
            <h6 class="text-warning">Si desea iniciar una nueva gestion, esto actualizara los datos.</h6>
            <button class="btn btn-lg btn-primary">Actualizar datos</button>
        </div>
        <table class="table table-bordered table-lg table-dark" id="tabla_clienteA">
            <thead>
                <tr>
                    <th scope="col">Nombre Cliente</th>
                    <th scope="col">Datos Factura</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono Casa</th>
                    <th scope="col">Telefono Trabajo</th>
                    <th scope="col">Celular 1</th>
                    <th scope="col">Celular 2</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Info Cisterna</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="fl contenedorC">
            <h5>Ultimos comentarios</h5>
        </div>
        <div class="fr contenedorC">
            <h5>Comentarios historicos</h5>
        </div>
        <br><br>
        <textarea id="comentariosG"></textarea>
        <textarea id="comentarios" class="coment"></textarea>
        <button class="btn btn-success btn-md btn-left" id="btn_acepto">Aceptó</button>
        <button class="btn btn-success btn-md " id="btn_volver">Volver a llamar</button>
        <button class="btn btn-success btn-md " id="btn_rechazo">Rechazó</button>
        <button class="btn btn-success btn-md " id="btn_Nresponde">No responde</button>
        <button class="btn btn-success btn-md " id="btn_equivocado">Equivocado</button>
        <button class="btn btn-success btn-md " id="btn_averiado">Averiado</button>
        <button class="btn btn-success btn-md " id="btn_otro">Otro</button>
        <div id="estadistica_gestion">

        </div>
        <!-- cliente siguiente 1 -->
        <div class="accordion accordion-margin" id="clienteNXT">
            <div class="card card-dark">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
        <button class="btn btn-link text-center text-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Siguente cliente
                <button style="float: right; margin-left: 20px;" class="btn btn-info btn-sm" id="gestionarNext">Gestionar cliente</button>
                <button style="float: right" class="btn btn-primary btn-sm" id="historialNext">Ver historial gestion</button>
        </button>
      </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#clienteNXT">
                    <div class="card-body Cbody">
                        <table class="table table-bordered table-sm table-ligth" id="tabla_clienteN">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre Cliente</th>
                                    <th scope="col">Datos Factura</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Telefono Casa</th>
                                    <th scope="col">Telefono Trabajo</th>
                                    <th scope="col">Celular 1</th>
                                    <th scope="col">Celular 2</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--         cliente sigueinte 2 -->
        <div class="accordion accordion-margin" id="clienteNXT2">
            <div class="card card-dark">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
        <button class="btn btn-link text-center text-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          Siguente cliente
                <button style="float: right; margin-left: 20px;" class="btn btn-info btn-sm" id="gestionarNext2">Gestionar cliente</button>
                <button style="float: right" class="btn btn-primary btn-sm" id="historialNext2">Ver historial gestion</button>
        </button>
      </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#clienteNXT2">
                    <div class="card-body Cbody">
                        <table class="table table-bordered table-sm table-ligth" id="tabla_clienteN2">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre Cliente</th>
                                    <th scope="col">Datos Factura</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Telefono Casa</th>
                                    <th scope="col">Telefono Trabajo</th>
                                    <th scope="col">Celular 1</th>
                                    <th scope="col">Celular 2</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   MODALES -->
    <!-- Modal gestion llamada -->
    <div class="modal fade" id="gestionModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" id="modal-xlg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="ModalLabel">Gestion de llamadas</h5>
                    <button class="btn btn-sm btn-success" id="resume_h">Resumen Historial </button>
                </div>
                <div class="modal-body">


                    <button class="btn btn-success btn-sm btn-top" id="btn-head">Buscar PDF</button>
                    <table class="table table-bordered table-sm table-dark" id="tabla_clienteU">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Datos Factura</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Info Cisterna</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-sm table-dark" id="tabla_clienteU2">
                        <thead>
                            <tr>
                                <th scope="col">Telefono Casa</th>
                                <th scope="col">Telefono Trabajo</th>
                                <th scope="col">Celular 1</th>
                                <th scope="col">Celular 2</th>
                                <th scope="col">Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="fl contenedorC">
                        <h5>Ultimos comentarios</h5>
                    </div>
                    <div class="fr contenedorC">
                        <h5>Comentarios historicos</h5>
                    </div>
                    <br><br>
                    <textarea id="comentariosUG" resizable="false"></textarea>
                    <textarea id="comentariosU" resizable="false"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-md btn-left" id="btn_aceptoU">Aceptó</button>
                    <button class="btn btn-success btn-md " id="btn_volverU">Volver a llamar</button>
                    <button class="btn btn-success btn-md " id="btn_rechazoU">Rechazó</button>
                    <button class="btn btn-success btn-md " id="btn_NrespondeU">No responde</button>
                    <button class="btn btn-success btn-md " id="btn_equivocadoU">Equivocado</button>
                    <button class="btn btn-success btn-md " id="btn_averiadoU">Averiado</button>
                    <button class="btn btn-success btn-md " id="btn_otroU">Otro</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modales Botones -->
    <!-- Buscar cliente -->
    <div class="modal fade" id="Modal_buscar_cliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                        <select class="form-control" id="cliente_gestionar_antes">
                        <option>Selecciona el cliente</option>
                        </select>
                    </div>
                    <p class="hide" id="cliente_seleccionado_antes"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GestionarCmodal">Gestionar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal conteo gestiones -->
    <div class="modal fade" id="modal-gestiones" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
        <!-- Modal historial gestiones -->
    <div class="modal fade" id="historial-gestiones" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-primary text-center">Historial de gestiones</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Historial Post-venta -->
    <div class="modal fade" id="ModalRH" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Resumen historial post-venta</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea id="resumenH"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="cerrarH">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- acepto -->
    <div class="modal fade" id="ModalA" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Gestión aceptada</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idcl">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idcl" disabled="true">

                  
                    <label for="fechaAcepto">Fecha ejecución del servicio</label>

                    <input id="fechaAcepto"   class="form-control" type="date"  width="276"  onkeydown="return false">

                    <label for="horaAcepto">Hora ejecución del servicio</label>
                    <div id="horaAcepto">
                        <input type="number" id="horaAC" class="hora" min="6" max="18" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('minutoAC'), 2)">
                        <label> : </label>
                        <input type="number" id="minutoAC" class="hora" min="0" max="59" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('comment'), 2)">
                        <label class="text-danger hide" id="alertaHNL">Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <label for="comment">Horas Ocupadas</label>

                    <div id="horas_ocupadas" class="text-danger">
                            
                       
                           

                    </div>
                    <label for="comment">Comentarios adicionales</label>


                    <input type="text" class="form-control" id="comment">
                    <p class="text-danger text-center hide" id="mensaje_error_acepto"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarA">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- rechazo -->
    <div class="modal fade" id="ModalRE" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Gestión rechazada</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <label for="idclR">Nombre del cliente</label>
                        <input type="text" class="form-control" id="idclR" disabled="true">
                        <label for="horaRechazo">Hora rechazo</label>
                        <input type="text" class="form-control" id="horaRechazo" disabled="true">
                        <label for="fechaRechazo">Fecha rechazo</label>
                        <input id="fechaRechazo" class="fechapicker" width="276" disabled="true" />
                        <label for="comment">Comentarios adicionales</label>
                        <input type="text" class="form-control" id="commentRE">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarR">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Reprogramar -->
    <div class="modal fade" id="ModalR" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Reprogramar llamada</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="tipoModal" class="hide"></span>
                    <label for="idCliente">Nombre Cliente</label>
                    <input type="text" class="form-control" id="idCliente" disabled="true">
                    <label for="fechaLlamada">Fecha llamada</label>
                    <input id="fechaLlamada" min="<?php echo date ('Y-m-d')?>"  class="form-control" type="date"  width="276"  onkeydown="return false">
                    <label for="horaLlamada">Hora llamada</label>
                    <div id="horaLlamada">

                    <input type="hidden" id="hora" name="hora" value="" >
                    <input type="hidden" id="minuto"  name="minuto" value="">
                    <input type="hidden" id="selec_resp"  name="selec_resp" value="">

                        <input type="number" id="hora_mos" class="hora" min="0" max="23" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('minuto'), 2)" disabled>
                        <label> : </label>
                        <input type="number" id="minuto_mos" class="hora" min="0" max="59" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('commentR'), 2)" disabled>
                        
                        
                        <label class="text-danger hide" id="alertaHNL">Hey, estas agendando fuera de horario laborable</label>
                    </div>
                    <label for="commentR">Comentarios adicionales</label>
                    <input type="text" class="form-control" name="commentR" id="commentR">
                    <p class="text-danger hide" id="error_hora"></p>

                    <table style="font-size:13px" class="table-bordered table-striped" id="tabla_hora">
                            

                          
                           

                    </table>


                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="ReprogramarLL">Reprogramar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Descansar -->
    <div class="modal fade" id="ModalD" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Tomate un tiempo para relajarte</h3>
                </div>
                <div class="modal-body">
                    <br><br>
                    <h2 class="text-center text-success">Tiempo que has descansado</h2>
                    <br>
                    <h2 id="tiempoI" class="text-center text-success">00:00:00</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="volverT">Volver al trabajo</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Almorzar -->
    <div class="modal fade" id="ModalAL" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Almuerza tranquilo</h3>
                </div>
                <div class="modal-body">
                    <img src="https://www.entrenamiento.com/wp-content/uploads/2016/11/hora-almuerzo-exito.png" id="imga">
                    <br><br>
                    <h2 class="text-center text-success">Tiempo que llevas almorzando</h2>
                    <br>
                    <h2 id="tiempoALM" class="text-center text-success">00:00:00</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="volverTA">Volver al trabajo</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Agregar nuevo cliente -->
    <div class="modal fade" id="ModalNC" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Agrega un nuevo cliente</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="ID_clienteW">ID cliente</label>
                            <input type="text" class="form-control" id="ID_clienteW" placeholder="Identificador cliente (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="coordenadas_cliente">Coordenadas</label>
                            <input type="text" class="form-control" id="coordenadas_cliente" placeholder="Coordenadas geograficas lugar de residencia (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="nombre_cliente">Nombre cliente</label>
                            <input type="text" class="form-control" id="nombre_cliente" placeholder="Nombre completo cliente (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="datos_factura">Datos de la factura</label>
                            <input type="text" class="form-control" id="datos_factura" placeholder="Datos de la factura (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="direccion_cliente">Direccion</label>
                            <input type="text" class="form-control" id="direccion_cliente" placeholder="Direccion de residencia del cliente (Obligatorio)">
                        </div>
                        <div class="form-group">
                            <label for="tel_cliente">Telefono principal</label>
                            <input type="text" class="form-control" id="tel_cliente" placeholder="Telefono principal cliente  (Obligatorio)">
                            <select class="form-control" id="tipo_persona_tel_cliente">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>                                
                                <input type="text" class="form-control" id="obser_tel_cliente" placeholder="Observación">
                            </select>
                             
                        </div>
                        <div class="form-group">
                            <label for="tel_of">Telefono oficina</label>
                            <input type="text" class="form-control" id="tel_of" placeholder="Telefono de la oficina del cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_tel_of">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_tel_of" placeholder="Observación">

                        </div>
                        <div class="form-group">
                            <label for="cel1">Celular 1</label>
                            <input type="text" class="form-control" id="cel1" placeholder="Celular principal cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_cel1">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_cel1" placeholder="Observación">

                        </div>
                        <div class="form-group">
                            <label for="cel2">Celular 2</label>
                            <input type="text" class="form-control" id="cel2" placeholder="Celular secundario del cliente (Opcional)">
                            <select class="form-control" id="tipo_persona_cel2">
                                <option value="">Seleccionar opción</option>
                                <option value="1">Señor</option>
                                <option value="2">Señora</option>
                                <option value="3">Hijo/a</option>
                                <option value="4">Asistente oficina</option>
                                <option value="5">Empleada domestica</option>
                            </select>
                            <input type="text" class="form-control" id="obser_cel2" placeholder="Observación">

                        </div>
                        <div class="form-group">
                            <label for="correoC">Correo electronico</label>
                            <input type="text" class="form-control" id="correoC" placeholder="Correo electronico cliente (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="comentarios_cliente">Comentarios inciales</label>
                            <input type="text" class="form-control" id="comentarios_cliente" placeholder="Comentarios iniciales sobre el cliente (Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="cisterna">Informacion cisterna</label>
                            <input type="text" class="form-control" id="cisterna" placeholder="Informacion inicial sobre la cisterna (Opcional)">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="agregarCN">Agregar Cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modificar cliente -->
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
                            <input type="text" class="form-control" id="ID_clienteM" disabled="true">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="actualizarC">Actualizar Cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- postventa -->
    <div class="container hide" id="ContainerPV" style="margin-top: 20px;">
        <div class="loader"></div>
        <div class="form-group">
            <label for="sel1">Selecciona cliente</label>
            <select class="form-control select2" id="sel1">
                <option>Seleccionar Cliente</option>
            </select>
        </div>
            <div id="postv">
                <div class='operator_name'></div>
                <div id="ckehboxesTrabajo">
                    <h5>Trabajo realizado</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="" id="TrabajoRS">
                        <label class="form-check-label" for="TrabajoRS">
                            SI
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="" id="TrabajoRN">
                        <label class="form-check-label" for="TrabajoRN">
                            NO
                        </label>
                    </div>
                </div>
                <div class="form-group hide" id="MotivoNT">
                    <label for="motivoT">Motivos</label>
                    <input type="text" class="form-control" id="motivoT" placeholder="Motivo por el que el trabajo no se realizo">
                </div>
                <br>
                <div id="ckehboxesPago">
                    <h5>Pago realizado</h5>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="" id="TrabajoPS">
                        <label class="form-check-label" for="TrabajoRS">
                            SI
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="" id="TrabajoPN">
                        <label class="form-check-label" for="TrabajoRN">
                            NO
                        </label>
                    </div>
                </div>
                <div class="form-group hide" id="MotivoNP">
                    <label for="motivoP">Motivos</label>
                    <input type="text" class="form-control" id="motivoP" placeholder="Motivo por el que el pago no fue realizado">
                </div>
                <br>
                <div id="fechaPV">
                    <h5>Fecha de venta</h5>
                    <input id="fechaVentaPV" class="datepicker" width="276" disabled="true" />
                </div>
                <br><br>
                <div id="Add_pdf">
                    <label for="pdfAdicional">Subir informe PDF</label>
                    <br>
                    <button id="pdfAdicional" class="btn btn-success btn-md">Subir PDF</button>
                </div>
                <br>
                <div class="form-group hide" id="containerRS">
                    <label for="motivoT">Comentarios Renovacion Servicio</label>
                    <input type="text" class="form-control" id="comentRS" placeholder="Comentario adicional sobre renovacion de servicio">
                </div>
                <h4>Reprogramar llamada</h4>
                <div id="reprogramarPV">
                    <br>
                    <label class="radio-inline"><input type="radio" name="meses" value="1"  onclick="cambiar_fecha(this)"> 1</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="2"  onclick="cambiar_fecha(this)"> 2</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="3"  onclick="cambiar_fecha(this)"> 3</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="4"  onclick="cambiar_fecha(this)"> 4</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="5"  onclick="cambiar_fecha(this)"> 5</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="6"  onclick="cambiar_fecha(this)"> 6</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="7"  onclick="cambiar_fecha(this)"> 7</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="8"  onclick="cambiar_fecha(this)"> 8</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="9"  onclick="cambiar_fecha(this)"> 9</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="10" onclick="cambiar_fecha(this)"> 10</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="11" onclick="cambiar_fecha(this)"> 11</label>
                    <label class="radio-inline"><input type="radio" name="meses" value="12" onclick="cambiar_fecha(this)"> 12</label>

                    <br>
                    <label for="fechaLlamadaPV">Fecha llamada</label>


                    <input id="fechaLlamadaPV" min="<?php echo date ('Y-m-d')?>"  class="form-control" type="date"  width="150"  onkeydown="return false">



                    <label for="horaLlamadaPV">Hora llamada</label>
                    <div id="horaLlamadaPV">

<input type="hidden" id="horaPV_vv">
<input type="hidden" id="minutoPV_vv">


                        <input type="text" id="horaPV" class="hora" min="0" max="23" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('minutoPV'), 2)" disabled>
                        <label> : </label>
                        <input type="text" id="minutoPV" class="hora" min="0" max="59" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('commentR'), 2)" disabled>
                        <label class="text-danger hide" id="alertaHNL">Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <table style="font-size:13px; background-color:#ffffff; color:#000000" class="table-bordered table-striped" id="tabla_hora2">
                            

                          
                           

                    </table>
                </div>
                <br><br>
                <p id="ErrorPV" class="text-danger hide text-center"></p>
                <button class="btn btn-lg btn-success" id="botonPV">Guardar</button>
            </div>
        </div>

    <!-- generar reportes -->
    <div class="container text-center" id="containerGR" style="display: none">
        <!-- <div class="report">
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
        </div> -->

        <div class="report">
            <h1 class="text-warning">Reporte ejecucion del servicio - mantenimiento de cisterna</h1>
            <span class="badge badge-pill badge-warning">Seleccionar fechas</span>
            <div class="form-group">
                <!-- <input id="fechaAcepto" class="datepicker" width="276"/> -->
                <input type="text" id="fechaAceptoR" name="daterange2" value="01/01/2018 - 01/15/2018" 
                style="cursor: pointer; width: 25%; margin-left: 5%; text-align: center;"/>
            </div>
            <div class="alert alert-danger" role="alert" id="alert_date" >
                <h5><b><i class="fas fa-exclamation-circle"></i> Selecciona una fecha!!</b></h5>
            </div>

            <!--
            <span class="badge badge-pill badge-warning">Exportar a</span>
            <select class="form-control" id="tipo_archivo">
                <option value="1">PDF</option>
                <option value="2">EXCEL</option>
            </select>-->
            <div class="form-group">
            <button class="btn btn-warning" style="margin-left:0px; padding-left:0px;" id="generarReporte">Generar reporte</button>
            </div>
        </div>

        <!-- <div class="report" style="margin-bottom: 50px">
            <h1 class="text-warning">Reporte clientes no gestionados</h1>
            <span class="badge badge-pill badge-warning">Exportar a</span>
            <select class="form-control" id="tipo_exportCNG">
                <option value="1">PDF</option>
                <option value="2">EXCEL</option>
            </select>
			<br>
            <button class="btn btn-warning" id="generarReporteCNG">Generar reporte</button>
        </div> -->
    </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS 
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>-->
        
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script type="text/javascript" src="../js/auxiliares.js"></script>
        <script type="text/javascript" src="../js/usuario.js"></script>
        <script type="text/javascript" src="../libs/select2-4.0.3/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>  

        <script>
            <?php
                if(!empty($_GET["c"])){
                    echo "cargaGLlamada('".$_GET["c"]."', ".$_SESSION["ide"].")";
                } else {
                    echo "document.getElementById('Motivate').click();";
                }
            ?>
        </script>
<script type="text/javascript">
  $(document).ready(function(){
      $('.select2').select2();


    





$('#cliente_gestionar').select2({
            language: 'es',
            ajax: {
                url: 'clientes.php',
                dataType: 'json',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                delay: 250,
                type: 'POST',
                data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function (data) {
                    var arr = []
                    $.each(data, function (index, value) {
                        ///console.log(index);
                        arr.push({
                            id: value.id,
                            text: value.text
                        })
                    })
                    return {
                        results: arr
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 4
        });
















    $("#input_BCC").keyup(function(){
      var query = $(this).val();
      if (query != "") {
        $.ajax({
                url: '../php/query.php',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#results').html(data);
                  $('#results').css('display', 'block');
                    $("#input_BCC").focusout(function(){
                        $('#results').css('display', 'none');
                    });
                    $("#input_BCC").focusin(function(){
                        $('#results').css('display', 'block');
                    });
                }
        });
      } else {
             $('#results').css('display', 'none');
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#input_BC").keyup(function(){
      var query = $(this).val();
      if (query != "") {
        $.ajax({
                url: '../php/query1.php',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#results').html(data);
                  $('#results').css('display', 'block');
                    $("#input_BC").focusout(function(){
                        $('#results').css('display', 'none');
                    });
                    $("#input_BC").focusin(function(){
                        $('#results').css('display', 'block');
                    });
                }
        });
      } else {
             $('#results').css('display', 'none');
      }
    });
  });
</script>
</body>

</html>
