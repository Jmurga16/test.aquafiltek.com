<?php
session_start();

$fechaI = $_GET['day1'] . '/' . $_GET['month1'] . '/' . $_GET['year1'];
$fechaF = $_GET['day2'] . '/' . $_GET['month2'] . '/' . $_GET['year2'];
$operador = $_GET['user'];
$orden = $_GET['or'];
$tipo = $_GET['tipo'];
$str_tipo = ($tipo == 'semanal')?'Fechas':'Mes';
$id = (int)$_GET['id'];
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
    <title>Aquafiltek</title>
    <link rel="shortcut icon" href="../img/aquafiltek.png" type="image/x-icon" />
</head>

<body>
        <!-- <div class="history_ge"></div> -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <div class="container">
            <label><?php echo $operador; ?></label>
            <table class="table table-striped table-dark" id="reporte">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" style="min-width:120px"><?php echo $str_tipo; ?></th>
                    <th scope="col">Emoji</th>
                    <th scope="col">Total Gestiones </th>
                    <th scope="col">Aceptó</th>
                    <th scope="col">Inspección</th>
                    <th scope="col">Cobros</th>
                    <th scope="col">Importante</th>
                    <th scope="col">Rechazo</th>
                    <th scope="col">Volver a llamar</th>
                    <th scope="col">No responde</th>
                    <th scope="col">Equivocado</th>
                    <th scope="col">Averiado</th>
                    <th scope="col">Otro</th>
                    
                    </tr>
                </thead>
                <tbody>
<?php
include 'connect.php';
//include 'funciones_reporte.php';
$dia_inicio = (int)explode("-",$arr_rango['start'])[2];
//$query = get_script($fechaI, $fechaF, $operador, $orden);
$mes = 0;
$where = "";
$str_semana_mes = "";
$arr_meses = ["","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
$dia_actual = (int) date("d");
$dia_inicio = 1;

function getStartAndEndDate($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $ret['start'] = $dto->format('Y-m-d');
  $dto->modify('+6 days');
  $ret['end'] = $dto->format('Y-m-d');
  return $ret;
}
if( $tipo == 'semanal'){
    $date = new DateTime();
    $week = $date->format("W");
    $arr_rango =getStartAndEndDate($week,date("Y"));
    $where.=" (fecha BETWEEN '".$arr_rango['start']."' AND '".$arr_rango['end']."' ) ";
    $str_semana_mes=$arr_rango['start']." - ".$arr_rango['end'];
    $dia_inicio = (int)explode("-",$arr_rango['start'])[2];
        
}
else{
    $mes = date("m");
    $anio = date("Y");
    $where.=" YEAR(fecha)=".$anio." AND MONTH(fecha) = ".$mes;
    $mes = (int)$mes;
    $str_semana_mes = $arr_meses[$mes];

    
}
$t_acepto = 0;
	$t_rechazo = 0;
	$t_volver_llamar = 0;
	$t_no_responde = 0;
	$t_otro = 0;
	$t_equivocado = 0;
	$t_averiado = 0;
	$t_inspeccion = 0;
	$t_cobros = 0;
	$t_importante = 0;
    $sql = "SELECT tgd.*,dc.nombre_completo  FROM `tipo_gestiones_dia` AS tgd JOIN 
	 DatosClientes AS dc ON dc.codigo = tgd.usuario_gestionado WHERE tgd.`id_operador`=" . $id." AND ".$where." ORDER BY fecha";
    
	$numero_objetivo = 0;
    $sql_escalas_operador = "SELECT ue.*,e.imagen from usuario_escala as ue JOIN escalas as e ON e.id = ue.escala_id WHERE usuario_id = ".$_SESSION['ide']." ORDER BY escala_id DESC LIMIT 1";
		$result_escalas = mysqli_query($enlace, $sql_escalas_operador);
		if($result_escalas){
		    while ($fila_escala = mysqli_fetch_array($result_escalas)) {
		        $numero_objetivo = $fila_escala['numero'];
		    }
		}
	
    
   
	$result_cont = mysqli_query($enlace, $sql);
    $total = 0;
    //echo $sql;
    if($result_cont){
	while ($data_cont = mysqli_fetch_array($result_cont)) {
	    $total_registros++;
		switch ($data_cont['tipo_gestion']) {
		case 'ac':
			$t_acepto++;
			$total++;
			break;
		case 're':
			$t_rechazo++;
			break;
		case 'vl':
			$t_volver_llamar++;
			break;
		case 'nr':
			$t_no_responde++;
			
			break;
		case 'ot':
			$t_otro++;
			break;
		case 'eq':
			$t_equivocado++;
			break;
		case 'av':
			$t_averiado++;
			break;
		case 'in':
		    $t_inspeccion++; 
		
		case 'co':
		    $t_cobros++; 
		    break;
		case 'vi':
		    $t_importante++; 
		    break;
		    
		}
	}
    }
    else{
        echo mysqli_error($enlace);
    }
    
    $numero = 0;
    //echo "t:".$total."--tr:".$total_registros."---";
    $dias_trabajados = ( $dia_actual - $dia_inicio ) + 1;
    //echo "<br> dt:".$dias_trabajados."-obj diario:".$numero_objetivo."";
    $objetivo_suma = $dias_trabajados *  $numero_objetivo;
    $total = round( ($total / $objetivo_suma )*100, 2 );
    //echo "suma:".$objetivo_suma."---tt:".$total."-----";
    if ($total >= 100) {
			$numero = "10";
		} else if ($total >= 80) {
			$numero = "8";
		} else if ($total >= 60) {
			$numero = "6";
		} else if ($total >= 40) {
			$numero = "4";
		} else if ($total >= 20) {
			$numero = "2";
		}
		else{
		    $numero = 0;
		}


	$str_fila= '
        <tr>
            <th scope="row" style="width:100px">' . $str_semana_mes . '</th>
            <td><img src="../img/emoticonos/'.$numero.'.png" style="width:40px"> </td>
            <td>' . $total_registros . '</td>
            <td>' . $t_acepto . '</td>
            <td>' . $t_inspeccion . '</td>
            <td>' . $t_cobros . '</td>
            <td>' . $t_importante . '</td>
            <td>' . $t_rechazo . '</td>
            <td>' . $t_volver_llamar . '</td>
            <td>' . $t_no_responde . '</td>
            <td>' . $t_equivocado . '</td>
            <td>' . $t_averiado . '</td>
            <td>' . $t_otro . '</td>
        </tr>';

$str_fila = str_replace('%numero%',$numero,$str_fila);
echo $str_fila;
include 'QuitDB.php';
?>
          </tbody>
            </table>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.min.js"></script>
        <script type="text/javascript" src="../js/jsPDF/jspdf.plugin.autotable.js"></script>
        <script type="text/javascript" src="../js/create_pdf.js"></script>
</body>

</html>