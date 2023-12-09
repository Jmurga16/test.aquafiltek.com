<?php
include "connect.php";
session_start();
$identificador = $_POST['ide'];
$mensaje = $_POST['mensaje'];
$operador = $_SESSION['ide'];

$script = "SELECT * FROM historial_postventa WHERE codigo='$identificador'";
$resultado = mysqli_query($enlace, $script);
if (mysqli_num_rows($resultado) != 0) {
	$fila = mysqli_fetch_array($resultado);
	$msj_final = $fila['historial'] . $mensaje;
	$script = "UPDATE `historial_postventa` SET `historial`='$msj_final',`operador`=$operador WHERE  codigo='$identificador'";
	echo mysqli_query($enlace, $script);
} else {
	$script = "INSERT INTO `historial_postventa`(`operador`,`codigo`, `historial`) VALUES ($operador,'$identificador','$mensaje')";
	echo mysqli_query($enlace, $script);
}


mysqli_query($enlace, "DELETE FROM `Clientes_gestionados` WHERE id_cliente='$identificador'");
mysqli_query($enlace, "INSERT INTO `Clientes_gestionados`(`id_operador`, `id_cliente`) VALUES ($operador,'$identificador')");


include "QuitDB.php";
?>