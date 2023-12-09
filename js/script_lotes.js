var container = "#OAC";
var selectedIds;
var opera;

$.post('../php/get_clientes_lote.php', {}, function(response) {
    $("#table_lote tbody").html(response);
    var tbl = $('#table_lote').DataTable({
        columnDefs: [{
            targets: 0,
            data: 1,
            'checkboxes': {
                'selectRow': true
            }
        }],
        select: {
            style: 'multi'
        },
        language: {
            "url": "../Spanish.json"
        },
        order: [
            [1, 'asc']
        ],
        iDisplayLength: 10,
    //     initComplete : function() {
    //     var input = $('.dataTables_filter input').unbind(),
    //         self = this.api(),
    //         $searchButton = $('<button>')
    //                   .text('Search')
    //                   .click(function() {
    //                       self.search(input.val()).draw();
    //                   }),
    //         $clearButton = $('<button>')
    //                   .text('Clear')
    //                   .click(function() {
    //                       input.val('');
    //                       $searchButton.click(); 
    //                   }) 
    //     $('.dataTables_filter').append($searchButton, $clearButton);
    // }            
    });
    $(".loader").fadeOut("slow");

    $("#delete_clients").click(function delete_client() {
        selectedIds = tbl.columns().checkboxes.selected()[0];
        llenar_modal_confirmacion();
        $("#change_operators").html("Espera " + 3 + " segundos...");
        mostrar_modal_confirmacion(2);
    });

});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function llenar_modal_confirmacion() {
    $("#cant_cl").html(selectedIds.length);
   $("#table_confirmacion tbody").html("");
    selectedIds.forEach(function(selectedId) {
        $.post('../php/get_nombre.php', { id: selectedId }, function(message) {
            $("#table_confirmacion tbody").append(message);
        });
    });
}

function mostrar_modal_confirmacion(restante) {
    setTimeout(function() {
        console.log("restante", restante);
        if (restante == 0) {
            $("#change_operators").html("Cambiar operador");
            $("#modal_confirmacion").modal();
        } else {
            $("#change_operators").html("Espera " + restante + " segundos...");
        }
        if (restante > 0) {
            mostrar_modal_confirmacion(restante - 1)
        }
    }, 1000);

}


$("#regresar").click(function() {
    $("#modal_confirmacion").modal('toggle');
});
$("#continuar").click(function(event) {
    $("#modal_confirmacion").modal('toggle');
         selectedIds.forEach(function(selectedId) {
            $.post("../php/delete_client.php", { id: selectedId}, function(mensaje) {
              console.log('MENSAJE', mensaje)
                if (mensaje != 1) {
                    alert("Hubo un error eliminando los clientes, por favor recarga la pagina.\n si el problema persiste contacta al desarrollador y dale este codigo de error:\n\n" + mensaje);
                    return;
                }
            });
        });
        alert("Los clientes han sido eliminados satisfactoriamente.");
       location.reload();
});
