<?php 
include("connect.php");

$id=$_POST['id'];
$script="SELECT name,permiso_agregar FROM DatosIngreso WHERE id='$id'";

$resultado=mysqli_query($enlace,$script);
$fila = mysqli_fetch_array($resultado);

$total=$fila['name']."|".$fila['permiso_agregar'];
include("QuitDB.php");



echo json_encode($total);
 ?>