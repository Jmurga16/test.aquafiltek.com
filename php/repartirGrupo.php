<?php
error_reporting(0);
include "connect.php";

$total = $_POST['total'];
$repartir = $_POST['repartir'];

$grupos = $_POST['grupos'];

$cant_grupos = count($grupos);

$n_cant = intval($repartir/$cant_grupos);

$fecha = date('Y-m-d');

foreach($grupos AS $val)
{
	$clientes = mysqli_query($enlace,"SELECT * FROM DatosClientes LEFT JOIN grupo_asignacion on DatosClientes.codigo = grupo_asignacion.id_cliente WHERE actualizar_pendiente = 1 AND grupo_asignacion.id_cliente IS NULL LIMIT $n_cant");
	while($cl = mysqli_fetch_array($clientes))
	{
		mysqli_query($enlace,"INSERT INTO grupo_asignacion (`id_cliente`,`id_grupo`,`fecha_asginacion`,`tipo`) VALUES ('".$cl['codigo']."','$val','$fecha',1)");
	}
}

$verif = $total-$n_cant;

if($verif == 0)
{

}
else
{
	$clientes = mysqli_query($enlace,"SELECT * FROM DatosClientes LEFT JOIN grupo_asignacion on DatosClientes.codigo = grupo_asignacion.id_cliente WHERE actualizar_pendiente = 1 AND grupo_asignacion.id_cliente IS NULL LIMIT $verif");
	while($cl = mysqli_fetch_array($clientes))
	{
		mysqli_query($enlace,"INSERT INTO grupo_asignacion (`id_cliente`,`id_grupo`,`fecha_asginacion`,`tipo`) VALUES ('".$cl['codigo']."','".$grupos[$cant_grupos]."','$fecha',1)");
	}
}




?>
