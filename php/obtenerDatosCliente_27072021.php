<?php
include("connect.php");
$idcb=str_replace(' ', '', $_POST['if']);
$total="";

$script="SELECT * FROM `DatosClientes` WHERE codigo='$idcb'";
//echo "'$idcb'";


$resultado=mysqli_query($enlace, $script);
$fila = mysqli_fetch_array($resultado);



$total=$fila[1]."|".$fila[2]."|".$fila[3]."|".$fila[4]."|".$fila[5]."|".$fila[6]."|".$fila[7]."|".$fila[8]."|".$fila[9]."|".$fila[11]
."|".$fila[12]."|".$fila[10]."|".$fila['info_cisterna']."|".$fila[17]."|".$fila[18]."|".$fila[19]."|".$fila[20]."|".$fila[21]."|".$fila[22]."|".$fila[23]."|".$fila[24];

echo $total;
?>
