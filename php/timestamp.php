<?php
include "connect.php";

$get_llamadas = mysqli_query($enlace,"SELECT * FROM llamadasProgramadas");

while($llam = mysqli_fetch_array($get_llamadas))
{

	$fecha = $llam['fecha_llamada'];

	$fecha1 = str_replace('/', '-', $fecha);
	$date = "$fecha1 $llam[hora_llamada]";

	$timestamp = strtotime($date);

	mysqli_query($enlace,"UPDATE llamadasProgramadas SET `timestamp` = $timestamp WHERE id = '$llam[id]'");

}


include "QuitDB.php";
?>