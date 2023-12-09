$.post("../php/getUsuario.php", { id: getParameterByName('user') }, function(mensaje) {
    var cad1 = "<div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios\" id=\"SIP\" value=\"option1\" checked>  <label class=\"form-check-label\" for=\"exampleRadios1\">    Puede agregar nuevos clientes y modificar los datos.  </label></div><div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios\" id=\"NOP\" value=\"option2\">  <label class=\"form-check-label\" for=\"exampleRadios2\">NO puede agregar nuevos clientes.</label></div>";
    var cad2 = "<div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios\" id=\"SIP\" value=\"option1\">  <label class=\"form-check-label\" for=\"exampleRadios1\">    Puede agregar nuevos clientes y modificar los datos.  </label></div><div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios\" id=\"NOP\" value=\"option2\" checked>  <label class=\"form-check-label\" for=\"exampleRadios2\">NO puede agregar nuevos clientes.</label></div>";

    //agregando permiso de inactivar
    var cad3 = "<div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios1\" id=\"SIP1\" value=\"option1\" checked>  <label class=\"form-check-label\" for=\"exampleRadios1\">    Puede inactivar clientes.  </label></div><div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios1\" id=\"NOP1\" value=\"option2\">  <label class=\"form-check-label\" for=\"exampleRadios2\">NO puede inactivar clientes.</label></div>";
    var cad4 = "<div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios1\" id=\"SIP1\" value=\"option1\">  <label class=\"form-check-label\" for=\"exampleRadios1\">    Puede inactivar clientes.  </label></div><div class=\"form-check\">  <input class=\"form-check-input\" type=\"radio\" name=\"exampleRadios1\" id=\"NOP1\" value=\"option2\" checked>  <label class=\"form-check-label\" for=\"exampleRadios2\">NO puede inactivar clientes.</label></div>";


    var aux = mensaje.split("|");

    if (aux[1] == 1) {
        if(aux[2] == 1)
        {
            $("#formulario").html($("#formulario").html() + cad1 + "<br/><br/>"+ cad3);
        }
        else
        {
            $("#formulario").html($("#formulario").html() + cad1 + "<br/><br/>"+cad4);
        }
        
    } else {
        if(aux[2] == 1)
        {
            $("#formulario").html($("#formulario").html() + cad2 + "<br/><br/>"+cad3);
        }
        else
        {
            $("#formulario").html($("#formulario").html() + cad2 + "<br/><br/>"+cad4);
        }
        
    }


    $("#RinputNC").val($.trim(aux[0]));
});

$("#btn-actualizar").click(function() {
    var puede;
    var puede1;
    if ($("#SIP").is(':checked')) {
        puede = true;
    } else {
        puede = false;
    }
    if($("#SIP1").is(':checked'))
    {
        puede1 = true;
    }
    else
    {
        puede1 = false;
    }
    $.post("../php/actualizar_permisos.php", { id: getParameterByName('user'), puede: puede, puede1: puede1 }, function(mensaje) {

        if (mensaje == 1) {
            alert("Los permisos se han actualizado con exito");
            window.open('', '_parent', '');
            window.close();
        } else {
            alert("Hubo un error actualizando los permisos, intenta de nuevo mas tarde" + mensaje);
            window.open('', '_parent', '');
            window.close();
        }
    });

});


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}