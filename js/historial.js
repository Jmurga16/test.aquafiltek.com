var usuario = getParameterByName('user');
var identificador = getParameterByName('id');
$("#user").html(usuario);
$.post("../php/ver_historial.php", { ide: identificador }, function(mensaje) {
    // console.log(mensaje);
    // var logins = mensaje.split("-");
    // console.log(logins);
    // for (var i = 1; i <= logins[0]; i++) {
    //     var aux = logins[i].split(",");
    //     var auxiliar = $("#registros").find("tbody").html();
    //     if (aux[1] == "") {
    //         if (aux[5] == "00:00:00") {
    //             $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[4] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>"+"</td><td>"+aux[6]+"</td></tr>");
    //         } else {
    //             $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[4] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td> " + aux[5] +"</td><td>"+aux[6]+ "</td></tr>");
    //         }
    //     } else {
    //         if (aux[5] == "00:00:00") {
    //             $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[4] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + " </td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>"+"</td><td>"+aux[6]+"</td></tr>");
    //         } else {
    //             $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[4] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + "</td> <td>" + aux[2] + "</td><td>" + aux[5] +"</td><td>"+aux[6]+ "</td></tr>");
    //         }
    //     }

    // }
    

    // 2019 second !!!
    //master
    var logins = mensaje.split("-");
    for (var i = 1; i <= logins[0]; i++) {
        var aux = logins[i].split(",");
        var auxiliar = $("#registros").find("tbody").html();        
        aux = aux.slice(1) ;
        console.log(aux);
        if (aux[1] == "") {
            console.log("fdsfds") ;
            if (aux[4] == "00:00:00") {
                $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>"+"</td><td>"+aux[5]+"</td></tr>");
            } else {
                $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td> " + aux[4] +"</td><td>"+aux[5]+ "</td></tr>");
            }
        } else {
            if (aux[4] == "00:00:00") {
                $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + " </td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>"+"</td><td>"+aux[5]+"</td></tr>");
            } else {
                $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + "</td> <td>" + aux[2] + "</td><td>" + aux[4] +"</td><td>"+aux[5]+ "</td></tr>");
            }
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