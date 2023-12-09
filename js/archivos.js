function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
$("#operador").val(getParameterByName('id'));
$("#operador2").val(getParameterByName('id'));
$("#cliente").val(getParameterByName('cl'));

$.post('./php/obtener_rutas.php', { 
    id: getParameterByName('id'),cliente:getParameterByName('cl') }, 
    function(data) {
    //console.log("mensaje", mensaje);

    $.each(data,function(index_data,registros){
        $("#ruta").append(new Option(registros.ruta+" / "+registros.name+" / "+registros.fecha, registros.ruta));
       
    });


    /*var x = mensaje.split("~");
    for (var i = 1; i <= x[0]; i++) {
        var aux = $("#ruta").html();
        $("#ruta").html(aux + "<option>" + x[i] + "</option>");
    }*/
    $(".loader").fadeOut('slow');
}, 
"json");

$("#ruta").change(function() {
    ruta = $(this).children(":selected").html();
    if (ruta === "Seleccionar Archivo") {
        $("#descargarPDF").addClass('hide');
    } else {
     $("#descargarPDF").removeClass('hide');
    }
});

if(getParameterByName('u')==='b'){
$("#SubirArchivo").addClass('hide');
}
else{
 $("#DescargarArchivo").addClass('hide');   
}