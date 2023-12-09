<?php
include "connect.php";

$script = "SELECT codigo, nombre_completo, direccion, id_operador, fecha, hora, motivo, tipo_inactivo FROM DatosClientes LEFT JOIN gestion_inactivos on DatosClientes.codigo = gestion_inactivos.id_cliente WHERE inactivo = 1";

$resultado = mysqli_query($enlace, $script);
$total = "";
while ($fila = mysqli_fetch_array($resultado)) {
	$script1 = "SELECT `user` from DatosIngreso WHERE id =".$fila['id_operador']."";
	$resultado2 = mysqli_query($enlace,$script1);
	$res = mysqli_fetch_array($resultado2);

	if($fila['tipo_inactivo'] == 1)
	{
		$tipo_in = 'Inactivación normal';
	}
	else if($fila['tipo_inactivo'] == 2)
	{
		$tipo_in = 'Inactivación averiado';
	}
	else if($fila['tipo_inactivo'] == 3)
	{
		$tipo_in = 'Inactivación por rechazo';
	}
	else
	{
		$tipo_in = 'Inactivación';
	}


	$total .= "<tr><td>".$fila['codigo']."</td><td>".$fila['nombre_completo']."</td><td>".$fila['motivo']."</td><td>".$tipo_in."</td><td>".$fila['fecha']." - ".$fila['hora']."</td><td>".$res['user']."</td><td><input type='button' class='btn btn-success' onclick=reactivar_cli('".$fila['codigo']."') value='Reactivar'> <br/><br/><input type='button' class='btn btn-primary' value='Archivar'></td></tr>";

}
echo $total;
include "QuitDB.php";
?>