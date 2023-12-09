$(".search").fadeOut("fast");
var clientes_total;

function llenar_control(dir, contain) {
    var container = "#container" + contain;
    var contenido = $(container).html();
    $(container).html("");
    $.post("../php/obtenerUsers.php", {}, function(mensaje) {
        var usuarios = mensaje.split("-");
        for (var i = 1; i <= usuarios[0]; i++) {
            var aux = usuarios[i].split(",");
            var contenido = $(container).html();
            $(container).html(contenido + "<div class=\"nombre_user\"><a href=\"" + "../php/" + dir + "?user=" + aux[1] + "&id=" + aux[0] + "\" target=\"_blank\">" + aux[1] + "</a></div>");
        }
    });
}

function llenar_menus() {
    $(".loader").fadeIn("slow");
    $("#AOC").html("");
    $.post("../php/obtenerClientes.php", {}, function(mensaje) {
        $("#AOC").append(mensaje);
    });

    var container = "#MPO";
    $(container).html("");
    $.post("../php/obtenerUsers.php", {}, function(mensaje) {
        var usuarios = mensaje.split("-");
        for (var i = 1; i <= usuarios[0]; i++) {
            var aux = usuarios[i].split(",");
            var contenido = $(container).html();
            $(container).html(contenido + "<a class=\"dropdown-item\" href=\"" + "../php/cambiarPermisos.php?user=" + aux[0] + "\" target=\"_blank\">" + aux[1] + "</a>");
        }
        $(".loader").fadeOut("slow");

    });
}
$("#btn-registrar").click(function() {
    var name = $("#RinputNC").val();
    var us = $("#RinputUser").val();
    var passw = $("#RinputPass").val();
    if (name == "" || us == "" || passw == "") {
        $("#msj-err").html("<p>Tiene que diligenciar <b>todos</b> los campos.</p>");
        $("#msj-succ").css("display", "none");
        $("#msj-err").css("display", "block");
    } else {
        $("#RinputNC").val("");
        $("#RinputUser").val("");
        $("#RinputPass").val("");
        $.post("../php/create_User.php", { usuario: us, password: passw, nombre: name }, function(mensaje) {
            if (mensaje == -1) {
                $("#msj-err").html("<p>El usuario <b>" + us + "</b> ya esta se encuentra registrado.</p>");
                $("#msj-succ").css("display", "none");
                $("#msj-err").css("display", "block");
            } else if (mensaje == 1) {
                $("#msj-succ").html("<p>El usuario <b>" + us + "</b> ha sido creado con exito.</p>");
                $("#msj-succ").css("display", "block");
                $("#msj-err").css("display", "none");
            }
        });
    }
});

$("#CrearU").click(function() {
    $("#PcrearU").addClass("active");
    $("#containerRegister").addClass("fondo");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");

    if ($("#containerRegister").css("display") == "none") {
        $("#containerRegister").toggle("slow", function() {
            $("#containerRegister").css("display", "block");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function() {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function() {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function() {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function() {
            $("#containerGR").css("display", "none");
        });

    }
});
$("#ControlU").click(function() {
    $("#PcrearU").removeClass("active");
    $("#PcontrolU").addClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");

    if ($("#containerControl").css("display") == "none") {
        $("#containerControl").toggle("slow", function() {
            $("#containerControl").css("display", "block");
        });
    }

    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function() {
            $("#containerRegister").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function() {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function() {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function() {
            $("#containerGR").css("display", "none");
        });

    }
    llenar_control("Historial_Usuario.php", "Control");
});
$("#CambiarP").click(function() {
    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").addClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");

    if ($("#containerCP").css("display") == "none") {
        $("#containerCP").toggle("slow", function() {
            $("#containerCP").css("display", "block");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function() {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function() {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function() {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function() {
            $("#containerGR").css("display", "none");
        });

    }
    llenar_control("Control_Passwords.php", "CP");
});


$("#ControlP").click(function() {
    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").addClass("active");
    $("#GenerarR").removeClass("active");


    if ($("#containerPO").css("display") == "none") {
        $("#containerPO").toggle("slow", function() {
            $("#containerPO").css("display", "block");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function() {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function() {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function() {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function() {
            $("#containerGR").css("display", "none");
        });

    }
    llenar_menus();
});
$("#GenerarR").click(function() {
    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").addClass("active");


    if ($("#containerPO").css("display") == "block") {
        $("#containerPO").toggle("slow", function() {
            $("#containerPO").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function() {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function() {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function() {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "none") {
        $("#containerGR").toggle("slow", function() {
            $("#containerGR").css("display", "block");
        });

    }
    llenar_menus();
});

$("#cerrar_sesion").click(function() {
    $.post("../php/exit_script.php", {}, function(mensaje) {
        if (mensaje == 1)
            location.replace("../index.html");
    });
});

$("#btn-b").click(function() {
    var msx = $("#input_BP").val();
    $(".search").fadeIn("slow");
    $.post('../php/buscar_clientes.php', { busqueda: msx }, function(msj) {
        var clientes = msj.split("~");
        clientes_total = clientes;
        if (clientes[0] != 0) {
            ultima_busqueda = clientes;
            $("#cliente_gestionar").html("<option>Selecciona el cliente<o/ption>");
            for (var i = 1; i <= clientes[0]; i++) {
                var cliente_actual = clientes[i].split("|");
                var aux = $("#cliente_gestionar").html();
                $("#cliente_gestionar").html(aux + "<option " + "value=\"" + i + "\"" + ">" + cliente_actual[1] + "</option>");
            }
            $("#Modal_BC").modal();
            $(".search").fadeOut("slow");
        } else {
            $(".search").fadeOut("slow");
            $("#snackbar").html("No existe ningun cliente con ese nombre, revisa e intentalo de nuevo.");
            $("#snackbar").addClass('show');
            setTimeout(function() { $("#snackbar").removeClass('show'); }, 5000);
        }
    });
});

$("#AsignarOBC").click(function() {
    var msjx = $("#cliente_gestionar").children(':selected').html();
    var id;
    console.log("clientes_total.lenght", clientes_total.length);
    for (var i = 0; i < clientes_total.length; i++) {
        var aux = clientes_total[i].split("|");
        if (aux[1] === msjx)
            id = i;
    }
    console.log("id", id);
    var newc = clientes_total[id].split("|");
    console.log("clientes_total[id]", clientes_total[id]);
    var dominio = "../php/asignarOperador.php?ide=" + newc[0] + "&name=" + newc[1] + "&oa=NA"
    $("#Modal_BC").modal("toggle");
    window.open(dominio);
});

$('.datepicker').datepicker({
    todayHighlight: true,
    showOnFocus: true,
    format: 'dd/mm/yyyy',
    uiLibrary: 'bootstrap4'
});
/*
EXCEL=bf57c906fa7d2bb66d07372e41585d96
PDF=437175ba4191210ee004e1d937494d09
*/
$("#generarReporte").click(function(event) {
    // var date = $("#fechaAcepto").val();
    var date = $("#fechaAcepto").val().split("-");
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

$("#generarReporte2").click(function(event) {
    var date = $("#reportrange").val().split("-");
    var opera = $("#usuario_report").val();
    var ordenamiento = $("#tipo_ordenamiento").val();
    console.info("date", date);
    if ($("#tipo_export").val() == 1) {
        R2generar(date, '437175ba4191210ee004e1d937494d09', opera, ordenamiento);
    } else {
        R2generar(date, 'bf57c906fa7d2bb66d07372e41585d96', opera, ordenamiento);
    }

});
$("#generarReporteCNG").click(function(event) {
    var user = $("#usuario_reportCNG").val();
    if ($("#tipo_exportCNG").val() == 1) {
        R3generar('437175ba4191210ee004e1d937494d09', 0);
    } else {
        R3generar('bf57c906fa7d2bb66d07372e41585d96', 0);
    }

});

function R1generar(date, type) {
    var fecha = date[0].trim().split("/");
    var fechaF = date[1].trim().split("/");
    window.open('../php/report_acepto.php?day=' + fecha[0] + '&month=' + fecha[1] + '&year=' + fecha[2] + '&day2=' + fechaF[0] + '&month2=' + fechaF[1] + '&year2=' + fechaF[2] + '&type=' + type + '&report=accept');
}

function R2generar(date, type, operator, order) {
    var fechaI = date[0].split("/");
    var fechaF = date[1].split("/");
    window.open('../php/reporte_historial.php?day1=' + fechaI[0] + '&month1=' + fechaI[1] + '&year1=' + fechaI[2] + '&day2=' + fechaF[0] + '&month2=' + fechaF[1] + '&year2=' + fechaF[2] + '&op=' + operator + '&or=' + order + '&type=' + type + '&report=history');
}

function R3generar(type,user) {
    window.open('../php/reporte__cng.php?user=' + user +'&type=' + type + '&report=cng');
}

$(function() {
    var start = moment();
    var end = moment().add(7, 'days');
    $('input[name="daterange"]').daterangepicker({
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
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

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
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});

$("#ecr").click(function() {
  window.open('eliminar_clientes.php');
});
