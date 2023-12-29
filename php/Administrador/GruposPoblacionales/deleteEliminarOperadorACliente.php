<?php
include("../../connect.php");

$id_operador = $_POST['id_operador'];
$codigo_cliente = $_POST['codigo_cliente'];

$query = "DELETE FROM operador_x_cliente WHERE `id_operador` = $id_operador AND `codigo_cliente` = '$codigo_cliente'";

mysqli_query($enlace, $query);


include("../../QuitDB.php");
?>