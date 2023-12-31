$(document).ready(function () {
    $('#selectEstadosClientes').on('select2:open', function (e) {
        $('.select2-dropdown--below').addClass('normalLeft');
    });

    $('#selectEstadosClientes').on('select2:select', function (e) {

        //$('#tabla_pg').DataTable().clear().draw();

        getDataTablePorGestionar()

    });

    $('#selectEstadosClientes').on('select2:unselect', function (e) {

        getDataTablePorGestionar()
    });
});

$("#linkPorGestionar").click(function () {

    hideContainers()

    $("#navPorGestionar").addClass("active");

    if ($("#containerPorGestionar").css("display") == "none") {
        $("#containerPorGestionar").toggle("slow", function () {
            $("#containerPorGestionar").css("display", "block");
        });
    }

    getDataTablePorGestionar()
});

async function getDataTablePorGestionar() {
    var estadosSelected = $("#selectEstadosClientes").select2('data')
    var estados = []

    var idUsuario = $("#identificador_usuario").html()

    if (estadosSelected != undefined && estadosSelected.length > 0) {
        estadosSelected.forEach(element => {
            estados.push(element.id)
        });
    }

    if (estados.length > 0) {
        await $.post("../../php/Usuario/PorGestionar/getTablePorGestionarConFiltro.php", { idUsuario: idUsuario, estadosSelected: estados }, function (data) {

            restartDataTablePorGestionar()

            $("#tableBodyPorGestionar").html(data);

            createDataTablePorGestionar()

        });
    }
    else {
        await $.post("../../php/Usuario/PorGestionar/getTablePorGestionar.php", { idUsuario: idUsuario }, function (data) {

            restartDataTablePorGestionar()

            $("#tableBodyPorGestionar").html(data);

            createDataTablePorGestionar()
        });
    }
}

function restartDataTablePorGestionar() {
    if ($.fn.dataTable.isDataTable('#tabla_pg')) {
        table = $('#tabla_pg').DataTable();
        table.clear().destroy();
    }
}

function createDataTablePorGestionar() {

    $('#tabla_pg').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
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


}

