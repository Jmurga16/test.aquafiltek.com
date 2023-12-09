<?php
include "connect.php";
 
error_reporting(0);
$busqueda = $_POST['busqueda'];

$script = "SELECT codigo,nombre_completo FROM DatosClientes WHERE Datos_factura Like '%$busqueda%' ";



$resultado = mysqli_query($enlace, $script);
$total = "";
$conta = 0;
while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}




echo $conta . "~".$total;
include "QuitDB.php";
?>
