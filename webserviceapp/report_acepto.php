<?php
session_start();
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font-Awesome CC -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/styleR.css">
    <link rel="stylesheet" type="text/css" href="../css/styleU.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>

    <br>
        <div class="history_ge"></div>
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <div class="container">
            <table class="table table-striped table-dark" id="reporte">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono 1</th>
                    <th scope="col">Telefono 2</th>
                    <th scope="col">Celular 1</th>
                    <th scope="col">Celular 2</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Hora visita</th>
                    </tr>
                </thead>
                <tbody>
<?php
include 'connect.php';
$fecha = $_GET['day'] . '/' . $_GET['month'] . '/' . $_GET['year'];
$fechaF = $_GET['day2'] . '/' . $_GET['month2'] . '/' . $_GET['year2'];

$query = "SELECT dc.coordenadas ,ga.hora_acepto AS hora,dc.nombre_completo AS name, dc.direccion AS dir, dc.telefono AS te, 
    dc.telefono_oficina AS teo, dc.celular1 AS c1, dc.celular2 AS c2, dc.info_cisterna AS cis, dc.codigo, ga.fecha_acepto AS fecha, df.user AS useriov 
    FROM `Gestion_acepto` AS ga 
    JOIN Clientes_gestionados AS cg
    ON
        cg.id_cliente = ga.codigo_cliente
    JOIN DatosIngreso AS df
    ON
        df.id = cg.id_operador
    INNER JOIN  `DatosClientes` AS dc ON STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y') between STR_TO_DATE('$fecha','%d/%m/%Y') AND STR_TO_DATE('$fechaF','%d/%m/%Y') AND dc.codigo= ga.codigo_cliente 
    ORDER BY dc.coordenadas";

//echo $query;


$result = mysqli_query($enlace, $query);
while ($fila = mysqli_fetch_array($result)) {
	echo '
        <tr>
            <th scope="row">';
   if($_SESSION['TipoUsuario'] == 2){
        echo '<a href="/php/Modulo_Usuario.php?c='.$fila['codigo'].'">'. $fila['name'] .'</a>';
    } else {
        echo $fila['name'];
   } 
    echo '</th>
            <td>' . $fila['dir'] . '</td>
            <td>' . $fila['te'] . '</td>
            <td>';if ($fila['teo'] == '') {echo 'NA';} else {echo $fila['teo'];}
	echo '</td>
            <td>';if ($fila['c1'] == '') {echo 'NA';} else {echo $fila['c1'];}
	echo '</td>
            <td>';if ($fila['c2'] == '') {echo 'NA';} else {echo $fila['c2'];}
	echo '</td>
            <td>';if ($fila['useriov'] == '') {echo 'NA';} else {echo $fila['useriov'];}
	echo '</td>
            <td>' .$fila['fecha']." - ".$fila['hora'] . '
            </td>
        </tr>';
}















?>

          </tbody>
            </table>





            <table class="table table-striped table-success" id="reporte2">
                <thead class="thead-dark">
                    <tr>
                    <th >Operator Period from<?php echo " ".$_REQUEST["day"]."/".$_REQUEST["month"]."/".$_REQUEST["year"]." - ".$_REQUEST["day2"]."/".$_REQUEST["month2"]."/".$_REQUEST["year2"]?></th>
                    <th >Sales</th>
                    </tr>
                </thead>
                <tbody>



            <?php
            
              // echo $query;
   $query1 = "SELECT COUNT(*) as cant, df.user
   FROM `Gestion_acepto` as ga 
   JOIN Clientes_gestionados as cg on cg.id_cliente=ga.codigo_cliente
   join DatosIngreso as df on df.id=cg.id_operador 
   where 
   STR_TO_DATE(ga.fecha_acepto, '%d/%m/%Y') 
   between STR_TO_DATE('$fecha','%d/%m/%Y') 
   AND STR_TO_DATE('$fechaF','%d/%m/%Y') 
   GROUP BY cg.id_operador";
   
  $total=0; 
  //echo $query1;
 // exit();

$result1 = mysqli_query($enlace, $query1);
while ($fila2 = mysqli_fetch_array($result1)) {
    $total=$total+$fila2['cant'];

    echo '</tr>
            <td>' . $fila2['user'] . '</td>
            <td>' . $fila2['cant'] . '</td>           
	</tr>';
}
        



include 'QuitDB.php';

            ?>

<tr>
    <td>Total sales of period:</td>
    <td><?php echo $total; ?></td>
</tr>
</tbody>
 </table>

 <style>

.even{
    background-color: rgba(255,255,255,.05);
}
table.dataTable tbody tr{
    background-color: rgba(255,255,255,.05);
}
.table.dataTable tbody tr{
    background-color: rgba(255,255,255,.05);
}
 </style>


<img src="../img/pdf.png" onclick="exportTableToPdf()" style="cursor:pointer">
<img src="../img/excell.png" onclick="exportTableToExcel('reporte', '')" style="cursor:pointer">












<script>
$(document).ready(function() {

    $('#reporte').DataTable({
        "aoColumnDefs": [
                        {'bSortable': false,'aTargets': [4]},   /*columnas que no filtran*/
                        { "reagrupamiento" : [ "desc"  ], "aTargets" : [1]}, /*orden que muestra resultados*/
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "Todos"] // change per page values here
            ],
            // set the initial value
            "pageLength": -1,
            "order": [
                [0, 'asc']
            ],
            "oLanguage":{"sUrl": "es_VE.txt"}

    });
} );


</script>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.min.js"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.plugin.autotable.js"></script>    
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


        

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


        <script type="text/javascript" src="../js/usuario.js"></script>  
        <script type="text/javascript" src="../js/create_pdf.js"></script>



</body>

</html>