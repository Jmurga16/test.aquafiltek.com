window.onload = function() {
    if (getParameterByName('type') == '437175ba4191210ee004e1d937494d09') { //pdf
        //exportTableToPdf();
    } else if (getParameterByName('type') == 'bf57c906fa7d2bb66d07372e41585d96') {
        //exportTableToExcel('reporte', '');
    }
    $(".history_ge").fadeOut(1000);
}

function exportTableToPdf() {
    var doc = new jsPDF();
    // You can use html:
    doc.autoTable({ styles: { maxCellWidth: 45, minCellWidth: 21 }, html: '#reporte' });
    doc.setFontSize(4);
    if (getParameterByName('report') == 'history') {
        doc.save('reporte-historial.pdf');
    } else if (getParameterByName('report') == 'cng') {
        doc.save('clientes_no_gestionados.pdf');
    } else {
        doc.save('reporte-acepto.pdf');
    }
    $(".history_ge").fadeOut(1500);
    reactivar_actividad();
}

function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    if (getParameterByName('report') == 'history') {
        filename = filename ? filename + '.xls' : 'reporte-historial.xls';
    } else if (getParameterByName('report') == 'cng') {
        filename = filename ? filename + '.xls' : 'clientes_no_gestionados.xls';
    } else {
        filename = filename ? filename + '.xls' : 'reporte-acepto.xls';
    }

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
    $(".history_ge").fadeOut(1000);
    reactivar_actividad();
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}