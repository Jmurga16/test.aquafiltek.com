  total_segundos = 0;
aumentar_segundos_gestion();
  function AbrirEditar(){
      
      console.log(data_gestion);
      console.log('fecha:'+data_gestion.fecha_acepto);
        
      $('#myModal').modal('toggle')
      if( data_gestion.otra_gestion == 1 ){
          //reprogramar llamada
          $('#ModalR').modal('show');
          $("#idCliente").val(data_gestion.nombre_completo);
          $("#fechaLlamada").val(data_gestion.fecha_acepto).trigger('change');
            
      }
      else{
          let arr_hora = data_gestion.hora_acepto.split(":");
        $('#idcl').val(data_gestion.nombre_completo);
      
        $('#fechaAcepto').val(data_gestion.fecha_acepto).trigger('change');
      
        $('#horaAC').val(arr_hora[0]);
        $('#minutoAC').val(arr_hora[1]);
      
        $('#ModalEditar').modal('show');
        $('#lb_tipo_gestion').text(data_gestion.gestion);
      }
      

  }
  function eliminarAgendamiento(){
      
      console.log(data_gestion);
      if(confirm("Está seguro que desea eliminar el agendamiento?")){
        
        
        $.post("../php/eliminar_gestion.php", {
          id_gestion:data_gestion.id,
          codigo:data_gestion.codigo,
          id_tipo_gestion:(data_gestion.id_tipo_gestion !== undefined)?data_gestion.id_tipo_gestion:-1,
          fecha_acepto: data_gestion.fecha_acepto,
            hora_acepto:data_gestion.hora_acepto
        }, function(data) {
            console.log(data);
            alert(data.msj);
            if( !data.error ){
                location.reload();
            }
        }, "json");
      }
  } 
   
   /*$("#fechaAcepto").change(function() {


  $.post("../php/horas_ocupadas.php", 
  {
    fecha:$("#fechaAcepto").val(),
    id:$("#identificador_usuario").html()
  }, 
  function procesar(data){
    $("#tabla_hora").html(data.tabla);
    $.each(data.dias,function(index){
        $("#"+data.dias[index].id).css("background-color", "red");
        $("#"+data.dias[index].id).prop("onclick", null).off("click");
        $("#"+data.dias[index].id).prop('title', 'HORARIO OCUPADO');
    });
  }, "json");
  $("#tabla_hora").show();

});*/


$("#GuardarA").click(function() {
  //reactivar_actividad();
  console.log('id_gestion:'+data_gestion.id);
  $("#GuardarA").addClass('disabled');
  $("#GuardarA").html("Guardando...");
  if ($("#fechaAcepto").val() == "") {
    alert("La fecha es obligatoria!");
    $("#GuardarA").removeClass('disabled');
    $("#GuardarA").html("Guardar");
  } else {
    var fecha, hora, cliente, comentario;
    fecha = $("#fechaAcepto").val();
    hora = $("#horaAC").val() + ":" + $("#minutoAC").val() + ":00";
    cliente = data_gestion.codigo;
    comentario = $("#comment").val();
    console.log('cliente cod:'+cliente);
    let sigla = get_siglas_gestion(data_gestion.gestion);
    console.log('sigla:'+sigla);
                        
    let response_data = guardar_tiempo('ac', cliente);
    
    console.log('response_data  :');
    console.log(response_data);
    if(response_data.data == 1){

        $.post("../php/valida_hora_acepto.php", {
          id_act: cliente,
          fecha: fecha,
          hora: hora,
          id_gestion:data_gestion.id
        }, function(data) {
    
            if (data.estado == "insertar") {
    
                    $.post('../php/llamadaRealizada.php', {
                      cl: cliente
                    }, function(mensaje) {});
                
                    $.post('release_client.php', {
                      id: cliente
                    },
                    function() {  
                    });
                
                
                    $.post("../php/Cliente_acepto_modificar.php", {
                      id_act: cliente,
                      fecha: fecha,
                      hora: hora,
                      comentario: comentario,
                      id_gestion:data_gestion.id,
                      
                    }, function(mensaje) {
                        if (mensaje == 1) {
                                  $("#snackbar").html("Datos de gestión actualizada con éxito.");
                                  $("#snackbar").addClass('show');
                                  setTimeout(function() {
                                    $("#snackbar").removeClass('show');
                                  }, 10000);
                                 
                                $("#ModalA").modal('toggle');
                                $("#comment").val("");
                                $("#fechaAcepto").val("");
                
                                $("#horaAC").val('');
                                $("#minutoAC").val('');
                
                                
                                $("#GuardarA").removeClass('disabled');
                                $("#GuardarA").html("Guardar");
                                /*Llenar tabla urgentes de nuevo*/
                                $(".loader").fadeIn("slow");
                                tabla_llena = false;
                                $("#registrosD tbody").html(" ");
                                $("#registrosW tbody").html(" ");
                
                                  /*if (!esta_importante) {
                                    $("#tableDanger").css('display', 'block');
                                    $("#botonUrgente").css('display', 'block');
                                    $("#tableWarning").css('display', 'none');
                                    $("#botonWarning").css('display', 'none');
                                  } else {
                                    $("#tableDanger").css('display', 'none');
                                    $("#botonUrgente").css('display', 'none');
                                    $("#tableWarning").css('display', 'block');
                                    $("#botonWarning").css('display', 'block');
                                  }*/
                
                           
                        $("#mensaje_error_acepto").addClass('hide');
                        sumar_gestion(sigla, $("#cliente_selc_pargestion").val());
                        //gestionado_botones = true;
                        //comentado  01022021 guardar_tiempo('ac', $("#cliente_selc_pargestion").val());
                
                        setTimeout(function() {
                        location.reload();
                      }, 3000);
                                    
                      } 
                      else {
                            mensaje = mensaje.split("~");
                            if (mensaje[0] == -3) {
                              $("#GuardarA").removeClass('disabled');
                              $("#GuardarA").html("Guardar");
                              $("#mensaje_error_acepto").html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + mensaje[1] + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                              $("#mensaje_error_acepto").removeClass('hide');
                            }
                      }
                
                    });
    
                
    
    
    
            
            }
            else {
             
                
                  $("#GuardarA").removeClass('disabled');
                  $("#GuardarA").html("Guardar");
                  $("#mensaje_error_acepto").html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + data.mensaje + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                  $("#mensaje_error_acepto").removeClass('hide');
             
            }
    
        }, "json");
    
        
    }
    else{
        alert(response_data.msj);
        console.log('no puede continuar no hay sesion');
    }


  }


});


//16082021
$("#fechaAcepto").change(function() {

  $.post("../php/horas_ocupadas_acepto.php", 
  {
    fecha:$("#fechaAcepto").val(),
    id:$("#identificador_usuario").html()
  }, 
  function procesar(data){

    //console.log(data.datos);
    $("#horas_ocupadas").html(data.datos);   
    
  }, "json");
  //$("#horas_ocupadas").show();

});



$("#fechaLlamada").change(function() {


  $.post("../php/horas_ocupadas.php", 
  {
    fecha:$("#fechaLlamada").val(),
    id:$("#identificador_usuario").html()
  }, 
  function procesar(data){
    $("#tabla_hora_reprogramar").html(data.tabla);
    $.each(data.dias,function(index){
        $("#"+data.dias[index].id).css("background-color", "red");
        $("#"+data.dias[index].id).prop("onclick", null).off("click");
        $("#"+data.dias[index].id).prop('title', 'HORARIO OCUPADO');
    });
  }, "json");
  $("#tabla_hora").show();

});


function hora_maracada(datos){

  var result = datos.split(':');

  //console.log(result[0]+" "+result[1]);

  $("#hora").val(result[0]);
  $("#minuto").val(result[1]);


  $("#hora_mos").val(result[0]);
  $("#minuto_mos").val(result[1]);


  if($("#selec_resp").val()!=""){
    var ids=$("#selec_resp").val();
    $("#"+ids).css("background-color", "#ffffff");
    $("#"+ids).prop('title', 'DISPONIBLE');
  }

  var ido="hora_"+result[0]+result[1]+"00"; 
  $("#"+ido).css("background-color", "#28a745");
  $("#"+ido).prop('title', 'SELECCIONADO');
  $("#selec_resp").val(ido);

  

}

function convertir_hora(h, m) {
  var hora = "";
  if (h.length > 1) {
    hora += h;
  } else {
    if (h < 10) {
      hora += "0" + h;
    } else {
      hora += h;
    }

  }
  if (m.length > 1) {
    hora += ":" + m;
  } else {
    if (m < 10) {
      hora += ":0" + m;
    } else {
      hora += ":" + m;
    }

  }
  hora += ":00";
  return hora;
}

function release_client_p(index){
    var id= index;
  
  $.post('release_client.php', {
    id: id
  },
  function() {

  });

}

function sumar_gestion(tipo_gestion, cliente) {
  $.post('../php/gestiones.php', {
    tipo: 1,
    gestion: tipo_gestion,
    cl: cliente
  }, function(message) {
    ver_gestiones_hoy();
  });
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
    case 'vi':
      {
        return 8;
        break;
      }
    
    case 'in':{
        return 9;
        break;
    }
    case 'co':{
        return 10;
        break;
    }
        
    
    default:
      {
        return 0;
        break;
      }

  }
}

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
 let asincrono = (tipo=='ac' || tipo == 'co' || tipo == 'in')?false:true;
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


$("#ReprogramarLL").click(function() {


 // alert(cliente_actual);

  reactivar_actividad();
  $("#ReprogramarLL").addClass("disabled");
  $("#ReprogramarLL").html("Reprogramando...");
    console.log('fe:'+$("#fechaLlamada").val()+'-'+$("#hora").val()+'-'+$("#minuto").val())
  if ($("#fechaLlamada").val() == "" || $("#hora").val() == "" || $("#minuto").val() == "") {
    alert("Todos los campos son obligatorios, los caracteres especiales no estan permitidos.");
    $("#error_hora").removeClass('hide');
    $("#ReprogramarLL").removeClass('disabled');
    $("#ReprogramarLL").html("Reprogramar");
  } else {


    var fecha, hora, cliente, comentario;
    var tipo = 'vi';//$("#tipoModal").html();   
    console.log('reprogramar llamada :'+tipo);
    fecha = $("#fechaLlamada").val();
    hora = convertir_hora($("#hora").val(), $("#minuto").val());
    cliente = data_gestion.codigo;
    comentario = $("#commentR").val();
    

    $.post("../php/getClientsByUser1.php", {
      hora: $("#hora").val(),
      minuto: $("#minuto").val(),
      fecha:fecha

    }, function(data) {
  
      if (data=="true") {
        //console.log('CONDITION PASSED')
        // release_client(cliente);
        release_client_p(cliente);
        $.post('../php/llamadaRealizada.php', {
          cl: cliente
        }, function(mensaje) {
          //console.log('MENSAJE', mensaje)
          $.post("../php/add_llamada1.php", {
            id_act: cliente,
            fecha: $("#fechaLlamada").val(),
            hora: hora,
            comentario: comentario,
            tipo: tipo
          }, function(mensaje) {
            if (mensaje == 1) {
              
              $("#snackbar").html("El cliente ha sido reprogramado con éxito.");
              $("#snackbar").addClass('show');
              setTimeout(function() {
                $("#snackbar").removeClass('show');
                location.reload();
              }, 4000);
              $("#ModalR").modal('toggle');
              $("#commentR").val("");
              $("#fechaLlamada").val("");

              $("#hora").val("");
              $("#minuto").val("");
              $("#hora_mos").val("");
              $("#minuto_mos").val("");

              /*Llenar tabla urgentes de nuevo*/
              
              
              sumar_gestion(tipo, cliente);
              guardar_tiempo(tipo, cliente);

            }
            $("#ReprogramarLL").removeClass('disabled');
            $("#ReprogramarLL").html("Reprogramar");
          });
        });
      } else {

            alert("Error de sincronizacion. Esta fecha y hora ya no esta disponible");
              
            var ido="hora_"+$("#hora").val()+$("#minuto").val()+"00";
            

              $("#"+ido).css("background-color", "#9c9c9c");
              $("#"+ido).prop("onclick", null).off("click");
              $("#"+ido).prop('title', 'FUERA DE HORA');
              $("#selec_resp").val('');


              $("#hora").val("");
              $("#minuto").val("");
              $("#hora_mos").val("");
              $("#minuto_mos").val("");

              


        $("#ReprogramarLL").removeClass('disabled');
        $("#ReprogramarLL").html("Reprogramar");
      }
    });
  }
  $("#error_hora").addClass('hide');
});

function get_siglas_gestion(gestion){
    console.log(gestion);
    gestion = gestion.toLowerCase();
    console.log(gestion);
    if(gestion.indexOf('cobros') > -1){
        return 'co';
    }
    else if(gestion.indexOf('aceptó') > -1){
        return 'ac';
    }
    else{
        return 'in';
    }
} 


function pasaSiguiente(actual, siguiente, longitud) {
  if ((actual.value.length + 1) == longitud) {
    if (parseInt($("#hora").val()) >= 0 && parseInt($("#hora").val()) < 6) {
      $("#alertaHNL").removeClass("hide");
    } else if (parseInt($("#hora").val()) == 6 && $("#minuto").val() != "") {
      if (parseInt($("#minuto").val()) == 0) {
        $("#alertaHNL").removeClass("hide");
      } else {
        $("#alertaHNL").addClass("hide");
      }
    } else {
      $("#alertaHNL").addClass("hide");
    }
    siguiente.focus();
  }
}

function aumentar_segundos_gestion() {
  setTimeout(function() {
    total_segundos++;
    aumentar_segundos_gestion();
  }, 999);

}

//17082021
function validaHoraMinuto(extension,siguiente){
        
        console.log('ext:'+extension+'---hora:'+$('#horaAC'+extension).val()+'-min:'+$('#minutoAC'+extension).val());
        int_hora = parseInt($('#horaAC'+extension).val());
        int_minuto = parseInt($('#minutoAC'+extension).val());
        console.log('int_hora:'+int_hora+'-int_minuto:'+int_minuto);
        let puede_siguiente = true;
       
            if (int_hora >= 0 && int_hora < 6) {
                console.log('>=0 <6');
                $('#horaAC'+extension).focus();
                puede_siguiente = false;
                console.log('e2');
              $(".alertaHNL").removeClass("hide");
            } else if (int_hora == 6 && $('#minutoAC'+extension).val() != "") {
                console.log('6 y min');
              if (int_minuto == 0 || int_minuto >= 60 ) {
                  console.log('min o r');
                  $('#minutoAC'+extension).focus();
                  puede_siguiente = false;
                  console.log('e3');
                $(".alertaHNL").removeClass("hide");
              } else {
                $(".alertaHNL").addClass("hide");
              }
            } else if (int_hora == 18 && $('#minutoAC'+extension).val() != "") {
                console.log('18 y min ');
                if (int_minuto > 0 ) {
                    console.log('18 min > 0');
                    $('#minutoAC'+extension).focus();
                  puede_siguiente = false;
                  console.log('e4');
                    $(".alertaHNL").removeClass("hide");
                } else {
                    $(".alertaHNL").addClass("hide");
                }
            }
            else if( int_hora > 18 ){
                console.log('>18');
                $('#horaAC'+extension).focus();
                puede_siguiente = false;
                  console.log('e5');
                    $(".alertaHNL").removeClass("hide");
            }
            else if( int_minuto > 59 ){
                 console.log(' min > 59');
                $('#minutoAC'+extension).focus();
                puede_siguiente = false;
                  console.log('e6');
                    $(".alertaHNL").removeClass("hide");
            }            
            else {
              $(".alertaHNL").addClass("hide");
            }
       
        console.log('puede_siguiente:'+puede_siguiente);
        if(puede_siguiente)
        $('#'+siguiente+extension).focus();
        //siguiente.focus();
    }












