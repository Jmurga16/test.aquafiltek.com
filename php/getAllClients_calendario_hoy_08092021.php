<?php
include("connect.php");
$hoy_min = date('Y-m-d 00:00:00');
$hoy_max = date('Y-m-d 23:59:59');
$fin_horario = date('Y-m-d 17:00:00'); //_SESSION
$time_fin_horario = strtotime($fin_horario);
$hoy_actual = date('Y-m-d H:i:s');
$time_actual = strtotime($hoy_actual);
$condicion = "STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') <= '".$hoy_max."' AND 
STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '".$hoy_min."'";
if( $time_actual > $time_fin_horario){
    $condicion = "STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') >= '".$hoy_actual."'";    
}
$script="SELECT primaryk, `codigo`,`coordenadas`, `nombre_completo`,fecha_acepto,hora_acepto FROM `DatosClientes` 
LEFT JOIN Gestion_acepto ON Gestion_acepto.codigo_cliente = DatosClientes.codigo WHERE 
".$condicion." 
ORDER BY STR_TO_DATE(Gestion_acepto.fecha_acepto,'%d/%m/%Y') , Gestion_acepto.hora_acepto  "; //coordenadas
//echo $script; exit(); GROUP BY Gestion_acepto.codigo_cliente
//26062021 actual_gestion=0 AND 
$resultado=mysqli_query($enlace, $script);
$repetidos = [];
while ($fila = mysqli_fetch_array($resultado)) {
    if( trim($fila['codigo']) != "" && !in_array(trim($fila['codigo']), $repetidos) ){
        $repetidos[] = trim($fila['codigo']);
        $int_hora = explode(":",$fila['hora_acepto'])[0];
        echo $fila['codigo']."|".$fila['coordenadas']."|".$fila['nombre_completo']."|".$fila['fecha_acepto']."|".$fila['hora_acepto']."|".$int_hora."="; 
    }
        
}
include("QuitDB.php");
