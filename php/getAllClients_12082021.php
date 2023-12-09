<?php
include("connect.php");

$script="SELECT `codigo`,`coordenadas`, `nombre_completo` FROM `DatosClientes` WHERE actual_gestion=0 ORDER BY coordenadas";
$resultado=mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
    if( trim($fila['codigo']) != "" )
    echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."=";
}
include("QuitDB.php");
