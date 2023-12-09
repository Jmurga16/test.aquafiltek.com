<?php 
include("connect.php");
$busqueda= $_POST['busqueda'];
$nombres=explode(" ", $busqueda);
$cantidad = count($nombres);
$script="SELECT `codigo`,`nombre_completo` FROM DatosClientes LIKE ";
 
$nombre_aux=$nombres[0];
$script=$script." `nombre_completo` LIKE '%$nombre_aux%'";

for ($i=1; $i < $cantidad ; $i++) { 
	$nombre_aux=$nombres[$i];
	$script=$script." AND `nombre_completo` LIKE '%$nombre_aux%'";
}

 $resultado=mysqli_query($enlace,$script);
 $total="";
 $conta=0;
 	while($fila = mysqli_fetch_array($resultado))
	{
		$total=$total.$fila[0]."|".$fila[1]."~";
		$conta++;
	}
	echo $conta."~";
	echo $total;
include("QuitDB.php");
 ?>				