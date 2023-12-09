<?php
include 'connect.php';
session_start();

if (isset($_POST['cliente'])) {
    $cliente = $_POST['cliente'];
} else {
    $cliente = 'NO_MOSTRAR';
}
$tipo = $_POST['tipo'];
$operador = $_SESSION['ide'];
$tiempo = $_POST['tiempo'];

if ($tipo>0) {
	mysqli_query($enlace, "DELETE FROM `Clientes_gestionados` WHERE id_cliente='$cliente'");
	mysqli_query($enlace, "INSERT INTO `Clientes_gestionados`(`id_operador`, `id_cliente`) VALUES ($operador,'$cliente')");
}
mysqli_query($enlace, "INSERT INTO `tiempo_gestion`(`id_operador`, `id_cliente`, `tiempo_total`, `tipo`) VALUES ($operador,'$cliente','$tiempo','$tipo')");
mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `id_cliente`='NO_MOSTRAR'");
mysqli_query($enlace, "DELETE FROM `tiempo_gestion` WHERE `tiempo_total`='00:00:00'");
include 'QuitDB.php';
