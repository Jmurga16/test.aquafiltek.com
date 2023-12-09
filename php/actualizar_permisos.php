<?php 
include("connect.php");

$id=$_POST['id'];
$permiso=$_POST['puede'];
$permiso1=$_POST['puede1'];

$script="UPDATE `DatosIngreso` SET `permiso_agregar`= $permiso, `permiso_inactivar`= $permiso1 WHERE `id`=$id";
echo mysqli_query($enlace,$script);
include("QuitDB.php");
 ?>