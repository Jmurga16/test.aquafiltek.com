<?php
include 'connect.php';

$cliente = $_POST['cliente'];
echo '<table class="table table-hover table-striped table-dark">
  <thead>
    <tr>
	<th scope="col">Operador</th>
    <th scope="col">Fecha gestion</th>
      <th scope="col">Tiempo gestion</th>
      <th scope="col"></th>
    </tr></thead><tbody>';

$result = mysqli_query($enlace, "SELECT di.name AS operador , tg.tiempo_total AS tiempo, tg.fecha_gestion AS fecha_gestion,tg.tipo AS tipo FROM `tiempo_gestion` as tg INNER JOIN  `DatosIngreso` as di ON tg.id_cliente='$cliente' AND di.id = tg.id_operador;");

while ($fila = mysqli_fetch_array($result)) {
	echo '<tr>
      <th scope="row">' . $fila['operador'] . '</th>
      <th scope="row">' . $fila['fecha_gestion'] . '</th>
      <td><h5>' . $fila['tiempo'] . '</h5></td>';

	if ($fila['tipo'] == '0') {
		echo '<td class="text-danger"><b>Tiempo sin gestion</b></td>';
	} else {
		echo '<td class="text-success"><b>Tiempo aprovechado</b></td>';
	}
	echo '</tr>';
}
echo "</tbody></table>";
include 'QuitDB.php';
?>