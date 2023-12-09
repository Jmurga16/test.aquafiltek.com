<?php
include "connect.php";
 
$busqueda = $_POST['busqueda'];
$nombres = explode(" ", $busqueda);
$nombre_aux =$nombres;
$script = "SELECT codigo,nombre_completo FROM DatosClientes WHERE direccion Like '%$busqueda%' ";
// //techplus lahore
//  for ($i = 1; $i < count($nombres); $i++) {
// 	$nombre_aux = $nombres[$i];
// 	$script = $script . " AND `direccion` LIKE '%$busqueda%' ";
// }

$resultado = mysqli_query($enlace, $script);
$total = "";
$conta = 0;
while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}

// office phone

$script = "SELECT codigo,nombre_completo FROM `DatosClientes` WHERE telefono_oficina like '%$nombre_aux%'";

for ($i = 1; $i < count($nombres); $i++) {
	$nombre_aux = $nombres[$i];
	$script = $script . " AND telefono_oficina LIKE '%$nombre_aux%'";
}

$resultado = mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}

//house phone

$script = "SELECT codigo,nombre_completo FROM `DatosClientes` WHERE telefono like '%$nombre_aux%'";

for ($i = 1; $i < count($nombres); $i++) {
	$nombre_aux = $nombres[$i];
	$script = $script . " AND telefono LIKE '%$nombre_aux%'";
}

$resultado = mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}

//hand phone

$script = "SELECT codigo,nombre_completo FROM `DatosClientes` WHERE celular1 like '%$nombre_aux%'";

for ($i = 1; $i < count($nombres); $i++) {
	$nombre_aux = $nombres[$i];
	$script = $script . " AND celular1 LIKE '%$nombre_aux%'";
}

$resultado = mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}


//hand phone 2

$script = "SELECT codigo,nombre_completo FROM `DatosClientes` WHERE celular2 like '%$nombre_aux%'";

for ($i = 1; $i < count($nombres); $i++) {
	$nombre_aux = $nombres[$i];
	$script = $script . " AND celular2 LIKE '%$nombre_aux%'";
}

$resultado = mysqli_query($enlace, $script);


 // commented to avoid extra two result in client search menu
 
 
//while ($fila = mysqli_fetch_array($resultado)) {
//	$total = $total . $fila[0] . "|" . $fila[1] . "~";
//	$conta++;
//}


echo $conta . "~".$total;
include "QuitDB.php";
?>
