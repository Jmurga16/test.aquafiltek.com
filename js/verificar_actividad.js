var tiempo_ausente = 0;
var horasT = 0,
  minutosT = 0,
  segundosT = 0,
  horasA = 0,
  minutosA = 0,
  segundosA = 0;

function convertir_tiempo(h, m, s) {
  var cad = "";
  if (h < 10) {
    cad += "0" + h;
  } else {
    cad += h;
  }
  cad += ":";
  if (m < 10) {
    cad += "0" + m;
  } else {
    cad += m;
  }
  cad += ":";
  if (s < 10) {
    cad += "0" + s;
  } else {
    cad += s;
  }
  return cad;
}



function modal_reco(){
  setTimeout(function(){
    $.post("../php/getLlamadasPend.php", {}, function(mensaje) {
      var data = jQuery.parseJSON(mensaje);
      if(data.mostrar == 1)
      {
        $("#ModalReco").modal();
        $("#personas").html(data.data);
      } 
      else
      {

          
      }

      modal_reco();
  });

  }, 60000);
}

function verificar_inactividad() {


 



  setTimeout(function() {


    tiempo_ausente += 5;
    
    //comentado 01022021 if (tiempo_ausente == 600) {
    console.log('ausente:'+tiempo_ausente);





    if (tiempo_ausente == 1800) {
        console.log('se inicia cerrar sesion');
      var hora = getHora();
      var tiempoT = convertir_tiempo(horasT, minutosT, segundosT);
      var tiempoA = convertir_tiempo(horasA, minutosA, segundosA);
      $.post("../php/exit_user.php", {
        hora: hora,
        tiempoI: tiempoT,
        almuerzo: tiempoA
      }, function(mensaje) {
        if (mensaje == 1){
          console.log('cesión cerrada');
          location.replace("../index.html");
        }
      });
    }
    verificar_inactividad();
  }, 5000);
}

function reactivar_actividad() {
    console.log('reactivar_actividad');
    tiempo_ausente = 0;
}

verificar_inactividad();
modal_reco();