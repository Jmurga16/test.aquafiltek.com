<?php
include("../../connect.php");

$codigo_cliente = $_POST['codigo_cliente'];

$script = "SELECT * FROM operador_x_cliente WHERE `codigo_cliente` = '$codigo_cliente'";

$resultado = mysqli_query($enlace, $script);

$myArray = array();

while($row = $resultado->fetch_assoc()) {
    $myArray[] = $row;
}

echo json_encode($myArray);

include("../../QuitDB.php");
?>