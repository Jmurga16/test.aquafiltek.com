<?php
include("connect.php");

$codigo = $_POST['codigo'];


$script = "UPDATE `DatosClientes` SET inactivo = 0 WHERE codigo = '$codigo'";

$resultado = mysqli_query($enlace, $script);

$script1 = "DELETE FROM gestion_inactivos WHERE id_cliente = '$codigo'";
$resultado1 = mysqli_query($enlace, $script1);


include "QuitDB.php";
?>