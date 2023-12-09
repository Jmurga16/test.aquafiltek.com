<?php
include 'connect.php';

$cliente = $_POST['cliente'];
$total.='<table class="table table-hover table-striped table-dark">
 <tbody>';

$result = mysqli_query($enlace, "SELECT di.name AS operador , tg.tiempo_total AS tiempo, tg.fecha_gestion AS fecha_gestion,tg.tipo AS tipo FROM `tiempo_gestion` as tg INNER JOIN  `DatosIngreso` as di ON tg.id_cliente='$cliente' AND di.id = tg.id_operador;");

while ($fila = mysqli_fetch_array($result)) {
	$total.= '<tr>
      <td scope="row">Operador: ' . $fila['operador'] . '<br>
      Fecha gestión:' . $fila['fecha_gestion'] . '<br>
      Tiempo gestion: <span>' . $fila['tiempo'] . '</span><br>';

	if ($fila['tipo'] == '0') {
		$total.= '<span class="text-danger"><b>Tiempo sin gestion</b></span>';
	} else {
		$total.= '<span class="text-success"><b>Tiempo aprovechado</b></span>';
	}
	$total.= '<td></tr>';
}
$total.= "</tbody></table>";
include 'QuitDB.php';



echo json_encode($total);

?>


   