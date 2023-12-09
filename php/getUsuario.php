<?php 
include("connect.php");

$id=$_POST['id'];
$script="SELECT name,permiso_agregar, permiso_inactivar FROM DatosIngreso WHERE id='$id'";

$resultado=mysqli_query($enlace,$script);
$fila = mysqli_fetch_array($resultado);

echo $fila['name']."|".$fila['permiso_agregar']."|".$fila['permiso_inactivar'];
include("QuitDB.php");
 ?>