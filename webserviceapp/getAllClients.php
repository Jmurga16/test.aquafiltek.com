<?php
include("connect.php");

$script="SELECT `codigo`,`coordenadas`, `nombre_completo` FROM `DatosClientes` WHERE actual_gestion=0 ORDER BY coordenadas";
$resultado=mysqli_query($enlace, $script);
$total="";
while ($fila = mysqli_fetch_array($resultado)) {
    $total.=$fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
}
include("QuitDB.php");


echo json_encode($total);
