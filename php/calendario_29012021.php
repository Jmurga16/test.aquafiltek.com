<?php
session_start();
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
      
        <div id="calendar" class=""> </div>
                                            




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


        

        <script>
   
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

      $.post('fechas_calendario.php', {
        id: id,
        accion:"detalle"
      }, function(data){

        //alert(data)
        $("#formularioEditar").html(data)

        $('#myModal').modal('toggle')

      });



    },



   });
  });
   
  </script>



</body>

</html>