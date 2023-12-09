var esta_aumentando = false;
var cliente_actual;
var nombre_cliente_actual;
var cliente_espacios;
var cliente_urgente_actual;
var esta_importante = false;
//comentado 01022021 var tiempo_ausente = 0;
var urge = false;
var llamadas_hoy = [];
var contador;
var cantidad_clientes;
var clientes_cookie_cargado = false;
var clientes_cookie;
var ultima_busqueda;
var primer_enter = false;
var arr_id_gestionar = [];
var arr_id_modals = [];
var id_modal_actual = '';
var max_recordatorios=6;
var max_ancho = window.innerWidth;
var margen_modal = (max_ancho / 6).toFixed(2);
var vector = [];
var arr_codigos_tabla = [];
var arr_filtros = [];
const GESTION_INSPECCION = 1;
const GESTION_COBROS = 2;
const GESTION_IMPORTANTE = 3;
var json_clientes = [];
var map;
var markerCluster;
var obj_url_pines = {
    'ayer':'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
    'temprano' : 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
    'normal' :'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
}
var markers=[];
var id_actual='';
var desde_postventa=false;//20082021 para cobros postventa
var codigo_seleccionado_aux='';//2008 para problema de cliente seleccionado


console.log('margen_modal:'+margen_modal);
llenar_hoy();

var tira_permanente = $('#tira_permanete').val();
var tiempo_tira = parseInt($('#tiempo_tira').val())*60;//en segundos

console.log(tira_permanente+'--tiempo_tira:'+tiempo_tira);
var distnacia_inicial = 0.1;
var distnacia_aumentar = 0.1;
var marker_referencia = null;
bloquear_urgente();

//comentado 01022021 verificar_inactividad();

ver_gestiones_hoy();
//$(".asdf").attr('style',"display:none")
$(".search-box").toggle("slow");
//sohaib
//$("#BCCC").toggle("slow");
$(".search").fadeOut("fast");
$(".history_ge").fadeOut("slow");

$("#Motivate").click(function() {
  reactivar_actividad();
  $("#PMotivate").addClass("active");
  $("#PPventa").removeClass("active");
  $("#PRecordatorio").removeClass("active");
  $("#PGllamada").removeClass("active");
  $("#PgenerarR").removeClass("active");

  if ($("#ContainerVM").css("display") == "none") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", "block");
    });
  }

  if ($("#ContainerR").css('display') == "block") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", 'none');
    });
  }
  if ($("#ContainerGL").css('display') == "block") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", 'none');
    });
  }
  if ($("#ContainerPV").css('display') == "block") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", 'none');
    });
  }

  if ($("#containerGR").css("display") == "block") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "none");
    });
  }
});

$("#Gllamada").click(function() {
  reactivar_actividad();

  $("#tabla_hora2").html('');
    $("#tabla_hora").html('');

  $('.navbar-collapse').collapse("toggle");
  $("#PGllamada").addClass("active");
  $("#PMotivate").removeClass("active");
  $("#PRecordatorio").removeClass("active");
  $("#PPventa").removeClass("active");
  $("#PgenerarR").removeClass("active");

  if ($("#ContainerGL").css("display") == "none") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", "block");
    });
  }

  if ($("#ContainerVM").css('display') == "block") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", 'none');
    });
  }
  if ($("#ContainerR").css('display') == "block") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", 'none');
    });
  }
  if ($("#ContainerPV").css('display') == "block") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", 'none');
    });
  }
  total_segundos = 0;
  cliente_actual = undefined;
  //cargar_gestion();
  if (!esta_aumentando) {
    aumentar_segundos_gestion();
    esta_aumentando = true;
  }
  esta_importante = false;

  if ($("#containerGR").css("display") == "block") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "none");
    });
  }
});

$("#Recordatorio").click(function() {
  reactivar_actividad();
  $("#PRecordatorio").addClass("active");
  $("#PMotivate").removeClass("active");
  $("#PGllamada").removeClass("active");
  $("#PPventa").removeClass("active");
  $("#PgenerarR").removeClass("active");

  $("#registrosD tbody").html(" ");
  $("#registrosW tbody").html(" ");
  $("#Gllamada").removeClass("disabled");

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


  if ($("#ContainerR").css("display") == "none") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", "block");
    });
  }

  if ($("#ContainerVM").css('display') == "block") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", 'none');
    });
  }
  if ($("#ContainerGL").css('display') == "block") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", 'none');
    });
  }
  if ($("#ContainerPV").css('display') == "block") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", 'none');
    });
  }

  //$(".loader").fadeIn("slow");
  llenar_llamadas();

  if ($("#containerGR").css("display") == "block") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "none");
    });
  }
});

$("#botonUrgente").click(function() {
  

  if ($("#tableWarning").css("display") == "none") {
    $("#botonWarning").css("display", 'block');
    $("#tableWarning").toggle("slow", function() {
      $("#tableWarning").css("display", "block");
    });
  }
  if ($("#tableDanger").css('display') == "block") {
    $("#botonUrgente").css("display", 'none');
    $("#tableDanger").toggle("slow", function() {
      $("#tableDanger").css("display", 'none');
    });
  }
  esta_importante = true;

  llenar_llamadas();
});

$("#botonWarning").click(function() {
  reactivar_actividad();
  if ($("#tableDanger").css("display") == "none") {
    $("#botonUrgente").css("display", 'block');
    $("#tableDanger").toggle("slow", function() {
      $("#tableDanger").css("display", "block");
    });
  }

  if ($("#tableWarning").css('display') == "block") {
    $("#botonWarning").css("display", 'none');
    $("#tableWarning").toggle("slow", function() {
      $("#tableWarning").css("display", 'none');

    });
  }
  esta_importante = false;
});

$("#Pventa").click(function() {

$("#tabla_hora2").html('');
$("#tabla_hora").html('');

$("#fechaLlamadaPV").val('');

$("#horaPV").val('');
$("#minutoPV").val('');
$("#horaPV_vv").val('');
$("#minutoPV_vv").val('');



  reactivar_actividad();
  $(".loader").fadeIn("slow");
  llenar_lista_clientes();
  $("#PPventa").addClass("active");
  $("#PMotivate").removeClass("active");
  $("#PGllamada").removeClass("active");
  $("#PRecordatorio").removeClass("active");
  $("#PgenerarR").removeClass("active");

  if ($("#ContainerPV").css("display") == "none") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", "block");
    });
  }

  if ($("#ContainerVM").css('display') == "block") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", 'none');
    });
  }
  if ($("#ContainerR").css('display') == "block") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", 'none');
    });
  }
  if ($("#ContainerGL").css('display') == "block") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", 'none');
    });
  }

  if ($("#containerGR").css("display") == "block") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "none");
    });
  }
});

$("#cerrar_sesion").click(function() {
  if(contador !== undefined){

    ////console.log(contador) ;
    release_client(contador-1)
  }
  var hora = getHora();
  var tiempoT = convertir_tiempo(horasT, minutosT, segundosT);
  var tiempoA = convertir_tiempo(horasA, minutosA, segundosA);
  $.post("../php/exit_user.php", {
    hora: hora,
    tiempoI: tiempoT,
    almuerzo: tiempoA
  }, function(mensaje) {
    if (mensaje == 1)
    location.replace("../index.html");
  });
});


var num = Math.ceil((Math.random() * 10) % 14);
console.log('num motv:'+num);
switch (num) {

  case 1:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/elementor/thumbs/Alimenta-tu-Fe-hasta-que-tus-miedos-se-mueran-de-hambre-o038g8mybtycyd5e7bybv1u70yn17nrs4lgjulqc8g.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 2:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/a-quien-debes-retar-impresionar-y-superar-es-a-ti-mismo-1024x1024.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 3:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/Intentalo-una-y-otra-vez-hasta-que-tus-miedos-te-tengan-miedo-1024x1024.jpg\" class=\"img_motivacional\"> ");
      break;
    }
  case 4:
    {
      $("#ContainerVM").html("<img src=\"https://i.pinimg.com/originals/fb/6a/f3/fb6af3d1a2227c779aead8b94f9a8392.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 5:
    {
      $("#ContainerVM").html("<img src=\"https://i.pinimg.com/originals/db/2a/94/db2a94bdf0ce97cd082c41ad4563f4e2.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 6:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/cuando-sientas-que-vas-a-rendirte-piensa-en-por-que-empezaste-1024x1024.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 7:
    {
      $("#ContainerVM").html("<img src=\"http://el124.com/wp-content/uploads/2014/02/frases-motivadoras-para-el-trabajo-2.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 8:
    {
      $("#ContainerVM").html("<img src=\"https://1.bp.blogspot.com/-v-O4-3g-HYo/WwY8iw6ce5I/AAAAAAAAAV4/YyceWkH4sQM3L2cT6Y96Tn260co6ZSWGQCLcBGAs/s1600/FB_IMG_1527131294253.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 9:
    {
      $("#ContainerVM").html("<img src=\"https://i.pinimg.com/originals/b2/d4/9d/b2d49d9ec74b58f2286559942aa69713.png\" class=\"img_motivacional\">");
      break;
    }
  case 10:
    {
      $("#ContainerVM").html("<img src=\"https://i.pinimg.com/originals/d5/31/54/d531545b75b1e00af66680f590fdda66.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 11:
    {
      $("#ContainerVM").html("<img src=\"https://i.pinimg.com/originals/44/d4/2b/44d42b175e6460372a2e23ecf2d0d43e.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 12:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/deja-de-esperar-que-las-cosas-pasen-sal-ahi-fuera-y-haz-que-pasen-1024x1024.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 13:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/limpia-tu-mente-del-no-puedo-1-1024x1024.jpg\" class=\"img_motivacional\">");
      break;
    }
  case 14:
    {
      $("#ContainerVM").html("<img src=\"https://www.alcanzatussuenos.com/wp-content/uploads/2017/03/por-muy-alta-que-sea-la-monta%C3%B1a-siempre-hay-un-camino-hacia-la-cima-1024x1024.jpg\" class=\"img_motivacional\">");
      break;
    }


}
var tabla_llena = false;
var cookies_cargadas = false;
var c = true;

//variables contador gestion
var total_segundos = 0,
  gestionado_botones = false;

function cargar_gestion() {
    console.log('cargar gestión calendario');
//  $(".loader").fadeIn("slow");
  contador = -1;
  ////console.log("cargar_gestion :") ;
  $.post("../php/getAllClients_calendario.php", {
    ide: $("#identificador_usuario").html()
  }, function(mensaje) {
      json_clientes = [];
    ////console.log(mensaje) ;
    var cl = mensaje.split("=");
    //var cadena = "1|";
    var cadena = "";
    
    console.log('ayer:'+cl.length);
    let idx_cont=0;
    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      cadena += ($.trim(sc[0]) + "|");
      json_clientes.push({"idx":i,"codigo":$.trim(sc[0]),"coords":$.trim(sc[1]), "nombre":$.trim(sc[2]) ,"fecha":$.trim(sc[3]) ,"hora":$.trim(sc[4]) });
      idx_cont++;
    }
    console.log('ayer:'+(idx_cont-1));
    $.post("../php/getAllClients_calendario_hoy.php", {
        ide: $("#identificador_usuario").html()
      }, function(mensaje) {
          var cl = mensaje.split("=");
        
          console.log('hoy:'+cl.length);
            if(cl.length == 0 ){
                contador = 0;
            }
            for (var i = 0; i < cl.length - 1; i++) {
              var sc = cl[i].split("|");
              if(contador == -1){
                  console.log('asignar primer cliente temprano:'+$.trim(sc[0])+'-N:'+$.trim(sc[2]));
                  contador = idx_cont;
              }
              cadena += ($.trim(sc[0]) + "|");
              json_clientes.push({"idx":idx_cont,"codigo":$.trim(sc[0]),"coords":$.trim(sc[1]), "nombre":$.trim(sc[2]), "fecha":$.trim(sc[3]) ,"hora":$.trim(sc[4]) });
              idx_cont++;
            }
            console.log('contador:'+contador);
            console.log(json_clientes);
        cookies_cargadas = true;
        clientes_cookie_cargado = true;
        clientes_cookie = cadena;
        console.log(cadena);
        llenar_clientes();
        
      });
    

  });
}

function llenar_clientes( desdeReporte ) {
    
    console.log('llenar_clientes contador:'+contador);
    arr_codigos_tabla = [];
  // Si no se ha gestionado en los botones se guarda como tiempo muerto, de lo contrario no.
  $.when(function() {
    setTimeout(function() {}, 1000);
  }).then(function() {
    if (!gestionado_botones) {
      guardar_tiempo('tp', cliente_actual);
    }
  });

  /* Termina contador de gestion */
   vector = [];
  
  if (clientes_cookie === undefined) {
    alert("Error CO4503, por favor comunicate con el administrador de la plataforma.");
  }
    if(vector.length == 0)
   vector = clientes_cookie.split("|");
   console.log(vector);
   console.log('l vec:'+vector.length+'-last:'+vector[vector.length-1]+'--');
   vector.splice(-1);
   
   console.log('new vec:'+vector.length+'-last:'+vector[vector.length-1]+'--');
   console.log(vector);
   
    console.log('vector:');
    console.log(vector);
    
  if (c)
    c = false;

  cantidad_clientes = -1;

  for (var i = 0; i < vector.length; i++) {
    if (vector[i]!="") {
      cantidad_clientes++;
    }
    else{
        console.log("revisar post:"+i);
    }
  }
  console.log('cantidad_clientes:'+cantidad_clientes);
      console.log('contador:'+contador);

  if (typeof contador !== 'undefined') {

    if (contador > cantidad_clientes) {
        console.log("se reinicia contador");
      contador = 1;
    }

  }else {

    var codigo_cliente = $("#cliente_seleccionado").html();

    ////console.log(vector);

    console.log('codigo_cliente sel: '+codigo_cliente);

    for (var i = 0; i < vector.length; i++) {
      if (vector[i]==codigo_cliente && vector[i] != "") {
         contador = i ;                         //////////////////////////////////////////////////////////////////////////////////////////
      }
    }



  }
  console.log("contador:"+contador);
  var indice = contador;
  
  id_actual = vector[indice];
  arr_codigos_tabla.push(id_actual);
  console.log("id_actual" , id_actual) ;
  //console.log("codigo_clients: " , $("#cliente_seleccionado").html()) ;
  $.post('is_managing.php', {
    id: id_actual
  }, function(data) {

    //console.log('DATA', data);

    if (data==1) {

      //console.log('Is being managed');

      alert("Este cliente esta siendo gestionado por otro operador, sera dirigido al siguiente cliente");
        if (indice == cantidad_clientes) {
          indice = 1;
          contador = indice;
          $("#gestionarNext").removeClass('disabled');
        } else {
          indice++;
          contador = indice;
        }
        llenar_clientes();
        return;
    }

    if(!desdeReporte){
      manage_client(id_actual);
    }

    var id_anterior;
    let id_anterior_2=-1;
    let id_anterior_3=-1;
 
    console.log('indice:'+indice);
    //setClientesCercanos(id_actual);
    console.log('id_anterior_2:'+id_anterior_2+'-id_anterior_3:'+id_anterior_3);
    if( cantidad_clientes >= 7 ){
        if (indice > 1) {
        
          id_anterior = vector[indice - 1];
          if(indice <= 2 ){
              id_anterior_2 = vector[cantidad_clientes - 1];
              id_anterior_3 = vector[cantidad_clientes - 2];
             
          }
          else if(indice <= 3){
              id_anterior_2 = vector[indice - 2];
              id_anterior_3 = vector[cantidad_clientes - 1];
             
          }
          else{
              console.log('normal');
              id_anterior_2 = vector[indice - 2];
              id_anterior_3 = vector[indice - 3];
          }
          
        } else {
          id_anterior = vector[cantidad_clientes];
          if(vector[cantidad_clientes - 1] !== undefined){
              id_anterior_2 = vector[cantidad_clientes - 1]
          }
          if(vector[cantidad_clientes - 2] !== undefined){
              id_anterior_3 = vector[cantidad_clientes - 2]
          }
        }
    
        indice++;
        console.log('idx para sig 1:'+indice)
        var id_nxt = vector[indice];
        console.log('id_nxt:'+id_nxt+'--')
        
        if (id_nxt == "" || id_nxt === undefined) {
          id_nxt = vector[1];
        }
        else{
             arr_codigos_tabla.push(id_nxt);
       
        }
        console.log('id_nxt aft:'+id_nxt)
        
    
        indice++;
        console.log('idx para sig 2:'+indice)
        
        let data_siguiente = getIndiceSiguiente(indice);
        console.log(data_siguiente);
        var id_nxt2 = data_siguiente.codigo; //27072021 vector[indice];
        
        if (id_nxt2 == "" || id_nxt2 === undefined) {
          id_nxt2 = -1;
        }
        else{
            arr_codigos_tabla.push(id_nxt2);
        }
        indice = data_siguiente.idx;
        indice++;
        console.log('idx para sig 3:'+indice)
        
        data_siguiente = getIndiceSiguiente(indice);
        console.log(data_siguiente);
        var id_nxt3 = data_siguiente.codigo;//27072021 vector[indice];
        
        if (id_nxt3 == "" || id_nxt3 === undefined) {
          id_nxt3 = -1;
        }
        else{
            arr_codigos_tabla.push(id_nxt2);
        }
        console.log('sig2:'+id_nxt2+'-sig3:'+id_nxt3);
        indice = data_siguiente.idx;
        console.log('ult idx:'+indice)
    
    }
    else{
        console.log('no hay suficientes registros');
       
        switch( cantidad_clientes ){
            case 1:
                id_anterior = -1;
                id_anterior_2 = -1;
                id_anterior_3 = -1;
                id_nxt = -1;
                id_nxt2 = -1;
                id_nxt3 = -1;
                break;
            case 2:
                id_anterior = vector[indice - 1];
                id_anterior_2 = -1;
                id_anterior_3 = -1;
                id_nxt = -1;
                id_nxt2 = -1;
                id_nxt3 = -1;
                break;
            case 3:
                id_anterior = vector[indice - 1];
                id_anterior_2 = -1;
                id_anterior_3 = -1;
                 data_siguiente = getIndiceSiguiente(indice);
                console.log('case 3:');
                console.log(data_siguiente);
                id_nxt = data_siguiente.codigo;
                indice = data_siguiente.idx;
                id_nxt2 = -1;
                id_nxt3 = -1;
                break;
            case 4:
                id_anterior = vector[indice - 1];
                id_anterior_2 = vector[indice - 2];
                id_anterior_3 = -1;
                
                id_nxt2 = -1;
                id_nxt3 = -1;
                break;
            case 5:
                id_anterior = vector[indice - 1];
                id_anterior_2 = vector[indice - 2];
                id_anterior_3 = -1;
                console.log('id_anterior:'+id_anterior+'-id_anterior_2:'+id_anterior_2+'-:')
                console.log('case 5:');
                 data_siguiente = getIndiceSiguiente(indice);//fredd
                
                console.log(data_siguiente);
                id_nxt = data_siguiente.codigo;
                indice = data_siguiente.idx;
                indice++;
                data_siguiente = getIndiceSiguiente(indice);
                console.log('case 5 next2:');
                console.log(data_siguiente);
                id_nxt2 = data_siguiente.codigo;
                indice = data_siguiente.idx;
                
                id_nxt3 = -1;
                break;
            case 6:
                console.log('case 6 idx:'+indice);
                id_anterior = vector[indice - 1];
                id_anterior_2 = vector[indice - 2];
                id_anterior_3 = -1;//vector[indice - 3];
                data_siguiente = getIndiceSiguiente(indice);//fredd
                
                id_nxt = data_siguiente.codigo;
                indice = data_siguiente.idx;
                indice++;
                data_siguiente = getIndiceSiguiente(indice);
                console.log('case 6 next2:');
                console.log(data_siguiente);
                id_nxt2 = data_siguiente.codigo;
                data_siguiente = getIndiceSiguiente(indice);
                console.log('case 6 next3:');
                console.log(data_siguiente);
                
                id_nxt3 = data_siguiente.codigo;
                break;
            
        }
    }
    arr_codigos_tabla.push(id_anterior);
    arr_codigos_tabla.push(id_anterior_2);
    arr_codigos_tabla.push(id_anterior_3);
    /*27072021
    indice++;

    var id_nxt = vector[indice];

    if (id_nxt == "" || id_nxt === undefined) {
      id_nxt = vector[1];
    }
    else{
         arr_codigos_tabla.push(indice);
   
    }

    indice++;
    let data_siguiente = getIndiceSiguiente(indice);
    console.log(data_siguiente);
    var id_nxt2 = data_siguiente.codigo; //27072021 vector[indice];
    
    if (id_nxt2 == "" || id_nxt2 === undefined) {
      id_nxt2 = -1;
    }
    indice = data_siguiente.idx;
    indice++;
    data_siguiente = getIndiceSiguiente(indice);
    var id_nxt3 = data_siguiente.codigo;//27072021 vector[indice];
    
    if (id_nxt3 == "" || id_nxt3 === undefined) {
      id_nxt3 = -1;
    }
    console.log('sig2:'+id_nxt2+'-sig3:'+id_nxt3);
    indice = data_siguiente.idx;
    */
    indice--;
    contador++;
    //console.log("indice: " ,  indice) ;
    //console.log("contador" , contador ) ;
    var cook = "" + indice + "|";

    for (var l = 1; l < vector.length; l++) {
      cook += (vector[l] + "|");
    }
    console.log('id_actual antes when:'+id_actual)
    if(isNaN(id_actual)){
        alert("no hay clientes para hoy");
         $(".loader").fadeOut("slow");
        return;
    }
    
    $.when(
      

      $.post("../php/getDatosCliente1.php", 
      {
        id_act: id_actual,
        id_ant: id_anterior,
        id_next: id_nxt,
        id_next2: id_nxt2,
        id_next3:id_nxt3,
        id_ant2:id_anterior_2,
        id_ant3:id_anterior_3
        
      }, 
      function procesar(data){
        console.log(data.principal.fechas );//fred
        let html_nuevo_view='<tr>';
        if( data.anterior3 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior3.codigo+'">'+data.anterior3.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior2 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior2.codigo+'">'+data.anterior2.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior.codigo+'">'+data.anterior.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        html_nuevo_view+='<td class="col_principal" data-codigo="'+data.principal.codigo+'">'+data.principal.direccion+'</td>';
        
        if( data.siguiente != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente.codigo+'">'+data.siguiente.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente2 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente2.codigo+'">'+data.siguiente2.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente3 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente3.codigo+'">'+data.siguiente3.direccion+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        html_nuevo_view+='</tr><tr>';
        
        if( data.anterior3 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior3.codigo+'">'+data.anterior3.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior2 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior2.codigo+'">'+data.anterior2.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior.codigo+'">'+data.anterior.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        html_nuevo_view+='<td class="col_principal" data-codigo="'+data.principal.codigo+'">'+data.principal.nombre_completo+'</td>';
        
        if( data.siguiente != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente.codigo+'">'+data.siguiente.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente2 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente2.codigo+'">'+data.siguiente2.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente3 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente3.codigo+'">'+data.siguiente3.nombre_completo+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        
        html_nuevo_view+='</tr><tr>';
  
        if( data.anterior3 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior3.codigo+'">'+data.anterior3.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior2 != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior2.codigo+'">'+data.anterior2.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.anterior != null )
        html_nuevo_view+='<td class="col_anterior" data-codigo="'+data.anterior.codigo+'">'+data.anterior.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        html_nuevo_view+='<td class="col_principal" data-codigo="'+data.principal.codigo+'">'+data.principal.estado+'</td>';
        
        if( data.siguiente != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente.codigo+'">'+data.siguiente.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente2 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente2.codigo+'">'+data.siguiente2.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        if( data.siguiente3 != null )
        html_nuevo_view+='<td class="col_siguiente" data-codigo="'+data.siguiente3.codigo+'">'+data.siguiente3.estado+'</td>';
        else
        html_nuevo_view+='<td class="col_blanco" data-codigo=""></td>';
        
        html_nuevo_view+='</tr>';
  
  
        $('#tabla_previa').html(html_nuevo_view);
  
  
        
        
        /** siguiente 1 */
        $("#tabla_clienteN tbody").html("<tr><th scope=\"row\">" + 
        data.siguiente.nombre_completo + "</th><th>" + 
        data.siguiente.Datos_factura +  "</th><td>" + 
        data.siguiente.direccion  + "</td><td>" + 
        data.siguiente.telefono  + "<br>"+
        data.siguiente.tipo_persona_tel_cliente + "<br>"+
        data.siguiente.obser_tel_cliente +"</td><td>" + 
        data.siguiente.telefono_oficina  + "<br>"+
        data.siguiente.tipo_persona_tel_of + "<br>"+      
        data.siguiente.obser_tel_of +"</td><td>" + 
        data.siguiente.celular1  + "<br>"+
        data.siguiente.tipo_persona_cel1 + "<br>"+
        data.siguiente.obser_cel1 +"</td><td>" + 
        data.siguiente.celular2  + "<br>"+
        data.siguiente.tipo_persona_cel2 + "<br>"+
        data.siguiente.obser_cel2 +"</td><td>" + 
        data.siguiente.correo  + "</td><td>" + 
        data.siguiente.estado  + "</td></tr>");
  
         /** siguiente 2 */
         $("#tabla_clienteN2 tbody").html("<tr><th scope=\"row\">" + 
         data.siguiente2.nombre_completo + "</th><th>" + 
         data.siguiente2.Datos_factura +  "</th><td>" + 
         data.siguiente2.direccion  + "</td><td>" + 
         data.siguiente2.telefono  + "<br>"+
         data.siguiente2.tipo_persona_tel_cliente + "<br>"+
         data.siguiente2.obser_tel_cliente +"</td><td>" + 
         data.siguiente2.telefono_oficina  + "<br>"+
         data.siguiente2.tipo_persona_tel_of + "<br>"+      
         data.siguiente2.obser_tel_of +"</td><td>" + 
         data.siguiente2.celular1  + "<br>"+
         data.siguiente2.tipo_persona_cel1 + "<br>"+
         data.siguiente2.obser_cel1 +"</td><td>" + 
         data.siguiente2.celular2  + "<br>"+
         data.siguiente2.tipo_persona_cel2 + "<br>"+
         data.siguiente2.obser_cel2 +"</td><td>" + 
         data.siguiente2.correo  + "</td><td>" + 
         data.siguiente2.estado  + "</td></tr>");
  
  
          /** anterior */
        $("#tabla_clienteAN tbody").html("<tr><th scope=\"row\">" + 
        data.anterior.nombre_completo + "</th><th>" + 
        data.anterior.Datos_factura +  "</th><td>" + 
        data.anterior.direccion  + "</td><td>" + 
        data.anterior.telefono  + "<br>"+
        data.anterior.tipo_persona_tel_cliente + "<br>"+
        data.anterior.obser_tel_cliente +"</td><td>" + 
        data.anterior.telefono_oficina  + "<br>"+
        data.anterior.tipo_persona_tel_of + "<br>"+      
        data.anterior.obser_tel_of +"</td><td>" + 
        data.anterior.celular1  + "<br>"+
        data.anterior.tipo_persona_cel1 + "<br>"+
        data.anterior.obser_cel1 +"</td><td>" + 
        data.anterior.celular2  + "<br>"+
        data.anterior.tipo_persona_cel2 + "<br>"+
        data.anterior.obser_cel2 +"</td><td>" + 
        data.anterior.correo  + "</td><td>" + 
        data.anterior.estado  + "</td></tr>");
  
  
  
        if (data.principal.estado !== "Por gestionar") {
            console.log(data.principal.fechas);
            let arr_fechas = data.principal.fechas.split(",");
            let str_fechas = '';
            if( arr_fechas.length > 4) {
                for( let i = 0; i < 5; i++){
                    str_fechas+=arr_fechas[i]+'</br>';
                }
            }
            else{
                str_fechas = arr_fechas.join("</br>");
            }
            console.log(str_fechas);
            $("#tabla_clienteA tbody").html("<tr><th scope=\"row\">" + 
            str_fechas + "</th><th>" + 
            data.principal.nombre_completo + "</th><th>" + 
            data.principal.Datos_factura +  "</th><td>" + 
            data.principal.direccion  + "</td><td>" + 
            data.principal.telefono  + "<input type='text' id='telefono_casa' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_tel_cliente + "<br>"+
            data.principal.obser_tel_cliente +"</td><td>" + 
            data.principal.telefono_oficina  + "<input type='text'id='Telefono_Trabajo' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_tel_of + "<br>"+      
            data.principal.obser_tel_of +"</td><td>" + 
            data.principal.celular1  + "<input type='text' id='Celular_1' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_cel1 + "<br>"+
            data.principal.obser_cel1 +"</td><td>" + 
            data.principal.celular2  + "<input type='text' id='Celular_2' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_cel2 + "<br>"+
            data.principal.obser_cel2 +"</td><td>" + 
            data.principal.numero_libre+"</td><td>" + 
            data.principal.correo  + "</td><td>" + 
            data.principal.estado  + "<br><span class=\"badge badge-pill badge-dark\">Ultima gestion</span><p class=\"h7\"><br>"+
            data.principal.fecha_gestionp+"<br>"+
            data.principal.operador+"</td><td>" + 
            data.principal.info_cisterna  + "</td></tr>");
      
        } else {
            $("#tabla_clienteA tbody").html("<tr><th scope=\"row\">" + 
            data.principal.nombre_completo + "</th><th>" + 
            data.principal.Datos_factura +  "</th><td>" + 
            data.principal.direccion  + "</td><td>" + 
            data.principal.telefono  + "<br>"+
            data.principal.tipo_persona_tel_cliente + "<br>"+
            data.principal.obser_tel_cliente +"</td><td>" + 
            data.principal.telefono_oficina  + "<br>"+
            data.principal.tipo_persona_tel_of + "<br>"+      
            data.principal.obser_tel_of +"</td><td>" + 
            data.principal.celular1  + "<br>"+
            data.principal.tipo_persona_cel1 + "<br>"+
            data.principal.obser_cel1 +"</td><td>" + 
            data.principal.numero_libre+"</td><td>" + 
            data.principal.celular2  + "<br>"+
            data.principal.tipo_persona_cel2 + "<br>"+
            data.principal.obser_cel2 +"</td><td>" + 
            data.principal.correo  + "</td><td>" + 
            data.principal.estado  + "</td><td>" + 
            data.principal.info_cisterna  + "</td></tr>");      
            
            
        }
        
        console.log(data.principal.comentarios);
        $("#comentarios").val(data.principal.comentarios);
        $("#comentariosG").val(data.principal.comentarios_gestion);
  
        cliente_actual = $.trim(data.principal.codigo);
        $("#cliente_selc_pargestion").val(cliente_actual);

        nombre_cliente_actual = data.principal.nombre_completo;
        cliente_espacios = data.principal.codigo;
        if (data.principal.estado === "Equivocado") {
          $("#tabla_clienteA").removeClass('table-dark');
          $("#tabla_clienteA").removeClass('table-success');
          $("#tabla_clienteA").addClass('table-danger');
        } else if (data.principal.estado === "Averiado") {
          $("#tabla_clienteA").removeClass('table-dark');
          $("#tabla_clienteA").removeClass('table-danger');
          $("#tabla_clienteA").addClass('table-success');
        } else {
          $("#tabla_clienteA").removeClass('table-danger');
          $("#tabla_clienteA").removeClass('table-success');
          $("#tabla_clienteA").addClass('table-dark');
        }
  
        $.when($.post("../php/gestionado.php", {
          id_act: cliente_actual
        }, function(mensaje) {
          if (mensaje == 1) {
            $("#Cliente_gestionado").removeClass("hide");
          }
        })).then(function() {
          Cookies.set("llamadas_operador", cook);
          clientes_cookie_cargado = true;
          clientes_cookie = cook;
          //console.log("cook:" , cook) ;
          //console.log("vector: " , vector) ;
        });
  
  
      }, 
      "json")



    
    ).then(function() {
      $(".loader").fadeOut("slow");
      $("#gestionarNext").removeClass('disabled');
      $("#gestionarNext2").removeClass('disabled');
      $("#gestionarAnterior").removeClass('disabled');
      $(".search").fadeOut("fast");
    });
  });

}

function actualizarCookie(search){

  $.post("../php/getAllClients_calendario.php", {
    ide: $("#identificador_usuario").html(),
    cliente:$("#cliente_seleccionado").html()
  }, function(mensaje) {

    var cl = mensaje.split("=");
    var cadena = "1|";

    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      cadena += ($.trim(sc[0]) + "|");
    }
    aux_cadena = cadena.slice(0, -1);
    cadena = aux_cadena;
    cookies_cargadas = true;
    clientes_cookie_cargado = true;
    clientes_cookie = cadena;
    llenar_clientes(search);
  });

}

function manage_client(id){
  $.post('manage_client.php', {id: id}, function(data) {});
}

function release_client(index){

  ////console.log('index dentro de release_client: '+index);

  var vector = clientes_cookie.split("|")

  ////console.log('Vector dentro de release_client: '+vector);

  var id= vector[index];
  //console.log("id" , id) ;
  //console.log("release_client: " , id) ;
  ////console.log('id detro de release_client: '+id);
//alert(id);


  $.post('release_client.php', {
    id: id
  },
  function() {

  });

}

function release_client_id(id,llenar_cli=false){

  //cargar_gestion();

  $.post('release_client.php', {
    id: id
  },
  function() {
    if(llenar_cli){
        console.log('llenar cliente despues de libera');
        llenar_clientes(); 
    }
  });

}

function llenar_llamadas() {
  if (!esta_importante) {
    $("#botonUrgente").fadeIn("fast");
    $("#tableDanger").fadeIn("fast");
  }
  $.post("../php/getClientsByUser_recordatorio.php", {
    ide: $.trim($("#identificador_usuario").html()),
    hoy: getDia()
  }, function(mensaje) {
    var cl = mensaje.split("=");
    $("#registrosD tbody").html("");
    
    let opciones='';
    $('#sel_llamadas_urgentes').find('option').not(':first').remove();;
    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      var some = $("#registrosD tbody").html();
      $("#registrosD tbody").html(some + "<tr><th scope=\"row\">" + sc[0] + "</th><td>" + sc[4] + "</td><td>" + sc[1] + "</td><td>" + sc[2] + "</td></tr>");
    
        //23072021
        
        opciones+='<option value="'+sc[0]+'">'+sc[4]+'</option>';
    }
    
    $('#lb_recordatorio_vencido').text(cl.length);
    $('#sel_llamadas_urgentes').append(opciones).select2();
    if (cl.length == 0) {
      $("#snackbar").html("No hay llamadas programadas para hoy, ya puedes pasar a gestion de llamadas.");
      $("#snackbar").addClass('show');
      setTimeout(function() {
        $("#snackbar").removeClass('show');
      }, 5000);

    }
    Cookies.set("llamadas_urgentes", "");
  });

  var tmw = getNxtDia();
  var nxw = getSemana();
  $.post("../php/getClientsByWeek.php", {
    ide: $("#identificador_usuario").html(),
    inicio: tmw,
    fin: nxw
  }, function(mensaje) {
    $("#registrosW tbody").html("");
    var cl = mensaje.split("=");
    let opciones='';
    $('#sel_llamadas_semanales').find('option').not(':first').remove();
    
    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      
      $("#registrosW tbody").append("<tr><th scope=\"row\">" + sc[0] + "</th><td>" + sc[4] + "</td><td>" + sc[1] + "</td><td>" + sc[2] + "</td></tr>")
    
        opciones+='<option value="'+sc[0]+'">'+sc[4]+'</option>';
        
    }
    $('#sel_llamadas_semanales').append(opciones).select2();
    
    tabla_llena = true;
    $(".loader").fadeOut("slow");
  });
  $("#registrosD tbody").delegate('tr', 'click', function() {
    $(".loader").fadeIn("fast");
    var datos = (this.outerHTML).split("</");
    var aux = datos[0].split(">");
    var identificadorU = aux[2];
    gestionar_urgente(identificadorU);
  });
  $("#registrosW tbody").delegate('tr', 'click', function() {
    $(".loader").fadeIn("fast");
    var datos = (this.outerHTML).split("</");
    var aux = datos[0].split(">");
    var identificadorU = aux[2];
    gestionar_urgente(identificadorU);
  });
  var llama = Cookies.get("llamadas_urgentes");
}




function gestionar_urgente(id_cliente) {
    if(arr_id_modals.length >= max_recordatorios){
        console.log('llegó a max');
        alert('Debe gestionar las notificaciones actuales');
         $(".loader").fadeOut("fast");
        return;
    }
    mimimizarModalActual();
    id_cliente = id_cliente.trim();
    idx_gestion = arr_id_gestionar.indexOf(id_cliente);
    id_modal = 'gestionModal';
    let clonar = false;
    console.log(id_cliente+'-idx:'+idx_gestion+'-ancho:'+margen_modal);
    
    if( idx_gestion > -1){
        id_modal = arr_id_modals[idx_gestion];
        console.log('-id_modal:'+id_modal);
    }
    else{
        arr_id_gestionar.push(id_cliente);
        
        id_modal = 'gestionModal_'+id_cliente;
        arr_id_modals.push(id_modal);
        clonar = true;
        
    }
    
  cliente_urgente_actual = $.trim(id_cliente);
  $.when($.post("../php/obtenerDatosCliente.php", {
    if: $.trim(id_cliente)
  }, function(mensaje) {
    //console.log('MENSAJE--', mensaje)
    if( clonar ){
        let clone_modal = $('#modal_base_gestion').html();
        clone_modal = clone_modal.replaceAll('%id%',id_cliente); 
        $('body').append(clone_modal);
    }
    else{
        console.log('ya existe');
    }
    //20082021
    console.log('codigo_cli_anterior:'+codigo_seleccionado_aux);//20082021 problema cli sel
        if( $("#cliente_selc_pargestion").val().trim() != '' ){
            console.log('había anterior');
            codigo_seleccionado_aux = $("#cliente_selc_pargestion").val();
            console.log(' anterior '+codigo_seleccionado_aux);
        }
    var w = mensaje.split("|");
    $("#cliente_selc_pargestion").val($.trim(id_cliente))

    $("#tabla_clienteU_"+id_cliente+" tbody").html("<tr><th scope=\"row\">" + w[1] + "</th><th>" + w[2] + "</th><td>" + w[3] + "</th><td>" + w[11] + "</td></tr>");
    $("#tabla_clienteU2_"+id_cliente+" tbody").html("<tr></td><td>" + w[4] + "</td><td>" + w[5] + "</td><td>" + w[6] + "</td><td>" + w[7] + "</td><td>" + w[8] + "</td></tr>");
    $("#comentariosU_"+id_cliente+"").val(w[9]);
    $("#comentariosUG_"+id_cliente+"").val(w[10]);
    nombre_cliente_actual = w[1];
  })).then(function() {
    

    //alert($.trim(id_cliente))
    total_segundos = 0;
    if (!esta_aumentando) {
      aumentar_segundos_gestion();
      esta_aumentando = true;
    }

    $(".loader").fadeOut("fast");
    $("#gestionModal_"+id_cliente+"").modal({backdrop: false, keyboard: false});//25072021
    $("body").removeClass("modal-open");
    id_modal_actual = "gestionModal_"+id_cliente+"";
    console.log(arr_id_gestionar);
    console.log(arr_id_modals);
    dragElement(document.getElementById("gestionModal_"+id_cliente));
  });

}

function getDistancia(item, origen) {
  var coordenadas = item['coordenada'].split(",");
  var destino = $.trim(coordenadas[0]) + "," + $.trim(coordenadas[1]);
  $.post("../php/Distancia.php", {
    c1: origen,
    c2: destino
  }, function(mensaje) {
    var object = JSON.parse(mensaje);
    var d = object['rows'][0]['elements'][0]['distance']['value'];
    var nombre = "distancia" + item['id'];
    Cookies.set(nombre, d);
  });
}

function pausecomp(millis) {
  var date = new Date();
  var curDate = null;
  do {
    curDate = new Date();
  }
  while (curDate - date < millis);
}

function getDia() {
  var f = new Date();
  var cad = "";
  if (f.getDate() < 10)
    cad += "0" + f.getDate() + "/";
  else
    cad += f.getDate() + "/";
  if ((f.getMonth() + 1) < 10)
    cad += "0" + (f.getMonth() + 1) + "/";
  else
    cad += (f.getMonth() + 1) + "/";

  cad += f.getFullYear();

  return cad;
}

function getNxtDia() {
  var f = new Date();
  var cad = "";
  var dia = parseInt(f.getDate()) + 1;
  var mes = parseInt(f.getMonth()) + 1;
  if (dia < 10)
    cad += "0" + dia + "/";
  else
    cad += dia + "/";
  if (mes < 10)
    cad += "0" + mes + "/";
  else
    cad += mes + "/";

  cad += f.getFullYear();

  return cad;
}

function getSemana() {
  var f = new Date();
  var cad = "";
  var dia = parseInt(f.getDate()) + 7;
  var mes = parseInt(f.getMonth()) + 1;
  if (dia < 10) {
    cad += "0" + dia + "/";
  } else
    cad += dia + "/";
  if (mes < 10)
    cad += "0" + mes + "/";
  else
    cad += mes + "/";

  cad += f.getFullYear();

  return cad;
}

$('.datepicker').datepicker({
  todayHighlight: true,
  showOnFocus: true,
  format: 'dd/mm/yyyy',
  uiLibrary: 'bootstrap4'
});

$('.fechapicker').datepicker({
  todayHighlight: true,
  showOnFocus: true,
  format: 'dd/mm/yyyy',
  uiLibrary: 'bootstrap4'
});

function convertir_fecha(cad) {
  var x = cad.split("/");
  var aux = x[0] + "/" + x[1] + "/" + x[2];
  return aux;
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

var tiempo = {
  hora: 0,
  minuto: 0,
  segundo: 0
};

$("#descansar").click(function() {
  bandera = true;
  tiempo_inactivo();
  $("#ModalD").modal();
  reactivar_actividad();
});

var bandera = true;

function tiempo_inactivo() {
  if (bandera) {
    setTimeout(function() {
      // Segundos
      tiempo.segundo++;
      if (tiempo.segundo >= 60) {
        tiempo.segundo = 0;
        tiempo.minuto++;
      }
      // Minutos
      if (tiempo.minuto >= 60) {
        tiempo.minuto = 0;
        tiempo.hora++;
      }

      $("#tiempoI").html(convertir_tiempo(tiempo.hora, tiempo.minuto, tiempo.segundo));
      reactivar_actividad();
      tiempo_inactivo();
    }, 1000);
  } else
    return;
}

$("#volverT").click(function() {
  bandera = false;
  horasT = tiempo.hora;
  minutosT = tiempo.minuto;
  segundosT = tiempo.segundo;
  $("#ModalD").modal('toggle');
  reactivar_actividad();
});

$("#almorzar").click(function() {
  bandera = true;
  tiempo_almuerzo();
  $("#ModalAL").modal();
  reactivar_actividad();
});

var tiempoA = {
  hora: 0,
  minuto: 0,
  segundo: 0
}

var bandera2 = true;

function tiempo_almuerzo() {
  if (bandera2) {
    setTimeout(function() {
      // Segundos
      tiempoA.segundo++;
      if (tiempoA.segundo >= 60) {
        tiempoA.segundo = 0;
        tiempoA.minuto++;
      }
      // Minutos
      if (tiempoA.minuto >= 60) {
        tiempoA.minuto = 0;
        tiempoA.hora++;
      }

      $("#tiempoALM").html(convertir_tiempo(tiempoA.hora, tiempoA.minuto, tiempoA.segundo));
      reactivar_actividad();
      tiempo_almuerzo();
    }, 1000);
  } else
    return;
}

$("#volverTA").click(function() {
  bandera2 = false;
  horasA = tiempoA.hora;
  minutosA = tiempoA.minuto;
  segundosA = tiempoA.segundo;
  $("#ModalAL").modal('toggle');
  reactivar_actividad();
});

/*comentado 01022021
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
*/
$("#addCN").click(function() {
  $("#ModalNC").modal();
  reactivar_actividad();
});

$("#agregarCN").click(function() {
  reactivar_actividad();
  var idC = $.trim($("#ID_clienteW").val());
  var corC = $.trim($("#coordenadas_cliente").val());
  var nomC = $.trim($("#nombre_cliente").val());
  var datC = $.trim($("#datos_factura").val());
  var dirC = $.trim($("#direccion_cliente").val());
  var telC = $.trim($("#tel_cliente").val());
  var teloC = $.trim($("#tel_of").val());
  var cel1C = $.trim($("#cel1").val());
  var cel2C = $.trim($("#cel2").val());
  var mailC = $.trim($("#correoC").val());
  var comC = $.trim($("#comentarios_cliente").val());
  var icis = $.trim($("#cisterna").val());

  var obser1 = $.trim($("#obser_tel_cliente").val());
  var obser2 = $.trim($("#obser_tel_of").val());
  var obser3 = $.trim($("#obser_cel1").val());
  var obser4 = $.trim($("#obser_cel2").val());
  var persona1 = $.trim($("#tipo_persona_tel_cliente").val());
  var persona2 = $.trim($("#tipo_persona_tel_of").val());
  var persona3 = $.trim($("#tipo_persona_cel1").val());
  var persona4 = $.trim($("#tipo_persona_cel2").val());
    //27072021
    var numerolibre =$("#numerolibre").val();
    console.log(numerolibre);

    
  if (idC == "" || corC == "" || nomC == "" || dirC == "" || telC == "") {
    alert("Tienes que llenar todos los campos obligatorios!");
  } else {
    var telefono_correcto = true;
    if ($("#tel_cliente").val().length == 9) {

      if (teloC !== "") {
        if ($("#tel_of").val().length != 9) {
          telefono_correcto = false;
        }
      }
      if (cel1C !== "") {
        if ($("#cel1").val().length != 10) {
          telefono_correcto = false;
        }
      }
      if (cel2C !== "") {
        if ($("#cel2").val().length != 10) {
          telefono_correcto = false;
        }
      }
    } else {
      telefono_correcto = false;
    }
    if (!telefono_correcto) {
      alert("Error, recuerda que un celular tiene 10 digitos y un telefono fijo tiene 9.");
      return;
    }
    $.post('../php/agregarCliente.php', {
      id: idC,
      cor: corC,
      nom: nomC,
      dat: datC,
      dir: dirC,
      tel: telC,
      telo: teloC,
      cel1: cel1C,
      cel2: cel2C,
      mail: mailC,
      com: comC,
      obser1:obser1,
      obser2:obser2,
      obser3:obser3,
      obser4:obser4,
      persona1:persona1,
      persona2:persona2,
      persona3:persona3,
      persona4:persona4,
      ope: $("#identificador_usuario").html(),
      isis: icis,
      numerolibre:numerolibre
    }, function(mensaje) {

      if (mensaje == 1) {
        $("#ID_clienteW").val("");
        $("#coordenadas_cliente").val("");
        $("#nombre_cliente").val("");
        $("#datos_factura").val("");
        $("#direccion_cliente").val("");
        $("#tel_cliente").val("");
        $("#tel_of").val("");
        $("#cel1").val("");
        $("#cel2").val("");
        $("#correoC").val("");
        $("#comentarios_cliente").val("");
        $("#cisterna").val("");
        $("#ModalNC").modal('toggle');
        //console.log("contador: " , contador);
        release_client(contador-1)
        cargar_gestion();
      } else {
        alert("Hubo un problema creando el cliente, intentelo de nuevo mas tarde.\n\n Si el problema persiste contacte con el administrador y proporcionele el siguiente codigo de error:\n\n" + mensaje);
      }
    });
  }

});

$("#rh").click(function() {
  reactivar_actividad();
  $.post('../php/obtenerHistorial.php', {
    if: cliente_actual
  }, function(mensaje) {
    $("#resumenH").val(mensaje);
    $("#ModalRH").modal();
  });
});

$("#resume_h").click(function() {
  reactivar_actividad();
  $.post('../php/obtenerHistorial.php', {
    if: cliente_urgente_actual
  }, function(mensaje) {
    $("#resumenH").val(mensaje);
    $("#ModalRH").modal();
  },"json");
});

$("#cerrarH").click(function(event) {
  reactivar_actividad();
  $("#ModalRH").modal("toggle");
});

      $("#modCA").click(function() {
        reactivar_actividad();
        let url = 'Modulo_Usuario.php?editar_cliente='+cliente_actual;
        console.log(url);
        window.open(url,'_blank');
        
    });

$("#actualizarC").click(function() {
  var idC = $("#ID_clienteM").val();
  var corC = $("#coordenadas_clienteM").val();
  var nomC = $("#nombre_clienteM").val();
  var datC = $("#datos_facturaM").val();
  var dirC = $("#direccion_clienteM").val();
  var telC = $("#tel_clienteM").val();
  var teloC = $("#tel_ofM").val();
  var cel1C = $("#cel1M").val();
  var cel2C = $("#cel2M").val();
  var mailC = $("#correoCM").val();
  var comC = $("#comentarios_clienteM").val();
  var infoC = $("#cisternaM").val();

  var obser1 = $.trim($("#obser_tel_clienteM").val());
  var obser2 = $.trim($("#obser_tel_ofM").val());
  var obser3 = $.trim($("#obser_cel1M").val());
  var obser4 = $.trim($("#obser_cel2M").val());
  var persona1 = $.trim($("#tipo_persona_tel_clienteM").val());
  var persona2 = $.trim($("#tipo_persona_tel_ofM").val());
  var persona3 = $.trim($("#tipo_persona_cel1M").val());
  var persona4 = $.trim($("#tipo_persona_cel2M").val());
    
  //27072021
  var numerolibre =$("#numerolibreM").val();
    console.log(numerolibre);
if(nomC=="--CLIENTE REPETIDO--"){
  alert("Eliminar");

  $.post('../php/delete_client.php', {
    id: idC,
  }, function(mensaje) {
   
      $("#ModalMC").modal('toggle');
      cargar_gestion();
    
  });
}
else{

  if (idC == "" || corC == "" || nomC == "" || dirC == "" || telC == "") {
    alert("No puede borrar un campos obligatorio!");
  } else {
    var telefono_correcto = true;
    if ($("#tel_clienteM").val().length == 9) {
      if (teloC !== "") {
        if ($("#tel_ofM").val().length != 9) {
          telefono_correcto = false;
        }
      }
      if (cel1C !== "") {
        if ($("#cel1M").val().length != 10) {
          telefono_correcto = false;
        }
      }
      if (cel2C !== "") {
        if ($("#cel2M").val().length != 10) {
          telefono_correcto = false;
        }
      }
    } else {
      telefono_correcto = false;
    }
    if (!telefono_correcto) {
      alert("Error, recuerda que un celular tiene 10 digitos y un telefono fijo tiene 9.");
      return;
    }
    console.log('tt');
    let datapost = {
      id: idC,
      cor: corC,
      nom: nomC,
      dat: datC,
      dir: dirC,
      tel: telC,
      telo: teloC,
      cel1: cel1C,
      cel2: cel2C,
      mail: mailC,
      com: comC,
      obser1:obser1,
      obser2:obser2,
      obser3:obser3,
      obser4:obser4,
      persona1:persona1,
      persona2:persona2,
      persona3:persona3,
      persona4:persona4,
      ope: $("#identificador_usuario").html(),
      ic: infoC,
      numerolibre:numerolibre,
    }
    console.log(datapost)
    $.post('../php/actualizarCliente.php', datapost , function(mensaje) {
      if (mensaje == 1) {
        $("#ModalMC").modal('toggle');
        cargar_gestion();
      } else {
        alert("Hubo un problema actualizando el cliente, intentelo de nuevo mas tarde.");
      }
    });
  }

}
});

//botones gestion
$("#btn_acepto").click(function() {
    console.log(nombre_cliente_actual);
  $("#fechaAcepto").val(getDia());
  $("#idcl").val(nombre_cliente_actual);
  //$(".fechapicker").datepicker("open");
  $("#horas_ocupadas").html('');
  $("#ModalA").modal();
  reactivar_actividad();
});
$("#btn_rechazo").click(function() {
    console.log(nombre_cliente_actual);
  $("#horaRechazo").val(getHora());
  $("#fechaRechazo").val(getDia());
  $("#idclR").val(nombre_cliente_actual);
  $("#ModalRE").modal();
  reactivar_actividad();
});
/*
$("#btn_volverU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("vl");
  urge = true;
  reactivar_actividad();
});*/

$("#btn_volverU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;

  
  $("#cliente_selc_pargestion").val(cliente_actual)
  //$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("vl");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  urge = true;
  reactivar_actividad();
});



$("#btn_volver").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  //$(".fechapicker").datepicker("open");

  $("#ModalR").modal();
  $("#tipoModal").html("vl");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  reactivar_actividad();
});


/*
$("#btn_Nresponde").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  ///$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("nr");
  reactivar_actividad();
});

$("#btn_equivocado").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("eq");
  reactivar_actividad();
});


$("#btn_otro").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("ot");
  reactivar_actividad();
});

$("#btn_averiado").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("av");
  reactivar_actividad();
});
*/
$("#btn_averiado").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $("#ModalR").modal();
  $("#tipoModal").html("av");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  reactivar_actividad();
});






$("#btn_otro").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $("#ModalR").modal();
  $("#tipoModal").html("ot");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  reactivar_actividad();
});





$("#btn_equivocado").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $("#ModalR").modal();
  $("#tipoModal").html("eq");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  reactivar_actividad();
});






$("#btn_Nresponde").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  $("#ModalR").modal();
  $("#tipoModal").html("nr");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  reactivar_actividad();
});





/*Botones gestion urgente*/
$("#btn_aceptoU").click(function() {
  $("#fechaAcepto").val(getDia());
  $("#idcl").val(nombre_cliente_actual);
  //$(".fechapicker").datepicker("open");
  cliente_actual = cliente_urgente_actual;
  $("#cliente_selc_pargestion").val(cliente_urgente_actual)

  $("#horas_ocupadas").html('');
  $("#ModalA").modal();
  urge = true;
  reactivar_actividad();
});




$("#btn_rechazoU").click(function() {
  $("#horaRechazo").val(getHora());
  $("#fechaRechazo").val(getDia());
  $("#idclR").val(nombre_cliente_actual);
  //cliente_actual = cliente_urgente_actual;
  $("#ModalRE").modal();
  urge = true;
  reactivar_actividad();
});







/*

$("#btn_NrespondeU").click(function() {
  reactivar_actividad();
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("nr");
  urge = true;
});
$("#btn_otroU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("ot");
  urge = true;
  reactivar_actividad();
});
$("#btn_equivocadoU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("eq");
  urge = true;
  reactivar_actividad();
});
$("#btn_averiadoU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;
  $(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("av");
  urge = true;
  reactivar_actividad();
});
*/




$("#btn_NrespondeU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;

  //$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("nr");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  urge = true;
  reactivar_actividad();
});







$("#btn_otroU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;

  //$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("ot");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  urge = true;
  reactivar_actividad();
});











$("#btn_equivocadoU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;

  //alert(cliente_actual)
$("#cliente_selc_pargestion").val(cliente_actual);

  //$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("eq");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  urge = true;
  reactivar_actividad();
});




$("#btn_averiadoU").click(function() {
  $("#idCliente").val(nombre_cliente_actual);
  cliente_actual = cliente_urgente_actual;

  //$(".fechapicker").datepicker("open");
  $("#ModalR").modal();
  $("#tipoModal").html("av");
  $("#tabla_hora").hide();
  $("#hora").val('');
  $("#minuto").val('');
  $("#hora_mos").val('');
  $("#minuto_mos").val('');
  if($("#fechaLlamada").val()!=""){
    $.post("../php/horas_ocupadas.php", 
    {
      fecha:$("#fechaLlamada").val(),
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
  }  
  urge = true;
  reactivar_actividad();
});


















//botones modal gestion urgente
$("#GuardarA").click(function() {
  reactivar_actividad();
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
    cliente = cliente_actual;
    comentario = $("#comment").val();

    let response_data = guardar_tiempo('ac', $("#cliente_selc_pargestion").val());
    
    console.log('response_data  :');
    console.log(response_data);
    if(response_data.data == 1){
    
        $.post("../php/valida_hora_acepto.php", {
          id_act: $("#cliente_selc_pargestion").val(),
          fecha: fecha,
          hora: hora
        }, function(data) {
    
            if (data.estado == "insertar") {
    
                    $.post('../php/llamadaRealizada.php', {
                      cl: $("#cliente_selc_pargestion").val()
                    }, function(mensaje) {});
                
                    $.post('release_client.php', {
                      id: $("#cliente_selc_pargestion").val()
                    },
                    function() {  
                    });
                
                
                    $.post("../php/Cliente_acepto.php", {
                      id_act: $("#cliente_selc_pargestion").val(),
                      fecha: fecha,
                      hora: hora,
                      comentario: comentario
                    }, function(mensaje) {
                        if (mensaje == 1) {
                                  $("#snackbar").html("El cliente acepto, y ha sido gestionado con éxito.");
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
                
                        llenar_llamadas();
                            if (urge) {
                              urge = false;
                              //11082021
                              console.log('elimina gestionModal urgente:gestionModal_'+$("#cliente_selc_pargestion").val());
                              cerrarModal(''+$("#cliente_selc_pargestion").val());
                              
                              //$("#gestionModal").modal('toggle');
                            }
                        $("#mensaje_error_acepto").addClass('hide');
                        sumar_gestion('ac', $("#cliente_selc_pargestion").val());
                        gestionado_botones = true;
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
    
        
    }
    else{
        alert(response_data.msj);
        console.log('no puede continuar no hay sesion');
    }
    







  }


});





$("#GuardarR").click(function() {
  reactivar_actividad();
  $("#GuardarR").addClass('disabled');
  $("#GuardarR").html("Guardando...");
  if ($("#fechaRechazo").val() == "") {
    alert("La fecha es obligatoria!");
    $("#GuardarR").removeClass('disabled');
    $("#GuardarR").html("Guardar");
  } else {

    var fecha, hora, cliente, comentario;
    fecha = $("#fechaRechazo").val();
    hora = $("#horaRechazo").val();
    cliente = cliente_actual;
    comentario = $("#commentRE").val();
    $.post('../php/llamadaRealizada.php', {
      cl: cliente
    }, function(mensaje) {});
    release_client(cliente);
    $.post("../php/Cliente_rechazo.php", {
      id_act: cliente,
      fecha: fecha,
      hora: hora,
      comentario: comentario
    }, function(mensaje) {
      if (mensaje == 1) {
        $("#snackbar").html("El cliente rechazo, y ha sido gestionado con éxito.");
        $("#snackbar").addClass('show');
        setTimeout(function() {
          $("#snackbar").removeClass('show');
        }, 10000);
        if (!urge) {
          llenar_clientes();
        }
        $("#ModalRE").modal('toggle');
        $("#commentE").val("");
        $("#fechaRechazo").val("");
        $("#GuardarR").removeClass('disabled');
        $("#GuardarR").html("Guardar");
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
        llenar_llamadas();

        if (urge) {
          urge = false;
          //11082021
          console.log('elimina rechazó gestionModal urgente:gestionModal_'+$("#cliente_selc_pargestion").val());
          cerrarModal(''+$("#cliente_selc_pargestion").val());
        
          //$("#gestionModal").modal('toggle');
        }
        sumar_gestion('re', cliente);
        gestionado_botones = true;
        guardar_tiempo('re', cliente_actual);

      }

    });

  }

});

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
    var tipo = $("#tipoModal").html();    
    fecha = $("#fechaLlamada").val();
    hora = convertir_hora($("#hora").val(), $("#minuto").val());
    cliente = cliente_actual;
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
              if (clientes_cookie_cargado) {
                llenar_clientes();
              }
              $("#snackbar").html("El cliente ha sido reprogramado con éxito.");
              $("#snackbar").addClass('show');
              setTimeout(function() {
                $("#snackbar").removeClass('show');
              }, 10000);
              $("#ModalR").modal('toggle');
              $("#commentR").val("");
              $("#fechaLlamada").val("");

              $("#hora").val("");
              $("#minuto").val("");
              $("#hora_mos").val("");
              $("#minuto_mos").val("");

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
              llenar_llamadas();
              if (urge) {
                urge = false;
                //11082021
                console.log('elimina averiado gestionModal urgente:gestionModal_'+$("#cliente_selc_pargestion").val());
                cerrarModal(''+$("#cliente_selc_pargestion").val());
                 
                //$("#gestionModal").modal('toggle');
              }
              sumar_gestion(tipo, cliente);
              gestionado_botones = true;
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













function release_client_p(index){

  ////console.log('index dentro de release_client: '+index);

  // var vector = clientes_cookie.split("|")

  ////console.log('Vector dentro de release_client: '+vector);

  // var id= vector[index];
  var id= index;
  ////console.log("id" , id) ;
  ////console.log("release_client: " , id) ;
  ////console.log('id detro de release_client: '+id);

  $.post('release_client.php', {
    id: id
  },
  function() {

  });

}

function diferencia_horas(h, m, h2, m2) {
  t1 = new Date();
  t2 = new Date();
  t1.setHours(h, m, "00");
  t2.setHours(h2, m2, "00");

  var h_final = (t1.getHours() - t2.getHours());
  if (h_final < 0) {
    h_final = 0;
    var m_final = 60 - (t1.getMinutes() - t2.getMinutes());
    if (m_final < 0) {
      m_final *= (-1);
    }
    if (m_final == 60) {
      m_final = 0;
      h_final = 1;
    }
  } else {
    var m_final = (t1.getMinutes() - t2.getMinutes());
    if (m_final < 0) {
      m_final *= (-1);
    }

  }

  var d_final = {
    hora: (h2 + ":" + m2),
    horas: h_final,
    minutos: m_final
  };
  return d_final;
}
$("#gestionarAnterior").click(function() {
  $("#gestionarAnterior").addClass('disabled');
  var indice = contador;
  indice--;
  release_client(indice);
  if (indice == 1) {
    indice = cantidad_clientes;
    contador = indice;
    $("#gestionarAnterior").removeClass('disabled');
  } else {
    indice--;
    contador = indice;
  }
  llenar_clientes();
  reactivar_actividad();
});

$("#gestionarNext").click(function() {
  $("#gestionarNext").addClass('disabled');
  var indice = contador;
  indice--;
  release_client(indice);
  if (indice == cantidad_clientes) {
    indice = 1;
    contador = indice;
    $("#gestionarNext").removeClass('disabled');
  } else {
    indice++;
    contador = indice;
  }
  llenar_clientes();
  reactivar_actividad();
});

$("#gestionarNext2").click(function() {
  $("#gestionarNext2").addClass('disabled');
  var indice = contador;
  indice--;
  release_client(indice);
  if (indice == (cantidad_clientes - 1) || indice == (cantidad_clientes)) {
    alert("No existen mas clientes en el futuro");
    $("#gestionarNext2").removeClass('disabled');
  } else {
    indice += 2;;
    contador = indice;
    llenar_clientes();
  }
  reactivar_actividad();
});

function llenar_hoy() {
  setTimeout(function() {
    llamadas_hoy = [];
    $.post("../php/getClientsByUser.php", {
      ide: $.trim($("#identificador_usuario").html()),
      hoy: getDia()
    }, function(mensaje) {
      var x = mensaje.split("=");
      for (var i = 0; i < x.length - 1; i++) {
        var w = x[i].split("|");
        var z = w[2].split(":");
        llamadas_hoy.push({
          id: w[0],
          hora: z[0],
          minuto: z[1]
        });
      }
    });
    llenar_hoy();
  }, 30000);
}


function hora_maracada_post(datos){

  var result = datos.split(':');

  //console.log(result[0]+" "+result[1]);

  $("#horaPV").val(result[0]);
  $("#minutoPV").val(result[1]);


  $("#horaPV_vv").val(result[0]);
  $("#minutoPV_vv").val(result[1]);


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

function bloquear_urgente() {
  setTimeout(function() {
    f = new Date();
    var h = f.getHours();
    var m = f.getMinutes();
    for (var i = 0; i < llamadas_hoy.length; i++) {
      var x = parseInt(llamadas_hoy[i].hora);
      var y = parseInt(llamadas_hoy[i].minuto);

      if (x != h || y != m) { // 27072021 original if (x == h && y == m) {
        gestionar_urgente(llamadas_hoy[i].id);
      } else if (x == h && y == (m - 1)) {
        gestionar_urgente(llamadas_hoy[i].id);
      }
    }
    bloquear_urgente();
  }, 50000);
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
$("#hora").focus(function() {
  $("#minuto").val("");
});
$("#horaPV").focus(function() {
  $("#minutoPV").val("");
});

function verificar_caracteres(x) {
  if (x[0] == "." || x[1] == "." || x[0] == "e" || x[1] == "e" || x[0] == "+" || x[1] == "+" || x[0] == "-" || x[1] == "-")
    return true;
  return false;
}

function fecha_pasada(fecha, hora) {

  var fechaH = getDia().split("-");
  var horaH = getHora().split(":");
  var fechaA = fecha.split("-");
  var horaA = hora.split(":");
  if (parseInt(fechaA[2]) > parseInt(fechaH[2])) {
    return false;
  }
  if (fechaA[0] < fechaH[0]) {
    if (fechaA[1] <= fechaH[1]) {
      return true;
    } else if (fechaA[1] > fechaH[1]) {
      return false;
    }
  } else if (fechaA[0] == fechaH[0]) {
    if (fechaA[1] < fechaH[1]) {
      return true;
    } else if (fechaA[1] > fechaH[1]) {
      return false;
    } else {
      if (horaA[0] < horaH[0]) {
        return true;
      } else if (horaA[0] == horaH[0]) {
        if (horaA[1] > horaH[1]) {
          return false;
        } else {
          return true;
        }
      } else {
        return false;
      }
    }
  } else if (fechaA[0] > fechaH[0]) {
    if (fechaA[1] < fechaH[1]) {
      return true;
    } else {
      return false;
    }
  }

}

function fecha_pasada1(fecha, hora) {

  var fechaH = getDia().split("-");
  var horaH = getHora().split(":");
  var fechaA = fecha.split("-");
  var horaA = hora.split(":");
  if (parseInt(fechaA[2]) > parseInt(fechaH[2])) {
    return false;
  }
  if (fechaA[0] < fechaH[0]) {
    if (fechaA[1] <= fechaH[1]) {
      return true;
    } else if (fechaA[1] > fechaH[1]) {
      return false;
    }
  } else if (fechaA[0] == fechaH[0]) {
    if (fechaA[1] < fechaH[1]) {
      return true;
    } else if (fechaA[1] > fechaH[1]) {
      return false;
    } else {
      if (horaA[0] < horaH[0]) {
        return true;
      } else if (horaA[0] == horaH[0]) {
        if (horaA[1] > horaH[1]) {
          return false;
        } else {
          return true;
        }
      } else {
        return false;
      }
    }
  } else if (fechaA[0] > fechaH[0]) {
    if (fechaA[1] < fechaH[1]) {
      return true;
    } else {
      return false;
    }
  }

}

/*comentado 01022021
function verificar_inactividad() {
  setTimeout(function() {
    tiempo_ausente += 5;
    if (tiempo_ausente == 600) {
      var hora = getHora();
      var tiempoT = convertir_tiempo(horasT, minutosT, segundosT);
      var tiempoA = convertir_tiempo(horasA, minutosA, segundosA);
      $.post("../php/exit_user.php", {
        hora: hora,
        tiempoI: tiempoT,
        almuerzo: tiempoA
      }, function(mensaje) {
        if (mensaje == 1)
          location.replace("../index.html");
      });
    }
    verificar_inactividad();
  }, 5000);
}

function reactivar_actividad() {
  tiempo_ausente = 0;
}*/

// postventa funciones
function llenar_lista_clientes() {
  $.post("../php/get_Clients_Accept.php", {
    ide: $("#identificador_usuario").html()
  }, function(mensaje) {
    //console.log('MENSAJE', mensaje)
    $("#sel1").html(mensaje);
    $(".loader").fadeOut("slow");
  });
}



var cliente_post_actual;
$("#fechaVentaPV").val(getDia());
$("#postv").fadeOut("fast");


$("#sel1").change(function() {
  $("#postv .operator_name").html('');
  reactivar_actividad();
  usuario = $(this).children(":selected").html();
  //id = $(this).children(":selected").attr('data-id');
  id =$(this).val();


  if (usuario === "Seleccionar Cliente") {
    $("#postv").fadeOut("fast");
  } else {
	//	fb = usuario.split("/");
   // cliente_post_actual = $.trim(fb[1]);
    
    cliente_post_actual =id
		////console.log(cliente_post_actual);
		$.post("../php/getClientsByID.php", {
			id: id
		}, function(data) {
			$("#postv .operator_name").html(data);
			$("#postv").fadeIn("fast");
		    //20082021 postventa
			id_actual=id;
			cliente_actual=id;
			nombre_cliente_actual = $("#sel1 option:selected").html();
			$("#cliente_selc_pargestion").val(cliente_actual);
			console.log('asignar id actual:'+id_actual);//20082021 cobros despues postventa
		    console.log('asignar cliente_actual:'+cliente_actual);//20082021 cobros despues postventa
		    
		    console.log('asignar id nombre_cliente_actual:'+nombre_cliente_actual);//20082021 cobros despues postventa
		    
		//$("#postv").append(cliente_post_actual);
		});
    
  }
});



$("#TrabajoRN").on('change', function() {
  if ($(this).is(':checked')) {
    $("#MotivoNT").removeClass('hide');
    $("#TrabajoRS").prop('checked', false);
    $("#containerRS").addClass('hide');
  } else {
    $("#MotivoNT").addClass('hide');
  }
});

$("#TrabajoPN").on('change', function() {
  if ($(this).is(':checked')) {
    $("#MotivoNP").removeClass('hide');
    $("#TrabajoPS").prop('checked', false);
    $("#containerRS").addClass('hide');
  } else {
    $("#MotivoNP").addClass('hide');
  }
});

$("#TrabajoRS").on('change', function() {
  if ($(this).is(':checked') && $("#TrabajoPS").is(':checked')) {
    $("#containerRS").removeClass('hide');
  }
  if ($(this).is(':checked')) {
    $("#MotivoNT").addClass('hide');
    $("#motivoT").val('');
    $("#TrabajoRN").prop('checked', false);
  } else {
    $("#containerRS").addClass('hide');
    $("#MotivoNP").addClass('hide');
  }
});

$("#TrabajoPS").on('change', function() {
  if ($(this).is(':checked') && $("#TrabajoRS").is(':checked')) {
    $("#containerRS").removeClass('hide');
  }
  if ($(this).is(':checked')) {
    $("#MotivoNP").addClass('hide');
    $("#motivoP").val('');
    $("#TrabajoPN").prop('checked', false);
  } else {
    $("#containerRS").addClass('hide');
    $("#MotivoNP").addClass('hide');
  }
});

$("#botonPV").click(function(event) {

  

  $("#botonPV").addClass('disabled');
  $("#botonPV").html("Guardando...");
  var fechapv = $("#fechaVentaPV").val();
  var fecharl = $("#fechaLlamadaPV").val();
  var horapv = $("#horaPV").val();
  var minutopv = $("#minutoPV").val();
  var trabajom = $.trim($("#motivoT").val());
  var pagom = $.trim($("#motivoP").val());
  var trabajo;
  var pago;
  // $("#pdfAdicional");
  if ($("#TrabajoRS").is(":checked") || $("#TrabajoRN").is(':checked')) {
    if ($("#TrabajoRS").is(":checked")) {
      trabajo = true;
    } else {
      trabajo = false;
    }
  } else {
    alert("Debes llenar todos los campos!");
    $("#botonPV").removeClass('disabled');
    $("#botonPV").html("Guardar");
    return;
  }

  if ($("#TrabajoPS").is(':checked') || $("#TrabajoPN").is(':checked')) {
    if ($("#TrabajoPS").is(':checked'))
      pago = true;
    else
      pago = false;
  } else {
    alert("Debes llenar todos los campos!");
    $("#botonPV").removeClass('disabled');
    $("#botonPV").html("Guardar");
    return;
  }
    console.log('trabajo:'+trabajo);
  if (!trabajo) {
    if (trabajom === "") {
      alert("Debes llenar todos los campos!");
      $("#botonPV").removeClass('disabled');
      $("#botonPV").html("Guardar");
      return;
    }
  }
  if (!pago) {
    if (pagom === "") {
      alert("Debes llenar todos los campos!");
      $("#botonPV").removeClass('disabled');
      $("#botonPV").html("Guardar");
      return;
    }
  }
  if (fecharl === "" || fechapv === "" || horapv === "" || minutopv === "") {
    alert("Debes completar la fecha y hora para poder continuar!");
    $("#botonPV").removeClass('disabled');
    $("#botonPV").html("Guardar");
    return;
  }
  var mensaje = "-------------------\nFecha de venta: " + fechapv + "\n";
  if (trabajo)
    mensaje += "El trabajo se realizo\n";
  else
    mensaje += "El trabajo no se realizo\n  Comentarios:\n  " + trabajom + "\n";
  if (pago)
    mensaje += "El pago se realizo\n";
  else
    mensaje += "El pago no se realizo\n  Comentarios:\n  " + pagom + "\n";

  if (pago && trabajo)
  mensaje += "  Comentarios renovacion de servicio\n" + $("#comentRS").val() + "\n";
  mensaje += "El cliente ha sido reprogramado para el dia " + fecharl;
  mensaje += "\n-------------------\n";


  $.post("../php/guardarPV.php", {
    mensaje: mensaje,
    ide: $("#sel1").val()
  }, function(mensaje) {
    if (mensaje == 1) {
      $(".loader").fadeIn("slow");
      // reprogramar llamada (reutilizar codigo)
      // #fechaLlamadaPV
      // #horaPV
      // #minutoPV
      if ($("#horaPV").val().length > 2 || $("#minutoPV").val().length > 2) {
        $("#ErrorPV").html("Error en el formato de hora, <b>revisa bien.</b>");
        $("#ErrorPV").removeClass('hide');
        $("#botonPV").removeClass('disabled');
        $("#botonPV").html("Guardar");
        $(".loader").fadeOut("slow");
        return;
      }
      var tiene_espacial = verificar_caracteres($("#horaPV").val());
      var tiene_espacial2 = verificar_caracteres($("#minutoPV").val());
      if (tiene_espacial || tiene_espacial2) {
        $("#ErrorPV").html("Error en el formato de hora, <b>No se permiten caracteres especiales!</b>");
        $("#ErrorPV").removeClass('hide');
        $("#botonPV").removeClass('disabled');
        $("#botonPV").html("Guardar");
        $(".loader").fadeOut("slow");
        return;
      }
      if (parseInt($("#horaPV").val()) > 23 || parseInt($("#minutoPV").val()) > 59) {
        $("#ErrorPV").html("<b>Esa hora no existe!</b>");
        $("#ErrorPV").removeClass('hide');
        $("#botonPV").removeClass('disabled');
        $("#botonPV").html("Guardar");
        $(".loader").fadeOut("slow");
        return;
      }
      fecha = convertir_fecha($("#fechaLlamadaPV").val());
      hora = convertir_hora($("#horaPV").val(), $("#minutoPV").val());
      cliente = cliente_post_actual;
      comentario = "Comentario disponible en historial post-venta";
      if (fecha_pasada(fecha, hora)) {
        $("#ErrorPV").html("<b>Estas agendando una llamada en el pasado!</b>");
        $("#ErrorPV").removeClass('hide');
        $("#botonPV").removeClass('disabled');
        $("#botonPV").html("Guardar");
        $(".loader").fadeOut("slow");
        return;
      }



   


        $.post("../php/getClientsByUser1.php", {
          hora: $("#horaPV_vv").val(),
          minuto: $("#minutoPV_vv").val(),
          fecha:fecha
    
        }, function(data) {
          tipo = "ac";
          if (data=="true") {

       
       
          $.post('../php/llamadaRealizada.php', {
            cl: cliente
          }, function(mensaje) {

            $.post("../php/add_llamada1.php", {
              id_act: cliente,
              fecha: $("#fechaLlamadaPV").val(),
              hora: hora,
              comentario: comentario,
              tipo: tipo

            }, function(mensaje) {
              if (mensaje == 1) {}
              // $("#TrabajoRN").prop('checked', false);
              // $("#TrabajoRS").prop('checked', false);
              // $("#TrabajoPN").prop('checked', false);
              // $("#TrabajoPS").prop('checked', false);
              // $("#fechaLlamadaPV").val("");
              // $("#horaPV").val("");
              // $("#minutoPV").val("");
              // $("#motivoT").val("");
              // $("#motivoP").val("");
              // $("#comentRS").val("");
              $(".loader").fadeOut("slow");
              $("#snackbar").html("El registro post-venta ha sido agregado con exito.");
              $("#snackbar").addClass('show');

              $("#Pventa").click();
                //20082021 llamar formulario cobros postventa
                desde_postventa = true;
              $("#btn_cobros").click();
                
              setTimeout(function() {
                $("#snackbar").removeClass('show');
              }, 5000);
              $("#sel1").val("Seleccionar Cliente");
              $("#postv").fadeOut("fast");
            });
          });
        }
      });
    }
    $("#ErrorPV").addClass('hide');
    // Termina reprogramar llamada
    $("#botonPV").removeClass('disabled');
    $("#botonPV").html("Guardar");
  });
});

$("#pdfAdicional").click(function(event) {
  reactivar_actividad();
  ///Estoy acaaaa
  var x = usuario.split("/");
  //comentado 01022021 window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=s&cl=" + $.trim(x[1]));
    window.open('../control_archivos.php?id=' + $.trim($("#identificador_usuario").html()) + "&u=s&cl=" + $.trim(x[1]));
});

$("#btn-head").click(function(event) {
  reactivar_actividad();
  //comentado 01022021 window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_urgente_actual));
  window.open('../control_archivos.php?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_urgente_actual));

    
});

$("#bPDF").click(function(event) {
  reactivar_actividad();
  //comentado 01022021 window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_actual));
  window.open('../control_archivos.php?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_actual));

    
});

var mostrar_buscar = false;

$("#btn-buscar").click(function() {
  $(".search").fadeIn("slow");
  buscar_coincidencias($("#input_BC").val());
  reactivar_actividad();
});


$("#fechaLlamada").change(function() {


  $.post("../php/horas_ocupadas.php", 
  {
    fecha:$("#fechaLlamada").val(),
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

});



$("#fechaLlamadaPV").change(function() {

 

  $.post("../php/horas_ocupadas_post.php", 
  {
    fecha:$("#fechaLlamadaPV").val(),
    id:$("#identificador_usuario").html()
  }, 
  function procesar(data){
    $("#tabla_hora2").html(data.tabla);
    $.each(data.dias,function(index){
      console.log(data.dias[index].id);
        $("#"+data.dias[index].id).css("background-color", "red");
        $("#"+data.dias[index].id).prop("onclick", null).off("click");
        $("#"+data.dias[index].id).prop('title', 'HORARIO OCUPADO');
    });
  }, "json");
  $("#tabla_hora2").show();

  $("#selec_resp").val('');
});




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


/*21072021 borrar ya no se usa $("#btn-buscar-c").click(function() {
    //20072021
    console.log('m:'+$("#input_BCC").val().trim);
    if($("#input_BCC").val().trim() == '') return;
    console.log('af m');
    
  $(".search").fadeIn("slow");
  buscar_ciudadela($("#input_BCC").val());
  reactivar_actividad();
});*/

/*21072021 ya no se usa en buscar cliente
$("#btn-buscar-cc").click(function() {
    //20072021
    if($("#input_BCCC").val().trim() == '') return;
    
  $(".search").fadeIn("slow");
  buscar_telefono($("#input_BCCC").val());
  reactivar_actividad();
});*/


//techplus
// $("#btn-buscar-cc").click(function() {
//   $(".search").fadeIn("slow");
//   buscar_ciudadela($("#input_BCCC").val());
//   reactivar_actividad();
// });
//techplus
$("#bCL").click(function() {
  $(".search-box").toggle("slow");
//techplus
  //$("#BCCC").toggle("slow");
  reactivar_actividad();
});

function buscar_coincidencias(mensaje) {
  $.post('../php/buscar_coincidencia.php', {
    busqueda: mensaje
  }, function(msj) {
    var clientes = msj.split("~");
    if (clientes[0] != 0) {
      ultima_busqueda = clientes;
      $("#cliente_gestionar").html("<option>Selecciona el cliente<o/ption>");
      for (var i = 1; i <= clientes[0]; i++) {
        var cliente_actual = clientes[i].split("|");
        var aux = $("#cliente_gestionar").html();
        $("#cliente_gestionar").html(aux + "<option " + "value=\"" + i + "\"" + ">" + cliente_actual[1] + "</option>");
      }
      $("#Modal_buscar_cliente").modal();
      $(".search").fadeOut("slow");
    } else {
      $(".search").fadeOut("slow");
      $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
      $("#snackbar").addClass('show');
      setTimeout(function() {
        $("#snackbar").removeClass('show');
      }, 5000);
    }
  }).fail(function() {
    $(".search").fadeOut("slow");
    $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
    $("#snackbar").addClass('show');
    setTimeout(function() {
      $("#snackbar").removeClass('show');
    }, 5000);
  });
}

function buscar_ciudadela(mensaje) {
    
  $.post('../php/buscar_ciudadela.php', {
    busqueda: mensaje
  }, function(msj) {
    var clientes = msj.split("~");
    if (clientes[0] != 0) {
      ultima_busqueda = clientes;
      $("#cliente_gestionar_antes").html("<option value=''>Selecciona el cliente<o/ption>");
      for (var i = 1; i <= clientes[0]; i++) {
        var cliente_actual = clientes[i].split("|");
        var aux = $("#cliente_gestionar_antes").html();

        $("#cliente_gestionar_antes").html(aux + "<option " + "value=\"" + cliente_actual[0] + "\"" + ">" + cliente_actual[1] + "</option>");

        //$("#cliente_gestionar_antes").html(aux + "<option " + "value=\"" + i + "\"" + ">" + cliente_actual[1] + "</option>");
      }
      $("#Modal_buscar_cliente").modal();
      $(".search").fadeOut("slow");
    } else {
      $(".search").fadeOut("slow");
      $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
      $("#snackbar").addClass('show');
      setTimeout(function() {
        $("#snackbar").removeClass('show');
      }, 5000);
    }
  });
}
//////////techplus lhr  21072021 ya no se usa en buscar cliente
function buscar_telefono(mensaje) {
    
  $.post('../php/buscar_telefono.php', {
    busqueda: mensaje
  }, function(msj) {
    var clientes = msj.split("~");
    if (clientes[0] != 0) {
      ultima_busqueda = clientes;
      $("#cliente_gestionar_antes").html("<option>Selecciona el cliente<o/ption>");
      for (var i = 1; i <= clientes[0]; i++) {
        var cliente_actual = clientes[i].split("|");
        var aux = $("#cliente_gestionar_antes").html();

        $("#cliente_gestionar_antes").html(aux + "<option " + "value=\"" + cliente_actual[0] + "\"" + ">" + cliente_actual[1] + "</option>");

        //$("#cliente_gestionar").html(aux + "<option " + "value=\"" + i + "\"" + ">" + cliente_actual[1] + "</option>");
      }
      $("#Modal_buscar_cliente").modal();
      $(".search").fadeOut("slow");
    } else {
      $(".search").fadeOut("slow");
      $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
      $("#snackbar").addClass('show');
      setTimeout(function() {
        $("#snackbar").removeClass('show');
      }, 5000);
    }
  });
}

//Sohaib
// function buscar_telephone(mensaje) {
//   $.post('../php/telephone.php', {
//     busqueda: mensaje
//   }, function(msj) {
//     var clientes = msj.split("~");
//     if (clientes[0] != 0) {
//       ultima_busqueda = clientes;
//       $("#cliente_gestionar").html("<option>Selecciona el cliente<o/ption>");
//       for (var i = 1; i <= clientes[0]; i++) {
//         var cliente_actual = clientes[i].split("|");
//         var aux = $("#cliente_gestionar").html();
//         $("#cliente_gestionar").html(aux + "<option " + "value=\"" + i + "\"" + ">" + cliente_actual[1] + "</option>");
//       }
//       $("#Modal_buscar_cliente").modal();
//       $(".search").fadeOut("slow");
//     } else {
//       $(".search").fadeOut("slow");
//       $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
//       $("#snackbar").addClass('show');
//       setTimeout(function() {
//         $("#snackbar").removeClass('show');
//       }, 5000);
//     }
//   });
// }

//Sohaib
/*
$("#cliente_gestionar_antes").change(function() {
  reactivar_actividad();
  usuario = $(this).children(":selected").html();
  if (usuario === "Selecciona el cliente") {
    $("#cliente_seleccionado_antes").html("0x000");
  } else {
    var valor = $("#cliente_gestionar").val();
    var x = ultima_busqueda[valor].split("|");
    $("#cliente_seleccionado_antes").html(x[0]);
  }
});
*/

$("#cliente_gestionar_antes").change(function() {
  reactivar_actividad();
  usuario = $("#cliente_gestionar_antes").val();

  if (usuario == "") {
    $("#cliente_seleccionado").html("0x000");
  } else {
    $("#cliente_seleccionado").html(usuario);

  }
});




$("#cliente_gestionar").change(function() {
  reactivar_actividad();
  usuario = $("#cliente_gestionar").val();

  if (usuario == "") {
    $("#cliente_seleccionado").html("0x000");
  } else {
    $("#cliente_seleccionado").html(usuario);

  }
});



$("#nuevo_buscador").change(function() {
  //reactivar_actividad();


  setTimeout(() => {
    actualizarCookie(1);
  }, 1000);

  id=$("#nuevo_buscador").val();
  alert(id)
  $.post('release_client.php', {
    id: id
  },
  function() {

  });



});


$("#GestionarCmodal").click(function(event) {

  $("#GestionarCmodal").addClass('disabled');
  var cl = $("#cliente_seleccionado").html();

  if (cl==="0x000" || cl=="") {

    //alert("Debe seleccionar un cliente");
    $("#Modal_buscar_cliente").modal("toggle");
    $("#GestionarC").removeClass('disabled');

  } else {
    //console.log("Cl: " , cl) ;
    var id = get_identificador(cl);
    //console.log("id :" , id );
    release_client_id(cl);

    //Se debe pasar el index del usuario no el id
    release_client(contador-1);

    contador = id;

    $(".search").fadeIn("fast");

   setTimeout(() => {
      actualizarCookie(1);
    }, 1000);

    

    $("#GestionarCmodal").removeClass('disabled');
    $("#Modal_buscar_cliente").modal("toggle");

  }

});

$("#GestionarC").click(function(event) {

  $("#GestionarC").addClass('disabled');
  var cl = $("#cliente_seleccionado").html();

  if (cl==="0x000" || cl=="") {

    alert("Debe seleccionar un cliente");
   // $("#Modal_buscar_cliente").modal("toggle");
   // $("#GestionarC").removeClass('disabled');

  } else {
    //console.log("Cl: " , cl) ;
    var id = get_identificador(cl);
    //console.log("id :" , id );
    release_client_id(cl);

    //Se debe pasar el index del usuario no el id
    release_client(contador-1);

    contador = id;

    $(".search").fadeIn("fast");

   setTimeout(() => {
      actualizarCookie(1);
    }, 1000);

    

    //$("#GestionarC").removeClass('disabled');
    //$("#Modal_buscar_cliente").modal("toggle");

  }

});

function get_identificador(iden) {

  //Vector
  //console.log("iden" , iden) ;
  var clien = clientes_cookie.split("|");
  //console.log("clien" , clien) ;
  for (var i = 0; i <= clien.length; i++) {
    if (clien[i] == iden){
        //console.log("iden" , iden);
        return i;
    }
      
  }

}
/*
0.consulta
1.aumentar
2.reiniciar
*/
function ver_gestiones_hoy() {
  $.post('../php/gestiones.php', {
    tipo: 0,
    gestion: 'nd',
    cl: 'nd'
  }, function(message) {
    $("#estadistica_gestion").html(message);
  });
}


function ver_horas_de(){
  alert("si")
$("#tabla_hora").show();

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
/*
0 = Tiempo perdido
1 = Volver a Llamar
2 = Acepto
3 = Rechazo
4 = Averiado
5 = No responde
6 = Equivocado
7 = Otro
*/
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

function llenar_modal() {
  $.post('../php/gestiones.php', {
    tipo: 2,
    gestion: 'nd',
    cl: 'nd'
  }, function(messa) {
    var messa = messa.split("~");
    $("#modal-gestiones .modal-content .modal-header").html(messa[0]);
    $("#modal-gestiones .modal-content .modal-body").html(messa[1]);
  });

}

function cambiar_fecha(obj) {
  
  meses_futuro = $(obj).val();
  console.log(meses_futuro);
  /*20082021 var hoy = new Date();
  var dd = hoy.getDate();
  var mm = hoy.getMonth() + 1 + parseInt(meses_futuro);
  var yyyy = hoy.getFullYear();
  if (mm > 12) {
    mm -= 12;
    yyyy += 1;
  }
  if(mm < 10)
  mm='0'+mm;
  if(dd < 10)
  mm='0'+dd;*/
  
  //$("#fechaLlamadaPV").val(dd + "/" + mm + "/" + yyyy); 30072021
 $.post("../php/getNuevaFechaPostVenta.php", {
    meses: meses_futuro,
    fecha_post_venta: $('#fechaVentaPV').val(),
    }, function(data) {
        data = JSON.parse(data);
        console.log(data);
        //     $("#fechaLlamadaPV").val(yyyy + "-" + mm + "-" + dd);
        $("#fechaLlamadaPV").val(data.futura);
  
      $("#horaPV").val('06');
      $("#minutoPV").val('30');

  });
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
 let asincrono = (tipo=='ac' || tipo == 'in' || tipo == 'co')?false:true;
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

function aumentar_segundos_gestion() {
  setTimeout(function() {
    total_segundos++;
    aumentar_segundos_gestion();
  }, 999);

}

/*
historialAnterior
historialNext
historialNext2
*/
$("#historialAnterior").click(function() {
  $(".history_ge").fadeIn("slow");
  var indice = contador;
  //27072021 indice--;

  if (indice == 1) {
    indice = cantidad_clientes;
  } else {
    //27272021 indice--;
  }
  show_modal_cant(indice);
  reactivar_actividad();
});

$("#historialNext").click(function() {
  $(".history_ge").fadeIn("slow");
  var indice = contador;
  indice--;
  if (indice == cantidad_clientes) {
    indice = 1;

  } else {
    indice++;
  }
  show_modal_cant(indice);
  reactivar_actividad();
});

$("#historialNext2").click(function() {
  $(".history_ge").fadeIn("slow");
  var indice = contador;
  indice--;
  if (indice == (cantidad_clientes - 1) || indice == (cantidad_clientes)) {
    alert("No existen mas clientes en el futuro");
  } else {
    indice += 2;;
  }
  show_modal_cant(indice);
  reactivar_actividad();
});

function show_modal_cant(indice) {
  var vector = clientes_cookie.split("|");
  var cl_aux = vector[indice];
  $.post('../php/get_historial_gestion.php', {
    cliente: cl_aux
  }, function(message) {
    $("#historial-gestiones .modal-content .modal-body").html(message);
    $("#historial-gestiones").modal();
    $(".history_ge").fadeOut("slow");
  });
}

/******************
 * FUNCIONES AGREGADAS PARA REPORTES
 */


 $("#btn_mantenimiento").click(function(){
        window.open('../php/calendario.php', "_blank");
 });


$("#GenerarR").click(function() {
  reactivar_actividad();
  $("#PgenerarR").addClass("active");
  $("#PPventa").removeClass("active");
  $("#PMotivate").removeClass("active");
  $("#PGllamada").removeClass("active");
  $("#PRecordatorio").removeClass("active");
  
  if ($("#containerGR").css("display") == "none") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "block");
    });
  }
  
  if ($("#ContainerPV").css("display") == "block") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", "none");
    });
  }

  if ($("#ContainerVM").css('display') == "block") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", 'none');
    });
  }
  if ($("#ContainerR").css('display') == "block") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", 'none');
    });
  }
  if ($("#ContainerGL").css('display') == "block") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", 'none');
    });
  }
});

$("#generarReporte").click(function(event) {
  var date = $("#fechaAceptoR").val().split("-");
  if (date == "") {
      $("#alert_date").css({
          display: 'block'
      });
  } else {
      if ($("#tipo_archivo").val() == 1) {
          R1generar(date, '437175ba4191210ee004e1d937494d09');
      } else {
          R1generar(date, 'bf57c906fa7d2bb66d07372e41585d96');
      }
      $("#alert_date").css({
          display: 'none'
      });
  }
});



  



function R1generar(date, type) {
  var fecha = date[0].trim().split("/");
  var fechaF = date[1].trim().split("/");

  //window.open(url, '_self');
  window.open('../php/report_acepto.php?day=' + fecha[0] + '&month=' + fecha[1] + '&year=' + fecha[2] + '&day2=' + fechaF[0] + '&month2=' + fechaF[1] + '&year2=' + fechaF[2] + '&type=' + type + '&report=accept', "_blank");
}

function cargaGLlamada( cl, idUser ) {
  ////console.log(id);
  //document.getElementById('Gllamada').click();
  //console.log("Cl" , cl) ;
  //console.log("idUser" , idUser) ;
  $('.navbar-collapse').collapse("toggle");
  $("#PGllamada").addClass("active");
  $("#PMotivate").removeClass("active");
  $("#PRecordatorio").removeClass("active");
  $("#PPventa").removeClass("active");
  $("#PgenerarR").removeClass("active");

  if ($("#ContainerGL").css("display") == "none") {
    $("#ContainerGL").toggle("slow", function() {
      $("#ContainerGL").css("display", "block");
    });
  }

  if ($("#ContainerVM").css('display') == "block") {
    $("#ContainerVM").toggle("slow", function() {
      $("#ContainerVM").css("display", 'none');
    });
  }
  if ($("#ContainerR").css('display') == "block") {
    $("#ContainerR").toggle("slow", function() {
      $("#ContainerR").css("display", 'none');
    });
  }
  if ($("#ContainerPV").css('display') == "block") {
    $("#ContainerPV").toggle("slow", function() {
      $("#ContainerPV").css("display", 'none');
    });
  }
  // async function aaa() {
  //   var result = await $.ajax()
  //   aaaaaaaaaaaaaaaaaaaaaaa
  // }
  if ($("#containerGR").css("display") == "block") {
    $("#containerGR").toggle("slow", function() {
      $("#containerGR").css("display", "none");
    });
  }
  release_client_id(cl);
  $.post("../php/getAllClients_calendario.php", {
    ide: idUser
  }, function(mensaje) {

    var mcl = mensaje.split("=");
    var cadena = "1|";
    for (var i = 0; i < mcl.length - 1 ; i++) {
      var sc = mcl[i].split("|");
      cadena += ($.trim(sc[0]) + "|");
    }
    
    cookies_cargadas = true;
    clientes_cookie_cargado = true;
    clientes_cookie = cadena;
    //console.log(cadena) ;
    var id = get_identificador(cl);
    //console.log("contador" , contador) ;
    if ( id === undefined){
      
    }
    release_client_id(cl);
    //console.log("id : " , id );
    //Se debe pasar el index del usuario no el id
    
    release_client(contador-1);
    contador = id; 
    //console.log("contador" ,contador)
    $(".search").fadeIn("fast");
    
    llenar_clientes( true );

  });

}

$(function() {
  var start = moment();
  var end = moment().add(7, 'days');
  $('input[name="daterange2"]').daterangepicker({
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aceptar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    startDate: start,
    endDate: end,
    opens: 'left'
  }, function(start, end, label) {
      //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});


//nuevos requerimientos 21072021
function search_client(idbotonbuscar){
    $("#"+idbotonbuscar).addClass('disabled');
      var cl = $("#cliente_seleccionado").html();
    
      if (cl==="0x000" || cl=="") {
    
        alert("Debe seleccionar un cliente");
       
      } else {
        var id = get_identificador(cl);
        release_client_id(cl);
    
        //Se debe pasar el index del usuario no el id
        release_client(contador-1);
    
        contador = id;
    
        $(".search").fadeIn("fast");
    
       setTimeout(() => {
          actualizarCookie(1);
          $("#cliente_seleccionado").html("0x000");
        $('#cliente_gestionar').val('').trigger('change');
        $('#input_BCC').val('').trigger('change');
        $('#input_BCCC').val('').trigger('change');
        $('#input_buscar_factura').val('').trigger('change');

        }, 1000);
        
        primer_enter = false;
        
      }

}

$("#input_BCC").change(function() {
  reactivar_actividad();
  usuario = $("#input_BCC").val();
    console.log('u ciudadela:'+usuario);
  if (usuario == "") {
    $("#cliente_seleccionado").html("0x000");
  } else {
    $("#cliente_seleccionado").html(usuario);

  }
});
//buscar por ciudadela
$("#btn-buscar-c").click(function(event) {
    search_client('btn-buscar-c');
});

/*$("#input_BCC").keyup(function(event) {
    if (event.keyCode === 13) {
        search_client_enter('btn-buscar-c');  
    }
});*/


$("#cliente_gestionar").keyup(function(event) {
    if (event.keyCode === 13) {
        search_client_enter('GestionarC');  
    }
});
//buscar por teléfono

$("#input_BCCC").change(function() {
  reactivar_actividad();
  usuario = $("#input_BCCC").val();
    console.log('u tel:'+usuario);
  if (usuario == "") {
    $("#cliente_seleccionado").html("0x000");
  } else {
    $("#cliente_seleccionado").html(usuario);

  }
});
$("#btn-buscar-cc").click(function(event) {
  search_client('btn-buscar-cc');  
  
});
$("#input_BCCC").keyup(function(event) {
    if (event.keyCode === 13) {
        search_client_enter('btn-buscar-cc');  
    }
});





//buscar por factura
$("#input_buscar_factura").change(function() {
  reactivar_actividad();
  usuario = $("#input_buscar_factura").val();
    console.log('u fac:'+usuario);
  if (usuario == "") {
    $("#cliente_seleccionado").html("0x000");
  } else {
    $("#cliente_seleccionado").html(usuario);

  }
});
$("#btn-buscar-factura").click(function() {
   search_client('btn-buscar-factura');  
});



function search_client_enter(idbotonbuscar,cl){
    console.log('bt:'+idbotonbuscar);
       
          $("#"+idbotonbuscar).addClass('disabled');
    
        var id = get_identificador(cl);
        release_client_id(cl);
    
        //Se debe pasar el index del usuario no el id
        release_client(contador-1);
    
        contador = id;
    
        $(".search").fadeIn("fast");
    
       setTimeout(() => {
          actualizarCookie(1);
          $("#cliente_seleccionado").html("0x000");
        $('#cliente_gestionar').val('').trigger('change');
        $('#input_BCC').val('').trigger('change');
        $('#input_BCCC').val('').trigger('change');
        $('#input_buscar_factura').val('').trigger('change');
        
        }, 1000);
      primer_enter = false;
        /*$("#cliente_seleccionado").html("0x000");
        $('#cliente_gestionar').val('').trigger('change');
        $('#input_BCC').val('').trigger('change');
        $('#input_BCCC').val('').trigger('change');
        $('#input_buscar_factura').val('').trigger('change');
        */
        $("#"+idbotonbuscar).removeClass('disabled');        

}
/*$('.select2-search-field > input.select2-input').on('keyup', function(e) {
   if(e.keyCode === 13) 
      console.log('e1');
});
$('.select2-selection__rendered').on('keyup', function(e) {
   if(e.keyCode === 13) 
      console.log('e2');
});*/


$(document).on('keyup',function (e) {
    if (e.which === 13) {
       let cl = $("#cliente_seleccionado").html();
       console.log('cl:'+cl);
       if (cl==="0x000" || cl=="") {
           console.log('no data');
       }
       else{
           if(primer_enter){
               let val_select_nombre = $('#cliente_gestionar').val();
               let val_select_ciudadela = $('#input_BCC').val();
               let val_select_telefono = $('#input_BCCC').val();
               let val_select_factura = $('#input_buscar_factura').val();
               console.log('n:'+val_select_nombre+'-c:'+val_select_nombre+'-t:'+val_select_nombre+'-f.'+val_select_factura);
               
               if(cl == val_select_nombre)
                 search_client_enter('GestionarC',cl);
               else if(cl == val_select_ciudadela)
                 search_client_enter('btn-buscar-c',cl);
               else if(cl == val_select_telefono)
                 search_client_enter('btn-buscar-cc',cl);
               else if(cl == val_select_factura)
                 search_client_enter('btn-buscar-factura',cl);
                
               primer_enter=false;
           }
           else{
               primer_enter = true;
               
                console.log('esperar 2do!');
           }
       }
       
    }
});

//recordatorios
   var $content, $modal, $apnData, $modalCon; 

$('#sel_llamadas_urgentes').change(function(){
    console.log($(this).val())
    if($(this).val().trim() != '')
    gestionar_urgente($(this).val());
});

$('#sel_llamadas_semanalaes').change(function(){
    console.log($(this).val())
    if($(this).val().trim() != '')
    gestionar_urgente($(this).val());
});


//modal minimizado
    $(".mdlFire").click(function(e){

          e.preventDefault();

          var $id = $(this).attr("data-target"); 

          $($id).modal({backdrop: false, keyboard: false}); 

        }); 
 

    //$(".modalMinimize").on("click", function(){
    $("body").on("click",'.modalMinimize', function(){
        
        console.log('al minimizar id_modal_actual:'+id_modal_actual);
        id_modal = $(this).closest(".modal").attr("id");  
        arr_str_id=id_modal.split("_");//2008 problema cli sel
        console.log(arr_str_id);//2008 problema cli sel
        
        console.log('id_modal:'+id_modal)
        if(id_modal_actual != '' && id_modal_actual != id_modal){
            console.log('autoclick min')
            if( !$('#'+id_modal_actual).hasClass('min') ){
                console.log('no está minimizado');
                 $('#'+id_modal_actual+' .modalMinimize').click();
            }
            else{
                console.log('ya esta  min')
            }
           
            
        }
       
        $apnData = $(this).closest(".modal");

        $modal = "#" + id_modal;

        $(".modal-backdrop").addClass("display-none");   

        $($modal).toggleClass("min");  

        if ( $($modal).hasClass("min") ){ 
            console.log('se minimiza:'+id_modal);
            
            $(".minmaxCon").append($apnData);  
            $($modal+' .bt_ocultar').hide();
            $($modal).find("i").toggleClass( 'fa-minus').toggleClass( 'fa-clone');
            let idx_posicion = arr_id_modals.indexOf(id_modal);
            console.log('pos:'+idx_posicion);
            let margen = idx_posicion * margen_modal;
            margen = margen+'px';
            console.log('margen:'+margen)
            $($modal).css('left',margen);
            //20082021 problema cli sel
            if( codigo_seleccionado_aux != '' ){
                console.log('se devuelve control a id:'+codigo_seleccionado_aux);
                $('#cliente_selc_pargestion').val(codigo_seleccionado_aux);
            }
        } 
        else{ 
            console.log('se max:'+id_modal);
              //20082021 problema cli sel
            if( $('#cliente_selc_pargestion').val().trim() != '' ){
                console.log('val ante:'+$('#cliente_selc_pargestion').val());
                codigo_seleccionado_aux = $('#cliente_selc_pargestion').val();
                $('#cliente_selc_pargestion').val(arr_str_id[1]);
                console.log('nuevo sel:'+$('#cliente_selc_pargestion').val());
                
            }
              $("body").append($apnData); 
                
              $($modal).find("i").toggleClass( 'fa-clone').toggleClass( 'fa-minus');
               $($modal+' .bt_ocultar').show();
                mimimizarModalActual(id_modal);

        }

    });

    $("button[data-dismiss='modal']").click(function(){   

                $(this).closest(".modal").removeClass("min");

                $(".container").removeClass($apnData);   

                $(this).next('.modalMinimize').find("i").removeClass('fa fa-clone').addClass( 'fa fa-minus');

              }); 

    
    function mimimizarModalActual(id=''){
        console.log('id_modal_actual:'+id_modal_actual+'-p:'+id+'-');
        if(id_modal_actual != '' && id!='' && id_modal_actual != id){
            //$('#'+id_modal_actual+' .modalMinimize').click();
             
        }
    }

    function cerrarModal(id){
        console.log('cerrar:'+id+'-');
        console.log(arr_id_gestionar);
        console.log(arr_id_modals);
        let idx = arr_id_gestionar.indexOf(id);
        let id_modal_cerrar = arr_id_modals[idx];
        console.log('idx cerrar:'+idx);
         arr_id_gestionar.splice(idx, 1);
        arr_id_modals.splice(idx, 1);
        console.log(arr_id_gestionar);
        console.log(arr_id_modals);
        $('#'+id_modal_cerrar).remove();
        posicionarMinimizables();
    }


    //mover 
    
    function dragElement(elmnt) {
      let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
      /*if (document.getElementById(elmnt.id + "header")) {
        // if present, the header is where you move the DIV from:
        document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
      } else {
        // otherwise, move the DIV from anywhere inside the DIV:
        elmnt.onmousedown = dragMouseDown;
      }*/
      elmnt.onmousedown = dragMouseDown;
    
      function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        pos3 = e.clientX;
        pos4 = e.clientY;
        document.onmouseup = closeDragElement;
        // call a function whenever the cursor moves:
        document.onmousemove = elementDrag;
      }
    
      function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;
        pos3 = e.clientX;
        pos4 = e.clientY;
        // set the element's new position:
        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
      }
    
      function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
      }
    }


    $("body").on("click",'.col_anterior',function(){
        console.log('id_actual:'+id_actual);
        release_client_id(id_actual);//20082021
        
        let codigo = $(this).data('codigo');
        console.log('a:'+codigo);
        let idx = vector.indexOf(codigo);
        console.log('idx:'+idx);
        contador = idx ;
        
        release_client_id(codigo,true);
        
        
    })
    
    $("body").on("click",'.col_principal',function(){
        console.log('id_actual:'+id_actual);
        release_client_id(id_actual);//20082021
        
        let codigo = $(this).data('codigo');
        console.log('p:'+codigo);
        let idx = vector.indexOf(codigo);
        console.log('idx:'+idx);
        contador = idx;
        release_client_id(codigo,true);
    })
    
    $("body").on("click",'.col_siguiente',function(){
        console.log('id_actual:'+id_actual);
        release_client_id(id_actual);//20082021
        
        let codigo = $(this).data('codigo');
        console.log('s:'+codigo);
        let idx = vector.indexOf(codigo);
        console.log('idx:'+idx);
        contador = idx;
        release_client_id(codigo,true);
    })
    
    
    
    
    
    function getIndiceSiguiente(idx){
        console.log(arr_codigos_tabla);
        let obj = {"idx":-1,"codigo":""};
        let reiniciar = true;
        console.log('getIndiceSiguiente:'+idx+'-cantidad_clientes:'+cantidad_clientes);
        if(idx >= cantidad_clientes){
            console.log('limite alcanzado reiniciar')
            idx = 1;
        }
        /*let cod = vector[idx];
        console.log('cod:'+cod+'---');
        if( cod == "" || arr_codigos_tabla.indexOf(cod) > -1){
            console.log('volver a obtener');
            idx++;
            getIndiceSiguiente(idx);
            return;
        }
        else{
            console.log("encontrado en:"+idx)
            obj.idx = idx;
            obj.codigo = cod;
        }*/
        for(let i = idx ; i < vector.length ; i++ ){
            console.log('i:'+i);
            if( vector[i] != "" && arr_codigos_tabla.indexOf(vector[i]) == -1){
                 console.log("encontrado en:"+i);
                obj.idx = i;
                obj.codigo = vector[i];
                arr_codigos_tabla.push(obj.codigo);
                break;
            }
            /*if( i == vector.length && reiniciar ){
                console.log('reiniciar');
                i = 1;
                reiniciar = false;
            }*/
        }
        console.log(arr_codigos_tabla);
        console.log("antes obj");
        console.log(obj);
        return obj;
        
       
        
    }
    
    
    
    //abrir editar cliente en otra pestañas
    function abrirEditarCliente(cod_cliente){
        console.log(cod_cliente);
        cliente_actual = cod_cliente 
        $.post('../php/obtenerDatosCliente.php', {
          if: cliente_actual
        }, function(mensaje) {
         // console.log(mensaje)
          var x = mensaje.split("|");

          $("#ID_clienteM").val($.trim(cliente_actual));
          $("#coordenadas_clienteM").val($.trim(x[0]));
          $("#nombre_clienteM").val($.trim(x[1]));
          $("#datos_facturaM").val($.trim(x[2]));
          $("#direccion_clienteM").val($.trim(x[3]));
          $("#tel_clienteM").val($.trim(x[4]));
          $("#tel_ofM").val($.trim(x[5]));
          $("#cel1M").val($.trim(x[6]));
          $("#cel2M").val($.trim(x[7]));
          $("#correoCM").val($.trim(x[8]));
          $("#comentarios_clienteM").val($.trim(x[9]));
          $("#cisternaM").val($.trim(x[11]));
          
          $("#tipo_persona_tel_clienteM").val($.trim(x[13]));
          $("#obser_tel_clienteM").val($.trim(x[14]));
          $("#tipo_persona_tel_ofM").val($.trim(x[15]));
          $("#obser_tel_ofM").val($.trim(x[16]));
          $("#tipo_persona_cel1M").val($.trim(x[17]));
          $("#obser_cel1M").val($.trim(x[18]));
          $("#tipo_persona_cel2M").val($.trim(x[19]));
          $("#obser_cel2M").val($.trim(x[20]));
          $("#numerolibreM").val($.trim(x[21]));
          $("#ModalMC").modal();
        });
    }
    
    
    
    function mostrarBarraInformativa(mostrar){
        console.log(mostrar);
        if(mostrar){
            $('#tira_informativa').show();
            $('.minmaxCon').addClass('sobretira');
            $('#estadistica_gestion').addClass('sobretira');
            
            
            
        }
        else{
            $('#tira_informativa').hide();
           $('.minmaxCon').removeClass('sobretira');
           $('#estadistica_gestion').removeClass('sobretira');
            
        }
        setTimeout(function(){
                mostrarBarraInformativa(!mostrar);
            },tiempo_tira);
    }
    
    
    
    //30072021 postventa
    var rad = document.getElementsByName('meses');
    for (var i = 0; i < rad.length; i++) {
        rad[i].addEventListener('change', function() {
            cambiar_fecha(this);
            console.log(this.value)
        });
    }

    
    $('#BTbusqueda').click( function(){
        $('#modal_filtro').modal('show');
    });
    
    $(document).ready(function(){
        if( tira_permanente == 0 ){
            console.log("no permaente")
            setTimeout(function(){
                mostrarBarraInformativa(true);
            },tiempo_tira);
        }
        else{
            console.log('tira permaente');
            $('#tira_informativa').show();
            $('.minmaxCon').addClass('sobretira');
             $('#estadistica_gestion').addClass('sobretira');
        }
        
        $.post("../php/obtenerDatosTira.php", {
            
          }, function(data) {
            data = JSON.parse(data);
            if( data.datos !== undefined){
                console.log(data.datos);
                if( data.datos.mensaje.trim() != ''  ){
                    $('.msjs_admin').show();
                    $('#lb_msj_admin').text(data.datos.mensaje);
                }
            }
        });
        
        $.post("../php/obtenerInfoTira.php", {
            
          }, function(data) {
            data = JSON.parse(data);
           
                if(data.gestiones !== null && data.gestiones.length > 0 ){
                    //lb_recordatorio_vencido
                    let html_info='';
                    for(let i =0; i < data.gestiones.length; i++){
                        let g = data.gestiones[i];
                        html_info+='<span class="sp_espacio"></span><label>'+g.gestion+' : '+g.cantidad+'</label>';
                    }
                    
                    $('#lb_recordatorio_vencido').after(html_info);
                }
            
        });


        $(".btfiltro").click(function (){
            if( $(this).hasClass("btn-primary") ){
                $(this).removeClass("btn-primary");
                console.log('t');
                $(this).toggleClass("btn-success");
                arr_filtros.push($(this).data("filtro"));
            }
            else{
                console.log('nt');
                $(this).toggleClass("btn-primary");
                $(this).removeClass("btn-success");
                idx = arr_filtros.indexOf($(this).data("filtro"));
                console.log(idx);
                arr_filtros.splice(idx,1);
            }
            
            console.log(arr_filtros);
        });
        
        $('#btFiltrarClientes').click(function(){
            let fecha_inicio = $('#fecha_filtro_inicio').val();
            let fecha_fin = $('#fecha_filtro_fin').val();
            
            if(fecha_inicio == '' && fecha_fin == ''){
                if(arr_filtros.length == 0){
                    alert('Debe seleccionar una fecha o un tipo de filtro');
                    return;
                }
            }
        console.log(arr_filtros);
        $.post('../php/buscarClientesFiltros.php', {
          filtros: arr_filtros, fecha_inicio:fecha_inicio, fecha_fin:fecha_fin
        }, function(data) {
            data = JSON.parse(data);
            console.log(data.msj);
            let filas = '';
            
            if(!data.error){
                if( data.filas.length > 0 ){
                    console.log('encontrados:'+data.filas.length);
                    for( let i = 0 ; i < data.filas.length ; i++ ){
                        fila = data.filas[i];
                        filas += '<tr class="fila_filtro" data-codigo="'+fila.codigo+'">';
                        filas += '<td><a href="Modulo_Usuario.php?c='+fila.codigo+'" target="_blank">'+fila.nombre_completo+'</a></td>';
                        filas += '<td>'+fila.tipo_gestion+'</td>';
                        filas += '<td>'+fila.direccion+'</td>';
                        filas += '<td>'+fila.fecha_gestion+'</td>';
                        filas += '</tr>';
                        
                    }
                }
                else{
                    filas = '<tr><td colspan="4">No se encontraron clientes </td></tr>';
                }
                $('#tb_resultados_filtro tbody').html(filas);
            }
            else{
                alert(data.msj);
            }
         
        });    
    })

    })
    
    
    
    
    
    $(document).on('click','.fila_filtro',function(){
        let codigo = $(this).data('codigo');
        console.log('coc sel:'+codigo);
        let idx = vector.indexOf(codigo);
        console.log('idx desde filtro:'+idx);
        if( idx == -1 ){
            console.log('cliente no existe ne array, agregar');
            vector.push(codigo);
            idx = vector.indexOf(codigo);
        }
        contador = idx;
        console.log('contador desde filtro:'+contador);
        $("#identificador_usuario").html(codigo);
        clientes_cookie += (codigo + "|");
        release_client_id(codigo,true);
        
        //actualizarCookie(1);
        
        
        $('#modal_filtro').modal('hide');
        $('#tb_resultados_filtro tbody').html('');
    });
    
    
    //nuevos botones gestion
    
    $("#btn_inspeccion").click(function() {
        console.log(nombre_cliente_actual);
      $("#fechaAceptoInspeccion").val(getDia());
      $("#idclInspeccion").val(nombre_cliente_actual);
      //$(".fechapicker").datepicker("open");
      $("#horas_ocupadasInspeccion").html('');
      $("#ModalInspeccion").modal('show');
      reactivar_actividad();
    });

    $("#fechaAceptoInspeccion").change(function() {

      $.post("../php/horas_ocupadas_acepto.php", 
      {
        fecha:$("#fechaAceptoInspeccion").val(),
        id:$("#identificador_usuario").html(),
        tipo_gestion:GESTION_INSPECCION
        
      }, 
      function procesar(data){
    
        //console.log(data.datos);
        $("#horas_ocupadasInspeccion").html(data.datos);   
        
      }, "json");
      //$("#horas_ocupadas").show();
    
    });

//inspecciones
     $("#GuardarInspeccion").click(function() {
        console.log(nombre_cliente_actual);
        
                //14082021
                if (urge) {
                 console.log('es urge');                       
                }
        $("#GuardarInspeccion").addClass('disabled');
          $("#GuardarInspeccion").html("Guardando...");
          if ($("#fechaAceptoInspeccion").val() == "") {
            alert("La fecha es obligatoria!");
            $("#GuardarInspeccion").removeClass('disabled');
            $("#GuardarInspeccion").html("Guardar");
          } else {
            var fecha, hora, cliente, comentario;
            fecha = $("#fechaAceptoInspeccion").val();
            hora = $("#horaACInspeccion").val() + ":" + $("#minutoACInspeccion").val() + ":00";
            cliente = cliente_actual;
            comentario = $("#commentInspeccion").val();
            
            
              
                let response_data = guardar_tiempo('in', $("#cliente_selc_pargestion").val());//14082021 fred ss
                
                console.log('response_data  :');
                console.log(response_data);
                if(response_data.data == 1){
                
                    $.post("../php/valida_hora_acepto.php", {
                      id_act: $("#cliente_selc_pargestion").val(),
                      fecha: fecha,
                      hora: hora,
                      id_tipo_gestion : GESTION_INSPECCION
                    }, function(data) {
                
                        if (data.estado == "insertar") {
                
                                $.post('../php/llamadaRealizada.php', {
                                  cl: $("#cliente_selc_pargestion").val()
                                }, function(mensaje) {});
                            
                                $.post('release_client.php', {
                                  id: $("#cliente_selc_pargestion").val()
                                },
                                function() {  
                                });
                            
                            
                                $.post("../php/Cliente_acepto.php", {//12082021
                                  id_act: $("#cliente_selc_pargestion").val(),
                                  fecha: fecha,
                                  hora: hora,
                                  comentario: comentario,
                                  id_tipo_gestion : GESTION_INSPECCION //14082021
                                }, function(mensaje) {
                                    if (mensaje == 1) {
                                              $("#snackbar").html("El cliente aceptó la inspección, y ha sido gestionado con éxito.");
                                              $("#snackbar").addClass('show');
                                              setTimeout(function() {
                                                $("#snackbar").removeClass('show');
                                              }, 10000);
                                              if (!urge) {
                                                  console.log('no urge');
                                                //13082021 llenar_clientes();
                                                console.log('desde_postventa:'+desde_postventa);
                                                if(!desde_postventa)
                                                    cargar_gestion();
                                                    
                                                    desde_postventa = false;//20082021 postventa
                                              
                                              }
                                            $("#ModalInspeccion").modal('toggle');
                                            $("#commentInspeccion").val("");
                                            $("#fechaAceptoInspeccion").val("");
                            
                                            $("#horaACInspeccion").val('');
                                            $("#minutoACInspeccion").val('');
                            
                                            
                                            $("#GuardarInspeccion").removeClass('disabled');
                                            $("#GuardarInspeccion").html("Guardar");
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
                            
                                    llenar_llamadas(); 
                                        if (urge) {
                                          urge = false;
                                          //11082021
                                          console.log('elimina gestionModal urgente:gestionModal_'+$("#cliente_selc_pargestion").val());
                                          cerrarModal(''+$("#cliente_selc_pargestion").val());
                                          //$("#gestionModal_"+$("#cliente_selc_pargestion").val()).modal('toggle');
                                        }
                                    $("#mensaje_error_aceptoInspeccion").addClass('hide');
                                    sumar_gestion('in', $("#cliente_selc_pargestion").val());
                                    gestionado_botones = true;
                                    //comentado  01022021 guardar_tiempo('ac', $("#cliente_selc_pargestion").val());
                              } 
                                  else {
                                        mensaje = mensaje.split("~");
                                        if (mensaje[0] == -3) {
                                          $("#GuardarInspeccion").removeClass('disabled');
                                          $("#GuardarInspeccion").html("Guardar");
                                          $("#mensaje_error_aceptoInspeccion").html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + mensaje[1] + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                                          $("#mensaje_error_aceptoInspeccion").removeClass('hide');
                                        }
                                  }
                            
                                });
                        }
                        else {
                         
                            
                              $("#GuardarInspeccion").removeClass('disabled');
                              $("#GuardarInspeccion").html("Guardar");
                              $("#mensaje_error_aceptoInspeccion").html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + data.mensaje + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                              $("#mensaje_error_aceptoInspeccion").removeClass('hide');
                         
                        }
                
                    }, "json");
                
                    
                }
                else{
                    alert(response_data.msj);
                    console.log('no puede continuar no hay sesion');
                }
            
            
              

            //fin 
                /*14082021 let response_data = guardar_tiempo_otros( GESTION_INSPECCION , $("#cliente_selc_pargestion").val());//fredd
                
                console.log('response_data  :');
                console.log(response_data);
                if(response_data){
                   guardar_otras_gestiones('ModalInspeccion','Inspeccion',hora,fecha,comentario,GESTION_INSPECCION);
                
                }
                else{
                    alert(response_data.msj);
                    console.log('no puede continuar no hay sesion');
                }
                */
        
          }

 
    });
   
    
    
function guardar_tiempo_otros(tipo, cliente) {
  //var ntipo = get_tipo(tipo);
  console.log('tipo otros:'+tipo)
  var segundos = total_segundos,
    minutos = 0,
    horas = 0,
    tiempo = '';
  total_segundos = 0;
  gestionado_botones = false;
  
  //01022021
  let continuar = false;
 let asincrono = false;
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
  $.post('../php/guardar_tiempo_otros.php', {
    tipo_gestion: tipo,
    cliente: cliente,
    tiempo: tiempo,
    async: false,
  }, function(message) {
      console.log('message guardar_tiempo:');
      console.log(message)
      
      message = JSON.parse(message.trim());
      console.log('message.data--:'+message.data);
      console.log('message.error--:'+message.error);
      
      if( message.error == 0 )
      continuar = true;
      else{
          console.log('error -------')
      }
  });
  if(!asincrono){
      console.log('default config ajax');
      $.ajaxSetup({async: true});  
  }
  console.log('antes return:'+continuar);
  return continuar;
}

function guardar_otras_gestiones(id_modal, id_txt_gestion ,hora, fecha,comentario, tipo_gestion){
    console.log('id_modal:'+id_modal+'-id_txt_gestion :'+id_txt_gestion+'- hora:'+hora+' -fecha :'+fecha+' -comentario:'+comentario+' -tipo_gestion :'+tipo_gestion)
         $.post("../php/valida_hora_acepto_otros.php", {
          id_act: $("#cliente_selc_pargestion").val(),
          fecha: fecha,
          hora: hora,
          tipo_gestion:tipo_gestion
        }, function(data) {
    
            if (data.estado == "insertar") {
                    $.post("../php/Cliente_acepto_otros.php", {
                      id_act: $("#cliente_selc_pargestion").val(),
                      fecha: fecha,
                      hora: hora,
                      comentario: comentario,
                      tipo_gestion:tipo_gestion
                    }, function(mensaje) {
                        let data = JSON.parse(mensaje);
                        if (!data.error) {
                                  $("#snackbar").html(data.msj);
                                  $("#snackbar").addClass('show');
                                  setTimeout(function() {
                                    $("#snackbar").removeClass('show');
                                  }, 8000);
                                 
                                $("#"+id_modal).modal('toggle');
                                $("#comment"+id_txt_gestion).val("");
                                $("#fechaAcepto"+id_txt_gestion).val("");
                
                                $("#horaAC"+id_txt_gestion).val('');
                                $("#minutoAC"+id_txt_gestion).val('');
                
                                
                                $("#Guardar"+id_txt_gestion).removeClass('disabled');
                                $("#Guardar"+id_txt_gestion).html("Guardar");
                               
                                //$(".loader").fadeIn("slow");
                               
                        $("#mensaje_error_acepto"+id_txt_gestion).addClass('hide');
                        
                      } 
                      else {
                            $("#Guardar"+id_txt_gestion).removeClass('disabled');
                              $("#Guardar"+id_txt_gestion).html("Guardar");
                              $("#mensaje_error_acepto"+id_txt_gestion).html("<h6>"+data.msj+", recuerda programar con minimo una hora de diferencia.</h6>");
                              $("#mensaje_error_acepto"+id_txt_gestion).removeClass('hide');
                            
                      }
                
                    });
    
            }
            else {
             
                
                  $("#Guardar"+id_txt_gestion).removeClass('disabled');
                  $("#Guardar"+id_txt_gestion).html("Guardar");
                  $("#mensaje_error_acepto"+id_txt_gestion).html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + data.mensaje + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                  $("#mensaje_error_acepto"+id_txt_gestion).removeClass('hide');
             
            }
    
        }, "json");
    }
    
    //cobros
    
     $("#btn_cobros").click(function() {
        console.log(nombre_cliente_actual);
      $("#fechaAceptoCobros").val(getDia());
      $("#idclCobros").val(nombre_cliente_actual);
      //$(".fechapicker").datepicker("open");
      $("#horas_ocupadasCobros").html('');
      $("#ModalCobros").modal('show');
      reactivar_actividad();
    });

    $("#fechaAceptoCobros").change(function() {

      $.post("../php/horas_ocupadas_acepto.php", 
      {
        fecha:$("#fechaAceptoCobros").val(),
        id:$("#identificador_usuario").html(),
        tipo_gestion:GESTION_COBROS
        
      }, 
      function procesar(data){
    
        //console.log(data.datos);
        $("#horas_ocupadasCobros").html(data.datos);   
        
      }, "json");
      //$("#horas_ocupadas").show();
    
    });

     $("#GuardarCobros").click(function() {
        console.log(nombre_cliente_actual);
        $("#GuardarCobros").addClass('disabled');
          $("#GuardarCobros").html("Guardando...");
          if ($("#fechaAceptoCobros").val() == "") {
            alert("La fecha es obligatoria!");
            $("#GuardarCobros").removeClass('disabled');
            $("#GuardarCobros").html("Guardar");
          } else {
            var fecha, hora, cliente, comentario;
            fecha = $("#fechaAceptoCobros").val();
            hora = $("#horaACCobros").val() + ":" + $("#minutoACCobros").val() + ":00";
            cliente = cliente_actual;
            comentario = $("#commentCobros").val();
            let response_data = guardar_tiempo('co', $("#cliente_selc_pargestion").val());//14082021 fred
                
                console.log('response_data  :');
                console.log(response_data);
                if(response_data.data == 1){
                
                    $.post("../php/valida_hora_acepto.php", {
                      id_act: $("#cliente_selc_pargestion").val(),
                      fecha: fecha,
                      hora: hora,
                      id_tipo_gestion : GESTION_COBROS
                    }, function(data) {
                
                        if (data.estado == "insertar") {
                
                                $.post('../php/llamadaRealizada.php', {
                                  cl: $("#cliente_selc_pargestion").val()
                                }, function(mensaje) {});
                            
                                $.post('release_client.php', {
                                  id: $("#cliente_selc_pargestion").val()
                                },
                                function() {  
                                });
                            
                            
                                $.post("../php/Cliente_acepto.php", {//12082021
                                  id_act: $("#cliente_selc_pargestion").val(),
                                  fecha: fecha,
                                  hora: hora,
                                  comentario: comentario,
                                  id_tipo_gestion : GESTION_COBROS 
                                }, function(mensaje) {
                                    if (mensaje == 1) {
                                              $("#snackbar").html("Se agendó fecha de cobro y ha sido gestionado con éxito.");
                                              $("#snackbar").addClass('show');
                                              setTimeout(function() {
                                                $("#snackbar").removeClass('show');
                                              }, 10000);
                                              if (!urge) {
                                                  console.log('no urge');
                                                //13082021 llenar_clientes();
                                                cargar_gestion();
                                              }
                                            $("#ModalCobros").modal('toggle');
                                            $("#commentCobros").val("");
                                            $("#fechaAceptoCobros").val("");
                            
                                            $("#horaACCobros").val('');
                                            $("#minutoACCobros").val('');
                            
                                            
                                            $("#GuardarCobros").removeClass('disabled');
                                            $("#GuardarCobros").html("Guardar");
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
                            
                                    llenar_llamadas(); 
                                        if (urge) {
                                          urge = false;
                                          //11082021
                                          console.log('elimina gestionModal urgente:gestionModal_'+$("#cliente_selc_pargestion").val());
                                          cerrarModal(''+$("#cliente_selc_pargestion").val());
                                          //$("#gestionModal_"+$("#cliente_selc_pargestion").val()).modal('toggle');
                                        }
                                    $("#mensaje_error_aceptoCobros").addClass('hide');
                                    sumar_gestion('co', $("#cliente_selc_pargestion").val());
                                    gestionado_botones = true;
                                    //comentado  01022021 guardar_tiempo('ac', $("#cliente_selc_pargestion").val());
                              } 
                                  else {
                                        mensaje = mensaje.split("~");
                                        if (mensaje[0] == -3) {
                                          $("#GuardarCobros").removeClass('disabled');
                                          $("#GuardarCobros").html("Guardar");
                                          $("#mensaje_error_aceptoCobros").html("<h6>Error hay un conflicto con un mantenimiento programado para las <b>" + mensaje[1] + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                                          $("#mensaje_error_aceptoCobros").removeClass('hide');
                                        }
                                  }
                            
                                });
                        }
                        else {
                            
                              $("#GuardarCobros").removeClass('disabled');
                              $("#GuardarCobros").html("Guardar");
                              $("#mensaje_error_aceptoCobros").html("<h6>Error hay un conflicto con un cobro programado para las <b>" + data.mensaje + "</b>, recuerda programar con minimo una hora de diferencia.</h6>");
                              $("#mensaje_error_aceptoCobros").removeClass('hide');
                         
                        }
                
                    }, "json");
                    
                }
                else{
                    alert(response_data.msj);
                    console.log('no puede continuar no hay sesion');
                }
            //fin
            
          }

 
    });
    
    //importante
    
     $("#btn_importante").click(function() {
        console.log(nombre_cliente_actual);
      $("#fechaAceptoImportante").val(getDia());
      $("#idclImportante").val(nombre_cliente_actual);
      //$(".fechapicker").datepicker("open");
      $("#horas_ocupadasImportante").html('');
      $("#ModalImportante").modal('show');
      reactivar_actividad();
    });

    $("#fechaAceptoImportante").change(function() {

      $.post("../php/horas_ocupadas_otros.php", 
      {
        fecha:$("#fechaAceptoImportante").val(),
        id:$("#identificador_usuario").html(),
        tipo_gestion:GESTION_COBROS
        
      }, 
      function procesar(data){
    
        //console.log(data.datos);
        $("#horas_ocupadasImportante").html(data.datos);   
        
      }, "json");
      //$("#horas_ocupadas").show();
    
    });

    $("#GuardarImportante").click(function() {
        console.log(nombre_cliente_actual);
        $("#GuardarImportante").addClass('disabled');
          $("#GuardarImportante").html("Guardando...");
          if ($("#fechaAceptoImportante").val() == "") {
            alert("La fecha es obligatoria!");
            $("#GuardarImportante").removeClass('disabled');
            $("#GuardarImportante").html("Guardar");
          } else {
            var fecha, hora, cliente, comentario;
            fecha = $("#fechaAceptoImportante").val();
            hora = $("#horaACImportante").val() + ":" + $("#minutoACImportante").val() + ":00";
            cliente = cliente_actual;
            comentario = $("#commentImportante").val();
        
            let response_data = guardar_tiempo_otros( GESTION_IMPORTANTE , $("#cliente_selc_pargestion").val());//
            
            console.log('response_data  :');
            console.log(response_data);
            if(response_data){
               guardar_otras_gestiones('ModalImportante','Importante',hora,fecha,comentario,GESTION_IMPORTANTE);
            
            }
            else{
                alert(response_data.msj);
                console.log('no puede continuar no hay sesion');
            }
            
        
          }

 
    });
    
    
    function setClientesCercanos(codigo_actual){
        console.log("buscar:"+codigo_actual);
        let cli_actual = json_clientes.find( cli => cli.codigo == codigo_actual );
        if( cli_actual !== undefined ){
            
        }
        else{
            console.log("cli no encontrado");
        }
    }
    
    
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -2.099302, lng: -79.879019},
          zoom: 15
          
        });
          google.maps.event.addListener(map, 'click', function(event) {
       placeMarker(event.latLng);
       
    });
      }
      
      
      
  
    
    function placeMarker(location) {
        reactivar_actividad();
        console.log(location.lat());
        console.log(location.lng());
        if( marker_referencia !== null ){
            console.log('eliminar anterior marker');
            marker_referencia.setMap(null);
            eliminarMarkers();
        }
        console.log(location);
        marker_referencia = new google.maps.Marker({
            position: location, 
            map: map
        });
        
        marker_referencia.addListener("click", () => {
        //map.setZoom(8);
        map.setCenter(marker.getPosition());
      });
      contentString = '<div>Nombre:</div>';
       let infowindow = new google.maps.InfoWindow({
        content: contentString,
      });
      mostrarCercanos(location,distnacia_inicial);

    }      
    
    function mostrarCercanos(position,distancia = 0.1){
        
        console.log('distnacia_inicial:'+distnacia_inicial);
        console.log('lat:'+position.lat());
        console.log('lng:'+position.lng());
        let primer_cliente = null;
        $.post("../php/getClientesCercanos.php", {
            lat: position.lat(),
            lng: position.lng(),
            distancia:distnacia_inicial
            
          }, function(data) {
              data = JSON.parse(data);
            if (!data.error){
                markers = [];
                if( data.clientes.length > 0 ){
                    let cadena = '';
                    for(let i = 0 ; i < data.clientes.length ; i++ ){
                        
                        let client = data.clientes[i];
                        if( i == 0 ){
                            primer_cliente = client;
                        }
                        let html_info = getInfo(client);
                        let url_color = getColor(client.fecha_hora);
                        console.log('url_color:'+url_color);
                        console.log('lat:'+client.lat+'-lng:'+client.lng);
                        let latLng = new google.maps.LatLng(client.lat,client.lng);
                        
                        marker_existe = false;
        
                        if(markers.length != 0) {
                            let suma = data.clientes.length+markers.length;
                            console.log('verificar cluster:'+markers.length+'-'+suma);
                            for (j=0; j < markers.length; j++) {
                                var existingMarker = markers[j];
                                var pos = existingMarker.getPosition();
                                //console.log(pos.lat()+'-'+pos.lng());
                                if (latLng.equals(pos)) {
                                    var a = 360.0 / (suma);//markers.length;
                                    console.log('a:'+a);
                                    var newLat = pos.lat() + -.0004 * Math.cos((+a*i) / 180 * Math.PI);  
                                    var newLng = pos.lng() + -.0004 * Math.sin((+a*i) / 180 * Math.PI);  
                                    latLng = new google.maps.LatLng(newLat,newLng);
                                    console.log('nuevo lat->:'+latLng.lat()+'-'+latLng.lng());
                                    marker_existe = true;
                                    break;
                                }
                            }
                        }
                        console.log('lat->:'+latLng.lat()+'-'+latLng.lng());
                        let marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title:client.nombre_completo,icon: {
                              url: url_color
                            }
                            
                        });
                        marker.addListener("click", () => {
                            reactivar_actividad();
                        let infowindow = new google.maps.InfoWindow({
                            content: html_info,
                          });
                            map.setCenter(marker.getPosition());
                            infowindow.open({
                              anchor: marker,
                              map,
                              shouldFocus: false,
                            });
                         });
                        // Binds the infoWindow to the point
                        //bindInfoWindow(marker, map, infoWindow, html);
        
                        // Add the marker to the array
                        if(marker_existe){
                            console.log('mark existe')
                            markers.push(marker);
                        }
                        else{
                            console.log('mark individual:'+i);
                            if( i == 0 ){
                                console.log('primer mark se agrega');
                                markers.push(marker);
                            }
                            /*marker.addListener("click", () => {
                            
                            map.setCenter(marker.getPosition());
                            infowindow.open({
                              anchor: marker,
                              map,
                              shouldFocus: false,
                            });
                         });*/
                        }
                        cadena += $.trim(client.codigo + "|");
                          json_clientes.push({"idx":i,"codigo":client.codigo,"coords":client.coordenadas, 
                          "nombre":client.nombre_completo, 
                          "fecha":client.fecha_hora ,
                          "hora":client.hora_acepto,
                          "estado":client.estado });
                       
                           /*let infowindow = new google.maps.InfoWindow({
                            content: html_info,
                          });
                        */
                     
                                     
                    }//fin for
                    if( markers.length > 0 ){
                        markers.splice(0,1);
                        
                        markerCluster = new MarkerClusterer(map, markers, { zoomOnClick: true, 
                        maxZoom: 18, 
                        gridSize: 30 ,
                        imagePath:
                        "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
      
                        });
                    }
                    console.log(json_clientes);
                    cookies_cargadas = true;
                    clientes_cookie_cargado = true;
                    clientes_cookie = cadena;
                    console.log(cadena);
                    if( primer_cliente !== null ){
                        console.log('cli cercano gestionar');
                        gestionarClienteMapa(primer_cliente.codigo);
                    }
                }
                else{
                    distnacia_inicial+=distnacia_aumentar;
                    mostrarCercanos(position,distnacia_inicial)
                }
            }
            
          });
          /*
        var meters = 500;
        
        // number of km per degree = ~111km (111.32 in google maps, but range varies
           between 110.567km at the equator and 111.699km at the poles)
        // 1km in degree = 1 / 111.32km = 0.0089
        // 1m in degree = 0.0089 / 1000 = 0.0000089
        
        var coef = meters * 0.0000089;
        var new_lat = position.lat() + coef;
        // pi / 180 = 0.018
        var new_long = position.lng() + coef / Math.cos(position.lat() * 0.018);      
        console.log('new:'+new_lat+','+new_long)
                */ 
        
      
    }
    
    function getColor(str_fecha){
        console.log('fecha:'+str_fecha);
        let d1 = new Date(str_fecha);
        let d2 = new Date();
        var dmid = new Date();
        dmid.setHours(0,0,0,0);
        if( dmid > d1 ){
            return obj_url_pines.ayer;
        }
        else if(d2 > d1 ){
            return obj_url_pines.temprano;
        }
        else{
            return obj_url_pines.normal;
        }
    
    
    }
      
    function getInfo(client){
        let html = '<div style="display:block">';
        html += '<div><label>Nombre: '+client.nombre_completo+'</label><div>';
        html += '<div><label>Direción: '+client.direccion+'</label><div>';
        html += '<div><label>Estado: '+client.estado+'</label><div>';
        html += '<div><label>Fecha: '+client.fecha_hora+'</label><div>';
        
        html += '<div><button class="btn btn-primary" onclick="gestionarClienteMapa(\''+client.codigo+'\')">Gestionar</button><div>';
        html += '</div>';
        return html;
    }      
    
    function gestionarClienteMapa(codigo){
        reactivar_actividad();
        console.log(codigo);
        //1808release_client_id(codigo,false);
        setClienteGestionado(codigo)
    }
      
    function setClienteGestionado(id_actual){
        console.log('set cliente:'+id_actual);
    $.post("../php/getDatosCliente1.php", 
      {
        id_act: id_actual,

        
      }, 
        function procesar(data){
            data = JSON.parse(data);
            console.log(data.principal.fechas);
            let str_fechas = '';
                
            if( data.principal.fechas !== null ){
               let arr_fechas = data.principal.fechas.split(",");
         
                if( arr_fechas.length > 4) {
                    for( let i = 0; i < 5; i++){
                        str_fechas+=arr_fechas[i]+'</br>';
                    }
                }
                else{
                    str_fechas = arr_fechas.join("</br>");
                }
            }
            console.log(str_fechas);
                
            if (data.principal.estado !== "Por gestionar") {
            console.log(data.principal);
            let str_importante ='';
            let estado_principal = data.principal.estado.toLowerCase();
            console.log('estado_principal:'+estado_principal);
            if( estado_principal.indexOf('importante') > -1 ){
                str_importante='<label class="lb_importante"><i class="fa fa-star"></i></label>';
            }
            $("#tabla_clienteA tbody").html("<tr><th scope=\"row\">" + 
            str_fechas + "</th><th scope=\"row\">" + 
            data.principal.nombre_completo +str_importante+ "</th><th>" + 
            data.principal.Datos_factura +  "</th><td>" + 
            data.principal.direccion  + "</td><td>" + 
            data.principal.telefono  + "<input type='text' id='telefono_casa' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_tel_cliente + "<br>"+
            data.principal.obser_tel_cliente +"</td><td>" + 
            data.principal.telefono_oficina  + "<input type='text'id='Telefono_Trabajo' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_tel_of + "<br>"+      
            data.principal.obser_tel_of +"</td><td>" + 
            data.principal.celular1  + "<input type='text' id='Celular_1' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_cel1 + "<br>"+
            data.principal.obser_cel1 +"</td><td>" + 
            data.principal.celular2  + "<input type='text' id='Celular_2' style='width: 100%;'/><br>"+
            data.principal.tipo_persona_cel2 + "<br>"+
            data.principal.obser_cel2 +"</td><td>" + 
            data.principal.numero_libre+"</td><td>" + 
            data.principal.correo  + "</td><td>" + 
            data.principal.estado  + "<br><span class=\"badge badge-pill badge-dark\">Ultima gestion</span><p class=\"h7\"><br>"+
            data.principal.fecha_gestionp+"<br>"+
            data.principal.operador+"</td><td>" + 
            data.principal.info_cisterna  + "</td></tr>");
      
        } else {
            
            $("#tabla_clienteA tbody").html("<tr><th scope=\"row\">" + 
            str_fechas + "</th><th scope=\"row\">" + 
            data.principal.nombre_completo + "</th><th>" + 
            data.principal.Datos_factura +  "</th><td>" + 
            data.principal.direccion  + "</td><td>" + 
            data.principal.telefono  + "<br>"+
            data.principal.tipo_persona_tel_cliente + "<br>"+
            data.principal.obser_tel_cliente +"</td><td>" + 
            data.principal.telefono_oficina  + "<br>"+
            data.principal.tipo_persona_tel_of + "<br>"+      
            data.principal.obser_tel_of +"</td><td>" + 
            data.principal.celular1  + "<br>"+
            data.principal.tipo_persona_cel1 + "<br>"+
            data.principal.obser_cel1 +"</td><td>" + 
            data.principal.celular2  + "<br>"+
            data.principal.tipo_persona_cel2 + "<br>"+
            data.principal.obser_cel2 +"</td><td>" + 
            data.principal.numero_libre+"</td><td>" + 
            data.principal.correo  + "</td><td>" + 
            data.principal.estado  + "</td><td>" + 
            data.principal.info_cisterna  + "</td></tr>");      
        }
            console.log(data.principal.comentarios);
            $("#comentarios").val(data.principal.comentarios);
            $("#comentariosG").val(data.principal.comentarios_gestion);
      
            cliente_actual = $.trim(data.principal.codigo);
            $("#cliente_selc_pargestion").val(cliente_actual);
    
            nombre_cliente_actual = data.principal.nombre_completo;
            cliente_espacios = data.principal.codigo;
            if (data.principal.estado === "Equivocado") {
              $("#tabla_clienteA").removeClass('table-dark');
              $("#tabla_clienteA").removeClass('table-success');
              $("#tabla_clienteA").addClass('table-danger');
            } else if (data.principal.estado === "Averiado") {
              $("#tabla_clienteA").removeClass('table-dark');
              $("#tabla_clienteA").removeClass('table-danger');
              $("#tabla_clienteA").addClass('table-success');
            } else {
              $("#tabla_clienteA").removeClass('table-danger');
              $("#tabla_clienteA").removeClass('table-success');
              $("#tabla_clienteA").addClass('table-dark');
            }
      
            $.when($.post("../php/gestionado.php", {
              id_act: cliente_actual
            }, function(mensaje) {
              if (mensaje == 1) {
                $("#Cliente_gestionado").removeClass("hide");
              }
            })).then(function() {
              Cookies.set("llamadas_operador", cook);
              clientes_cookie_cargado = true;
              clientes_cookie = cook;
              //console.log("cook:" , cook) ;
              //console.log("vector: " , vector) ;
            });
  
        });
      
      
    }



    $('#sel_llamadas_urgentes').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('normalLeft');
       
      
    });
    $('#sel_llamadas_semanales').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('normalLeft');
       
      
    });
    $('#sel1').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('normalLeft');
       
      
    });
    
    $('#cliente_gestionar').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('normalLeft');
       
      
    });
    
    $('#input_buscar_factura').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('selectFactura');
       
      
    });




    function posicionarMinimizables(){
        console.log('re posicion');
        pos_margen = 0;
        $('.min').each(function (){
            let margen_int = pos_margen * margen_modal;
             margen_int = margen_int+'px';
            $(this).css('left',margen_int);
            pos_margen++;
            
            //let idx_posicion = arr_id_modals.indexOf(id_modal);
            //console.log('pos:'+idx_posicion);
           
            
        });
    }



        //11082021 botones de plantillas
    $(document).on('click','.btn_aceptoU',function(){
        
        //$(".btn_aceptoU").click(function() {
        console.log('pla aceptó');
        miminizarModals();
        
      $("#fechaAcepto").val(getDia());
      $("#idcl").val(nombre_cliente_actual);
      //$(".fechapicker").datepicker("open");
      cliente_actual = cliente_urgente_actual;
      $("#cliente_selc_pargestion").val(cliente_urgente_actual)
    
      $("#horas_ocupadas").html('');
      $("#ModalA").modal();
      urge = true;
      reactivar_actividad();
    });

    $(document).on('click','.btn_volverU',function(){
        miminizarModals();
        
        //$(".btn_volverU").click(function() {
      $("#idCliente").val(nombre_cliente_actual);
      cliente_actual = cliente_urgente_actual;
    
      
      $("#cliente_selc_pargestion").val(cliente_actual)
      //$(".fechapicker").datepicker("open");
      $("#ModalR").modal();
      $("#tipoModal").html("vl");
      $("#tabla_hora").hide();
      $("#hora").val('');
      $("#minuto").val('');
      $("#hora_mos").val('');
      $("#minuto_mos").val('');
      if($("#fechaLlamada").val()!=""){
        $.post("../php/horas_ocupadas.php", 
        {
          fecha:$("#fechaLlamada").val(),
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
      }  
      urge = true;
      reactivar_actividad();
    });

    $(document).on('click','.btn_rechazoU',function(){
        miminizarModals();
        
        //$(".btn_rechazoU").click(function() {
      $("#horaRechazo").val(getHora());
      $("#fechaRechazo").val(getDia());
      $("#idclR").val(nombre_cliente_actual);
      //cliente_actual = cliente_urgente_actual;
      $("#ModalRE").modal();
      urge = true;
      reactivar_actividad();
    });
    
    $(document).on('click','.btn_NrespondeU',function(){
        miminizarModals();
        
      $("#idCliente").val(nombre_cliente_actual);
      cliente_actual = cliente_urgente_actual;
    
      //$(".fechapicker").datepicker("open");
      $("#ModalR").modal();
      $("#tipoModal").html("nr");
      $("#tabla_hora").hide();
      $("#hora").val('');
      $("#minuto").val('');
      $("#hora_mos").val('');
      $("#minuto_mos").val('');
      if($("#fechaLlamada").val()!=""){
        $.post("../php/horas_ocupadas.php", 
        {
          fecha:$("#fechaLlamada").val(),
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
      }  
      urge = true;
      reactivar_actividad();
    });

    $(document).on('click','.btn_equivocadoU',function(){
        miminizarModals();
        
    
      $("#idCliente").val(nombre_cliente_actual);
      cliente_actual = cliente_urgente_actual;
    
      //alert(cliente_actual)
      $("#cliente_selc_pargestion").val(cliente_actual);
    
      //$(".fechapicker").datepicker("open");
      $("#ModalR").modal();
      $("#tipoModal").html("eq");
      $("#tabla_hora").hide();
      $("#hora").val('');
      $("#minuto").val('');
      $("#hora_mos").val('');
      $("#minuto_mos").val('');
      if($("#fechaLlamada").val()!=""){
        $.post("../php/horas_ocupadas.php", 
        {
          fecha:$("#fechaLlamada").val(),
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
      }  
      urge = true;
      reactivar_actividad();
    });
    
    $(document).on('click','.btn_averiadoU',function(){
        miminizarModals();
        
      $("#idCliente").val(nombre_cliente_actual);
      cliente_actual = cliente_urgente_actual;
    
      //$(".fechapicker").datepicker("open");
      $("#ModalR").modal();
      $("#tipoModal").html("av");
      $("#tabla_hora").hide();
      $("#hora").val('');
      $("#minuto").val('');
      $("#hora_mos").val('');
      $("#minuto_mos").val('');
      if($("#fechaLlamada").val()!=""){
        $.post("../php/horas_ocupadas.php", 
        {
          fecha:$("#fechaLlamada").val(),
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
      }  
      urge = true;
      reactivar_actividad();
    });
    

    $(document).on('click','.btn_otroU',function(){
        console.log('bt otro');
        miminizarModals();
        
      $("#idCliente").val(nombre_cliente_actual);
      cliente_actual = cliente_urgente_actual;
    
      //$(".fechapicker").datepicker("open");
      $("#ModalR").modal();
      $("#tipoModal").html("ot");
      $("#tabla_hora").hide();
      $("#hora").val('');
      $("#minuto").val('');
      $("#hora_mos").val('');
      $("#minuto_mos").val('');
      if($("#fechaLlamada").val()!=""){
        $.post("../php/horas_ocupadas.php", 
        {
          fecha:$("#fechaLlamada").val(),
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
      }  
      urge = true;
      reactivar_actividad();
    });


    function miminizarModals(){
        $('.minimizable ').each( function(){
            if( !$(this).hasClass("min") ){
                let idm = $(this).attr('id');
                if( idm.indexOf('%') == -1 ){
                    console.log('minimizar:'+idm);
                    $('#'+idm+' .modalMinimize').click();
                }
            }
        });
    }
    


    //17082021
    function validaHoraMinuto(extension,siguiente){
        
        console.log('ext:'+extension+'---hora:'+$('#horaAC'+extension).val()+'-min:'+$('#minutoAC'+extension).val());
        int_hora = parseInt($('#horaAC'+extension).val());
        int_minuto = parseInt($('#minutoAC'+extension).val());
        console.log('int_hora:'+int_hora+'-int_minuto:'+int_minuto);
        let puede_siguiente = true;
       
            if (int_hora >= 0 && int_hora < 6) {
                $('#horaAC'+extension).focus();
                puede_siguiente = false;
                console.log('e2');
              $(".alertaHNL").removeClass("hide");
            } else if (int_hora == 6 && $('#minutoAC'+extension).val() != "") {
              if (int_minuto == 0 || int_minuto >= 60 ) {
                  $('#minutoAC'+extension).focus();
                  puede_siguiente = false;
                  console.log('e3');
                $(".alertaHNL").removeClass("hide");
              } else {
                $(".alertaHNL").addClass("hide");
              }
            } else if (int_hora == 18 && $('#minutoAC'+extension).val() != "") {
                if (int_minuto > 0 ) {
                    $('#minutoAC'+extension).focus();
                  puede_siguiente = false;
                  console.log('e4');
                    $(".alertaHNL").removeClass("hide");
                } else {
                    $(".alertaHNL").addClass("hide");
                }
            }
            else if( int_hora > 18 ){
                $('#horaAC'+extension).focus();
                puede_siguiente = false;
                  console.log('e5');
                    $(".alertaHNL").removeClass("hide");
            }
            else if( int_minuto > 59 ){
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

    function eliminarMarkers(){
        console.log('eliminar markers'+markers.length);
       markerCluster.clearMarkers();

       /*for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }*/
    }

    //20082021 función para limitar números en hora minutos
    function validaFormatoHora(val,es_hora,id,siguiente){
        console.log('v:'+val+'-l:'+val.length);
        let int_v = parseInt(val);
        let is_valid = false;
        if(es_hora){
            if( val.length >= 3 ){
                $('#horaAC'+id).val('');
                $('#horaAC'+id).focus();
            }
            else{
                is_valid=true;
            }
        }
        else{
            if( val.length >= 3 ){
                $('#minutoAC'+id).val('');
                $('#minutoAC'+id).focus();
            }
            else{
                is_valid=true;
            }
        }
        
        console.log(is_valid);
        if( is_valid && val.length == 2){
            if( es_hora )
            $('#minutoAC'+id).focus();
            else
            $('#comment'+id).focus();
            
        }
        
        

    }
    
