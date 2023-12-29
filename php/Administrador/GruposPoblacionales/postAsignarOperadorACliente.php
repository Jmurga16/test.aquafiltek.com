<?php
include("../../connect.php");

$id_operador = $_POST['id_operador'];
$codigo_cliente = $_POST['codigo_cliente'];

$query = "INSERT INTO operador_x_cliente (`id_operador`,`codigo_cliente`) VALUES ('$id_operador','$codigo_cliente')";

mysqli_query($enlace, $query);


include("../../QuitDB.php");
?>