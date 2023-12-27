<?php
include "../../connect.php";

$identificador = $_POST['ide'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


$script = "SELECT * FROM HorariosIngreso WHERE id_operador ='$identificador' AND STR_TO_DATE(`dia`,'%d/%m/%Y') BETWEEN '$startDate' AND '$endDate' ORDER BY STR_TO_DATE(`dia`,'%d/%m/%Y') DESC";

$resultado = mysqli_query($enlace, $script);
mysqli_num_rows($resultado);

$total = mysqli_num_rows($resultado) . "-";
while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[1] . "," . $fila[2] . "," . $fila[3] . "," . $fila[4] . "," . $fila['dia'] . "," . $fila['tiempo_inactivo'] . "," . $fila['tiempo_almuerzo'] . "-";
}
include "../../QuitDB.php";
echo $total;
?>
