<?php
//comentado 01022021 session_start();
require "check_session.php";

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
    <link href="../js/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
<div id="snackbar" style="margin-left:250px!important"></div>

    <br>
     
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Detalles</h4>
      </div>
      <div class="modal-body">
        <div id="contenido_mostra"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


        <div class="container">




        
          <!-- Modal editar-->
          <div>
              <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="formularioEditar" class="formulario">
                        
                          
                      </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        <span id="identificador_usuario" class="hide"><?php echo $_SESSION['ide']; ?></span>
        <div style="width:100%; display:flex">
            <div style="background-color:green; color: white; width:32%; height:30px; padding:4px">ACEPTÓ</div>
            <div style="background-color:blue; color: white; width:32%; height:30px; padding:4px">INSPECCIÓN</div>
            <div style="background-color:yellow; width:32%; height:30px; padding:4px">COBROS</div>
            <div style="background-color:#60cbd6;  width:32%; height:30px; padding:4px">IMPORTANTE</div>
            
        </div>
        <div id="calendar" class=""> </div>
                                            
         <!-- acepto -->
    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-primary">Editar Gestión <label id="lb_tipo_gestion"></label> </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="idcl">Nombre del cliente</label>
                    <input type="text" class="form-control" id="idcl" disabled="true">

                  
                    <label for="fechaAcepto">Fecha ejecución del servicio</label>

                    <input id="fechaAcepto"   class="form-control" type="date"  width="276"  >

                    <label for="horaAcepto">Hora ejecución del servicio</label>
                    <div id="horaAcepto">
                        <input type="number" id="horaAC" class="hora" min="6" max="18" maxlength="2" onkeyup="validaFormatoHora(this.value,true,'');">
                        <label> : </label>
                        <input type="number" id="minutoAC" class="hora" min="0" max="59" maxlength="2" onkeyup="validaFormatoHora(this.value,false,'');">
                        <label class="text-danger hide alertaHNL" id="alertaHNL">Hey, estas agendando fuera de horario laborable</label>
                    </div>

                    
                    <label for="comment">Horas Ocupadas</label>

                    <div id="horas_ocupadas" class="text-danger">
                            
                       
                           

                    </div>
                    <label for="comment">Comentarios adicionales</label>
                    <table style="font-size:13px" class="table-bordered table-striped" id="tabla_hora">
                            

                          
                           

                    </table>

                    <input type="text" class="form-control" id="comment">
                    <p class="text-danger text-center hide" id="mensaje_error_acepto"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="GuardarA">Guardar</button>
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

                    <table style="font-size:13px" class="table-bordered table-striped" id="tabla_hora_reprogramar">
                            

                          
                           

                    </table>


                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="ReprogramarLL">Reprogramar</button>
                </div>
            </div>
        </div>
    </div>
    


<br><br>
        </div>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>     
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



        <link href='../js/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='../js/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='../js/fullcalendar/lib/moment.min.js'></script>
     <!--   <script src='../js/fullcalendar/lib/jquery.min.js'></script> -->
        <script src='../js/fullcalendar/fullcalendar.min.js'></script>
        <script src='../js/fullcalendar/lang-all.js'></script>
        <script src='../js/fullcalendar/lang/es.js'></script>

        <script type="text/javascript" src="../js/auxiliares.js"></script>
        <script type="text/javascript" src="../js/verificar_actividad.js?v=<?php echo time()?>"></script>

        <script>
   var data_gestion = {};
  $(document).ready(function() {

    $('.fc-event').css({"background":"red"});
   



   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
      left:'prev,next today',
      center:'title',  
      right: 'month,agendaWeek,agendaDay'
    },
    defaultView: 'agendaWeek',    
    events: 'fechas_calendario.php?accion=consultar',
    
    
    /*events: function(start, end, timezone, callback) {

$.ajax({
    url: 'fechas_calendario.php',
    dataType: 'xml',
    data: {
    // our hypothetical feed requires UNIX timestamps
    start: '2022-10-24',
    end: '2022-10-31',
    accion: 'consultar'
    },
    success: function(doc) {

    var events = [];

        $(doc).find('event').each(function() {
            events.push({ 
                title: $(this).attr('title'),
                start: $(this).attr('start'),
                end: $(this).attr('end'),
                className: $(this).attr('className'),
                url: $(this).attr('url'),
                minTime: '07:00:00',
    maxTime: '22:00:00'
            });
        });

        
      

        callback(events);
    }
});
  },*/
    selectable:true,
    selectHelper:true,
    
  /*   
    select: function(start, end, allDay)
    {
     var title = prompt("Confirme el dia feriado");
   
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"fechas_calendario.php",
       type:"POST",
       data:{accion:"insertar",title:"Festivo "+title, start_event:start, end_event:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //alert("Registro guardado");
       }
      })
     
    },
    editable:false,
   eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"fechas_calendario.php",
      type:"POST",
      data:{accion:"actualizar",title:title, start_event:start, end_event:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       //alert("Registro actualizado");
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
    url:"fechas_calendario.php",
      type:"POST",
      data:{accion:"actualizar",title:title, start_event:start, end_event:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Registro actualizado");
      }
     });
    },
*/
    eventClick:function(event)
    {

      var id = event.id;
      console.log(event);
      console.log(event.otra_gestion);

      $.post('fechas_calendario.php', {
        id: id,
        accion:"detalle",
        codigo:event.codigo,
        otra_gestion:event.otra_gestion
      }, function(data){
          
        console.log(data)
        data = JSON.parse(data);
        data_gestion = data;
        html="Nombre: "+data.nombre_completo+" ("+data.codigo+")<br>";
				html+="Direccion: "+data.direccion+"<br>";
				html+="Datos Factura: "+data.Datos_factura+"<br>";
				html+="Telefono Principal: "+data.telefono+"<br>";
				html+="Telefono oficina: "+data.telefono_oficina+"<br>";
				html+="Celular 1: "+data.celular1+"<br>";
				html+="Celular 2: "+data.celular2+"<br>";
				if( data.user !== undefined )
				html+="Operador : "+data.user+"<br>";
				html+="<a href='Modulo_Usuario.php?c="+data.codigo+"' target='_blank' class='btn btn-primary'>Ver</a>";
				html+="<button type='button' class='btn btn-warning' onclick='AbrirEditar();'>Editar</button>";
				html+="<button type='button' class='btn btn-danger' onclick='eliminarAgendamiento()'>Eliminar</button>";
				
        //alert(data)
        $("#formularioEditar").html(html)

        $('#myModal').modal('toggle')
        reactivar_actividad();
      });



    },



   });
  });
  

/*
function guardar_tiempo(tipo, cliente) {
  var ntipo = get_tipo(tipo);
  var segundos = total_segundos,
    minutos = 0,
    horas = 0,
    tiempo = '';
  total_segundos = 0;
  gestionado_botones = false;
  
  //01022021
  let continuar = false;
 let asincrono = (tipo=='ac')?false:true;
  console.log('tipo:'+tipo+'--a:'+asincrono);
  while (true) {
    if (segundos >= 60) {
      minutos++;
      segundos -= 60;
    }
    if (minutos >= 60) {
      minutos -= 60;
      horas++;
    }
    if (minutos < 60 && segundos < 60)
      break;
  }
  if (horas < 10)
    horas = '0' + horas;
  if (minutos < 10)
    minutos = '0' + minutos;
  if (segundos < 10)
    segundos = '0' + segundos;

  tiempo = '' + horas + ':' + minutos + ':' + segundos;
  if(!asincrono){
      console.log('config ajax');
      $.ajaxSetup({async: false});  
  }
  $.post('../php/guardar_tiempo.php', {
    tipo: ntipo,
    cliente: cliente,
    tiempo: tiempo,
    async: asincrono,
  }, function(message) {
      console.log('message guardar_tiempo:'+message+"---");
      message = JSON.parse(message.trim());
      console.log('message.data--:'+message.data);
      continuar = message;
  });
  if(!asincrono){
      console.log('default config ajax');
      $.ajaxSetup({async: true});  
  }
  console.log('antes return');
  return continuar;
}


function get_tipo(t) {
  switch (t) {
    case 'ac':
      {
        return 2;
        break;
      }
    case 're':
      {
        return 3;
        break;
      }
    case 'vl':
      {
        return 1;
        break;
      }
    case 'nr':
      {
        return 5;
        break;
      }
    case 'ot':
      {
        return 7;
        break;
      }
    case 'eq':
      {
        return 6;
        break;
      }
    case 'av':
      {
        return 4;
        break;
      }
    default:
      {
        return 0;
        break;
      }

  }
}
*/


  </script>


<script src="../js/calendario.js?v=<?php echo time() ?>"></script>
</body>

</html>