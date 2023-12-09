
  function AbrirEditar(){
      console.log(data_gestion);
      $('#myModal').modal('toggle')
      let arr_hora = data_gestion.hora_acepto.split(":");
      $('#idcl').val(data_gestion.nombre_completo);
      $('#fechaAcepto').val(data_gestion.fecha_acepto);
      
      $('#horaAC').val(arr_hora[0]);
      $('#minutoAC').val(arr_hora[1]);
      $('#ModalEditar').modal('show');
      
      

  }
  function eliminarAgendamiento(){
      console.log(data_gestion);
      if(confirm("Está seguro que desea eliminar el agendamiento?")){
        
        
        $.post("../php/eliminar_gestion.php", {
          id_gestion:data_gestion.id
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
    /*let response_data = guardar_tiempo('ac', cliente);
    
    console.log('response_data  :');
    console.log(response_data);
    if(response_data.data == 1){
    */
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
                      id_gestion:data_gestion.id
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
                
                                  if (!esta_importante) {
                                    $("#tableDanger").css('display', 'block');
                                    $("#botonUrgente").css('display', 'block');
                                    $("#tableWarning").css('display', 'none');
                                    $("#botonWarning").css('display', 'none');
                                  } else {
                                    $("#tableDanger").css('display', 'none');
                                    $("#botonUrgente").css('display', 'none');
                                    $("#tableWarning").css('display', 'block');
                                    $("#botonWarning").css('display', 'block');
                                  }
                
                           
                        $("#mensaje_error_acepto").addClass('hide');
                        //sumar_gestion('ac', $("#cliente_selc_pargestion").val());
                        //gestionado_botones = true;
                        //comentado  01022021 guardar_tiempo('ac', $("#cliente_selc_pargestion").val());
                
                
                
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
    
        
    /*}
    else{
        alert(response_data.msj);
        console.log('no puede continuar no hay sesion');
    }*/


  }


});