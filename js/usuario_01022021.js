var esta_aumentando = false;
var cliente_actual;
var nombre_cliente_actual;
var cliente_espacios;
var cliente_urgente_actual;
var esta_importante = false;
var tiempo_ausente = 0;
var urge = false;
var llamadas_hoy = [];
var contador;
var horasT = 0,
  minutosT = 0,
  segundosT = 0,
  horasA = 0,
  minutosA = 0,
  segundosA = 0;
var cantidad_clientes;
var clientes_cookie_cargado = false;
var clientes_cookie;
var ultima_busqueda;

llenar_hoy();
 
bloquear_urgente();

verificar_inactividad();

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
  cargar_gestion();
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

  $(".loader").fadeIn("slow");
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

var num = Math.ceil((Math.random() * 10) % 12);

switch (num) {

  case 1:
    {
      $("#ContainerVM").html("<img src=\"http://solomotivaciondescargar.com/wp-content/uploads/2016/08/descargar-imagenes-de-motivacion.png\" class=\"img_motivacional\">");
      break;
    }
  case 2:
    {
      $("#ContainerVM").html("<img src=\"http://solomotivaciondescargar.com/wp-content/uploads/2016/08/imagenes-de-motivaciones.png\" class=\"img_motivacional\">");
      break;
    }
  case 3:
    {
      $("#ContainerVM").html("<img src=\"https://lh6.googleusercontent.com/-gM3-I1UvTdk/Ugvx26sLdiI/AAAAAAAA3IQ/c1Yujs6hMCg/w1200-h720/WillSmith-PUEDES.jpg\" class=\"img_motivacional\"> ");
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
      $("#ContainerVM").html("<img src=\"https://cf-cdn.gananci.com/wp-content/uploads/2015/01/Mujer-sosteniendo-una-taza-con-una-frase-motivadora.jpg\" class=\"img_motivacional\">");
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
      $("#ContainerVM").html("<img src=\"http://solomotivaciondescargar.com/wp-content/uploads/2016/08/imagenes-animadas-de-motivacion-laboral.png\" class=\"img_motivacional\">");
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

  $(".loader").fadeIn("slow");
  contador = 1;
  ////console.log("cargar_gestion :") ;
  $.post("../php/getAllClients.php", {
    ide: $("#identificador_usuario").html()
  }, function(mensaje) {
    ////console.log(mensaje) ;
    var cl = mensaje.split("=");
    var cadena = "1|";

    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      cadena += ($.trim(sc[0]) + "|");
    }

    cookies_cargadas = true;
    clientes_cookie_cargado = true;
    clientes_cookie = cadena;

    llenar_clientes();

  });
}

function llenar_clientes( desdeReporte ) {

  // Si no se ha gestionado en los botones se guarda como tiempo muerto, de lo contrario no.
  $.when(function() {
    setTimeout(function() {}, 1000);
  }).then(function() {
    if (!gestionado_botones) {
      guardar_tiempo('tp', cliente_actual);
    }
  });

  /* Termina contador de gestion */
  var vector = [];
  
  if (clientes_cookie === undefined) {
    alert("Error CO4503, por favor comunicate con el administrador de la plataforma.");
  }

  var vector = clientes_cookie.split("|");

  if (c)
    c = false;

  cantidad_clientes = -1;

  for (var i = 0; i < vector.length; i++) {
    if (vector[i]!="") {
      cantidad_clientes++;
    }
  }

  if (typeof contador !== 'undefined') {

    if (contador > cantidad_clientes) {
      contador = 1;
    }

  }else {

    var codigo_cliente = $("#cliente_seleccionado").html();

    ////console.log(vector);

    //console.log('codigo cliente: '+codigo_cliente);

    for (var i = 0; i < vector.length; i++) {
      if (vector[i]==codigo_cliente && vector[i] != "") {
         contador = i ;                         //////////////////////////////////////////////////////////////////////////////////////////
      }
    }



  }
  //console.log("contador")
  var indice = contador;

  var id_actual = vector[indice];
  //console.log("id_actual" , id_actual) ;
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
    if (indice > 1) {
      id_anterior = vector[indice - 1];
    } else {
      id_anterior = vector[cantidad_clientes];
    }

    indice++;

    var id_nxt = vector[indice];

    if (id_nxt == "" || id_nxt === undefined) {
      id_nxt = vector[1];
    }

    indice++;

    var id_nxt2 = vector[indice];

    if (id_nxt2 == "" || id_nxt2 === undefined) {
      id_nxt2 = -1;
    }

    indice--;
    contador++;
    //console.log("indice: " ,  indice) ;
    //console.log("contador" , contador ) ;
    var cook = "" + indice + "|";

    for (var l = 1; l < vector.length; l++) {
      cook += (vector[l] + "|");
    }

    
    




    $.when(
      

      $.post("../php/getDatosCliente1.php", 
      {
        id_act: id_actual,
        id_ant: id_anterior,
        id_next: id_nxt,
        id_next2: id_nxt2
      }, 
      function procesar(data){
        //console.log(data.principal.nombre_completo )
  
  
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
  
        $("#tabla_clienteA tbody").html("<tr><th scope=\"row\">" + 
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
        data.principal.celular2  + "<br>"+
        data.principal.tipo_persona_cel2 + "<br>"+
        data.principal.obser_cel2 +"</td><td>" + 
        data.principal.correo  + "</td><td>" + 
        data.principal.estado  + "</td><td>" + 
        data.principal.info_cisterna  + "</td></tr>");      
        }
        
  
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

  $.post("../php/getAllClients.php", {
    ide: $("#identificador_usuario").html()
  }, function(mensaje) {

    var cl = mensaje.split("=");
    var cadena = "1|";

    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      cadena += ($.trim(sc[0]) + "|");
    }

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

function release_client_id(id){

  //cargar_gestion();

  $.post('release_client.php', {
    id: id
  },
  function() {

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

    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      var some = $("#registrosD tbody").html();
      $("#registrosD tbody").html(some + "<tr><th scope=\"row\">" + sc[0] + "</th><td>" + sc[4] + "</td><td>" + sc[1] + "</td><td>" + sc[2] + "</td></tr>");
    }
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
    for (var i = 0; i < cl.length - 1; i++) {
      var sc = cl[i].split("|");
      
      $("#registrosW tbody").append("<tr><th scope=\"row\">" + sc[0] + "</th><td>" + sc[4] + "</td><td>" + sc[1] + "</td><td>" + sc[2] + "</td></tr>")
    }
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
  cliente_urgente_actual = $.trim(id_cliente);
  $.when($.post("../php/obtenerDatosCliente.php", {
    if: $.trim(id_cliente)
  }, function(mensaje) {
    //console.log('MENSAJE--', mensaje)
    var w = mensaje.split("|");
    $("#cliente_selc_pargestion").val($.trim(id_cliente))

    $("#tabla_clienteU tbody").html("<tr><th scope=\"row\">" + w[1] + "</th><th>" + w[2] + "</th><td>" + w[3] + "</th><td>" + w[11] + "</td></tr>");
    $("#tabla_clienteU2 tbody").html("<tr></td><td>" + w[4] + "</td><td>" + w[5] + "</td><td>" + w[6] + "</td><td>" + w[7] + "</td><td>" + w[8] + "</td></tr>");
    $("#comentariosU").val(w[9]);
    $("#comentariosUG").val(w[10]);
    nombre_cliente_actual = w[1];
  })).then(function() {
    

    //alert($.trim(id_cliente))
    total_segundos = 0;
    if (!esta_aumentando) {
      aumentar_segundos_gestion();
      esta_aumentando = true;
    }

    $(".loader").fadeOut("fast");
    $("#gestionModal").modal();


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
      persona4,persona4,
      ope: $("#identificador_usuario").html(),
      isis: icis
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

          $("#ModalMC").modal();
        });
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

    $.post('../php/actualizarCliente.php', {
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
      persona4,persona4,
      ope: $("#identificador_usuario").html(),
      ic: infoC
    }, function(mensaje) {
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
  $("#fechaAcepto").val(getDia());
  $("#idcl").val(nombre_cliente_actual);
  //$(".fechapicker").datepicker("open");
  $("#horas_ocupadas").html('');
  $("#ModalA").modal();
  reactivar_actividad();
});
$("#btn_rechazo").click(function() {
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
                  if (!urge) {
                    llenar_clientes();
                  }
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
              $("#gestionModal").modal('toggle');
            }
        $("#mensaje_error_acepto").addClass('hide');
        sumar_gestion('ac', $("#cliente_selc_pargestion").val());
        gestionado_botones = true;
        guardar_tiempo('ac', $("#cliente_selc_pargestion").val());



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
          $("#gestionModal").modal('toggle');
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
                $("#gestionModal").modal('toggle');
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

      if (x == h && y == m) {
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
}

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
  window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=s&cl=" + $.trim(x[1]));
});

$("#btn-head").click(function(event) {
  reactivar_actividad();
  window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_urgente_actual));
});

$("#bPDF").click(function(event) {
  reactivar_actividad();
  window.open('../control_archivos.html?id=' + $.trim($("#identificador_usuario").html()) + "&u=b&cl=" + $.trim(cliente_actual));
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


$("#btn-buscar-c").click(function() {
  $(".search").fadeIn("slow");
  buscar_ciudadela($("#input_BCC").val());
  reactivar_actividad();
});

$("#btn-buscar-cc").click(function() {
  $(".search").fadeIn("slow");
  buscar_telefono($("#input_BCCC").val());
  reactivar_actividad();
});
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
//////////techplus lhr
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
  var hoy = new Date();
  var dd = hoy.getDate();
  var mm = hoy.getMonth() + 1 + parseInt(meses_futuro);
  var yyyy = hoy.getFullYear();
  if (mm > 12) {
    mm -= 12;
    yyyy += 1;
  }
  $("#fechaLlamadaPV").val(dd + "/" + mm + "/" + yyyy);
  $("#horaPV").val('06');
  $("#minutoPV").val('30');
}

function guardar_tiempo(tipo, cliente) {
  var ntipo = get_tipo(tipo);
  var segundos = total_segundos,
    minutos = 0,
    horas = 0,
    tiempo = '';
  total_segundos = 0;
  gestionado_botones = false;

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
  $.post('../php/guardar_tiempo.php', {
    tipo: ntipo,
    cliente: cliente,
    tiempo: tiempo
  }, function(message) {});
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
  indice--;

  if (indice == 1) {
    indice = cantidad_clientes;
  } else {
    indice--;
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
  $.post("../php/getAllClients.php", {
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