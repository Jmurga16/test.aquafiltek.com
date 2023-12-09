<?php 
include("connect.php");

$id = $_POST['id'];


$sql = "DELETE FROM DatosClientes WHERE codigo = '".$id."'";
$ejecutar = mysqli_query($enlace,$sql);

$sql1 = "DELETE FROM grupo_asignacion WHERE id_cliente = '".$id."'";
$ejecutar1 = mysqli_query($enlace,$sql1);


include("QuitDB.php");
 ?>
