<?php 
include("connect.php");

$id = $_POST['codigo'];


$sql = "UPDATE DatosClientes SET deleted = 0 WHERE codigo = '".$id."'";
$ejecutar = mysqli_query($enlace,$sql);


include("QuitDB.php");
 ?>
