    <?php
//comentado 01022021 session_start();
require "check_session.php";
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
    <link rel="stylesheet" type="text/css" href="../css/style.css?v=<?php echo time()?>">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/styleU.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../libs/select2-4.0.3/dist/css/select2.css">
    <style>
        .select2-dropdown ,.select2-dropdown--below{
            width:500px!important;
            left:-200px!important;
        }
        
        .select2-results{
            width:500px!important;
        }
        
        /*estilos modal*/
        .modal-header .btnGrp{
          position: absolute;
          top: 8px;
          right: 10px;
        } 
        .cursormover{
            cursor:move;
        }
        .min{
            border:1.2px;
            border-top-left-radius:10px;
            width: 16%; 
            height: 35px;
            overflow: hidden !important;
            padding: 0px !important;
            margin: 0px;    
             z-index: 9;
            float: left;  
            position: absolute !important; 
            top:2px!important;
        }
        
        .min .modal-dialog, .min .modal-content{
            height: 100%;
            width: 100%;
            margin: 0px !important;
            padding: 0px !important; 
        }
    
        .min .modal-header{
            height: 100%;
            width: 100%;
            margin: 0px !important;
            padding: 3px 5px !important; 
        }
        
        .min .modal-header{
            height: 100%;
            width: 100%;
            margin: 0px !important;
            padding: 3px 5px !important; 
        }
        .min .modal-lg{
            width:100%!important;
        }
        .display-none{display: none;}
        
        .minmaxCon {
            height: 35px;
            bottom: 1px;
            left: 1px;
            position: fixed;
            right: 1px;
            z-index: 999;
            background-color:white;
        }
        
        .col_anterior{
            background-color:#ecf749;
            cursor:pointer;
        }
        .col_principal{
            background-color:#9fecb3;
            cursor:pointer;
        }
        .col_siguiente{
            background-color:#ffc67e;
            cursor:pointer;
        }
        #tira_informativa{
            position:fixed;
            height:35px;
            width:100%;
            background-color:yellow;
            bottom:0px;
            left:0px;
            font-weight: bold;
    font-size: 14pt;
        }
        marquee label {
            margin-top: 4px;
        }
        .fila_filtro{
            cursor:pointer;
        }
        
        #estadistica_gestion{
            bottom: 15px;
            position: fixed;
        }
        
        body{
            padding-bottom:450px;
        }
        .sobretira{
            bottom:31px!important;
        }
         .sp_espacio{
             margin-left:30px;
            width:30px;
        }
        
         .normalLeft{
            left:0px!important;
        }
        .selectFactura{
            left:-300px!important;
        }
        .texto_wrap{width: 135px!important;
            white-space: nowrap;
            overflow: hidden;
            margin-bottom:0px;
        }
        .lb_importante{
            color:yellow;
            font-size:14pt;
        }
        #modal-gestiones .modal-dialog{
            min-width:70%!important;
        }
        .txt_wrap_gestion{
            width: 340px!important;
            white-space: nowrap;
            overflow: hidden;
            margin-bottom:0px!important;
            line-height:16px;
        }
        #navbarSupportedContent ul{
            width:80%;
        }
        #tabla_previa td{
            padding:0px;
        }
        .col_blanco{
            min-width:50px;
        }
        .marquee {
            width: 100%;
            /*line-height: 50px;
            background-color: red;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;*/
        }
        .marquee label {
            display: inline-block;
            /*padding-left: 100%;*/
            animation: marquee 15s linear infinite;
        }
        @keyframes marquee {
            0%   { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }
        
        .normal_width{
            min-width:1110px!important;
        }
        .normal_width .select2-results{
            width:100%!important;
        }
        .normal_width + .select2-dropdown{
            width:1110px!important;
        }
        @media (max-width:760px){
            .normal_width{
                width:700px!important;
            
                min-width:700px!important;
            }
            .normal_width + .select2-dropdown{
                width:700px!important;
            }
        }
        @media (max-width:480px){
            .normal_width{
                width:330px!important;
            
                min-width:330px!important;
            }
            .normal_width + .select2-dropdown{
                width:330px!important;
            
                width:333px!important;
            }
            
            #div_contenttable {overflow-x:auto
            }
        }
        
        
    </style>
</head>

<body>
<!--Nav bar tech plus lhr ---->
<div id="snackbar" style="margin-left:250px!important"></div>
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
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="#" id="BTbusqueda">Búsqueda por filtros</a>
                </li>
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="Modulo_Usuario.php" target="_blank" >Gestión por Usuario</a>
                </li>
                <li class="nav-item" id="PgenerarR">
                    <a class="nav-link" href="Modulo_mapa.php" target="_blank" >Gestión por mapa</a>
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
            <select class="form-control " id="sel_llamadas_urgentes">
                <option value="">Buscar cliente</option>
            </select>
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
            <select class="form-control " id="sel_llamadas_semanales">
                <option value="">Buscar cliente</option>
            </select>
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
        <button class="btn btn-primary btn-md btn-top" id="descansar" data-placement="top" data-toggle="tooltip" title="Descansar"><i class="fa fa-bed"></i></button>
        <button class="btn btn-primary btn-md btn-top" id="almorzar" data-placement="top" data-toggle="tooltip" title="Hora Almuerzo"><i class="fa fa-apple-alt"></i></button>
        <?php if ($_SESSION['permisos'] == 1) {
	echo "<button class=\"btn btn-primary btn-md btn-top\" id=\"addCN\" data-placement=\"top\" data-toggle=\"tooltip\" title=\"Agregar nuevo cliente\"><i class=\"fa fa-user-plus\"></i></button>";
    echo "<button class=\"btn btn-primary btn-md btn-top\" id=\"modCA\" data-placement=\"top\" data-toggle=\"tooltip\" title=\"Modificar cliente actual\"> <i class=\"fa fa-user-edit\"></i> </button>";
}
?>
        <button class="btn btn-primary btn-md btn-top" id="rh" data-placement="top" data-toggle="tooltip" title="Resumen Historial"><i class="fa fa-list-alt"></i></button>
        <button class="btn btn-primary btn-md btn-top" id="bPDF" data-placement="top" data-toggle="tooltip" title="Buscar PDF"><i class="fa fa-file-pdf"></i></button>
        <button class="btn btn-primary btn-md btn-top" id="bCL" data-placement="top" data-toggle="tooltip" title="Buscar cliente"><i class="fa fa-search"></i></button>
        <button class="btn btn-primary btn-md btn-top" id="btn_mantenimiento" data-placement="top" data-toggle="tooltip" title="Consultar calendario mantenimiento"><i class="fa fa-calendar-alt"></i></button>
        <br><br>


       



         <!--tech plus lhr -->
        <div style="display:none!important"><br /><br /></div>


<div class="container search-box" style="margin-bottom:10px" >
  <div class="row">
    <div class="" style="padding-right:0px; margin-left:15px">
    <button class="btn btn-success float-right" id="GestionarC" data-toggle="tooltip" data-placement="top" title="Buscar cliente por nombre"><i class="fa fa-user"></i></button>
    </div>
    <div  style="padding-left:0px">
       
            <select class="form-control " id="cliente_gestionar" >
                <option value="">Buscar por nombre</option>

                
            </select>
            <p  class="hide"  id="cliente_seleccionado"></p>
     
    </div>
     <div class="" style="padding-right:0px; margin-left:15px">
    <button class="btn btn-success float-right" id="btn-buscar-c" data-toggle="tooltip" data-placement="top" title="Buscar cliente por ciudadela"><i class="fa fa-building"></i></button>
    </div>
    <div  style="padding-left:0px">       
    <select class="form-control " id="input_BCC" >
                <option value="">Buscar por ciudadela</option>

                
    </select>
    </div>
     <div class="" style="padding-right:0px; margin-left:15px">
    <button class="btn btn-success float-right" id="btn-buscar-cc" data-toggle="tooltip" data-placement="top" title="Buscar cliente por teléfono"><i class="fa fa-phone"></i></button>
    </div>
    <div  style="padding-left:0px">       
    <select class="form-control " id="input_BCCC" >
                <option value="">Buscar por teléfono</option>

                
    </select>
    </div>
    <!-- buscar por factura-->
     <div class="" style="padding-right:0px; margin-left:15px">
    <button class="btn btn-success float-right" id="btn-buscar-factura" data-toggle="tooltip" data-placement="top" title="Buscar cliente por factura"><i class="fa fa-file-invoice"></i></button>
    </div>
    <div style="padding-left:0px">       
    <select class="form-control " id="input_buscar_factura" >
                <option value="">Buscar por factura</option>

                
    </select>
    </div>
    <!--fin buscar por factura-->
       <!-- buscar por Id-->
       <div class="" style="padding-right:0px;  margin-left:15px">
    <button class="btn btn-success float-right" id="btn-buscar-id" data-toggle="tooltip" data-placement="top" title="Buscar cliente por Id"><i class="fa fa-file-invoice"></i></button>
    </div>
    <div style="padding-left:0px">       
    <select class="form-control " id="input_buscar_id" >
                <option value="">Buscar por Id</option>

                
    </select>
    </div>
    <!--fin buscar por Id-->
  </div>  
</div>
        
      <div id="div_nueva_vista">
          <table  class="table table bordered">
              <tbody id="tabla_previa">
                  
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="7">
                        <button class="btn btn-success btn-md " id="btn_acepto">Aceptó</button>
                        <button class="btn btn-success btn-md " id="btn_inspeccion">Inspección</button>
                        <button class="btn btn-success btn-md " id="btn_cobros">Cobros</button>
                        <button class="btn btn-success btn-md " id="btn_importante">Importante</button>
        
                        <button class="btn btn-success btn-md " id="btn_volver">Volver a llamar</button>
                        <button class="btn btn-success btn-md " id="btn_rechazo">Rechazó</button>
                        <button class="btn btn-success btn-md " id="btn_Nresponde">No responde</button>
                        <button class="btn btn-success btn-md " id="btn_equivocado">Equivocado</button>
                        <button class="btn btn-success btn-md " id="btn_averiado">Averiado</button>
                        <button class="btn btn-success btn-sm " id="btn_otro">Otro</button>
                        <button class="btn btn-danger btn-sm" id="btn_compet">Competencia</button></td>
                  </tr>
            
              </tfoot>
          </table>
      </div>
     
        
        <!--to hide preview search-->
        <div style="float:right;display:none!important ; height:100px;overflow-y:scroll" id="results"></div>
        



       

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
        <!--<button class="btn btn-link text-center text-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Cliente anterior
               27072021  <button style="float: right; margin-left: 20px;" class="btn btn-info btn-sm" id="gestionarAnterior">Gestionar cliente</button>-->
                <button style="float: right" class="btn btn-primary btn-sm" id="historialAnterior">Ver historial gestion</button>
        <!--27072021</button>-->
      </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#clienteAnterior">
                    <!--27072021 <div class="card-body Cbody">
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
                    </div>-->
                </div>
            </div>
        </div>
        <!-- cliente actual -->
        <div class="text-center hide" id="Cliente_gestionado">
            <h4 class="text-warning">Este cliente ya se encuentra gestionado</h4>
            <h6 class="text-warning">Si desea iniciar una nueva gestion, esto actualizara los datos.</h6>
            <button class="btn btn-lg btn-primary">Actualizar datos</button>
        </div>
        <div id="div_contenttable" style="width:100%;">
        
        <table class="table table-bordered table-lg table-dark" id="tabla_clienteA">
            <thead>
                <tr>
                    <th scope="col">Fechas de Ventas Anteriores</th>
                    <th scope="col">Nombre Cliente</th>
                    <th scope="col">Datos Factura</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono Casa</th>
                    <th scope="col">Telefono Trabajo</th>
                    <th scope="col">Celular 1</th>
                    <th scope="col">Celular 2</th>
                    <th scope="col">Campo Libre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Info Cisterna</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div >
           <?php
            require('connect.php');

            $get_permiso = mysqli_query($enlace,"SELECT permiso_inactivar FROM `DatosIngreso` WHERE id = '$id_sesion'");
            $gp = mysqli_fetch_array($get_permiso);
            if($gp['permiso_inactivar'] == 1)
            {
                echo '<span id="inactivar_boton"><input type="button" class="btn btn-warning" value="Inactivar" style="width:250px" onclick="show_inactive()"></span>'; 
           
            }
            else
            {

            }
            
           ?>
    </div>
    <br/>
    <br/>







        </div>

        <!--
            UNIFICAR COMENTARIOS MG
        <div class="fl contenedorC">
            <h5>Ultimos comentarios</h5>
        </div>
        <div class="fr contenedorC">
            <h5>Comentarios historicos</h5>
        </div>
        <br><br>
        <textarea id="comentariosG"></textarea>
        <textarea id="comentarios" class="coment"></textarea>
        -->
        <div class="row">
        <div class="contenedorC" style="margin: 0px auto">
            <h5>Comentarios historicos</h5>
        </div>
        </div>
        <br/>
        <div class="row">
        <div id="comentarios" class="col-md-10" style="margin: 0px auto; background-color: white; padding:  10px 10px 10px 10px"></div>
        </div>



        <div style="width:100%;height:100px">
            
        </div>
         <br><br>
          <br><br>
           <br><br>
        <!--<button class="btn btn-success btn-md btn-left" id="btn_acepto">Aceptó</button>
        <button class="btn btn-success btn-md " id="btn_volver">Volver a llamar</button>
        <button class="btn btn-success btn-md " id="btn_rechazo">Rechazó</button>
        <button class="btn btn-success btn-md " id="btn_Nresponde">No responde</button>
        <button class="btn btn-success btn-md " id="btn_equivocado">Equivocado</button>
        <button class="btn btn-success btn-md " id="btn_averiado">Averiado</button>
        <button class="btn btn-success btn-md " id="btn_otro">Otro</button>
        -->
        <div id="estadistica_gestion">

        </div>
        <!-- cliente siguiente 1 -->
        <!--27072021 <div class="accordion accordion-margin" id="clienteNXT">
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
        </div>-->
        <!--         cliente sigueinte 2 -->
        <!--27072021 <div class="accordion accordion-margin" id="clienteNXT2">
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
        </div>-->
    </div>
    <!--   MODALES -->
    <!-- Modal gestion llamada -->
    <div class="modal fade" id="gestionModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" id="modal-xlg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="ModalLabel">Gestion de llamadas</h5>
                    <button class="btn btn-sm btn-success" id="resume_h">Resumen Historial </button>
                    <button class="close modalMinimize"> <i class='fa fa-minus'></i> </button>
 
                    <button class="btn btn-sm btn-danger" class="close" data-dismiss="modal" aria-label="Cerrar">Cerrar </button>
                    
                    
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
                    <!--27072021 <button class="btn btn-success btn-md btn-left" id="btn_aceptoU">Aceptó</button>
                    <button class="btn btn-success btn-md " id="btn_volverU">Volver a llamar</button>
                    <button class="btn btn-success btn-md " id="btn_rechazoU">Rechazó</button>
                    <button class="btn btn-success btn-md " id="btn_NrespondeU">No responde</button>
                    <button class="btn btn-success btn-md " id="btn_equivocadoU">Equivocado</button>
                    <button class="btn btn-success btn-md " id="btn_averiadoU">Averiado</button>
                    <button class="btn btn-success btn-md " id="btn_otroU">Otro</button>-->
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
                        <input type="number" id="horaAC" class="hora" min="6" max="18" maxlength="2" onkeyup="validaFormatoHora(this.value,true,'');"  onblur="validaHoraMinuto('','minutoAC')">
                        <label> : </label>
                        <input type="number" id="minutoAC" class="hora" min="0" max="59" maxlength="2" onkeyup="validaFormatoHora(this.value,false,'');"  onblur="validaHoraMinuto('','comment')">
                        <label class="text-danger hide alertaHNL" id="alertaHNL" >Hey, estas agendando fuera de horario laborable</label>
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
    <!-- competencia -->
   
    <div class="modal fade" id="ModalAC" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Competencia</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idclc">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idclc" disabled="true">

                  
                    <label>Fecha ejecución del servicio por la competencia</label>

                    <input id="fechaAceptoCom"   class="form-control" type="date"  width="276"  onkeydown="return false">
                    <br/>
                    <label>Hora ejecución del servicio por la competencia</label>
                    <div id="horaAceptoCom">
                        <input type="number" id="horaACOM" class="hora" min="6" max="18" maxlength="2" onkeyup="validaFormatoHora(this.value,true,'');" onblur="validaHoraMinuto('','minutoACOM')">
                        <label> : </label>
                        <input type="number" id="minutoACOM" class="hora" min="0" max="59" maxlength="2" onkeyup="validaFormatoHora(this.value,false,'');" onblur="validaHoraMinuto('','commentCOM')">
                        <label class="text-danger hide alertaHNL" id="alertaHNLC" >Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <!--

                    <div id="horas_ocupadas" class="text-danger">
                            
                       
                           

                    </div>

-->
                    <br/>
                    <label for="comment">Comentarios adicionales</label>


                    <input type="text" class="form-control" id="commentCOM">
                    <p class="text-danger text-center hide" id="mensaje_error_acepto"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarACOM">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--termina competencia -->
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
                    <h3 class="text-center text-primary" id="lb_reprogramar">Reprogramar llamada</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="tipoModal" class="hide"></span>
                    <label for="idCliente">Nombre Cliente</label>
                    <input type="text" class="form-control" id="idCliente" disabled="true">
                    <label for="fechaLlamada">Fecha llamada</label>
                    <input id="fechaLlamada" min="<?php echo date ('Y-m-d')?>"  class="form-control" type="date"  width="276"  >
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
                        <div class="form-group">
                            <label for="cisterna">Campo Libre </label>
                            <input type="text" class="form-control" id="numerolibre" placeholder="Campo Libre (Opcional)">
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
                    <h5>Fecha de Ejecución de servicio</h5>
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
                        <label class="text-danger hide" id="alertaHNL" >Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <table style="font-size:13px; background-color:#ffffff; color:#000000" class="table-bordered table-striped" id="tabla_hora2">
                            

                          
                           

                    </table>
                </div>
                <br><br>
                <p id="ErrorPV" class="text-danger hide text-center"></p>
                <button class="btn btn-lg btn-success" id="botonPV">Guardar</button>
            </div>
        </div>
    <div class="modal fade" id="ModalInspeccion" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Inspección </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idclInspeccion">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idclInspeccion" disabled="true">

                  
                    <label for="fechaAceptoInspeccion">Fecha ejecución del servicio</label>

                    <input id="fechaAceptoInspeccion"   class="form-control" type="date"  width="276" >

                    <label for="horaAceptoInspeccion">Hora ejecución del servicio</label>
                    <div id="horaAceptoInspeccion">
                        <input type="number" id="horaACInspeccion" class="hora" min="6" max="18" maxlength="2" onkeyup="validaFormatoHora(this.value,true,'Inspeccion');" onblur="validaHoraMinuto('Inspeccion','minutoAC')">
                        <label> : </label>
                        <input type="number" id="minutoACInspeccion" class="hora" min="0" max="59" maxlength="2" onkeyup="validaFormatoHora(this.value,false,'Inspeccion');" onblur="validaHoraMinuto('Inspeccion','comment')">
                        <label class="text-danger hide alertaHNL" id="alertaHNL" >Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <label for="comment">Horas Ocupadas</label>

                    <div id="horas_ocupadasInspeccion" class="text-danger">
                    </div>
                    <label for="commentInspeccion">Comentarios adicionales</label>
                    <input type="text" class="form-control" id="commentInspeccion">
                    <p class="text-danger text-center hide" id="mensaje_error_aceptoInspeccion"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarInspeccion">Guardar</button>
                </div>
            </div>
        </div>
    </div>
        
 <!-- modal inactivar-->
 <div id="modal_inactivar_div">
    <div class="modal fade minimizable" id="modal_inactivar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" id="gestion_mod" role="document">
            <div class="modal-content">
                <div class="modal-header cursormover ">
                    <h5 class="modal-title text-center">Inactivación de cliente</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
 
                    
                    
                    
                </div>
                
                <div class="modal-body">
                

                    
                    <h5><strong><span id='add_client'></span></strong></h5>
                    <br>
                    <input type="hidden" id="cliente_inactivar">
                    <strong>Motivo de la inactivación del cliente:</strong>
                    <br>
                    <textarea style="width:80%" id="motivo_inactivar"></textarea>
                
                </div>
                <div class="modal-footer" style="display:block" align=right>
                    <Input type="button" class="btn btn-success" style="width:150px" onclick="enviar_inactivo()" value="Guardar">                   
        
                </div>

            </div>
        </div>
    </div>
    </div>
    <!--fin modal inactivar-->

        <!-- Averiado -->
        <div class="modal fade" id="ModalAv" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary" id="lb_reprogramar">Averiado</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="tipoModal" class="hide"></span>
                    <label for="idClienteAv">Nombre Cliente</label>
                    <input type="text" class="form-control" id="idClienteAv" disabled="true">
                    <br/>
                    <br/>
                    <label for="commentR">Comentarios adicionales</label>
                    <input type="text" class="form-control" name="commentAv" id="commentAv">
                    <p class="text-danger hide" id="error_hora"></p>

                       

                          
                           

                    </table>


                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="AveriadoG">Inactivar por averiado</button>
                </div>
            </div>
        </div>
    </div>


        <!--modal recordatorios-->
        <div class="modal fade bs-example-modal-lg" id="ModalReco" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-target=".bs-example-modal-lg" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Llamadas para realizar ahora</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
            <h2>Las siguientes llamadas deben de realizarse en breve:</h2>

            <table class="table table-bordered">
            <thead>
            <tr>
            <th>
            Nombre
            </th>   
            <th>
            fecha
            </th>   
            <th>
            Hora
            </th>    
            </tr>
            </thead>
            <tbody id="personas">
        </tbody>

        </table>
                    
                   
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="IrReco">Ir a recordatorios</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Enterado</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--fin modal recordatorios-->
    
    <!--modal cobros-->
    <div class="modal fade" id="ModalCobros" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Cobros </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idclCobros">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idclCobros" disabled="true">

                  
                    <label for="fechaAceptoCobros">Fecha ejecución del servicio</label>

                    <input id="fechaAceptoCobros"   class="form-control" type="date"  width="276" >

                    <label for="horaAceptoCobros">Hora ejecución del servicio</label>
                    <div id="horaAceptoCobros">
                        <input type="number" id="horaACCobros" class="hora" min="6" max="18" maxlength="2" onkeyup="validaFormatoHora(this.value,true,'Cobros');">
                        <label> : </label>
                        <input type="number" id="minutoACCobros" class="hora" min="0" max="59" maxlength="2" onkeyup="validaFormatoHora(this.value,false,'Cobros');">
                        <label class="text-danger hide alertaHNL" id="alertaHNL">Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <label for="comment">Horas Ocupadas</label>

                    <div id="horas_ocupadasCobros" class="text-danger">
                    </div>
                    <label for="commentCobros">Comentarios adicionales</label>
                    <input type="text" class="form-control" id="commentCobros">
                    <p class="text-danger text-center hide" id="mensaje_error_aceptoCobros"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarCobros">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--fin modal cobros-->
    <!--modal importante-->
    <div class="modal fade" id="ModalImportante" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Importante </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idclImportante">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idclImportante" disabled="true">

                  
                    <label for="fechaAceptoImportante">Fecha ejecución del servicio</label>

                    <input id="fechaAceptoImportante"   class="form-control" type="date"  width="276" >

                    <label for="horaAceptoImportante">Hora ejecución del servicio</label>
                    <div id="horaAceptoImportante">
                        <input type="number" id="horaACImportante" class="hora" min="6" max="18" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('minutoAC'), 2)">
                        <label> : </label>
                        <input type="number" id="minutoACImportante" class="hora" min="0" max="59" maxlength="2" onKeyPress="pasaSiguiente(this, document.getElementById('comment'), 2)">
                        <label class="text-danger hide alertaHNL" id="alertaHNL" >Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <label for="comment">Horas Ocupadas</label>

                    <div id="horas_ocupadasImportante" class="text-danger">
                    </div>
                    <label for="commentImportante">Comentarios adicionales</label>
                    <input type="text" class="form-control" id="commentImportante">
                    <p class="text-danger text-center hide" id="mensaje_error_aceptoImportante"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarImportante">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--fin modal importante-->
    
    <!-- 25072021 plantilla modal-->
    <div id="modal_base_gestion">
    <div class="modal fade minimizable" id="gestionModal_%id%" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" id="modal-xlg_%id%" role="document">
            <div class="modal-content">
                <div class="modal-header cursormover ">
                    <h5 class="modal-title text-center" id="ModalLabel_%id%">Gestion de llamadas</h5>
                    <button class="btn btn-sm btn-success bt_ocultar" id="resume_h_%id%">Resumen Historial </button>
                    <button class="close modalMinimize"> <i class='fa fa-minus'></i> </button>
 
                    <button class="btn btn-sm btn-danger" class="close" onclick="cerrarModal('%id%')" aria-label="Cerrar">Cerrar </button>
                    
                    
                </div>
                <div class="modal-body">


                    <button class="btn btn-success btn-sm btn-top" id="btn-head_%id%">Buscar PDF</button>
                    <table class="table table-bordered table-sm table-dark" id="tabla_clienteU_%id%">
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
                    <table class="table table-bordered table-sm table-dark" id="tabla_clienteU2_%id%">
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
                    <textarea id="comentariosUG_%id%" resizable="false" class="comentariosUG"></textarea>
                    <textarea id="comentariosU_%id%" resizable="false" class="comentariosU"></textarea>
                </div>
                <div class="modal-footer" style="display:block">
                    <button class="btn btn-success btn-md btn- btn_aceptoU" id="btn_aceptoU_%id%">Aceptó</button>
                    <button class="btn btn-success btn-md btn_volverU" id="btn_volverU_%id%">Volver a llamar</button>
                    <button class="btn btn-success btn-md btn_rechazoU" id="btn_rechazoU_%id%">Rechazó</button>
                    <button class="btn btn-success btn-md btn_NrespondeU" id="btn_NrespondeU_%id%">No responde</button>
                    <button class="btn btn-success btn-md btn_equivocadoU" id="btn_equivocadoU_%id%">Equivocado</button>
                    <button class="btn btn-success btn-md btn_averiadoU" id="btn_averiadoU_%id%">Averiado</button>
                    <button class="btn btn-success btn-md btn_otroU" id="btn_otroU_%id%">Otro</button>
                     <button class="btn btn-success btn-md btn_inspeccionU" >Inspección</button>
                    <button class="btn btn-success btn-md btn_cobrosU" >Cobros</button>
                    <button class="btn btn-success btn-md btn_importanteU" >Importante</button>
        
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--plantilla modal fin -->

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
                
                //29072021
                $data_tira=[];
                $result = mysqli_query($enlace, "SELECT * FROM `tira_informativa` ");
                if($result){
                    $data_tira = mysqli_fetch_array($result); 
                }
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
        <input type="hidden" id="tira_permanete" value="<?php echo isset($data_tira['permanente'])?$data_tira['permanente']:"-1" ?>"/>
        <input type="hidden" id="tiempo_tira" value="<?php echo isset($data_tira['minutos'])?$data_tira['minutos']:"-1" ?>"/>
        
        

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
                <script type="text/javascript" src="../js/verificar_actividad.js?v=<?php echo time()?>"></script>
        <script type="text/javascript" src="../js/gestion_cliente_calendario.js?v=<?php echo time()?>"></script>
        <script type="text/javascript" src="../libs/select2-4.0.3/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>  

        <script>
            <?php
                if(!empty($_GET["c"])){
                    echo "cargaGLlamada('".$_GET["c"]."', ".$_SESSION["ide"].")";
                } else {
                    if(!empty($_GET["editar_cliente"])){
                        
                        echo "abrirEditarCliente('".$_GET["editar_cliente"]."')";
                    }
                    else
                    echo "document.getElementById('Motivate').click();";
                }
            ?>
        </script>
<script type="text/javascript">
        function enviar_inactivo(){
            var idc = document.getElementById('cliente_inactivar').value;
        var motivo = document.getElementById('motivo_inactivar').value;
        if(motivo == '')
        {
            alert('Debe ingresar un motivo para incativar a este cliente.');
        }
        else
        {
            $.ajax({
                type:'post',
                url:'inactivar.php',
                data:'idcliente='+idc+'&motivo='+motivo,
                success: function(data)
                {
                    $.post('../php/gestiones.php', {
                    tipo: 1,
                    gestion: 'ic',
                    cl: idc
                    }, function(message) {
                        $.post('../php/gestiones.php', {
                        tipo: 0,
                        gestion: 'nd',
                        cl: 'nd'
                         }, function(message) {
                        $("#estadistica_gestion").html(message);
                        });

                        if(data == 1)
                    {
                        alert('Cliente inactivado correctamente');
                        location.reload();
                    }

                    });
                   
                    location.reload();
                }

                
            });
        }
        
    }
    function show_inactive()
{
    
    $("#modal_inactivar").modal();
}
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

        




    
    $('#input_BCC').select2({
            language: 'es',
            ajax: {
                url: 'buscar_ciudadela.php',
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
    
    
    $('#input_BCCC').select2({
            language: 'es',
            ajax: {
                url: 'buscar_telefono.php',
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
    
    //buscar por factura
    $('#input_buscar_factura').select2({
            language: 'es',
            ajax: {
                url: 'buscar_factura.php',
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

           //nueva funcion de buscar
           $('#input_buscar_id').select2({
            language: 'es',
            ajax: {
                url: 'buscar_id.php',
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


        //fin buscar
    

    //recordatorios
    
    $('#sel_llamadas_urgentes').select2();


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
    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  });
</script>
<!-- Modal búsqueda por filtros -->
    <div class="modal fade" id="modal_filtro" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" id="modal-xlg" role="document">
            <div class="modal-content" style="max-height: 500px;overflow: auto;">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="ModalLabel">Búsqueda por filtros</h5>
                   
                    <button class="btn btn-sm btn-danger" class="close" data-dismiss="modal" aria-label="Cerrar">Cerrar </button>
                    
                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="cliente_gestionar">Fecha Inicio </label>
                            <input type="date" id="fecha_filtro_inicio" class="form-control"/>
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="cliente_gestionar">Fecha Final </label>
                            <input type="date" id="fecha_filtro_fin" class="form-control"/>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btfiltro" data-filtro="Acepto">Aceptó</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Volver a llamar">Volver a LLamar</button>
                        
                        <button class="btn btn-primary btfiltro" data-filtro="Rechazo">Rechazó</button>
                        <button class="btn btn-primary btfiltro" data-filtro="No responde">No responde</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Equivocado">Equivocado</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Averiado">Averiado</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Otro estado">Otro</button>
                         <button class="btn btn-primary btfiltro" data-filtro="Inspección">Inspección</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Cobros">Cobros</button>
                        <button class="btn btn-primary btfiltro" data-filtro="Importante">Importante</button>

                    </div>
                    

                    <button class="btn btn-success btn-sm btn-top" id="btFiltrarClientes">Buscar Clientes</button>
                    <table class="table table-bordered table-sm table-dark" id="tb_resultados_filtro">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Cliente</th>
                                <th scope="col">Tipo de Gestión </th>
                                <th scope="col">Direccion</th>
                               <th scope="col">Fecha Gestión</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<div class="minmaxCon"></div>
<div id="tira_informativa" style="display:block">
    <div style="display:flex">
        <marquee><label id="lb_titulo_msj_admin" class="msjs_admin">Mensaje del Administrador:</label>
    <label id="lb_msj_admin" class="msjs_admin"></label><span class="sp_espacio"></span>
    <label class="lb_aviso"></label><label id="lb_recordatorio_vencido"></label>
    </marquee>
    </div>
</div>
</body>

</html>
