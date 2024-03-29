$(".search").fadeOut("fast");
var clientes_total;
var operador_escal = 0;
var actuales = [];
var nuevos = [];
var grupos_sel = [];
var actuales_oper = [];
var nuevos_oper = [];
var loading = false
var codigo_cliente = "";

$("#cerrar_sesion").click(function () {
    $.post("../php/exit_script.php", {}, function (mensaje) {
        if (mensaje == 1)
            location.replace("../index.html");
    });
});


function llenar_control(dir, contain) {
    var container = "#container" + contain;
    var contenido = $(container).html();
    $(container).html("");
    $.post("../php/obtenerUsers.php", {}, function (mensaje) {

        var usuarios = mensaje.split("-");
        for (var i = 1; i <= usuarios[0]; i++) {
            var aux = usuarios[i].split(",");
            var contenido = $(container).html();
            let url1 = "<a href=\"" + "../php/" + dir + "?user=" + aux[1] + "&id=" + aux[0] + "\" target=\"_blank\">" + aux[1] + "</a>";
            let url2 = "<a href=\"" + "../php/reporte_gestiones.php?id=" + aux[0] + "&tipo=semanal" + "&user=" + aux[1] + "\"  target=\"_blank\">Reporte semanal</a>";
            let url3 = "<a href=\"" + "../php/reporte_gestiones.php?id=" + aux[0] + "&tipo=mensual" + "&user=" + aux[1] + "\"  target=\"_blank\">Reporte mensual</a>";

            $(container).html(contenido + "<div class=\"nombre_user\">" + url1 + url2 + url3 + "</div>");
        }
    });
}

function n_grupo() {
    $('#n_grupo').modal('show');
}

function editar(id) {
    $.post("../php/obtenerCliente.php", { id: id }, function (data) {
        var cl = data.split("=");

    });
    $('#ModalMC').modal('show');
}

function mostrar_archivados() {
    var tabla1 = document.getElementById('div_archivados');
    var button1 = document.getElementById('mostrar_archivados');
    var tabla2 = document.getElementById('div_inactivos');
    if (tabla1.style.display == 'none') {
        tabla1.style.display = '';
        button1.value = 'Ver inactivos';
        tabla2.style.display = 'none';
    }
    else {
        tabla1.style.display = 'none';
        tabla2.style.display = '';

        button1.value = 'Ver archivados';
    }
}

function eliminar_cliente(id) {

    $.ajax({
        type: 'post',
        url: '../php/eliminarCliente1.php',
        data: 'codigo=' + id,
        success: function () {
            location.reload();
        }
    });

}

function desarchivar_cli(id) {

    $.ajax({
        type: 'post',
        url: '../php/restaurarCliente.php',
        data: 'codigo=' + id,
        success: function () {
            location.reload();
        }
    });

}

function abrirEditarCliente(cod_cliente) {

    cliente_actual = cod_cliente
    $.post('../php/obtenerDatosCliente.php', {
        if: cliente_actual
    }, function (mensaje) {
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

function seleccionarTodos() {
    sele = document.getElementById('slpage').checked;
    if (sele == true) {
        $(otable.rows({ page: 'current' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", true);
            let index = nuevos.indexOf($this.attr('id'));

            if (index == -1) {
                nuevos.push($this.attr('id'));
            }
            else {
                nuevos.splice(index, 1);
            }
        });
    }
    else {
        $(otable.rows({ page: 'current' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", false);

            let index = nuevos.indexOf($this.attr('id'));
            if (index == -1) {

            }
            else {
                nuevos.splice(index, 1);
            }
        });
    }
}

function seleccionarTodosT() {
    sele = document.getElementById('slall').checked;
    if (sele == true) {
        $(otable.rows({ page: 'all', search: 'applied' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", true);

            let index = nuevos.indexOf($this.attr('id'));

            if (index == -1) {
                nuevos.push($this.attr('id'));
            }
            else {
                nuevos.splice(index, 1);
            }
        });
    }
    else {
        $(otable.rows({ page: 'all', search: 'applied' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", false);

            let index = nuevos.indexOf($this.attr('id'));
            if (index == -1) {

            }
            else {
                nuevos.splice(index, 1);
            }
        });
    }

}

function mostrar_canton(prov) {
    if (prov != '') {
        $.post("../php/getCanton.php", { provincia: prov }, function (data) {
            document.getElementById('canton_group').innerHTML = data;
        });
    }
}

function mostrar_parro(canton) {
    if (canton != '') {
        $.post("../php/getParro.php", { canton: canton }, function (data) {
            document.getElementById('parroquia_group').innerHTML = data;
        });
    }
}

function actualizar_filtro() {
    var nfiltro = document.getElementById('dias').value;
    if (nfiltro == '') {
        alert('Seleccione la cantidad de días para filtrar en recordatorios.')
    }
    else {
        $.post("../php/actualizarFiltro.php", { filtro: nfiltro, }, function (mensaje) {
            if (mensaje == 1) {
                alert('Filtro actualizado correctamente.');
                location.reload();
            }
            else {

                alert('Hubo un problema al actualizar el filtro, favor de intentar nuevamente.');
                location.reload();
            }
        });
    }
}

function reactivar_cli(id) {
    var aceptar = confirm('¿Esta seguro de reactivar a este cliente?');
    if (aceptar == true) {

        $.ajax({
            type: 'post',
            url: '../php/reactivarCliente.php',
            data: 'codigo=' + id,
            success: function () {

            }
        });
        $.post("../php/obtenerInactivos.php", {}, function (mensaje) {
            $("#llenar_inactivos").append(mensaje);
        });

        location.reload();
    }
}

function llenar_menus() {
    $(".loader").fadeIn("slow");
    $("#AOC").html("");
    $.post("../php/obtenerClientes.php", {}, function (mensaje) {
        $("#AOC").append(mensaje);
    });

    var container = "#MPO";
    $(container).html("");
    $.post("../php/obtenerUsers.php", {}, function (mensaje) {
        var usuarios = mensaje.split("-");
        for (var i = 1; i <= usuarios[0]; i++) {
            var aux = usuarios[i].split(",");
            var contenido = $(container).html();
            $(container).html(contenido + "<a class=\"dropdown-item\" href=\"" + "../php/cambiarPermisos.php?user=" + aux[0] + "\" target=\"_blank\">" + aux[1] + "</a>");
        }
        $(".loader").fadeOut("slow");

    });
}

function autorizar_edit(id, tipo) {
    $.post("../php/autorizar_edit.php", {
        id: id,
        tipo: tipo,
    }, function (mensaje) {
        if (mensaje == 1) {
            alert('Edición autorizada satisfactoriamente.');
            location.reload();
        }
        else if (mensaje == 2) {
            alert('Vuelva a iniciar sesión para continuar.');
            location.reload();
        }
        else {
            alert('Hubo un problema al realizar la operación, vuelva a intentar.');
            location.reload();
        }
    });
}

function llenar_inactivos() {
    $(".loader").fadeIn("slow");
    $("#llenar_inactivos").html("");
    $.post("../php/obtenerInactivos.php", {}, function (mensaje) {
        $("#llenar_inactivos").append(mensaje);
    });
    $(".loader").fadeOut("slow");
}

function llenar_edicion() {
    $(".loader").fadeIn("slow");
    $("#llenar_iediciones").html("");
    $.post("../php/obtenerSolId.php", {}, function (mensaje) {
        $("#llenar_iediciones").append(mensaje);
    });
    $(".loader").fadeOut("slow");

}

$("#btn-registrar").click(function () {
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
        $.post("../php/create_User.php", { usuario: us, password: passw, nombre: name }, function (mensaje) {
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

$("#CrearU").click(function () {
    $("div.active").hide("active");
    $(".active").removeClass("active");
    $("#PcrearU").addClass("active");
    // $("#containerRegister").addClass("fondo");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");
    $("#containerli").css("display", "block");

    if ($("#containerRegister").css("display") == "none") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "block");
        });
    }
    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }

    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }

    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
});

$("#CrearU1").click(function () {
    $("div.active").hide("active");
    $(".active").removeClass("active");
    $("#PcrearU").addClass("active");
    // $("#containerRegister").addClass("fondo");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");
    $("#containerli").css("display", "block");

    if ($("#containerRegister").css("display") == "none") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "block");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }

    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
});

$("#ControlU").click(function () {
    $("div.active").hide("active");
    $(".active").removeClass("active");
    $("#PcrearU").addClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");
    $("#containerli").css("display", "block");


    if ($("#containerControl").css("display") == "none") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", "block");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
    llenar_control("Historial_Usuario.php", "Control");
});

$("#CambiarP").click(function () {
    $("div.active").hide("active");
    $(".active").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcrearU").addClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");
    $("#containerli").css("display", "block");

    if ($("#containerCP").css("display") == "none") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "block");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }
    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
    llenar_control("Control_Passwords.php", "CP");
});

$("#ControlP").click(function () {
    $("div.active").hide("active");
    $(".active").removeClass("active");
    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").addClass("active");
    $("#GenerarR").removeClass("active");
    $("#containerli").css("display", "none");


    if ($("#containerPO").css("display") == "none") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "block");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
    llenar_menus();

    llenar_edicion();
});

$("#GenerarR").click(function () {
    $("div.active").hide("active");
    $("#containerli").css("display", "none");
    $(".active").removeClass("active");

    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").addClass("active");

    if ($("#containerPO").css("display") == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerPO").css("display") == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "none") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "block");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }
    llenar_menus();
});

//nuevo panel de aministracion
$("#ControlI").click(function () {
    $("div.active").hide("active");
    $("#containerli").css("display", "none");
    $(".active").removeClass("active");

    $("#PcrearU").removeClass("active");
    $("#PcontrolU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#ControlI").addClass("active");


    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerPO").css("display") == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });
    }

    if ($("#containerControl").css('display') == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });

    }
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", "none");
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }
    if ($("#containerInac").css('display') == "none") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "block");
        });

    }
    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }

    llenar_inactivos();

});

$("#btn-b").click(function () {
    var msx = $("#input_BP").val();
    $(".search").fadeIn("slow");
    $.post('../php/buscar_clientes.php', { busqueda: msx }, function (msj) {
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
            setTimeout(function () { $("#snackbar").removeClass('show'); }, 5000);
        }
    });
});

$("#AsignarOBC").click(function () {
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

$("#generarReporte").click(function (event) {
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

$("#generarReporte2").click(function (event) {
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

$("#generarReporteCNG").click(function (event) {
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

function R3generar(type, user) {
    window.open('../php/reporte__cng.php?user=' + user + '&type=' + type + '&report=cng');
}

$(function () {
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
    }, function (start, end, label) {
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
    }, function (start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
});

$("#ecr").click(function () {
    window.open('eliminar_clientes.php');
});

//28072021
$("#ControlEscalas").click(function () {
    $('.active').removeClass('active');
    if ($("#containerEscalasUsuario").css("display") == "none") {
        $("#containerEscalasUsuario").toggle("slow", function () {
            $("#containerEscalasUsuario").css("display", "block");
        });
    }

    $("#containerEscalasUsuario").addClass("active");

    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerControl").css("display") == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", "none");
        });
    }

    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }

    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }
    if ($("#containerInac").css('display') == "block") {
        $("#containerInac").toggle("slow", function () {
            $("#containerInac").css("display", "none");
        });

    }
    if ($("#containerTira").css("display") == "block") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "none");
        });
    }

});

function mostrarEscalas(idoperador) {
    if (idoperador == "") return;
    operador_escala = idoperador;
    $.post("../php/obtenerEscalasOperador.php", { idoperador: idoperador }, function (data) {
        data = JSON.parse(data);

        if (!data.error) {
            $('#div_escalas').show();
            if (data.filas > 0) {

                for (let i = 0; i < data.escalas.length; i++) {
                    let escala = data.escalas[i];
                    $('#txt_escala_' + escala.id).val(escala.numero);
                }
            }

        }
        else {
            alert(data.msj);
        }

    });

}

$('#bt_guardar_escalas').click(function () {

    console.log('save escalas id:' + operador_escala);
    let arr_ids = [];
    let arr_vals = [];
    let v_anterior = 0;
    $('.txt_escala').each(function () {
        let v = parseFloat($(this).val());
        if (v <= v_anterior) {
            console.log('error val');
            alert('El valor superior no puede ser igual o menor al anterior');
            arr_ids = [];
            arr_vals = [];
            console.log(arr_ids);
            console.log(arr_vals);
            return;
        }
        else {
            v_anterior = v;

            arr_ids.push($(this).data('id'));
            arr_vals.push(v);
        }
    });
    console.log(arr_vals);
    $.post("../php/guardarEscalasOperador.php", { ids: arr_ids, valores: arr_vals, idoperador: operador_escala }, function (data) {
        data = JSON.parse(data);
        alert(data.msj);
        if (!data.error) {
            location.reload();

        }
    });


});

function mostrarTiempoTira(val) {
    if (val == 0) {
        $("#tiempo_tira").show();
    }
    else {
        $("#tiempo_tira").hide();
    }
}

$("#bt_guardar_tira").click(function () {
    let opc_permanente = $("#sel_opcion_tira").val();
    let minutos = $("#txt_minutos_tira").val();
    let mensaje = $("#text_mensaje").val();
    console.log('m:' + mensaje);
    if (opc_permanente == '') return;
    if (opc_permanente == 0) {
        if (isNaN(minutos)) {
            alert('Debe ingresar minutos');
            return;
        }

    }
    $.post("../php/guardarTiraInformativa.php", { tira_permanente: opc_permanente, minutos: minutos, mensaje: mensaje, guardar: $("#guardar_ti").val() }, function (data) {
        data = JSON.parse(data);
        alert(data.msj);
        if (!data.error) {
            location.reload();

        }
    });
});

$("#actualizarC").click(function () {
    var idC = $("#ID_clienteM").val();
    var idcpre = $("#idcpre").val();
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


    var provin = $("#provincia_group").val();
    var canto = $("#canton_group").val();
    var parroq = $("#parroquia_group").val();

    var obser1 = $.trim($("#obser_tel_clienteM").val());
    var obser2 = $.trim($("#obser_tel_ofM").val());
    var obser3 = $.trim($("#obser_cel1M").val());
    var obser4 = $.trim($("#obser_cel2M").val());
    var persona1 = $.trim($("#tipo_persona_tel_clienteM").val());
    var persona2 = $.trim($("#tipo_persona_tel_ofM").val());
    var persona3 = $.trim($("#tipo_persona_cel1M").val());
    var persona4 = $.trim($("#tipo_persona_cel2M").val());

    //27072021
    var numerolibre = $("#numerolibreM").val();
    console.log(numerolibre);
    if (nomC == "--CLIENTE REPETIDO--") {
        alert("Eliminar");

        $.post('../php/delete_client.php', {
            id: idC,
        }, function (mensaje) {

            $("#ModalMC").modal('toggle');
            cargar_gestion();

        });
    }
    else {

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
                idpre: idcpre,
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
                obser1: obser1,
                obser2: obser2,
                obser3: obser3,
                obser4: obser4,
                persona1: persona1,
                persona2: persona2,
                persona3: persona3,
                persona4: persona4,
                provin: provin,
                canto: canto,
                parroq: parroq,
                ope: $("#identificador_usuario").html(),
                ic: infoC,
                numerolibre: numerolibre,
            }
            console.log(datapost)
            $.post('../php/actualizarCliente.php', datapost, function (mensaje) {
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

$("#ControlTira").click(function () {
    $('div.active').hide();
    $('.active').removeClass('active');
    if ($("#containerTira").css("display") == "none") {
        $("#containerTira").toggle("slow", function () {
            $("#containerTira").css("display", "block");
        });
    }

    $("#containerTira").addClass("active");

    if ($("#containerControl").css("display") == "block") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", "none");
        });
    }

    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", 'none');
        });

    }
    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });

    }
    if ($("#containerPO").css('display') == "block") {
        $("#containerPO").toggle("slow", function () {
            $("#containerPO").css("display", "none");
        });

    }
    if ($("#containerGR").css('display') == "block") {
        $("#containerGR").toggle("slow", function () {
            $("#containerGR").css("display", "none");
        });

    }



});

//#region Ocultar Pestañas | Modulo Administrador - Menu Usuarios
function hideContainerSubMenu() {
    $("div.active").hide("active");
    $(".active").removeClass("active");

    $("#PcrearU").removeClass("active");
    $("#PcambiarP").removeClass("active");
    $("#ControlP").removeClass("active");
    $("#GenerarR").removeClass("active");

    $("#containerli").css("display", "block");

    //SubMenu
    if ($("#containerRegister").css('display') == "block") {
        $("#containerRegister").toggle("slow", function () {
            $("#containerRegister").css("display", 'none');
        });
    }

    if ($("#containerControl").css('display') == "block" || $("#containerControl").css('display') == "flex") {
        $("#containerControl").toggle("slow", function () {
            $("#containerControl").css("display", 'none');
        });
    }

    if ($("#containerCP").css('display') == "block") {
        $("#containerCP").toggle("slow", function () {
            $("#containerCP").css("display", "none");
        });
    }

    if ($("#containerGrupo").css("display") == "block") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "none");
        });
    }

    if ($("#containerClientes").css("display") == "block") {
        $("#containerClientes").toggle("slow", function () {
            $("#containerClientes").css("display", "none");
        });
    }

    if ($("#containerVClientes").css("display") == "block") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "none");
        });
    }

}
//#endregion


//#region Pestaña Grupos Poblacionales

$("#GruposPoblacionales").click(function () {

    hideContainerSubMenu();

    if ($("#containerGrupo").css("display") == "none") {
        $("#containerGrupo").toggle("slow", function () {
            $("#containerGrupo").css("display", "block");
        });
    }

    goToGruposPoblacionales()

});

function goToGruposPoblacionales() {
    $.post("./Administrador/GruposPoblacionales/getHTMLGruposPoblacionales.php", {}, function (data) {
        $("#containerGrupo").html(data);
    });
}

function borrar_grupo(id) {
    $.post("../php/borrarGrupo.php", { id: id }, function () {
        alert('Grupo eliminado correctamente.');
        goToGruposPoblacionales()
    })
}

function guardar_grupo() {
    var nombre = document.getElementById('name_group').value;
    var provincia = document.getElementById('provincia_group').value;
    var canton = document.getElementById('canton_group').value;
    var parroquia = document.getElementById('parroquia_group').value;
    var comentario = document.getElementById('comentario_group').value;

    if (nombre == '' || provincia == '' || canton == '' || parroquia == '') {
        alert('Verifique que todos los campos fueron llenados.');
    }
    else {
        $.post("../php/guardarGrupo.php", { nombre: nombre, provincia: provincia, canton: canton, parroquia: parroquia, comentario: comentario }, function () {
            alert('Grupo guardado correctamente.');
            $('#n_grupo').modal('toggle');

            goToGruposPoblacionales()

        })
    }
}

function goToEditarMiembrosDeGrupo(id) {
    $.post("./Administrador/GruposPoblacionales/getHTMLEditarMiembros.php", { id: id }, function (data) {
        $("#containerGrupo").html(data);
        qtable = $('#clientes_grupo').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        otable = $('#clientes_libres').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });

        createPopOverAsignarOperador(id)
    });
}

function createPopOverAsignarOperador(id_grupo) {

    $("[data-toggle=popover]").popover({
        html: true,
        container: 'body',
        delay: { 'show': 300 },
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function () {
            var title = $(this).attr("data-popover-content");
            return $(title).children(".popover-heading").html();
        }
    });
    createChecklistInPopOver(id_grupo)
}

function createChecklistInPopOver(id_grupo) {

    $.post("./Administrador/GruposPoblacionales/getCheckListAsignarOperador.php", { id_grupo: id_grupo }, function (data) {
        $("#popoverAsignarOperador").html(data);
    });
}

function setCodigoCliente(codigo) {

    var popover = document.querySelector(".popover.show");

    if (popover != null) {
        if (codigo_cliente != codigo) {
            $("[data-toggle='popover']").popover('hide');
        }
    }

    codigo_cliente = codigo

    var items = document.querySelectorAll(".containerPopover .form-check-input");

    $.post("./Administrador/GruposPoblacionales/getValueCheckListOperador.php", { codigo_cliente: codigo_cliente }, function (response) {
        var data = JSON.parse(response)
        items.forEach(item => {
            item.removeAttribute("checked")
            data.forEach(element => {
                if (element.id_operador == item.value) {
                    item.setAttribute("checked", "")
                }
            });
        });
    });
}

function asignarOperadorACliente(checkbox) {

    var id_operador = checkbox.value

    if (checkbox.checked) {
        $.post("./Administrador/GruposPoblacionales/postAsignarOperadorACliente.php", { id_operador: id_operador, codigo_cliente: codigo_cliente }, function (data) {
        });
    }
    else {
        $.post("./Administrador/GruposPoblacionales/deleteEliminarOperadorACliente.php", { id_operador: id_operador, codigo_cliente: codigo_cliente }, function (data) {
        });
    }
}

function seleccionar_actual(id) {
    let index = actuales.indexOf(id);
    if (index == -1) {
        actuales.push(id);
    }
    else {
        actuales.splice(index, 1);
    }
}

function seleccionar_nuevo(id) {
    let index = nuevos.indexOf(id);
    if (index == -1) {
        nuevos.push(id);
    }
    else {
        nuevos.splice(index, 1);
    }
}

function seleccionar_oper_actual(id) {
    let index = actuales_oper.indexOf(id);
    if (index == -1) {
        actuales_oper.push(id);
    }
    else {
        actuales_oper.splice(index, 1);
    }
}

function seleccionar_operador(id) {
    let index = actuales_oper.indexOf(id);
    if (index == -1) {
        nuevos_oper.push(id);
    }
    else {
        nuevos_oper.splice(index, 1);
    }
}

function qTodos() {
    sele = document.getElementById('qlpage').checked;
    if (sele == true) {
        $(qtable.rows({ page: 'current' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", true);
            let index = actuales.indexOf($this.attr('id'));

            if (index == -1) {
                actuales.push($this.attr('id'));
            }
            else {
                actuales.splice(index, 1);
            }
        });
    }
    else {
        $(qtable.rows({ page: 'current' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", false);

            let index = actuales.indexOf($this.attr('id'));
            if (index == -1) {

            }
            else {
                actuales.splice(index, 1);
            }
        });
    }
}

function qTodosT() {
    sele = document.getElementById('qlall').checked;
    if (sele == true) {
        $(qtable.rows({ page: 'all', search: 'applied' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", true);

            let index = actuales.indexOf($this.attr('id'));

            if (index == -1) {
                actuales.push($this.attr('id'));
            }
            else {
                actuales.splice(index, 1);
            }
        });
    }
    else {
        $(qtable.rows({ page: 'all', search: 'applied' }).nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop("checked", false);

            let index = actuales.indexOf($this.attr('id'));
            if (index == -1) {

            }
            else {
                actuales.splice(index, 1);
            }
        });
    }
}

async function subir_seleccionados(id) {
    if (nuevos.length == 0) {
        alert('Seleccione algun cliente para agregar.');
    }
    else {
        await $.post("../php/subirGrupo.php", { idgrupo: id, tipo: 1, nuevos: nuevos }, function (data) {
            nuevos = [];
            goToEditarMiembrosDeGrupo(id);
        });
    }
}

function bajar_seleccionados(id) {
    if (actuales.length == 0) {
        alert('Seleccione algun cliente para retirar del grupo.');
    }
    else {
        $.post("../php/bajarGrupo.php", { nuevos: actuales, idgrupo: id, tipo: 1 }, function (data) {
            actuales = [];
            goToEditarMiembrosDeGrupo(id);
        });
    }
}

function subir_operadores(id) {
    if (nuevos_oper.length == 0) {
        alert('Seleccione algun operador para agregar.');
    }
    else {
        $.post("../php/subirGrupo.php", { nuevos: nuevos_oper, idgrupo: id, tipo: 2 }, function (data) {
            nuevos_oper = [];
            goToEditarMiembrosDeGrupo(id);

        });
    }
}

function bajar_oper(id) {
    if (actuales_oper.length == 0) {
        alert('Seleccione algun cliente para retirar del grupo.');
    }
    else {
        $.post("../php/bajarGrupo.php", { nuevos: actuales_oper, idgrupo: id, tipo: 2 }, function (data) {
            actuales_oper = [];
            goToEditarMiembrosDeGrupo(id);
        });
    }
}
//#endregion


//#region Pestaña Subir Clientes

$("#SubirClientes").click(function () {

    hideContainerSubMenu();

    $("#PcrearU").addClass("active");
    $("#containerClientes").toggle("slow", function () {
        $("#containerClientes").css("display", "block");
    });

});

function goToSubirClientes() {
    $("#subirClientesHistorial").css("display", 'none');
    $("#subirClientesMain").css("display", 'block');
}

function mostrarHistorialArchivosClientes() {
    $("#subirClientesMain").css("display", 'none');
    $("#subirClientesHistorial").css("display", 'block');
}

function eliminarArchivoCliente(id) {
    Swal.fire({
        title: "¿Está seguro de eliminar TODOS los clientes que se subió con este archivo ?",
        icon: "question",
        showDenyButton: true,
        confirmButtonColor: "#0062cc",
        confirmButtonText: "Confirmar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("./Administrador/SubirClientes/eliminarClienteDeArchivo.php", { id: id }, function () {
                Swal.fire("Eliminación Exitosa.", "", "success", 1500);

                Swal.fire({
                    title: 'Eliminación Exitosa.',
                    icon: 'success',
                    timer: '2500'
                }).then(() => {
                    location.reload();
                });
            });
        }
    });
}

//#endregion


//#region Pestaña Ver Clientes Nuevos

$("#VerClientesNuevos").click(function () {

    hideContainerSubMenu();

    if ($("#containerVClientes").css("display") == "none") {
        $("#containerVClientes").toggle("slow", function () {
            $("#containerVClientes").css("display", "block");
        });
    }

    goToClientesNuevos()

});

function eliminarCliente(id) {
    var confird = confirm("¿Esta seguro de eliminar este cliente?, esta acción no puede deshacerse.");
    if (confird == true) {
        $.post("../php/eliminarCliente.php", { id: id }, function () {
            location.reload();
        });
    }
}

function editar_nuevo(id) {
    location.replace("Modulo_Administrador.php?editar_cliente=" + id);
}

function goToClientesNuevos() {
    $("#divRepartirClientes").css("display", 'none');
    $("#divClientesNuevos").css("display", 'block');
}

function goToRepartirClientes() {
    $("#divClientesNuevos").css("display", 'none');
    $("#divRepartirClientes").css("display", 'block');
    getSelectRepartirClientes()
}

function getSelectRepartirClientes() {
    $.post("./Administrador/ClientesNuevos/getSelectGrupoPoblacional.php", function (data) {
        $("#formControlGrupoPoblacional").html(data);
        $("#listGroupRepartirClientes").html("");
    });
}

function getListGroupRepartirClientes() {
    var idGrupoPoblacional = document.getElementById('IdGrupoPoblacional').value;
    var filtroDisponible = document.getElementById('fitro_disponible').value;
    var filtroAsignado = document.getElementById('filtro_asignado').value;


    if (idGrupoPoblacional == "") {
        document.getElementById('fitro_disponible').value = "";
        document.getElementById('filtro_asignado').value = "";
        $("#divFiltroRepartirClientes").css("display", 'none');
        $("#listGroupRepartirClientes").css("display", 'none');
    } else {
        $("#divFiltroRepartirClientes").css("display", 'flex');
        $("#listGroupRepartirClientes").css("display", 'block');

        filtroDisponible = (filtroDisponible == null || filtroDisponible == undefined) ? "" : filtroDisponible
        filtroAsignado = (filtroAsignado == null || filtroAsignado == undefined) ? "" : filtroAsignado
        $.post("./Administrador/ClientesNuevos/getHTMLRepartirClientes.php", { id: idGrupoPoblacional, filtro_disponible: filtroDisponible, filtro_asignado: filtroAsignado }, function (data) {
            $("#listGroupRepartirClientes").html(data);
        });
    }
}

function agregarClienteAGrupo(codigo) {

    var idGrupoPoblacional = document.getElementById('IdGrupoPoblacional').value;

    if (!loading) {
        loading = true;
        $.post("./Administrador/ClientesNuevos/postAsignarClienteAGrupo.php", { idcliente: codigo, idgrupo: idGrupoPoblacional, tipo: 1 }, function (data) {
            getListGroupRepartirClientes();
            loading = false;
        });
    }
}

function retirarClienteDeGrupo(codigo) {

    var idGrupoPoblacional = document.getElementById('IdGrupoPoblacional').value;

    if (!loading) {
        loading = true;
        $.post("./Administrador/ClientesNuevos/deleteRetirarClienteDeGrupo.php", { idcliente: codigo, idgrupo: idGrupoPoblacional, tipo: 1 }, function (data) {
            getListGroupRepartirClientes();
            loading = false;
        });
    }
}

//#endregion

