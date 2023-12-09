<?php
include("connect.php");

error_reporting(0);

$nombres=explode(" ", $_POST['busqueda']);

$nombre_aux=$nombres[0];



//ofiice phone 
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


$script = "SELECT codigo,nombre_completo FROM `DatosClientes` WHERE celular2 like '%$nombre_aux%'";

for ($i = 1; $i < count($nombres); $i++) {
	$nombre_aux = $nombres[$i];
	$script = $script . " AND celular2 LIKE '%$nombre_aux%'";
}

$resultado = mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
	$total = $total . $fila[0] . "|" . $fila[1] . "~";
	$conta++;
}



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

  echo $conta."~".$total;
include("QuitDB.php");