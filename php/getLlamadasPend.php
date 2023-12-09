<?php
include "connect.php";
session_start();

$identificador= $_SESSION['ide'];

$fecha = new DateTime();
$ahora = $fecha->getTimestamp();
$ahora = $ahora-100;
$adelante = $ahora+400;

$script = "SELECT lp.id_cliente,lp.timestamp, lp.fecha_llamada,lp.hora_llamada,dc.coordenadas,dc.nombre_completo, 
STR_TO_DATE(lp.fecha_llamada, '%d/%m/%Y') as fes
FROM llamadasProgramadas AS lp
inner join Clientes_gestionados as cg
inner join DatosClientes as dc
ON lp.id_cliente=cg.id_cliente
AND dc.codigo=lp.id_cliente
AND lp.realizada=0
AND timestamp BETWEEN  '$ahora' and '$adelante'
AND cg.id_operador=$identificador
AND dc.inactivo = 0
ORDER by lp.timestamp desc";

$ejecutar = mysqli_query($enlace,$script);
$filas = mysqli_num_rows($ejecutar);

if($filas == 0)
{
	$data['mostrar'] = 0;
	$data['ahora'] = $ahora;
}
else
{
	$data['mostrar'] = 1;
	$data['data'] = "";
	while($data1 = mysqli_fetch_array($ejecutar))
{
	$data['data'] .= "<tr><td>".$data1['nombre_completo']."</td><td>".$data1['fecha_llamada']."</td><td>".$data1['hora_llamada']."</td><td align=center>
	<input type='button' class='btn btn-success' value='Ir a llamada' onclick=mostrar_llamada('".$data1['id_cliente']."')></td></tr>";
}
}




echo json_encode($data);

include "QuitDB.php";
?>