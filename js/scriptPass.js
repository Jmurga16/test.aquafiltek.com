$("#CPuser").val(getParameterByName('user'));
$("#btn-actualizar").click(function() {
    var id = getParameterByName('id');
    if ($("#CPPass").val() == "" || $("#CPCPass").val() == "") {
        $("#msj-nactu").html("<p>Error uno de los campos <b>esta vacio.</b></p>");
        $("#msj-nactu").css("display", "block");
    } else {
        if ($("#CPPass").val() == $("#CPCPass").val()) {
            $.post("../php/actualizar_password.php", { iden: id, pass: $("#CPCPass").val() }, function(mensaje) {
                if (mensaje == 1) {
                    $("#msj-actu").html("<p>La contraseña fue actualizada exitosamente</p>" + "<p> haz <a class=\"link-success\" href=\"javascript:cerrar();\">click aqui</a> para volver</p>");
                    $("#msj-actu").css("display", "block");
                    $("#msj-nactu").css("display", "none");
                } else {
                    $("#msj-nactu").html("Error actualizando la contraseña, intenta de nuevo mas tarde.");
                    $("#msj-nactu").css("display", "block");
                    $("#msj-actu").css("display", "none");
                }
            });
        } else {
            $("#msj-nactu").html("<p>Error las contraseñas <b>no coinciden</b></p>");
            $("#msj-nactu").css("display", "block");
            $("#msj-actu").css("display", "none");
        }
    }

});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function cerrar() { 
   window.open('','_parent',''); 
   window.close(); 
} 