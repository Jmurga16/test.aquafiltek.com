<?php 
include("connect.php");
$id=$_POST['if'];

$script="SELECT * FROM `historial_postventa` WHERE codigo='$id'";

$resultado= mysqli_query($enlace,$script);
 
 $fila= mysqli_fetch_array($resultado);

 echo $fila['historial'];
 ?>