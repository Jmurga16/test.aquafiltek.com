var usuario = getParameterByName('user');
var identificador = getParameterByName('id');
$("#user").html(usuario);

getCurrentDate();
getDataTable()


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function cerrar() {
    window.open('', '_parent', '');
    window.close();
}

function convertDateYYYYMMDD(dateInput) {
    var dd = dateInput.getDate();
    var mm = dateInput.getMonth() + 1;
    var yyyy = dateInput.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    return (yyyy + '-' + mm + '-' + dd);

}

function getCurrentDate() {

    var currentDate = new Date()
    var today = convertDateYYYYMMDD(currentDate)

    var lastMonth = new Date();
    lastMonth.setMonth(currentDate.getMonth() - 1);

    var start = convertDateYYYYMMDD(lastMonth)

    document.getElementById("startDate").setAttribute("max", today);
    document.getElementById("endDate").setAttribute("max", today);
    document.getElementById('startDate').value = start;
    document.getElementById('endDate').value = today;
}

function getDataTable() {

    var fechaInicio = document.getElementById('startDate').value
    var fechaFin = document.getElementById('endDate').value

    $("#tbodyid").empty();

    $.post("../php/Administrador/ControlUsuarios/getHistorialUsuario.php", { ide: identificador, startDate: fechaInicio, endDate: fechaFin }, function (mensaje) {
        var logins = mensaje.split("-");

        for (var i = 1; i <= logins[0]; i++) {
            var aux = logins[i].split(",");

            var auxiliar = $("#registros").find("tbody").html();
            aux = aux.slice(1);
            //console.log(aux);
            if (aux[1] == "") {
                if (aux[4] == "00:00:00") {
                    $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>" + "</td><td>" + aux[5] + "</td></tr>");
                } else {
                    $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td class=\"text-success\" > <b>Sesion activa <span class=\"text-danger\">/No cerrada</span></b></td> <td>" + aux[2] + "</td><td> " + aux[4] + "</td><td>" + aux[5] + "</td></tr>");
                }
            } else {
                if (aux[4] == "00:00:00") {
                    $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + " </td> <td>" + aux[2] + "</td><td class=\"text-success\" > <b>No contabilizado</b>" + "</td><td>" + aux[5] + "</td></tr>");
                } else {
                    $("#registros").find("tbody").html(auxiliar + "<tr><th scope=\"row\">" + aux[3] + "</th> <th>" + aux[0] + "</th> <td >" + aux[1] + "</td> <td>" + aux[2] + "</td><td>" + aux[4] + "</td><td>" + aux[5] + "</td></tr>");
                }
            }
        }

    });
}