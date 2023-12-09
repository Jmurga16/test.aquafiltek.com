<?php
include("connect.php");
$hoy_min = date('Y-m-d 00:00:00');
$hoy_max = date('Y-m-d 23:59:59');

$script="SELECT primaryk, `codigo`,`coordenadas`, `nombre_completo`,fecha_acepto,hora_acepto FROM `DatosClientes` 
LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE actual_gestion=0 AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '".$hoy_max."' AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '".$hoy_min."' GROUP BY Gestion_acepto.codigo_cliente
ORDER BY Gestion_acepto.primaryk DESC,STR_TO_DATE(Gestion_acepto.fecha_acepto+' '+Gestion_acepto.hora_acepto,'%d/%m/%Y %H:%i:%s')  "; //coordenadas
//echo $script; exit();
$resultado=mysqli_query($enlace, $script);

while ($fila = mysqli_fetch_array($resultado)) {
    if( trim($fila['codigo']) != "" ){
        $int_hora = explode(":",$fila['hora_acepto'])[0];
    echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['fecha_acepto']."|".$fila['hora_acepto']."|".$int_hora."="; 
    }
        
}
include("QuitDB.php");
