<?php
include "connect.php";
$identificador = $_POST['ide'];
$script = "SELECT * FROM HorariosIngreso WHERE id_operador ='$identificador' ORDER BY STR_TO_DATE(`dia`,'%d/%m/%Y') DESC";

$resultado = mysqli_query($enlace, $script);
mysqli_num_rows($resultado);

$total = mysqli_num_rows($resultado) . "-";
while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[1] . "," . $fila[2] . "," . $fila[3] . "," . $fila[4] . "," . $fila['dia'] . "," . $fila['tiempo_inactivo'] . "," . $fila['tiempo_almuerzo'] . "-";
}
include "QuitDB.php";
//echo $total;


echo json_encode($total);

?>
