<?php 
include("connect.php");
$total="";
$script="SELECT * FROM `DatosClientes` WHERE 1";

$resultado=mysqli_query($enlace,$script);

while ($fila=mysqli_fetch_array($resultado)) {
	$total=$total.$fila['codigo']."~";
}
//echo $total;
include("QuitDB.php");
echo json_encode($total);


 ?>