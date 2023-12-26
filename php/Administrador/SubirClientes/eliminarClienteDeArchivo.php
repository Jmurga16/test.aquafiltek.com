<?php 
include("../../connect.php");

$id = $_POST['id'];


$sql = "UPDATE `Archivos_SubirClientes` SET `Activo` = 0 WHERE `Id` = ".$id."";
$ejecutar = mysqli_query($enlace,$sql);

//$sql2 = "UPDATE `DatosClientes` SET `inactivo` = 1 WHERE `IdArchivo` = ".$id."";
//$ejecutar2 = mysqli_query($enlace,$sql2);

$sql1 = "DELETE FROM DatosClientes WHERE IdArchivo = '".$id."'";
$ejecutar1 = mysqli_query($enlace,$sql1);


//$sql3 = "DELETE FROM grupo_asignacion WHERE id_cliente = '".$id."'";
//$ejecutar3 = mysqli_query($enlace,$sql3);


include("../../QuitDB.php");
 ?>
