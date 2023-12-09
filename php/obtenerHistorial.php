<?php 
include("connect.php");
$id=$_POST['if'];

$script="SELECT * FROM `historial_postventa` 
JOIN DatosIngreso	on  historial_postventa.operador=DatosIngreso.id 
WHERE codigo='$id'";

$resultado= mysqli_query($enlace,$script);
$fila= mysqli_fetch_array($resultado);




$codigo = $_POST['id'];
$sql=" SELECT
tg.`fecha_gestion` AS fecha,
tg.`tipo`,
di.`user` AS operador,
tg.`tiempo_total` AS duracion,
dc.nombre_completo AS cliente
FROM
`tiempo_gestion` AS tg
INNER JOIN `DatosIngreso` AS di
ON
di.`id` = tg.`id_operador` 
INNER JOIN `DatosClientes` AS dc
ON
dc.codigo = tg.id_cliente

WHERE id_cliente='$id' AND tipo=2 order by fecha desc limit 1";

$dataO = mysqli_fetch_array(mysqli_query($enlace,$sql));





 $retorna=$fila['historial']."\n"."Usuario venta: ".$dataO["operador"]." ".$dataO["fecha"]."\n"."Usuario post-venta: ".$fila['user']." ".$fila['hora_realizacion'];



echo $retorna;

 ///echo json_encode($retorna);

 ?>