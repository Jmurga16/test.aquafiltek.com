<?php
include("connect.php");
$nombres=explode(" ", $_POST['busqueda']);

$nombre_aux=$nombres[0];
$script="SELECT `codigo`,`nombre_completo` FROM DatosClientes WHERE `nombre_completo` LIKE '%$nombre_aux%'";

for ($i=1; $i < count($nombres) ; $i++) {
    $nombre_aux=$nombres[$i];
    $script=$script." AND `nombre_completo` LIKE '%$nombre_aux%'";
}

 $resultado=mysqli_query($enlace, $script);
 $total="";
 $conta=0;
while ($fila = mysqli_fetch_array($resultado)) {
    $total=$total.$fila[0]."|".$fila[1]."~";
    $conta++;
}
  echo $conta."~".$total;
include("QuitDB.php");
