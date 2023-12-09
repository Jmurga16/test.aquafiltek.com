<?php
include "connect.php";
$identificador = $_POST['ide'];
$total = '';
/*$script = "SELECT dc.codigo AS id, MAX(ga.fecha_acepto) AS date, dc.nombre_completo AS nombre,dc.coordenadas AS ubicacion
						FROM DatosClientes AS dc
						INNER JOIN Gestion_acepto AS ga
						INNER JOIN Clientes_gestionados as cg
						ON dc.estado='Acepto'
						AND  ga.codigo_cliente =  dc.codigo
						AND cg.id_operador=$identificador
						AND cg.id_cliente = dc.codigo
						AND DATEDIFF(curdate(), STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y'))>0
						GROUP BY dc.codigo, dc.nombre_completo, dc.coordenadas
						ORDER BY dc.coordenadas";*/

$script = "SELECT dc.codigo AS id, MAX(ga.fecha_acepto) AS date, dc.nombre_completo AS nombre,dc.coordenadas AS ubicacion
						FROM DatosClientes AS dc
						INNER JOIN Gestion_acepto AS ga
						INNER JOIN Clientes_gestionados as cg
						ON dc.estado='Acepto'
						AND  ga.codigo_cliente =  dc.codigo
						AND cg.id_cliente = dc.codigo
						AND DATEDIFF(curdate(), STR_TO_DATE(ga.fecha_acepto,'%d/%m/%Y'))>0
						GROUP BY dc.codigo, dc.nombre_completo, dc.coordenadas
						ORDER BY dc.coordenadas";

		//	echo $script;
		//	exit();
$resultado = mysqli_query($enlace, $script);
$total = "<option>Seleccionar Cliente</option>";
while ($fila = mysqli_fetch_array($resultado)) {
 	$total .= "<option value='".$fila['id']."'>" . $fila['nombre'] . " / " . $fila['id'] . "</option>";
}
//echo $total;
include "QuitDB.php";

echo json_encode($total);

?>
