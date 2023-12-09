<?php 
include("connect.php");

$script="SELECT id_tarea_detalle,detalle_tarea FROM tbl_tareas_detalles";

$resultado=mysqli_query($enlace,$script);
mysqli_num_rows($resultado);
$total=mysqli_num_rows($resultado)."-";
	while($fila = mysqli_fetch_array($resultado))
	{
		$total=$total.$fila[0].",".$fila[1]."-";
	}

//echo $total;
include("QuitDB.php");

echo json_encode($total);

 ?>
