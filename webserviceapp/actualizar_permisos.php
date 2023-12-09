<?php 
include("connect.php");

$id=$_POST['id'];
$permiso=$_POST['puede'];

$script="UPDATE `DatosIngreso` SET `permiso_agregar`= $permiso WHERE `id`=$id";
echo mysqli_query($enlace,$script);
include("QuitDB.php");
 ?>